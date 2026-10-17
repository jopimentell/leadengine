<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // ===== MÉTRICAS (APENAS ATIVOS) =====
        $totalUsers = User::count();
        $totalProperties = Property::count();
        $totalLeads = Lead::count();
        $totalRevenue = Transaction::where('status', 'paid')->sum('amount') ?? 0;

        // ===== CRESCIMENTO DE USUÁRIOS =====
        $userGrowth = collect(range(5, 0))->map(function ($month) {
            $date = now()->subMonths($month);
            return [
                'month' => $date->format('M'),
                'count' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        });

        // ===== DISTRIBUIÇÃO DE PLANOS =====
        $planDistribution = User::select('plan_type', DB::raw('count(*) as total'))
            ->groupBy('plan_type')
            ->pluck('total', 'plan_type')
            ->toArray();

        // ===== TOP 5 CORRETORES =====
        $topCorretores = User::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->take(5)
            ->get(['id', 'name', 'leads_count']);

        // ===== ÚLTIMOS USUÁRIOS =====
        $recentUsers = User::latest()->take(5)->get();

        // ===== ÚLTIMAS TRANSAÇÕES =====
        $recentTransactions = Transaction::with('user')->latest()->take(5)->get();

        $planLabels = ['Essencial', 'Aceleração', 'Performance'];
        $planData = [
            $planDistribution['essencial'] ?? 0,
            $planDistribution['aceleracao'] ?? 0,
            $planDistribution['performance'] ?? 0,
        ];

        return view('admin.index', compact(
            'totalUsers',
            'totalProperties',
            'totalLeads',
            'totalRevenue',
            'userGrowth',
            'planLabels',
            'planData',
            'topCorretores',
            'recentUsers',
            'recentTransactions'
        ));
    }

    // ===== LISTA DE USUÁRIOS (APENAS ATIVOS) =====
    public function users()
    {
        $users = User::withCount('properties')
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    // ===== LISTA DE IMÓVEIS (APENAS ATIVOS) =====
     public function properties()
    {
        $properties = Property::with('user', 'images')
            ->latest()
            ->paginate(20);

        return view('admin.properties', compact('properties'));
    }

    // ===== LISTA DE TRANSAÇÕES =====
    public function transactions()
    {
        $transactions = Transaction::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.transactions', compact('transactions'));
    }

    // ===== LOGS DO SISTEMA =====
    public function logs()
    {
        $channels = ['app', 'leads', 'auth', 'performance', 'security'];
        $logs = [];

        foreach ($channels as $channel) {
            // Tenta arquivo com data (padrão do daily)
            $file = storage_path("logs/{$channel}-" . now()->format('Y-m-d') . '.log');

            // Fallback para arquivo sem data
            if (!file_exists($file)) {
                $file = storage_path("logs/{$channel}.log");
            }

            if (file_exists($file)) {
                $lines = array_slice(file($file), -30);
                $logs[$channel] = array_reverse($lines);
            } else {
                $logs[$channel] = ['Nenhum log registrado hoje.'];
            }
        }

        return view('admin.logs', compact('logs'));
    }
}
