@extends('layouts.app')

@section('title', 'Larnex - Sua vitrine digital para imóveis')
@section('meta_description', 'Crie sua vitrine digital de imóveis, capture leads e venda mais com o Larnex. Plataforma completa para corretores.')

@section('content')

<!-- ===== HERO ===== -->
<section class="bg-surface-soft py-16 md:py-24 lg:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Texto -->
            <div>
                <span class="bg-surface-strong text-ink text-xs font-semibold uppercase tracking-wider rounded-pill px-4 py-1.5 inline-block mb-4">
                    <i class="fa-solid  fa-star text-primary mr-1"></i> Para corretores
                </span>
                <h1 class="font-display font-normal text-4xl md:text-5xl lg:text-[64px] leading-[1.0] tracking-display-xl text-ink">
                    Sua vitrine digital<br>
                    <span class="text-primary">para imóveis</span>
                </h1>
                <p class="text-body text-lg md:text-xl mt-4 max-w-lg leading-relaxed">
                    Crie sua página profissional, capture leads e gerencie seus imóveis tudo em um só lugar.
                    Simples, rápido e feito para corretores.
                </p>
                <div class="flex flex-wrap gap-3 mt-6">
                    <a href="{{ route('register') }}" class="bg-primary text-white rounded-pill px-8 py-4 text-base font-semibold hover:bg-primary-active transition-soft shadow-soft">
                        <i class="fa-solid  fa-circle-check mr-2"></i> Começar grátis
                    </a>
                    <a href="#recursos" class="bg-white text-ink rounded-pill px-8 py-4 text-base font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                        <i class="fa-solid  fa-circle-play mr-2"></i> Ver recursos
                    </a>
                </div>
                <p class="text-muted text-sm mt-4">
                    <i class="fa-solid  fa-circle-check text-semantic-up mr-1"></i> Sem cartão de crédito. Grátis por 30 dias.
                </p>
            </div>

            <!-- Mockup (placeholder) -->
            <div class="relative flex justify-center lg:justify-end">
                <div class="bg-surface-dark rounded-xl p-6 w-full max-w-lg shadow-soft border border-gray-800">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-3 h-3 bg-[#eef0f3] rounded-full"></div>
                        <div class="w-3 h-3 bg-[#eef0f3] rounded-full"></div>
                        <div class="w-3 h-3 bg-[#eef0f3] rounded-full"></div>
                        <div class="flex-1 text-center text-xs text-white/40 font-mono">larnex.com.br/joao-silva</div>
                    </div>
                    <div class="bg-surface-elevated rounded-xl p-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">JS</div>
                            <div>
                                <div class="text-white text-sm font-semibold">João Silva</div>
                                <div class="text-xs text-on-dark-soft">CRECI 123456</div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-white/5 rounded-lg p-2 text-center">
                                <div class="text-white text-sm font-mono">8</div>
                                <div class="text-[10px] text-on-dark-soft">Imóveis</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-2 text-center">
                                <div class="text-white text-sm font-mono">124</div>
                                <div class="text-[10px] text-on-dark-soft">Leads</div>
                            </div>
                            <div class="bg-white/5 rounded-lg p-2 text-center">
                                <div class="text-white text-sm font-mono">32</div>
                                <div class="text-[10px] text-on-dark-soft">Visitas</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Elemento decorativo -->
                <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-primary/10 rounded-full blur-2xl -z-10"></div>
            </div>

        </div>
    </div>
</section>

<!-- ===== RECURSOS ===== -->
<section id="recursos" class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="bg-surface-strong text-ink text-xs font-semibold uppercase tracking-wider rounded-pill px-4 py-1.5 inline-block mb-3">
                Recursos
            </span>
            <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink">
                Tudo que você precisa para <br class="hidden md:block"><span class="text-primary">vender mais</span>
            </h2>
            <p class="text-body text-lg mt-3 max-w-md mx-auto">
                Ferramentas poderosas para corretores autônomos que querem se destacar.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl border border-hairline p-8 shadow-soft hover:shadow-lg transition-soft">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid  fa-window-maximize text-primary text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg text-ink">Vitrine Digital</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Sua página profissional com carrossel, filtros avançados e todos os seus imóveis organizados.
                </p>
                <a href="#" class="text-primary text-sm font-semibold inline-flex items-center gap-1 mt-3 hover:gap-2 transition-soft">
                    Saiba mais <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl border border-hairline p-8 shadow-soft hover:shadow-lg transition-soft">
                <div class="w-12 h-12 bg-semantic-up/10 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid  fa-user-plus text-semantic-up text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg text-ink">Captura de Leads</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Formulários otimizados que convertem visitantes em clientes. Notificações em tempo real.
                </p>
                <a href="#" class="text-primary text-sm font-semibold inline-flex items-center gap-1 mt-3 hover:gap-2 transition-soft">
                    Saiba mais <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl border border-hairline p-8 shadow-soft hover:shadow-lg transition-soft">
                <div class="w-12 h-12 bg-accent-yellow/20 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid  fa-wand-magic-sparkles text-accent-yellow text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg text-ink">IA para Imóveis</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Gere descrições incríveis com IA, melhore fotos e aumente suas chances de venda.
                </p>
                <a href="#" class="text-primary text-sm font-semibold inline-flex items-center gap-1 mt-3 hover:gap-2 transition-soft">
                    Saiba mais <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ===== PREÇOS ===== -->
<section id="precos" class="py-16 md:py-24 bg-surface-soft">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="bg-surface-strong text-ink text-xs font-semibold uppercase tracking-wider rounded-pill px-4 py-1.5 inline-block mb-3">
                Planos
            </span>
            <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink">
                Escolha o plano ideal para <span class="text-primary">você</span>
            </h2>
            <p class="text-body text-lg mt-3 max-w-md mx-auto">
                Todos os planos incluem <strong>7 dias grátis</strong> para testar sem compromisso.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto items-stretch">

            <!-- PLANO ESSENCIAL -->
            <div class="bg-white rounded-xl border border-hairline p-8 shadow-soft flex flex-col">
                <h3 class="font-semibold text-lg text-ink">Essencial</h3>
                <p class="text-xs text-muted mt-1">Faça você mesmo, no seu ritmo</p>

                <div class="mt-4">
                    <span class="font-display text-3xl font-normal text-ink">R$ 119,99</span>
                    <span class="text-muted text-sm">/mês</span>
                    <p class="text-xs text-muted mt-1">Cobrança mês a mês (12x no ano), sem fidelidade</p>
                    <p class="text-xs text-muted-soft">Total no ano: R$ 1.439,88</p>
                </div>

                <ul class="mt-6 space-y-2 text-sm text-body flex-1">
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Todos os recursos disponíveis</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Página pública personalizável</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Captura de leads ilimitada</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Suporte via WhatsApp</li>
                </ul>

                <a href="{{ route('register') }}" class="mt-6 block text-center bg-white text-ink rounded-pill px-6 py-3 text-base font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                    Experimente 7 dias grátis
                </a>
            </div>

            <!-- PLANO ACELERAÇÃO -->
            <div class="bg-white rounded-xl border border-hairline p-8 shadow-soft flex flex-col">
                <h3 class="font-semibold text-lg text-ink">Aceleração</h3>
                <p class="text-xs text-muted mt-1">Com nosso time para deixar pronto rápido</p>

                <div class="mt-4">
                    <span class="font-display text-3xl font-normal text-ink">R$ 119,99</span>
                    <span class="text-muted text-sm">/mês</span>
                    <p class="text-xs text-primary font-semibold mt-1">+ R$ 499,00 de implantação (pagamento único)</p>
                    <p class="text-xs text-muted-soft">Total no ano: R$ 1.938,88</p>
                </div>

                <ul class="mt-6 space-y-2 text-sm text-body flex-1">
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Todos os recursos disponíveis</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Suporte via WhatsApp</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> Acompanhamento do nosso time</li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> <span><strong>1 treinamento</strong> de 1h via Google Meet</span></li>
                    <li class="flex items-start gap-2"><i class="fa-solid fa-circle-check text-semantic-up mt-0.5"></i> <strong>2 intervenções</strong> no design do site</li>
                </ul>

                <a href="{{ route('register') }}" class="mt-6 block text-center bg-white text-ink rounded-pill px-6 py-3 text-base font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                    Experimente 7 dias grátis
                </a>
            </div>

            <!-- PLANO PERFORMANCE – DESTAQUE -->
            <div class="bg-surface-dark rounded-xl border-2 border-primary p-8 shadow-soft relative flex flex-col">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-semibold uppercase tracking-wider rounded-pill px-4 py-1 whitespace-nowrap">
                    ⭐ Mais Vendido
                </span>

                <h3 class="font-semibold text-lg text-white">Performance</h3>
                <p class="text-xs text-on-dark-soft mt-1">Melhor custo-benefício no ano</p>

                <div class="mt-4">
                    <!-- PREÇO DESTAQUE: 6x R$ 216,32 -->
                    <div class="bg-primary/10 border border-primary/30 rounded-lg p-3 mb-3">
                        <p class="text-xs text-primary font-semibold uppercase tracking-wider">Em até</p>
                        <p class="font-display text-3xl font-normal text-white">
                            6x <span class="text-primary">R$ 216,32</span>
                        </p>
                        <p class="text-xs text-on-dark-soft mt-1">no cartão, sem juros</p>
                    </div>

                    <div class="flex items-baseline gap-2">
                        <span class="font-display text-2xl font-normal text-white">R$ 1.297,90</span>
                        <span class="text-on-dark-soft text-sm">/ano</span>
                    </div>

                    <p class="text-xs text-on-dark-soft line-through mt-2">De R$ 1.938,88</p>
                    <p class="text-xs text-semantic-up font-semibold">
                        <i class="fa-solid fa-gift mr-1"></i>
                        Implantação grátis: economize R$ 499,00
                    </p>
                </div>

                <ul class="mt-6 space-y-2 text-sm text-on-dark-soft flex-1">
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> <strong>Implantação grátis</strong> (R$ 499,00)</li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> <strong>2 treinamentos</strong> de 1h via Google Meet</li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> <strong>3 intervenções</strong> no design do site</li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> <strong>1 ano grátis de Imovelweb</strong></li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> Acompanhamento do nosso time</li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> Todos recursos disponíveis</li>
                    <li class="flex items-start gap-2 text-white"><i class="fa-solid fa-circle-check text-primary mt-0.5"></i> Suporte prioritário via WhatsApp</li>
                </ul>

                <a href="{{ route('register') }}" class="mt-6 block text-center bg-primary text-white rounded-pill px-6 py-3 text-base font-semibold hover:bg-primary-active transition-soft">
                    Experimente 7 dias grátis
                </a>
            </div>

        </div>

        <p class="text-center text-sm text-muted mt-8">
            <i class="fa-regular fa-circle-check text-semantic-up mr-1"></i>
            Todos os planos incluem <strong>7 dias grátis</strong>. Cancele quando quiser, sem multa.
        </p>
    </div>
</section>

<!-- ===== CTA FINAL ===== -->
<section class="bg-surface-dark py-16 md:py-24">
    <div class="max-w-3xl mx-auto text-center px-4 md:px-8 lg:px-16">
        <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-white">
            Pronto para <span class="text-primary">vender mais</span>?
        </h2>
        <p class="text-on-dark-soft text-lg mt-3 max-w-lg mx-auto">
            Junte-se a centenas de corretores que já estão usando o Larnex.
        </p>
        <a href="{{ route('register') }}" class="inline-block mt-6 bg-primary text-white rounded-pill px-10 py-4 text-lg font-semibold hover:bg-primary-active transition-soft shadow-soft">
            <i class="fa-solid  fa-rocket mr-2"></i> Criar conta grátis
        </a>
        <p class="text-on-dark-soft text-sm mt-3">
            <i class="fa-solid  fa-circle-check text-semantic-up mr-1"></i> Sem compromisso. Cancele a qualquer momento.
        </p>
    </div>
</section>

@endsection