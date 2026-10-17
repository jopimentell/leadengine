<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Métricas básicas
        $totalProperties = $user->properties()->count();
        $activeProperties = $user->properties()->where('status', 'active')->count();
        $totalLeads = $user->leads()->count();
        $totalViews = $user->properties()->sum('views_count');

        // Leads do mês atual
        $leadsThisMonth = $user->leads()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Conversão (leads / visualizações * 100)
        $conversionRate = $totalViews > 0 ? round(($totalLeads / $totalViews) * 100, 2) : 0;

        // Leads por dia (últimos 7 dias)
        $leadDays = collect(range(6, 0))->map(function ($day) use ($user) {
            $date = now()->subDays($day);
            return [
                'date' => $date->format('D'),
                'count' => $user->leads()
                    ->whereDate('created_at', $date->toDateString())
                    ->count(),
            ];
        });

        // Últimos 5 leads
        $recentLeads = $user->leads()
            ->with('property')
            ->latest()
            ->take(5)
            ->get();

        // Últimos 5 imóveis
        $recentProperties = $user->properties()
            ->withCount('leads')
            ->latest()
            ->take(5)
            ->get();

        // Limite de imóveis do plano
        $maxProperties = $user->getMaxPropertiesAllowed();
        $remainingProperties = max(0, $maxProperties - $totalProperties);

        return view('dashboard.index', compact(
            'totalProperties',
            'activeProperties',
            'totalLeads',
            'totalViews',
            'leadsThisMonth',
            'conversionRate',
            'leadDays',
            'recentLeads',
            'recentProperties',
            'maxProperties',
            'remainingProperties'
        ));
    }
}