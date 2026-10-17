@extends('layouts.dashboard')

@section('title', 'Créditos IA')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">✨ Créditos de IA</h1>

    <div class="bg-white rounded-xl border border-hairline p-6 shadow-soft space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-ink">Seu saldo</h3>
                <p class="text-4xl font-bold text-primary font-mono">{{ $creditsAvailable ?? 12 }}</p>
                <p class="text-sm text-muted">créditos disponíveis</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-muted">Total</p>
                <p class="font-mono text-ink">{{ ($creditsTotal ?? 15) }}</p>
                <p class="text-sm text-muted">Usados: {{ ($creditsUsed ?? 3) }}</p>
            </div>
        </div>

        <hr class="border-hairline">

        <div>
            <h3 class="font-semibold text-ink mb-3">Comprar créditos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="border border-hairline rounded-xl p-4 text-center hover:border-primary transition-soft cursor-pointer">
                    <h4 class="font-bold text-lg">10</h4>
                    <p class="text-sm text-muted">créditos</p>
                    <p class="text-lg font-bold text-ink">R$ 9,90</p>
                    <button class="mt-2 bg-primary text-white rounded-pill px-4 py-1.5 text-xs font-semibold hover:bg-primary-active transition-soft">
                        Comprar
                    </button>
                </div>
                <div class="border border-primary rounded-xl p-4 text-center bg-primary/5 hover:shadow-soft transition-soft cursor-pointer">
                    <h4 class="font-bold text-lg text-primary">50</h4>
                    <p class="text-sm text-muted">créditos</p>
                    <p class="text-lg font-bold text-ink">R$ 39,90</p>
                    <span class="text-xs font-semibold text-primary">Melhor custo-benefício</span>
                    <button class="mt-2 bg-primary text-white rounded-pill px-4 py-1.5 text-xs font-semibold hover:bg-primary-active transition-soft block mx-auto">
                        Comprar
                    </button>
                </div>
                <div class="border border-hairline rounded-xl p-4 text-center hover:border-primary transition-soft cursor-pointer">
                    <h4 class="font-bold text-lg">100</h4>
                    <p class="text-sm text-muted">créditos</p>
                    <p class="text-lg font-bold text-ink">R$ 69,90</p>
                    <button class="mt-2 bg-primary text-white rounded-pill px-4 py-1.5 text-xs font-semibold hover:bg-primary-active transition-soft">
                        Comprar
                    </button>
                </div>
            </div>
        </div>

        <hr class="border-hairline">

        <div>
            <h3 class="font-semibold text-ink mb-3">Histórico de uso</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-muted-soft border-b border-hairline">
                            <th class="pb-2 font-medium">Data</th>
                            <th class="pb-2 font-medium">Descrição</th>
                            <th class="pb-2 font-medium text-right">Créditos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-hairline/50">
                            <td class="py-2">15/01/2025 14:32</td>
                            <td class="py-2">Geração de descrição - "Apartamento Vila Mariana"</td>
                            <td class="py-2 text-right text-semantic-down">-1</td>
                        </tr>
                        <tr class="border-b border-hairline/50">
                            <td class="py-2">14/01/2025 09:15</td>
                            <td class="py-2">Melhoria de imagem - "Casa Jardim"</td>
                            <td class="py-2 text-right text-semantic-down">-2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
