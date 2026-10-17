@extends('layouts.dashboard')

@section('title', 'Resumo')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Leads (mês)</span>
            <i class="fa-regular fa-users text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $leadsThisMonth }}</p>
        <span class="text-xs text-muted">Total: {{ $totalLeads }}</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Visualizações</span>
            <i class="fa-regular fa-eye text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $totalViews }}</p>
        <span class="text-xs text-muted">Total de visualizações</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Conversão</span>
            <i class="fa-regular fa-chart-line text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $conversionRate }}%</p>
        <span class="text-xs text-muted">Leads / Visualizações</span>
    </div>

    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between">
            <span class="text-sm text-muted">Imóveis ativos</span>
            <i class="fa-regular fa-building text-primary text-xl"></i>
        </div>
        <p class="text-2xl font-bold text-ink mt-1 font-mono">{{ $activeProperties }}</p>
        <span class="text-xs text-muted">de {{ $totalProperties }} total</span>
    </div>

</div>

<!-- GRÁFICO -->
<div class="bg-white rounded-xl border border-hairline p-4 shadow-soft mb-6">
    <h3 class="font-semibold text-ink text-lg mb-3">Leads por dia (últimos 7 dias)</h3>
    <div class="h-64">
        <canvas id="leadsChart"></canvas>
    </div>
</div>

<!-- ÚLTIMOS LEADS E IMÓVEIS -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Últimos leads -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-ink text-lg">📩 Últimos leads</h3>
            <a href="{{ route('dashboard.leads.index') }}" class="text-sm text-primary hover:underline transition-soft">Ver todos</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted-soft border-b border-hairline">
                        <th class="pb-2 font-medium">Nome</th>
                        <th class="pb-2 font-medium">Imóvel</th>
                        <th class="pb-2 font-medium">Data</th>
                        <th class="pb-2 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLeads as $lead)
                        <tr class="border-b border-hairline/50">
                            <td class="py-2 font-medium text-ink">{{ $lead->lead_name }}</td>
                            <td class="py-2 text-muted truncate max-w-[80px]">{{ $lead->property->title ?? '—' }}</td>
                            <td class="py-2 text-muted">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-2">
                                <span class="text-xs font-semibold rounded-pill px-3 py-1
                                    {{ $lead->status === 'new' ? 'bg-primary/10 text-primary' : '' }}
                                    {{ $lead->status === 'contacted' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $lead->status === 'converted' ? 'bg-semantic-up/10 text-semantic-up' : '' }}">
                                    {{ ucfirst($lead->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-4 text-center text-muted">Nenhum lead capturado ainda.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Últimos imóveis -->
    <div class="bg-white rounded-xl border border-hairline p-4 shadow-soft">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-ink text-lg">🏠 Últimos imóveis</h3>
            <a href="{{ route('dashboard.properties.index') }}" class="text-sm text-primary hover:underline transition-soft">Ver todos</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-muted-soft border-b border-hairline">
                        <th class="pb-2 font-medium">Título</th>
                        <th class="pb-2 font-medium">Preço</th>
                        <th class="pb-2 font-medium">Status</th>
                        <th class="pb-2 font-medium text-center">Leads</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProperties as $property)
                        <tr class="border-b border-hairline/50">
                            <td class="py-2 font-medium text-ink truncate max-w-[120px]">{{ $property->title }}</td>
                            <td class="py-2 font-mono text-ink">R$ {{ number_format($property->price, 2, ',', '.') }}</td>
                            <td class="py-2">
                                <span class="text-xs font-semibold rounded-pill px-3 py-1
                                    {{ $property->status === 'active' ? 'bg-semantic-up/10 text-semantic-up' : '' }}
                                    {{ $property->status === 'inactive' ? 'bg-gray-100 text-gray-500' : '' }}
                                    {{ $property->status === 'sold' ? 'bg-semantic-down/10 text-semantic-down' : '' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </td>
                            <td class="py-2 text-center font-mono text-ink">{{ $property->leads_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-4 text-center text-muted">Nenhum imóvel cadastrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('leadsChart').getContext('2d');
        const leadDays = @json($leadDays);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: leadDays.map(d => d.date),
                datasets: [{
                    label: 'Leads',
                    data: leadDays.map(d => d.count),
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
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#eef0f3' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush

@endsection