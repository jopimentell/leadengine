@extends('layouts.dashboard')

@section('title', 'Domínio')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">🌐 Domínio</h1>

    <div class="bg-white rounded-xl border border-hairline p-6 shadow-soft space-y-6">

        <div>
            <h3 class="font-semibold text-ink">Seu domínio atual</h3>
            <div class="flex items-center gap-2 mt-2">
                <span class="text-lg font-mono text-ink">{{ auth()->user()->slug }}.larnex.com.br.br</span>
                <span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-0.5">Ativo</span>
            </div>
            <p class="text-sm text-muted mt-1">Esta é a URL pública da sua vitrine.</p>
        </div>

        <hr class="border-hairline">

        <div>
            <h3 class="font-semibold text-ink">Domínio próprio</h3>
            <p class="text-sm text-muted mt-1">Use um domínio personalizado para sua vitrine.</p>

            <div class="flex items-center gap-3 mt-3">
                <input type="text" placeholder="ex: joaoimoveis.com.br"
                       class="flex-1 bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <button class="bg-primary text-white rounded-pill px-6 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft whitespace-nowrap">
                    Verificar
                </button>
            </div>

            <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm">
                <p class="text-yellow-700">
                    <i class="fa-solid  fa-triangle-exclamation mr-1"></i>
                    Para usar um domínio próprio, é necessário um plano <strong>Pro</strong> ou <strong>Black</strong>.
                </p>
                <a href="{{ route('dashboard.settings.subscription') }}" class="text-primary font-semibold hover:underline transition-soft">
                    Alterar plano →
                </a>
            </div>
        </div>

        <hr class="border-hairline">

        <div>
            <h3 class="font-semibold text-ink">Configurações DNS</h3>
            <p class="text-sm text-muted mt-1">Para configurar seu domínio próprio, adicione os seguintes registros DNS:</p>
            <div class="bg-surface-soft rounded-xl p-4 mt-2 font-mono text-sm space-y-1">
                <p><span class="text-muted">Tipo:</span> A <span class="text-muted ml-4">Valor:</span> 192.168.1.1</p>
                <p><span class="text-muted">Tipo:</span> CNAME <span class="text-muted ml-4">Valor:</span> larnex.com.br.br</p>
            </div>
            <p class="text-xs text-muted-soft mt-2">Pode levar até 48 horas para a propagação DNS.</p>
        </div>

    </div>
</div>
@endsection
