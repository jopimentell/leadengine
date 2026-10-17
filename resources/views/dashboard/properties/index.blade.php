@extends('layouts.dashboard')

@section('title', 'Meus Imóveis')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-bold text-ink">Meus Imóveis</h1>
    <a href="{{ route('dashboard.properties.create') }}" class="bg-primary text-white rounded-pill px-6 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft">
        <i class="fa-regular fa-plus mr-1"></i> Novo Imóvel
    </a>
</div>

@if(session('success'))
    <div class="bg-semantic-up/10 text-semantic-up text-sm rounded-pill px-4 py-3 mb-4 border border-semantic-up/20">
        <i class="fa-regular fa-circle-check mr-1"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Imagem</th>
                    <th class="px-4 py-3 font-medium">Título</th>
                    <th class="px-4 py-3 font-medium">Preço</th>
                    <th class="px-4 py-3 font-medium">Cidade</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-center">Leads</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr class="border-b border-hairline/50 hover:bg-surface-soft/50 transition-soft">
                        <td class="px-4 py-3">
                            @if($property->images->first())
                                <img src="{{ $property->images->first()->url }}" alt="{{ $property->title }}" class="w-12 h-12 object-cover rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                    <i class="fa-regular fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-ink">{{ $property->title }}</td>
                        <td class="px-4 py-3 font-mono text-ink">R$ {{ number_format($property->price, 2, ',', '.') }}</td>
                        <td class="px-4 py-3 text-muted">{{ $property->city ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold rounded-pill px-3 py-1
                                {{ $property->status === 'active' ? 'bg-semantic-up/10 text-semantic-up' : '' }}
                                {{ $property->status === 'inactive' ? 'bg-gray-100 text-gray-500' : '' }}
                                {{ $property->status === 'sold' ? 'bg-semantic-down/10 text-semantic-down' : '' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center text-ink font-mono">{{ $property->lead_count }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('dashboard.properties.edit', $property->id) }}" class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('public.imovel.detalhe', [auth()->user()->slug, $property->slug]) }}" target="_blank" class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('dashboard.properties.destroy', $property->id) }}" onsubmit="return confirm('Tem certeza que deseja excluir este imóvel?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm text-muted hover:text-semantic-down transition-soft">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-8 text-center text-muted">Nenhum imóvel cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $properties->links() }}
</div>
@endsection