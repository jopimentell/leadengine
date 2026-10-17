@extends('layouts.dashboard')

@section('title', 'Assinatura')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">💳 Assinatura</h1>

    <!-- ===== PLANO ATUAL ===== -->
    @php
        $planLabel = match(auth()->user()->plan_type) {
            'essencial'   => 'Essencial',
            'aceleracao'  => 'Aceleração',
            'performance' => 'Performance',
            default       => ucfirst(auth()->user()->plan_type),
        };
        $planPrice = match(auth()->user()->plan_type) {
            'essencial'   => 'R$ 119,99/mês',
            'aceleracao'  => 'R$ 119,99/mês + R$ 499,00 implantação',
            'performance' => 'R$ 1.297,90/ano (6x R$ 216,32)',
            default       => '—',
        };
    @endphp

    <div class="bg-white rounded-xl border border-hairline p-6 shadow-soft space-y-6">

        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h3 class="font-semibold text-ink">Plano atual</h3>
                <p class="text-2xl font-bold text-primary mt-1">{{ $planLabel }}</p>
                <p class="text-sm text-muted mt-1">{{ $planPrice }}</p>
            </div>
            <span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-1">
                {{ auth()->user()->subscription && auth()->user()->subscription->status === 'active' ? 'Ativo' : 'Trial' }}
            </span>
        </div>

        @if(auth()->user()->subscription)
            <div class="bg-surface-soft rounded-xl p-4 text-sm space-y-1">
                <p>
                    <span class="text-muted">Vencimento:</span>
                    {{ auth()->user()->subscription->current_period_end?->format('d/m/Y') ?? '—' }}
                </p>
                <p>
                    <span class="text-muted">Próxima cobrança:</span>
                    @if(auth()->user()->plan_type === 'essencial')
                        R$ 119,99
                    @elseif(auth()->user()->plan_type === 'aceleracao')
                        R$ 119,99
                    @elseif(auth()->user()->plan_type === 'performance')
                        R$ 216,32 (parcela)
                    @endif
                </p>
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm">
                <p class="text-yellow-700">
                    <i class="fa-regular fa-triangle-exclamation mr-1"></i>
                    Você está no período de teste. Após os 7 dias, escolha um plano para continuar.
                </p>
            </div>
        @endif

        <hr class="border-hairline">

        <!-- ===== MUDAR PLANO ===== -->
        <div>
            <h3 class="font-semibold text-ink mb-3">Mudar plano</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- ESSENCIAL -->
                <div class="border rounded-xl p-5 flex flex-col transition-soft
                            {{ auth()->user()->plan_type === 'essencial' ? 'border-primary bg-primary/5' : 'border-hairline hover:border-primary' }}">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-ink">Essencial</h4>
                        @if(auth()->user()->plan_type === 'essencial')
                            <span class="text-xs font-semibold text-primary bg-primary/10 rounded-pill px-2 py-0.5">Atual</span>
                        @endif
                    </div>
                    <p class="text-xs text-muted mt-1">Faça você mesmo, no seu ritmo</p>

                    <div class="mt-3">
                        <span class="text-xl font-bold text-ink">R$ 119,99</span>
                        <span class="text-xs text-muted">/mês</span>
                    </div>
                    <p class="text-xs text-muted-soft mt-1">Cobrança mês a mês, sem fidelidade</p>

                    <ul class="mt-4 space-y-1.5 text-xs text-body flex-1">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Todos os recursos disponíveis</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Página pública personalizável</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Captura de leads ilimitada</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Suporte via WhatsApp</li>
                    </ul>

                    @if(auth()->user()->plan_type !== 'essencial')
                        <button class="mt-4 bg-white text-ink rounded-pill px-4 py-2 text-xs font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                            Mudar para Essencial
                        </button>
                    @else
                        <button class="mt-4 bg-gray-100 text-muted-soft rounded-pill px-4 py-2 text-xs font-semibold cursor-not-allowed" disabled>
                            Plano ativo
                        </button>
                    @endif
                </div>

                <!-- ACELERAÇÃO -->
                <div class="border rounded-xl p-5 flex flex-col transition-soft
                            {{ auth()->user()->plan_type === 'aceleracao' ? 'border-primary bg-primary/5' : 'border-hairline hover:border-primary' }}">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-ink">Aceleração</h4>
                        @if(auth()->user()->plan_type === 'aceleracao')
                            <span class="text-xs font-semibold text-primary bg-primary/10 rounded-pill px-2 py-0.5">Atual</span>
                        @endif
                    </div>
                    <p class="text-xs text-muted mt-1">Com nosso time para deixar pronto rápido</p>

                    <div class="mt-3">
                        <span class="text-xl font-bold text-ink">R$ 119,99</span>
                        <span class="text-xs text-muted">/mês</span>
                    </div>
                    <p class="text-xs text-primary font-semibold mt-1">+ R$ 499,00 implantação (única)</p>

                    <ul class="mt-4 space-y-1.5 text-xs text-body flex-1">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Todos os recursos disponíveis</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Suporte via WhatsApp</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Acompanhamento do nosso time</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> 1 treinamento de 1h via Google Meet</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> 2 intervenções no design do site</li>
                    </ul>

                    @if(auth()->user()->plan_type !== 'aceleracao')
                        <button class="mt-4 bg-white text-ink rounded-pill px-4 py-2 text-xs font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                            Mudar para Aceleração
                        </button>
                    @else
                        <button class="mt-4 bg-gray-100 text-muted-soft rounded-pill px-4 py-2 text-xs font-semibold cursor-not-allowed" disabled>
                            Plano ativo
                        </button>
                    @endif
                </div>

                <!-- PERFORMANCE (Destaque) -->
                <div class="border-2 rounded-xl p-5 flex flex-col transition-soft relative
                            {{ auth()->user()->plan_type === 'performance' ? 'border-primary bg-primary/5' : 'border-primary bg-white shadow-soft' }}">
                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-[10px] font-bold uppercase tracking-wider rounded-pill px-3 py-1 whitespace-nowrap">
                        ⭐ Mais Vendido
                    </span>

                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-ink">Performance</h4>
                        @if(auth()->user()->plan_type === 'performance')
                            <span class="text-xs font-semibold text-primary bg-primary/10 rounded-pill px-2 py-0.5">Atual</span>
                        @endif
                    </div>
                    <p class="text-xs text-muted mt-1">Melhor custo-benefício no ano</p>

                    <div class="mt-3">
                        <span class="text-xl font-bold text-ink">R$ 1.297,90</span>
                        <span class="text-xs text-muted">/ano</span>
                    </div>
                    <p class="text-xs text-primary font-semibold mt-1">6x R$ 216,32 sem juros</p>
                    <p class="text-xs text-muted-soft line-through">De R$ 1.938,88</p>
                    <p class="text-xs text-semantic-up font-semibold mt-0.5">
                        <i class="fa-solid fa-gift mr-1"></i> Economize R$ 499,00
                    </p>

                    <ul class="mt-4 space-y-1.5 text-xs text-body flex-1">
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> <strong>Implantação grátis</strong> (R$ 499,00)</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> 2 treinamentos de 1h via Google Meet</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> 3 intervenções no design do site</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> 1 ano grátis de Imovelweb</li>
                        <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Suporte prioritário via WhatsApp</li>
                    </ul>

                    @if(auth()->user()->plan_type !== 'performance')
                        <button class="mt-4 bg-primary text-white rounded-pill px-4 py-2 text-xs font-semibold hover:bg-primary-active transition-soft">
                            Mudar para Performance
                        </button>
                    @else
                        <button class="mt-4 bg-gray-100 text-muted-soft rounded-pill px-4 py-2 text-xs font-semibold cursor-not-allowed" disabled>
                            Plano ativo
                        </button>
                    @endif
                </div>

            </div>
        </div>

        <!-- ===== HISTÓRICO DE PAGAMENTOS ===== -->
        @if(auth()->user()->subscription)
            <hr class="border-hairline">
            <div>
                <h3 class="font-semibold text-ink mb-3">Histórico de pagamentos</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-muted-soft border-b border-hairline">
                                <th class="pb-2 font-medium">Data</th>
                                <th class="pb-2 font-medium">Descrição</th>
                                <th class="pb-2 font-medium">Valor</th>
                                <th class="pb-2 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-hairline/50">
                                <td class="py-2 text-muted">{{ now()->format('d/m/Y') }}</td>
                                <td class="py-2 text-ink">Assinatura {{ $planLabel }}</td>
                                <td class="py-2 font-mono text-ink">R$ 119,99</td>
                                <td class="py-2">
                                    <span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-0.5">
                                        Pago
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-b border-hairline/50">
                                <td class="py-2 text-muted">{{ now()->subMonth()->format('d/m/Y') }}</td>
                                <td class="py-2 text-ink">Assinatura {{ $planLabel }}</td>
                                <td class="py-2 font-mono text-ink">R$ 119,99</td>
                                <td class="py-2">
                                    <span class="bg-semantic-up/10 text-semantic-up text-xs font-semibold rounded-pill px-3 py-0.5">
                                        Pago
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- ===== AJUDA ===== -->
        <hr class="border-hairline">
        <div class="text-center">
            <p class="text-sm text-muted">
                Precisa de ajuda para escolher?
                <a href="https://wa.me/5511999999999" target="_blank" class="text-primary font-semibold hover:underline transition-soft">
                    <i class="fa-brands fa-whatsapp mr-1"></i> Fale com nosso time
                </a>
            </p>
        </div>

    </div>
</div>
@endsection