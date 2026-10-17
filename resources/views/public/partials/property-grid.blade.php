<div id="property-grid-inner">
    @if($properties->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="card bg-base-100 shadow-md hover:shadow-xl transition-shadow duration-300 border border-gray-100 rounded-2xl overflow-hidden">
                    <figure class="h-48 bg-gray-200">
                        @if($property->main_image)
                            <img src="{{ $property->main_image }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-sm">Sem imagem</span>
                        @endif
                    </figure>
                    <div class="card-body p-4">
                        <h3 class="card-title text-lg font-bold truncate">{{ $property->title }}</h3>
                        <p class="text-primary font-bold text-xl">{{ $property->formatted_price }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $property->full_address }}</p>
                        <div class="flex items-center gap-3 text-sm text-gray-600 mt-1">
                            <span>🛏 {{ $property->bedrooms }}</span>
                            <span>🛁 {{ $property->bathrooms }}</span>
                            <span>📐 {{ $property->area_sqmt ?? '--' }} m²</span>
                        </div>
                        <div class="card-actions justify-end mt-2">
                            <a href="{{ route('public.property.detail', [$user->slug, $property->slug]) }}"
                               class="btn btn-primary btn-sm rounded-full px-4">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- PAGINAÇÃO (agora com classe específica para interceptação AJAX) -->
        <div class="mt-8 pagination-container">
            {{ $properties->links() }}
        </div>
    @else
        <div class="text-center py-16 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="text-xl font-semibold mt-4">Nenhum imóvel encontrado</h3>
            <p class="text-sm">Tente ajustar os filtros ou limpar a busca.</p>
        </div>
    @endif
</div>