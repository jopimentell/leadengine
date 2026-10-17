@if($imoveis->count() > 0)
    @foreach($imoveis as $imovel)
        <div class="bg-white rounded-xl border border-hairline overflow-hidden shadow-soft hover:shadow-lg transition-soft">
            <!-- Imagem -->
            <div class="relative h-48 bg-gray-200">
                @if($imovel->images->first())
                    <img src="{{ $imovel->images->first()->url }}" alt="{{ $imovel->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                        <i class="fa-solid  fa-image text-3xl"></i>
                    </div>
                @endif
                @if($imovel->status === 'sold')
                    <span class="absolute top-3 right-3 bg-semantic-down text-white text-xs font-semibold rounded-pill px-3 py-1">Vendido</span>
                @endif
            </div>

            <!-- Conteúdo -->
            <div class="p-4">
                <h3 class="font-semibold text-ink text-base truncate">{{ $imovel->title }}</h3>
                <p class="text-primary font-mono font-semibold text-lg mt-1">
                    R$ {{ number_format($imovel->price, 2, ',', '.') }}
                </p>
                <p class="text-muted text-sm truncate mt-0.5">
                    <i class="fa-solid  fa-location-dot mr-1"></i> {{ $imovel->city }}, {{ $imovel->state }}
                </p>
                <div class="flex items-center gap-4 mt-2 text-sm text-muted">
                    <span><i class="fa-solid  fa-bed mr-1"></i> {{ $imovel->bedrooms }}</span>
                    <span><i class="fa-solid  fa-bath mr-1"></i> {{ $imovel->bathrooms }}</span>
                    <span><i class="fa-solid  fa-arrows-left-right mr-1"></i> {{ $imovel->area_sqmt ?? '—' }}m²</span>
                </div>
                <a href="{{ route('public.imovel.detalhe', [$corretor->slug, $imovel->slug]) }}"
                   class="mt-3 block text-center bg-white text-primary rounded-pill px-4 py-2 text-sm font-semibold border border-primary hover:bg-primary hover:text-white transition-soft">
                    Ver detalhes
                </a>
            </div>
        </div>
    @endforeach
@else
    <div class="col-span-full text-center py-16 text-muted">
        <i class="fa-solid  fa-house-circle-xmark text-4xl text-gray-300 mb-3 block"></i>
        <h3 class="text-xl font-semibold text-ink">Nenhum imóvel encontrado</h3>
        <p class="text-sm">Tente ajustar os filtros ou buscar por outro termo.</p>
    </div>
@endif