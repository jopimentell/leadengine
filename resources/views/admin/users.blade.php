@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')
<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">

    {{-- Cabeçalho com busca funcional --}}
    <div class="px-4 py-3 border-b border-hairline flex flex-wrap items-center justify-between gap-2">
        <h2 class="font-semibold text-ink">
            Lista de Usuários
            <span class="text-xs text-muted font-normal ml-1">
                ({{ $users->total() }} {{ $users->total() === 1 ? 'registro' : 'registros' }})
            </span>
        </h2>
        <form method="GET" action="{{ route('admin.users') }}" class="flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Buscar nome ou e-mail..."
                   class="bg-white rounded-pill px-4 py-1.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            <button type="submit" class="bg-primary text-white rounded-pill px-4 py-1.5 text-sm font-semibold hover:bg-primary-active transition-soft">
                Buscar
            </button>
        </form>
    </div>

    {{-- Tabela dinâmica --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Nome</th>
                    <th class="px-4 py-3 font-medium">E-mail</th>
                    <th class="px-4 py-3 font-medium">Telefone</th>
                    <th class="px-4 py-3 font-medium">Plano</th>
                    <th class="px-4 py-3 font-medium">Admin</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-center">Imóveis</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b border-hairline/50 hover:bg-surface-soft/50 transition-soft">
                        <td class="px-4 py-3 font-medium text-ink">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-muted">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-muted font-mono text-xs">{{ $user->phone }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs font-semibold rounded-pill px-3 py-0.5
                                {{ $user->plan_type === 'essencial'   ? 'bg-gray-100 text-gray-700' : '' }}
                                {{ $user->plan_type === 'aceleracao'  ? 'bg-primary/10 text-primary' : '' }}
                                {{ $user->plan_type === 'performance' ? 'bg-surface-dark text-white' : '' }}">
                                {{ $user->getPlanLabelAttribute() }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($user->is_admin)
                                <span class="text-xs font-semibold rounded-pill px-2 py-0.5 bg-semantic-down/10 text-semantic-down">Admin</span>
                            @else
                                <span class="text-xs text-muted">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($user->trial_ends_at && $user->trial_ends_at->isFuture())
                                <span class="text-xs font-semibold rounded-pill px-3 py-0.5 bg-yellow-100 text-yellow-700">Trial</span>
                            @else
                                <span class="text-xs font-semibold rounded-pill px-3 py-0.5 bg-semantic-up/10 text-semantic-up">Ativo</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center font-mono text-ink">
                            {{ $user->properties_count ?? $user->properties()->count() }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('public.home', $user->slug) }}" target="_blank"
                                   class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"
                                   title="Ver vitrine pública">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users') }}?q={{ urlencode($user->email) }}"
                                   class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"
                                   title="Filtrar por este e-mail">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-10 text-center text-muted">
                            <i class="fa-solid fa-users text-4xl text-gray-300 block mb-3"></i>
                            Nenhum usuário encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    @if($users->hasPages())
        <div class="px-4 py-3 border-t border-hairline">
            {{ $users->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection