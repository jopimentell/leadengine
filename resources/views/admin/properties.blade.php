@extends('layouts.admin')

@section('title', 'Imóveis - Admin')

@section('content')
<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">
    <div class="px-4 py-3 border-b border-hairline flex flex-wrap items-center justify-between gap-2">
        <h2 class="font-semibold text-ink">Todos os Imóveis</h2>
        <div class="flex gap-2">
            <select class="bg-white rounded-pill px-4 py-1.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <option>Todos os status</option>
                <option>Ativo</option>
                <option>Inativo</option>
                <option>Vendido</option>
            </select>
            <button class="bg-primary text-white rounded-pill px-4 py-1.5 text-sm font-semibold hover:bg-primary-active transition-soft">Filtrar</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Imagem</th>
                    <th class="px-4 py-3 font-medium">Título</th>
                    <th class="px-4 py-3 font-medium">Corretor</th>
                    <th class="px-4 py-3 font-medium">Preço</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr class="border-b border-hairline/50 hover:bg-surface-soft/50 transition-soft">
                        <!-- Imagem -->
                        <td class="px-4 py-3">
                            @if($property->images->first())
                                <img src="{{ $property->images->first()->url }}" alt="{{ $property->title }}" class="w-10 h-10 object-cover rounded-lg">
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <!-- Título -->
                        <td class="px-4 py-3 font-medium text-ink">{{ $property->title }}</td>
                        <!-- Corretor -->
                        <td class="px-4 py-3 text-muted">{{ $property->user->name ?? '—' }}</td>
                        <!-- Preço -->
                        <td class="px-4 py-3 font-mono">R$ {{ number_format($property->price, 2, ',', '.') }}</td>
                        <!-- Status -->
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold rounded-pill px-3 py-1
                                {{ $property->status === 'active' ? 'bg-semantic-up/10 text-semantic-up' : '' }}
                                {{ $property->status === 'inactive' ? 'bg-gray-100 text-gray-500' : '' }}
                                {{ $property->status === 'sold' ? 'bg-semantic-down/10 text-semantic-down' : '' }}">
                                {{ ucfirst($property->status) }}
                            </span>
                        </td>
                        <!-- Ações -->
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('public.imovel.detalhe', [$property->user->slug ?? 'admin', $property->slug]) }}" target="_blank" class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button class="btn btn-ghost btn-sm text-muted hover:text-semantic-down transition-soft" onclick="if(confirm('Tem certeza que deseja excluir este imóvel?')) { document.getElementById('delete-form-{{ $property->id }}').submit(); }">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <form id="delete-form-{{ $property->id }}" action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-muted">
                            <i class="fa-solid fa-building text-3xl block mb-2 text-gray-300"></i>
                            Nenhum imóvel cadastrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Paginação -->
<div class="mt-4">
    {{ $properties->links() }}
</div>
@endsection
