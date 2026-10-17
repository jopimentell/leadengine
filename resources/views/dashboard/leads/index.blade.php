@extends('layouts.dashboard')

@section('title', 'Leads')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-bold text-ink">📩 Leads Capturados</h1>
    <div class="flex gap-2">
        <button class="bg-white text-ink rounded-pill px-4 py-2 text-sm font-medium border border-hairline hover:bg-gray-50 transition-soft">
            <i class="fa-solid  fa-file-csv mr-1"></i> Exportar CSV
        </button>
    </div>
</div>

<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Nome</th>
                    <th class="px-4 py-3 font-medium">Telefone</th>
                    <th class="px-4 py-3 font-medium">Imóvel</th>
                    <th class="px-4 py-3 font-medium">Data</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Tem imóvel?</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                    <tr class="border-b border-hairline/50 hover:bg-surface-soft/50 transition-soft">
                        <td class="px-4 py-3 font-medium text-ink">{{ $lead->lead_name }}</td>
                        <td class="px-4 py-3 text-muted">{{ $lead->lead_phone }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('public.imovel.detalhe', [auth()->user()->slug, $lead->property->slug]) }}" target="_blank"
                               class="text-primary hover:underline transition-soft">{{ $lead->property->title }}</a>
                        </td>
                        <td class="px-4 py-3 text-muted">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold rounded-pill px-3 py-1
                                {{ $lead->status === 'new' ? 'bg-primary/10 text-primary' : '' }}
                                {{ $lead->status === 'contacted' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $lead->status === 'converted' ? 'bg-semantic-up/10 text-semantic-up' : '' }}">
                                {{ ucfirst($lead->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center text-muted">
                            {{ $lead->has_property_to_sell ? 'Sim' : 'Não' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <!-- FORMULÁRIO PARA ATUALIZAR STATUS -->
                            <form action="{{ route('dashboard.leads.update-status', $lead->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                        class="bg-white rounded-pill px-3 py-1.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>Novo</option>
                                    <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Contactado</option>
                                    <option value="converted" {{ $lead->status == 'converted' ? 'selected' : '' }}>Convertido</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-8 text-center text-muted">Nenhum lead capturado ainda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $leads->links() }}
</div>
@endsection
