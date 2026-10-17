@extends('layouts.admin')

@section('title', 'Transações')

@section('content')
<div class="bg-white rounded-xl border border-hairline shadow-soft overflow-hidden">
    <div class="px-4 py-3 border-b border-hairline">
        <h2 class="font-semibold text-ink">Histórico de Transações</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-muted-soft border-b border-hairline bg-surface-soft">
                    <th class="px-4 py-3 font-medium">Data</th>
                    <th class="px-4 py-3 font-medium">Usuário</th>
                    <th class="px-4 py-3 font-medium">Valor</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-hairline/50">
                    <td class="px-4 py-3 text-muted">15/01/2025</td>
                    <td class="px-4 py-3 text-ink">João Silva</td>
                    <td class="px-4 py-3 font-mono">R$ 29,90</td>
                    <td class="px-4 py-3"><span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-0.5">Pago</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft"><i class="fa-solid  fa-receipt"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
