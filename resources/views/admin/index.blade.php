@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Cards de métricas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Corretores</span>
            <i class="fa-regular fa-users text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $totalUsers }}</p>
        <span class="text-xs text-muted">Total de usuários</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Imóveis</span>
            <i class="fa-regular fa-building text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $totalProperties }}</p>
        <span class="text-xs text-muted">Total de imóveis</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Leads</span>
            <i class="fa-regular fa-inbox text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $totalLeads }}</p>
        <span class="text-xs text-muted">Total de leads capturados</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Receita (MRR)</span>
            <i class="fa-regular fa-circle-dollar text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
        <span class="text-xs text-muted">Receita recorrente mensal</span>
    </div>

</div>

<!-- Gráficos (2 colunas) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- Crescimento de usuários -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <h3 class="font-semibold text-ink text-lg mb-3">Crescimento de usuários</h3>
        <div class="h-64">
            <canvas id="growthChart"></canvas>
        </div>
    </div>

    <!-- Distribuição de planos (Pie) -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <h3 class="font-semibold text-ink text-lg mb-3">Distribuição de planos</h3>
        <div class="h-64 flex items-center justify-center">
            <canvas id="planChart"></canvas>
        </div>
    </div>

</div>

<!-- Top Corretores e Últimos Usuários -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- Top Corretores (mais leads) -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <h3 class="font-semibold text-ink text-lg mb-3">🏆 Top corretores (mais leads)</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted-soft border-b border-hairline">
                        <th class="pb-2 font-medium">#</th>
                        <th class="pb-2 font-medium">Corretor</th>
                        <th class="pb-2 font-medium text-center">Leads</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topCorretores as $index => $corretor)
                        <tr class="border-b border-hairline/50">
                            <td class="py-2 font-medium text-muted">{{ $index + 1 }}</td>
                            <td class="py-2 font-medium text-ink">{{ $corretor->name }}</td>
                            <td class="py-2 text-center font-mono text-ink">{{ $corretor->leads_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-4 text-center text-muted">Nenhum dado disponível.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Últimos usuários cadastrados -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <h3 class="font-semibold text-ink text-lg mb-3">🆕 Últimos usuários</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted-soft border-b border-hairline">
                        <th class="pb-2 font-medium">Nome</th>
                        <th class="pb-2 font-medium">E-mail</th>
                        <th class="pb-2 font-medium">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers as $user)
                        <tr class="border-b border-hairline/50">
                            <td class="py-2 font-medium text-ink">{{ $user->name }}</td>
                            <td class="py-2 text-muted">{{ $user->email }}</td>
                            <td class="py-2 text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-4 text-center text-muted">Nenhum usuário registrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Últimas transações -->
<div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
    <h3 class="font-semibold text-ink text-lg mb-3">💰 Últimas transações</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline">
                    <th class="pb-2 font-medium">Usuário</th>
                    <th class="pb-2 font-medium">Valor</th>
                    <th class="pb-2 font-medium">Status</th>
                    <th class="pb-2 font-medium">Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $transaction)
                    <tr class="border-b border-hairline/50">
                        <td class="py-2 font-medium text-ink">{{ $transaction->user->name ?? '—' }}</td>
                        <td class="py-2 font-mono text-ink">R$ {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                        <td class="py-2">
                            <span class="text-xs font-semibold rounded-pill px-3 py-1
                                {{ $transaction->status === 'paid' ? 'bg-semantic-up/10 text-semantic-up' : '' }}
                                {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $transaction->status === 'failed' ? 'bg-semantic-down/10 text-semantic-down' : '' }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="py-2 text-muted">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-4 text-center text-muted">Nenhuma transação registrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de crescimento de usuários
        const growthData = @json($userGrowth);
        new Chart(document.getElementById('growthChart'), {
            type: 'line',
            data: {
                labels: growthData.map(d => d.month),
                datasets: [{
                    label: 'Novos usuários',
                    data: growthData.map(d => d.count),
                    borderColor: '#0052ff',
                    backgroundColor: 'rgba(0, 82, 255, 0.05)',
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#0052ff',
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#eef0f3' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Gráfico de distribuição de planos (Pie)
        new Chart(document.getElementById('planChart'), {
            type: 'pie',
            data: {
                labels: @json($planLabels),
                datasets: [{
                    data: @json($planData),
                    backgroundColor: ['#5b616e', '#0052ff', '#0a0b0d'], 
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 20 }
                    }
                },
                cutout: '60%',
            }
        });
    });
</script>
@endpush

@endsection