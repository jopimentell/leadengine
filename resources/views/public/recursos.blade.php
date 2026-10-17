@extends('layouts.app')

@section('title', 'Recursos - Larnex')

@section('content')
<div class="bg-white py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 md:px-8 lg:px-16">
        <h1 class="text-3xl md:text-4xl font-bold text-ink">Recursos do Larnex</h1>
        <p class="text-body text-lg mt-4">Tudo o que você precisa para vender mais imóveis.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="font-semibold text-ink">📱 Vitrine Digital</h3>
                <p class="text-sm text-muted mt-2">Sua página profissional com carrossel, filtros e todos os seus imóveis.</p>
            </div>
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="font-semibold text-ink">🤖 IA para descrições</h3>
                <p class="text-sm text-muted mt-2">Gere descrições incríveis com inteligência artificial.</p>
            </div>
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="font-semibold text-ink">📩 Captura de leads</h3>
                <p class="text-sm text-muted mt-2">Formulários otimizados que convertem visitantes em clientes.</p>
            </div>
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="font-semibold text-ink">📊 Dashboard completo</h3>
                <p class="text-sm text-muted mt-2">Acompanhe leads, visualizações e performance dos seus imóveis.</p>
            </div>
        </div>
    </div>
</div>
@endsection
