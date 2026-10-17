@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')
<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">
    <div class="px-4 py-3 border-b border-hairline flex flex-wrap items-center justify-between gap-2">
        <h2 class="font-semibold text-ink">Lista de Usuários</h2>
        <div class="flex gap-2">
            <input type="text" placeholder="Buscar usuário..." class="bg-white rounded-pill px-4 py-1.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            <button class="bg-primary text-white rounded-pill px-4 py-1.5 text-sm font-semibold hover:bg-primary-active transition-soft">Buscar</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Nome</th>
                    <th class="px-4 py-3 font-medium">E-mail</th>
                    <th class="px-4 py-3 font-medium">Plano</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-hairline/50">
                    <td class="px-4 py-3 font-medium text-ink">João Silva</td>
                    <td class="px-4 py-3 text-muted">joao@exemplo.com</td>
                    <td class="px-4 py-3"><span class="bg-primary/10 text-primary text-xs font-semibold rounded-pill px-3 py-0.5">Pro</span></td>
                    <td class="px-4 py-3"><span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-0.5">Ativo</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"><i class="fa-solid  fa-eye"></i></button>
                        <button class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"><i class="fa-solid  fa-pen-to-square"></i></button>
                    </td>
                </tr>
                <tr class="border-b border-hairline/50">
                    <td class="px-4 py-3 font-medium text-ink">Maria Santos</td>
                    <td class="px-4 py-3 text-muted">maria@exemplo.com</td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-500 text-xs font-semibold rounded-pill px-3 py-0.5">Free</span></td>
                    <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-pill px-3 py-0.5">Trial</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"><i class="fa-solid  fa-eye"></i></button>
                        <button class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"><i class="fa-solid  fa-pen-to-square"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
