@extends('layouts.app')

@section('title', $imovel->title . ' - ' . $user->name)
@section('meta_description', 'Detalhes do imóvel ' . $imovel->title . '. Entre em contato com o corretor.')

@section('hide-global-header')
@endsection

@section('content')
@include('public.partials.agent-header')
<div class="bg-white py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">

        <!-- Breadcrumb -->
        <nav class="text-sm text-muted mb-6">
            <a href="{{ route('public.home', $user->slug) }}" class="hover:text-ink transition-soft">Início</a>
            <span class="mx-2">/</span>
            <span>{{ $imovel->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- COLUNA ESQUERDA (Galeria + Info) -->
            <div class="lg:col-span-2">

                <!-- Galeria Swiper -->
                <div class="swiper gallerySwiper rounded-xl overflow-hidden shadow-soft border border-hairline">
                    <div class="swiper-wrapper">
                        @forelse($imovel->images as $image)
                            <div class="swiper-slide h-80 md:h-[450px] bg-gray-200">
                                <img src="{{ $image->url }}" alt="{{ $imovel->title }}" class="w-full h-full object-cover">
                            </div>
                        @empty
                            <div class="swiper-slide h-80 md:h-[450px] bg-gray-200 flex items-center justify-center text-gray-400">
                                <i class="fa-regular fa-image text-6xl"></i>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <!-- Thumbnails (miniaturas) -->
                @if($imovel->images->count() > 1)
                    <div class="flex gap-2 mt-3 overflow-x-auto pb-2">
                        @foreach($imovel->images as $image)
                            <img src="{{ $image->url }}" alt="Thumb"
                                 class="w-16 h-16 object-cover rounded-lg border-2 border-transparent hover:border-primary cursor-pointer transition-soft"
                                 onclick="document.querySelector('.gallerySwiper .swiper-slide-active img').src = this.src">
                        @endforeach
                    </div>
                @endif

                <!-- Descrição -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-ink">Descrição</h2>
                    <p class="text-body text-sm leading-relaxed mt-2">{{ $imovel->description ?? 'Descrição não disponível.' }}</p>
                </div>

                <!-- Mapa -->
                @if($imovel->latitude && $imovel->longitude)
                    <div class="mt-6 rounded-xl overflow-hidden shadow-soft border border-hairline h-64">
                        <iframe
                            src="https://www.google.com/maps?q={{ $imovel->latitude }},{{ $imovel->longitude }}&z=15&output=embed"
                            class="w-full h-full"
                            allowfullscreen
                            loading="lazy">
                        </iframe>
                    </div>
                @endif

                <!-- Ficha Técnica -->
                <div class="mt-6 bg-surface-soft rounded-xl p-6 border border-hairline">
                    <h3 class="font-semibold text-ink text-lg mb-3">Ficha Técnica</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        <div>
                            <span class="text-muted">Preço</span>
                            <p class="font-mono font-semibold text-primary">R$ {{ number_format($imovel->price, 2, ',', '.') }}</p>
                        </div>
                        @if($imovel->price_rent)
                            <div>
                                <span class="text-muted">Aluguel</span>
                                <p class="font-mono font-semibold">R$ {{ number_format($imovel->price_rent, 2, ',', '.') }}</p>
                            </div>
                        @endif
                        <div>
                            <span class="text-muted">Quartos</span>
                            <p>{{ $imovel->bedrooms }}</p>
                        </div>
                        <div>
                            <span class="text-muted">Banheiros</span>
                            <p>{{ $imovel->bathrooms }}</p>
                        </div>
                        <div>
                            <span class="text-muted">Área</span>
                            <p>{{ $imovel->area_sqmt ?? '—' }} m²</p>
                        </div>
                        <div>
                            <span class="text-muted">Endereço</span>
                            <p class="text-sm">{{ $imovel->street }}, {{ $imovel->neighborhood }}</p>
                            <p class="text-sm">{{ $imovel->city }} - {{ $imovel->state }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA (Formulário de Lead) -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-xl border border-hairline p-6 shadow-soft">

                    <h3 class="text-xl font-bold text-ink">📩 Tenho interesse!</h3>
                    <p class="text-sm text-muted mt-1">Preencha para entrar em contato com o corretor.</p>

                    <form x-data="leadForm()" @submit.prevent="submit" class="mt-4 space-y-4">

                        <!-- Nome -->
                        <div>
                            <label class="text-sm font-medium text-ink">Nome *</label>
                            <input type="text" x-model="form.name" required
                                   class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Telefone -->
                        <div>
                            <label class="text-sm font-medium text-ink">Telefone (WhatsApp) *</label>
                            <input type="tel" x-model="form.phone" required
                                   class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- E-mail -->
                        <div>
                            <label class="text-sm font-medium text-ink">E-mail (opcional)</label>
                            <input type="email" x-model="form.email"
                                   class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Tem imóvel para vender? -->
                        <div>
                            <label class="text-sm font-medium text-ink">Você tem imóvel para vender?</label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" x-model="form.has_property" value="1" class="text-primary focus:ring-primary"> Sim
                                </label>
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" x-model="form.has_property" value="0" class="text-primary focus:ring-primary"> Não
                                </label>
                            </div>
                        </div>

                        <!-- Detalhes do imóvel para vender (condicional) -->
                        <div x-show="form.has_property == 1" x-cloak>
                            <label class="text-sm font-medium text-ink">Descreva seu imóvel</label>
                            <textarea x-model="form.property_details" rows="2"
                                      class="w-full bg-white rounded-xl px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                      placeholder="Endereço, valor, características..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
                            <span x-text="loading ? 'Enviando...' : 'Enviar interesse'"></span>
                            <i class="fa-regular fa-paper-plane ml-2"></i>
                        </button>

                        <p class="text-xs text-muted text-center mt-2">Seus dados serão compartilhados apenas com o corretor.</p>
                    </form>

                    @if(session('success'))
                        <div class="mt-4 bg-semantic-up/10 text-semantic-up text-sm rounded-pill px-4 py-3 text-center border border-semantic-up/20">
                            <i class="fa-regular fa-circle-check mr-1"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // SWIPER GALERIA
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.gallerySwiper', {
            loop: true,
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    });

    // FORMULÁRIO DE LEAD (AJAX)
    function leadForm() {
        return {
            form: {
                name: '',
                phone: '',
                email: '',
                has_property: 0,
                property_details: '',
            },
            loading: false,

            async submit() {
                this.loading = true;
                const url = '{{ route("public.lead.store", [$user->slug, $imovel->id]) }}';

                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await res.json();
                    if (res.ok) {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: { message: data.message, type: 'success' }
                        }));
                        this.form = { name: '', phone: '', email: '', has_property: 0, property_details: '' };
                    } else {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: { message: data.message || 'Erro ao enviar. Tente novamente.', type: 'error' }
                        }));
                    }
                } catch (e) {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: { message: 'Erro de conexão. Tente novamente.', type: 'error' }
                    }));
                }

                this.loading = false;
            }
        }
    }
</script>
@endpush

@endsection