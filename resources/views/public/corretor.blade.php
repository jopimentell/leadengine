@extends('layouts.app')

@section('title', $user->name . ' - Imóveis em ' . ($user->city ?? 'todo o Brasil'))
@section('meta_description', 'Encontre imóveis com ' . $user->name . '. ' . $imoveis->total() . ' imóveis disponíveis em ' . ($user->city ?? 'diversas regiões') . '.')

@section('hide-global-header')
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     BANDA 01 — TOP BAR (contato + redes + horário)
     ═══════════════════════════════════════════════════════════ --}}
<div class="bg-surface-dark text-on-dark-soft text-xs">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-2 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1.5">
                <i class="fa-regular fa-clock text-[10px]"></i>
                <span class="hidden sm:inline">Seg–Sex, 8h–18h</span>
                <span class="sm:hidden">8h–18h</span>
            </span>
            <span class="hidden sm:flex items-center gap-1.5">
                <i class="fa-regular fa-location-dot text-[10px]"></i>
                {{ $user->city ?? 'Brasil' }}
            </span>
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:+{{ preg_replace('/\D/', '', $user->phone) }}" class="hover:text-white transition-soft flex items-center gap-1.5">
                <i class="fa-solid fa-phone text-[10px]"></i>
                <span class="hidden sm:inline">{{ $user->phone }}</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank" class="hover:text-white transition-soft">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <a href="#" class="hover:text-white transition-soft">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 02 — TOP NAV (sticky)
     ═══════════════════════════════════════════════════════════ --}}
@include('public.partials.agent-header')

{{-- ═══════════════════════════════════════════════════════════
     BANDA 03 — HERO CARROSSEL (imóvel real como banner)
     ═══════════════════════════════════════════════════════════ --}}
@if($destaques->count() > 0)
<section class="relative bg-surface-dark">
    <div class="swiper heroSwiper h-[480px] md:h-[560px]">
        <div class="swiper-wrapper">
            @foreach($destaques as $imovel)
                <div class="swiper-slide relative">
                    @if($imovel->images->first())
                        <img src="{{ $imovel->images->first()->url }}"
                             alt="{{ $imovel->title }}"
                             class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-gray-800"></div>
                    @endif

                    {{-- Overlay gradiente (apenas para legibilidade) --}}
                    <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(10,11,13,.85) 0%, rgba(10,11,13,.55) 45%, rgba(10,11,13,0) 75%);"></div>

                    {{-- Conteúdo sobreposto --}}
                    <div class="relative h-full max-w-7xl mx-auto px-4 md:px-8 lg:px-16 flex items-center">
                        <div class="max-w-xl">
                            {{-- Badge de status --}}
                            @if($imovel->status === 'active' && $imovel->created_at->diffInDays(now()) < 15)
                                <span class="inline-flex items-center gap-1.5 bg-primary text-white text-xs font-bold rounded-pill px-3 py-1 uppercase tracking-wider">
                                    <i class="fa-solid fa-bolt text-[10px]"></i> Novo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur text-white text-xs font-semibold rounded-pill px-3 py-1 uppercase tracking-wider">
                                    <i class="fa-solid fa-star text-accent-yellow text-[10px]"></i> Destaque
                                </span>
                            @endif

                            {{-- Título --}}
                            <h2 class="font-display font-normal text-3xl md:text-5xl lg:text-[52px] leading-[1.05] tracking-display-lg text-white mt-4">
                                {{ $imovel->title }}
                            </h2>

                            {{-- Endereço --}}
                            <p class="text-on-dark-soft text-sm mt-3 flex items-center gap-2">
                                <i class="fa-regular fa-location-dot"></i>
                                {{ $imovel->neighborhood ?? $imovel->city }}, {{ $imovel->state }}
                            </p>

                            {{-- Preço em mono --}}
                            <div class="mt-5 flex items-baseline gap-3">
                                <span class="font-mono font-medium text-3xl md:text-4xl text-white">
                                    R$ {{ number_format($imovel->price, 2, ',', '.') }}
                                </span>
                                @if($imovel->price_rent)
                                    <span class="text-on-dark-soft text-sm">ou aluguel R$ {{ number_format($imovel->price_rent, 0, ',', '.') }}/mês</span>
                                @endif
                            </div>

                            {{-- Specs --}}
                            <div class="flex items-center gap-5 mt-5 text-on-dark-soft text-sm">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-bed text-xs"></i>
                                    <span class="font-mono">{{ $imovel->bedrooms }}</span> quartos
                                </span>
                                <span class="w-px h-3 bg-white/20"></span>
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-bath text-xs"></i>
                                    <span class="font-mono">{{ $imovel->bathrooms }}</span> banheiros
                                </span>
                                <span class="w-px h-3 bg-white/20"></span>
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-ruler-combined text-xs"></i>
                                    <span class="font-mono">{{ $imovel->area_sqmt ?? '—' }}</span> m²
                                </span>
                            </div>

                            {{-- CTAs --}}
                            <div class="flex flex-wrap gap-3 mt-8">
                                <a href="{{ route('public.imovel.detalhe', [$user->slug, $imovel->slug]) }}"
                                   class="bg-primary text-white rounded-pill px-6 py-3 text-sm font-semibold hover:bg-primary-active transition-soft flex items-center gap-2">
                                    Ver imóvel
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}?text={{ urlencode('Olá! Vi o imóvel "' . $imovel->title . '" no site e gostaria de mais informações. ' . url()->current() . '/' . $imovel->slug) }}"
                                   target="_blank"
                                   class="bg-white text-ink rounded-pill px-6 py-3 text-sm font-semibold hover:bg-gray-100 transition-soft flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Controles --}}
        <div class="swiper-button-next !text-white !bg-white/10 hover:!bg-white/20 !backdrop-blur"></div>
        <div class="swiper-button-prev !text-white !bg-white/10 hover:!bg-white/20 !backdrop-blur"></div>
        <div class="swiper-pagination !bottom-6"></div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     BANDA 04 — SEARCH FLOAT (sobre a base do hero)
     ═══════════════════════════════════════════════════════════ --}}
<div class="bg-surface-soft relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="-mt-8 md:-mt-10 relative z-10">
            <form action="{{ route('public.filtrar', $user->slug) }}" method="POST"
                  class="bg-white rounded-2xl shadow-soft border border-hairline p-3 md:p-4"
                  x-data="filterProperties()">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-2 md:gap-3 items-end">
                    {{-- Busca textual --}}
                    <div class="md:col-span-5">
                        <label class="text-xs font-semibold text-muted uppercase tracking-wider block mb-1.5">Buscar</label>
                        <div class="relative">
                            <i class="fa-regular fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-muted-soft text-sm"></i>
                            <input type="text" x-model="filters.search" placeholder="Bairro, rua ou tipo..."
                                   class="w-full bg-surface-soft rounded-pill pl-10 pr-4 py-3 text-sm border border-transparent focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-soft">
                        </div>
                    </div>

                    {{-- Tipo (visual only – filtro funcional depois) --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold text-muted uppercase tracking-wider block mb-1.5">Tipo</label>
                        <select class="w-full bg-surface-soft rounded-pill px-4 py-3 text-sm border border-transparent focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-soft">
                            <option>Todos</option>
                            <option>Casa</option>
                            <option>Apartamento</option>
                            <option>Terreno</option>
                        </select>
                    </div>

                    {{-- Quartos --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold text-muted uppercase tracking-wider block mb-1.5">Quartos</label>
                        <select x-model="filters.bedrooms"
                                class="w-full bg-surface-soft rounded-pill px-4 py-3 text-sm border border-transparent focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-soft">
                            <option value="any">Qualquer</option>
                            <option value="1">1+</option>
                            <option value="2">2+</option>
                            <option value="3">3+</option>
                            <option value="4+">4+</option>
                        </select>
                    </div>

                    {{-- Preço --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold text-muted uppercase tracking-wider block mb-1.5">Até</label>
                        <input type="number" x-model="filters.max_price" placeholder="R$ 999.999"
                               class="w-full bg-surface-soft rounded-pill px-4 py-3 text-sm border border-transparent focus:outline-none focus:ring-2 focus:ring-primary focus:bg-white transition-soft font-mono">
                    </div>

                    {{-- Botão --}}
                    <div class="md:col-span-1">
                        <button type="submit"
                                class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft flex items-center justify-center">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 05 — TRUST BAR (CRECI + stats + selos)
     ═══════════════════════════════════════════════════════════ --}}
<section class="bg-white border-b border-hairline">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 items-center">

            {{-- CRECI verificado --}}
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-shield-halved text-primary"></i>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase tracking-wider font-semibold">CRECI</p>
                    <p class="font-mono font-semibold text-ink">{{ $user->creci ?? 'Verificado' }}</p>
                </div>
            </div>

            {{-- Imóveis ativos --}}
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-semantic-up/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-building text-semantic-up"></i>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase tracking-wider font-semibold">Imóveis ativos</p>
                    <p class="font-mono font-semibold text-ink text-lg">{{ $imoveis->total() }}+</p>
                </div>
            </div>

            {{-- Avaliação --}}
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-accent-yellow/20 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-star text-accent-yellow"></i>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase tracking-wider font-semibold">Avaliação</p>
                    <p class="font-mono font-semibold text-ink text-lg">4.9<span class="text-muted text-sm">/5</span></p>
                </div>
            </div>

            {{-- Resposta --}}
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-clock text-primary"></i>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase tracking-wider font-semibold">Resposta</p>
                    <p class="font-mono font-semibold text-ink">~15 min</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 06 — SOBRE O CORRETOR (editorial)
     ═══════════════════════════════════════════════════════════ --}}
<section id="sobre" class="bg-surface-soft py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">

            {{-- Foto/avatar grande --}}
            <div class="md:col-span-5">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                         class="w-full aspect-[4/5] object-cover rounded-2xl shadow-soft">
                @else
                    <div class="w-full aspect-[4/5] rounded-2xl bg-gradient-to-br from-primary to-primary-active flex items-center justify-center shadow-soft">
                        <span class="text-white font-display text-[120px] font-normal">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Bio --}}
            <div class="md:col-span-7">
                <span class="inline-block bg-white text-ink text-xs font-semibold uppercase tracking-wider rounded-pill px-4 py-1.5 mb-4">
                    Sobre {{ explode(' ', $user->name)[0] }}
                </span>
                <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink">
                    Seu corretor de confiança em<br>
                    <span class="text-primary">{{ $user->city ?? 'todo o Brasil' }}</span>
                </h2>
                <p class="text-body text-base md:text-lg mt-6 leading-relaxed">
                    Olá! Sou {{ $user->name }}@if($user->creci), corretor credenciado sob o CRECI {{ $user->creci }}@endif.
                    Trabalho ajudando famílias a encontrar o imóvel certo — seja o primeiro apartamento,
                    a casa dos sonhos ou o investimento certeiro.
                </p>
                <p class="text-body text-base mt-4 leading-relaxed">
                    Meu compromisso é com transparência, agilidade e um atendimento humano do primeiro
                    contato até a entrega das chaves.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-hairline">
                    <div>
                        <p class="font-mono font-medium text-2xl md:text-3xl text-ink">{{ $imoveis->total() }}+</p>
                        <p class="text-xs text-muted uppercase tracking-wider mt-1">Imóveis</p>
                    </div>
                    <div>
                        <p class="font-mono font-medium text-2xl md:text-3xl text-ink">10+</p>
                        <p class="text-xs text-muted uppercase tracking-wider mt-1">Anos exp.</p>
                    </div>
                    <div>
                        <p class="font-mono font-medium text-2xl md:text-3xl text-ink">500+</p>
                        <p class="text-xs text-muted uppercase tracking-wider mt-1">Negócios</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 mt-8">
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                       class="bg-semantic-up text-white rounded-pill px-6 py-3 text-sm font-semibold hover:bg-green-700 transition-soft inline-flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp"></i>
                        Falar agora
                    </a>
                    <a href="{{ route('public.sobre', $user->slug) }}"
                       class="bg-white text-ink rounded-pill px-6 py-3 text-sm font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                        Conhecer mais
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 07 — DESTAQUES (carrossel horizontal)
     ═══════════════════════════════════════════════════════════ --}}
@if($destaques->count() > 0)
<section id="destaques" class="bg-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">

        {{-- Section header --}}
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-xs font-semibold text-primary uppercase tracking-wider">Selecionados</span>
                <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink mt-2">
                    Imóveis em destaque
                </h2>
                <p class="text-body mt-2">Escolhidos especialmente para você</p>
            </div>
            <a href="#imoveis" class="text-primary text-sm font-semibold hover:underline transition-soft">
                Ver todos os imóveis <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
            </a>
        </div>

        {{-- Grid de destaques (3-up) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($destaques as $imovel)
                <a href="{{ route('public.imovel.detalhe', [$user->slug, $imovel->slug]) }}"
                   class="group bg-white rounded-2xl border border-hairline overflow-hidden hover:shadow-soft transition-all duration-300">

                    {{-- Foto --}}
                    <div class="aspect-[4/3] bg-gray-200 relative overflow-hidden">
                        @if($imovel->images->first())
                            <img src="{{ $imovel->images->first()->url }}" alt="{{ $imovel->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif

                        {{-- Badge --}}
                        <span class="absolute top-3 left-3 bg-primary text-white text-[10px] font-bold uppercase tracking-wider rounded-pill px-3 py-1">
                            Destaque
                        </span>

                        {{-- Contador de fotos --}}
                        @if($imovel->images->count() > 1)
                            <span class="absolute bottom-3 right-3 bg-black/60 backdrop-blur text-white text-xs font-medium rounded-pill px-2.5 py-1 flex items-center gap-1">
                                <i class="fa-regular fa-camera text-[10px]"></i>
                                {{ $imovel->images->count() }}
                            </span>
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="p-5">
                        <h3 class="font-semibold text-ink text-base leading-snug line-clamp-2 group-hover:text-primary transition-colors">
                            {{ $imovel->title }}
                        </h3>
                        <p class="text-muted text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-regular fa-location-dot text-[10px]"></i>
                            {{ $imovel->neighborhood ?? $imovel->city }}, {{ $imovel->state }}
                        </p>

                        <p class="font-mono font-medium text-xl text-ink mt-3">
                            R$ {{ number_format($imovel->price, 2, ',', '.') }}
                        </p>

                        <div class="flex items-center gap-3 mt-3 pt-3 border-t border-hairline-soft text-xs text-body">
                            <span><span class="font-mono font-medium text-ink">{{ $imovel->bedrooms }}</span> quartos</span>
                            <span class="text-hairline">·</span>
                            <span><span class="font-mono font-medium text-ink">{{ $imovel->bathrooms }}</span> banh.</span>
                            <span class="text-hairline">·</span>
                            <span><span class="font-mono font-medium text-ink">{{ $imovel->area_sqmt ?? '—' }}</span> m²</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════
     BANDA 08 — MID-PAGE BANNER (promocional)
     ═══════════════════════════════════════════════════════════ --}}
<section class="bg-surface-soft py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="relative rounded-2xl overflow-hidden h-[280px] bg-surface-dark">
            {{-- Foto de fundo (usa a primeira imagem como exemplo) --}}
            @if($destaques->first() && $destaques->first()->images->first())
                <img src="{{ $destaques->first()->images->first()->url }}" alt=""
                     class="absolute inset-0 w-full h-full object-cover opacity-50">
            @endif

            {{-- Overlay --}}
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(10,11,13,.9) 0%, rgba(10,11,13,.5) 50%, rgba(10,11,13,.1) 100%);"></div>

            {{-- Conteúdo --}}
            <div class="relative h-full flex items-center px-8 md:px-12">
                <div class="max-w-md">
                    <span class="inline-block bg-primary text-white text-[10px] font-bold uppercase tracking-wider rounded-pill px-3 py-1 mb-3">
                        Oportunidade
                    </span>
                    <h3 class="font-display font-normal text-2xl md:text-3xl text-white leading-tight">
                        Não encontrou o que procura?
                    </h3>
                    <p class="text-on-dark-soft text-sm mt-2">
                        Fale comigo e vou procurar o imóvel ideal para você — sem compromisso.
                    </p>
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                       class="mt-5 inline-flex items-center gap-2 bg-white text-ink rounded-pill px-6 py-3 text-sm font-semibold hover:bg-gray-100 transition-soft">
                        <i class="fa-brands fa-whatsapp text-semantic-up"></i>
                        Falar no WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 09 — BENTO DE TIPOS
     ═══════════════════════════════════════════════════════════ --}}
<section id="tipos" class="bg-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">

        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-xs font-semibold text-primary uppercase tracking-wider">Explore</span>
                <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink mt-2">
                    Busque por tipo de imóvel
                </h2>
            </div>
        </div>

        {{-- Bento grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            {{-- Célula grande --}}
            <div class="col-span-2 row-span-2 rounded-2xl overflow-hidden bg-surface-dark relative group cursor-pointer min-h-[320px]">
                @if($imoveis->first() && $imoveis->first()->images->first())
                    <img src="{{ $imoveis->first()->images->first()->url }}" alt="Casa"
                         class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-500">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <i class="fa-solid fa-house text-white text-2xl mb-3"></i>
                    <h3 class="font-display font-normal text-2xl text-white">Casas</h3>
                    <p class="text-on-dark-soft text-sm mt-1">Imóveis residenciais completos</p>
                </div>
            </div>

            {{-- Célula média --}}
            <div class="col-span-2 rounded-2xl overflow-hidden bg-surface-dark relative group cursor-pointer min-h-[152px]">
                <div class="absolute inset-0 bg-gradient-to-br from-primary to-primary-active"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5">
                    <i class="fa-solid fa-building text-white text-xl mb-2"></i>
                    <h3 class="font-display font-normal text-xl text-white">Apartamentos</h3>
                    <p class="text-white/70 text-xs mt-1">Praticidade e localização</p>
                </div>
            </div>

            {{-- Célula pequena --}}
            <div class="rounded-2xl overflow-hidden bg-surface-strong relative group cursor-pointer min-h-[152px] p-5 flex flex-col justify-end">
                <i class="fa-solid fa-tree text-semantic-up text-xl mb-2"></i>
                <h3 class="font-display font-normal text-lg text-ink">Terrenos</h3>
                <p class="text-muted text-xs mt-1">Para construir</p>
            </div>

            {{-- Célula pequena --}}
            <div class="rounded-2xl overflow-hidden bg-surface-strong relative group cursor-pointer min-h-[152px] p-5 flex flex-col justify-end">
                <i class="fa-solid fa-store text-primary text-xl mb-2"></i>
                <h3 class="font-display font-normal text-lg text-ink">Comercial</h3>
                <p class="text-muted text-xs mt-1">Salas e lojas</p>
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 10 — SERVIÇOS (3-up)
     ═══════════════════════════════════════════════════════════ --}}
<section class="bg-surface-soft py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-semibold text-primary uppercase tracking-wider">Serviços</span>
            <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink mt-2">
                Como posso te ajudar
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Financiamento --}}
            <div class="bg-white rounded-2xl border border-hairline p-8 hover:shadow-soft transition-soft">
                <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-hand-holding-dollar text-primary text-xl"></i>
                </div>
                <h3 class="font-semibold text-ink text-lg">Financiamento</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Simulação e assessoria completa com os principais bancos do país. Encontre a melhor taxa para o seu perfil.
                </p>
            </div>

            {{-- Avaliação --}}
            <div class="bg-white rounded-2xl border border-hairline p-8 hover:shadow-soft transition-soft">
                <div class="w-14 h-14 rounded-full bg-semantic-up/10 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-chart-line text-semantic-up text-xl"></i>
                </div>
                <h3 class="font-semibold text-ink text-lg">Avaliação de imóvel</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Precisa saber quanto vale seu imóvel? Faço uma avaliação gratuita e sem compromisso com base no mercado local.
                </p>
            </div>

            {{-- Consultoria --}}
            <div class="bg-white rounded-2xl border border-hairline p-8 hover:shadow-soft transition-soft">
                <div class="w-14 h-14 rounded-full bg-accent-yellow/20 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-comments text-accent-yellow text-xl"></i>
                </div>
                <h3 class="font-semibold text-ink text-lg">Consultoria</h3>
                <p class="text-body text-sm mt-2 leading-relaxed">
                    Dúvidas sobre documentação, contratos ou investimento? Conte comigo para orientar cada etapa.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 11 — LISTAGEM COMPLETA DE IMÓVEIS
     ═══════════════════════════════════════════════════════════ --}}
<section id="imoveis" class="bg-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">

        {{-- Header --}}
        <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-semibold text-primary uppercase tracking-wider">Portfólio</span>
                <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-ink mt-2">
                    Todos os imóveis
                </h2>
                <p class="text-body mt-2">
                    <span class="font-mono font-medium text-ink">{{ $imoveis->total() }}</span>
                    {{ $imoveis->total() === 1 ? 'imóvel disponível' : 'imóveis disponíveis' }}
                </p>
            </div>
        </div>

        {{-- Grid --}}
        <div x-data="favoritesManager()" x-init="init()">
            <div id="property-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @include('partials.property-card', ['imoveis' => $imoveis, 'user' => $user])
            </div>

            {{-- Paginação --}}
            <div class="mt-10 pagination-container">
                {{ $imoveis->links() }}
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 12 — SEO INTERNAL LINKING (grade de links)
     ═══════════════════════════════════════════════════════════ --}}
<section class="bg-surface-soft py-16">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <h2 class="font-display font-normal text-2xl text-ink mb-8">Explore por região</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @php
                $cidades = $imoveis->pluck('city')->filter()->unique()->take(4);
            @endphp
            @foreach($cidades as $cidade)
                <div>
                    <h3 class="text-xs font-semibold text-muted uppercase tracking-wider mb-3">{{ $cidade }}</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-body hover:text-primary transition-soft">Casas em {{ $cidade }}</a></li>
                        <li><a href="#" class="text-body hover:text-primary transition-soft">Apartamentos em {{ $cidade }}</a></li>
                        <li><a href="#" class="text-body hover:text-primary transition-soft">Terrenos em {{ $cidade }}</a></li>
                        <li><a href="#" class="text-body hover:text-primary transition-soft">Ver todos em {{ $cidade }}</a></li>
                    </ul>
                </div>
            @endforeach

            @if($cidades->count() < 4)
                {{-- Placeholders --}}
                @for($i = $cidades->count(); $i < 4; $i++)
                    <div>
                        <h3 class="text-xs font-semibold text-muted uppercase tracking-wider mb-3">Região {{ $i + 1 }}</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-body hover:text-primary transition-soft">Casas</a></li>
                            <li><a href="#" class="text-body hover:text-primary transition-soft">Apartamentos</a></li>
                            <li><a href="#" class="text-body hover:text-primary transition-soft">Terrenos</a></li>
                            <li><a href="#" class="text-body hover:text-primary transition-soft">Ver todos</a></li>
                        </ul>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     BANDA 13 — CTA FINAL (dark band)
     ═══════════════════════════════════════════════════════════ --}}
<section class="bg-surface-dark py-16 md:py-24">
    <div class="max-w-3xl mx-auto text-center px-4 md:px-8 lg:px-16">
        <h2 class="font-display font-normal text-3xl md:text-4xl lg:text-[44px] leading-[1.09] tracking-display-md text-white">
            Pronto para encontrar <span class="text-primary">seu próximo imóvel</span>?
        </h2>
        <p class="text-on-dark-soft text-lg mt-4 max-w-lg mx-auto">
            Fale comigo agora mesmo e receba atendimento personalizado.
        </p>
        <div class="flex flex-wrap gap-3 justify-center mt-8">
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
               class="bg-semantic-up text-white rounded-pill px-8 py-4 text-base font-semibold hover:bg-green-700 transition-soft inline-flex items-center gap-2">
                <i class="fa-brands fa-whatsapp"></i>
                Falar no WhatsApp
            </a>
            <a href="tel:+{{ preg_replace('/\D/', '', $user->phone) }}"
               class="bg-white text-ink rounded-pill px-8 py-4 text-base font-semibold hover:bg-gray-100 transition-soft inline-flex items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                Ligar agora
            </a>
        </div>
    </div>
</section>

@endsection

{{-- ═══════════════════════════════════════════════════════════
     SCRIPTS
     ═══════════════════════════════════════════════════════════ --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hero carrossel
        new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            effect: 'fade',
            fadeEffect: { crossFade: true },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    });

    // Filtros (client-side – já existente)
    function filterProperties() {
        return {
            filters: {
                search: '',
                max_price: '',
                bedrooms: 'any',
            },
        }
    }

    // Favoritos (localStorage – sem backend)
    function favoritesManager() {
        return {
            favorites: JSON.parse(localStorage.getItem('larnex_favorites') || '[]'),
            init() {
                // Nada a fazer por agora
            },
            isFavorite(id) {
                return this.favorites.includes(id);
            },
            toggleFavorite(id) {
                if (this.isFavorite(id)) {
                    this.favorites = this.favorites.filter(f => f !== id);
                } else {
                    this.favorites.push(id);
                }
                localStorage.setItem('larnex_favorites', JSON.stringify(this.favorites));

                window.dispatchEvent(new CustomEvent('notify', {
                    detail: {
                        message: this.isFavorite(id) ? '❤️ Adicionado aos favoritos' : 'Removido dos favoritos',
                        type: 'success'
                    }
                }));
            }
        }
    }
</script>
@endpush