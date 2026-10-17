@if($imoveis->count() > 0)
    @foreach($imoveis as $imovel)
        <article class="group bg-white rounded-2xl border border-hairline overflow-hidden hover:shadow-soft hover:-translate-y-0.5 transition-all duration-300">

            {{-- Foto --}}
            <div class="relative aspect-[4/3] bg-gray-200 overflow-hidden">
                @if($imovel->images->first())
                    <img src="{{ $imovel->images->first()->url }}"
                         alt="{{ $imovel->title }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fa-regular fa-image text-4xl"></i>
                    </div>
                @endif

                {{-- Badge status --}}
                @if($imovel->status === 'sold')
                    <span class="absolute top-3 left-3 bg-semantic-down text-white text-[10px] font-bold uppercase tracking-wider rounded-pill px-3 py-1">
                        Vendido
                    </span>
                @elseif($imovel->status === 'active' && $imovel->created_at->diffInDays(now()) < 7)
                    <span class="absolute top-3 left-3 bg-semantic-up text-white text-[10px] font-bold uppercase tracking-wider rounded-pill px-3 py-1">
                        <i class="fa-solid fa-bolt mr-1"></i> Novo
                    </span>
                @endif

                {{-- Favoritar --}}
                <button @click.prevent="toggleFavorite('{{ $imovel->id }}')"
                        class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center hover:bg-white hover:scale-110 transition-all shadow-sm">
                    <i class="fa-heart text-sm transition-colors"
                       :class="isFavorite('{{ $imovel->id }}') ? 'fa-solid text-semantic-down' : 'fa-regular text-muted'"></i>
                </button>

                {{-- Contador de fotos --}}
                @if($imovel->images->count() > 1)
                    <span class="absolute bottom-3 right-3 bg-black/60 backdrop-blur text-white text-xs font-medium rounded-pill px-2.5 py-1 flex items-center gap-1">
                        <i class="fa-regular fa-camera text-[10px]"></i>
                        {{ $imovel->images->count() }}
                    </span>
                @endif
            </div>

            {{-- Body --}}
            <div class="p-5 flex flex-col">
                <h3 class="font-semibold text-ink text-base leading-snug line-clamp-2 group-hover:text-primary transition-colors">
                    {{ $imovel->title }}
                </h3>
                <p class="text-muted text-xs mt-1.5 flex items-center gap-1">
                    <i class="fa-regular fa-location-dot text-[10px]"></i>
                    <span class="truncate">{{ $imovel->neighborhood ?? $imovel->city }}, {{ $imovel->state }}</span>
                </p>

                <p class="font-mono font-medium text-xl text-ink mt-3">
                    R$ {{ number_format($imovel->price, 2, ',', '.') }}
                </p>
                @if($imovel->price_rent)
                    <p class="text-xs text-muted mt-0.5 font-mono">
                        + R$ {{ number_format($imovel->price_rent, 0, ',', '.') }}/mês aluguel
                    </p>
                @endif

                {{-- Specs --}}
                <div class="flex items-center gap-3 mt-3 pt-3 border-t border-hairline-soft text-xs text-body">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-bed text-muted text-[10px]"></i>
                        <span class="font-mono font-medium text-ink">{{ $imovel->bedrooms }}</span>
                    </span>
                    <span class="text-hairline">·</span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-bath text-muted text-[10px]"></i>
                        <span class="font-mono font-medium text-ink">{{ $imovel->bathrooms }}</span>
                    </span>
                    <span class="text-hairline">·</span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-ruler-combined text-muted text-[10px]"></i>
                        <span class="font-mono font-medium text-ink">{{ $imovel->area_sqmt ?? '—' }}</span> m²
                    </span>
                </div>

                {{-- CTA --}}
                <a href="{{ route('public.imovel.detalhe', [$user->slug, $imovel->slug]) }}"
                   class="mt-4 block text-center bg-white text-primary rounded-pill px-4 py-2.5 text-sm font-semibold border border-primary hover:bg-primary hover:text-white transition-all">
                    Ver detalhes
                    <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </article>
    @endforeach
@else
    <div class="col-span-full text-center py-16">
        <i class="fa-regular fa-house-circle-xmark text-5xl text-gray-300 mb-4 block"></i>
        <h3 class="text-xl font-semibold text-ink">Nenhum imóvel encontrado</h3>
        <p class="text-sm text-muted mt-1 mb-6">Tente ajustar os filtros ou buscar por outro termo.</p>
        <a href="{{ route('public.home', $user->slug) }}"
           class="inline-flex items-center gap-2 bg-primary text-white rounded-pill px-6 py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            <i class="fa-solid fa-rotate-right"></i>
            Limpar filtros
        </a>
    </div>
@endif