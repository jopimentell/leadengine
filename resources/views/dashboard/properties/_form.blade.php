<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-ink">Título *</label>
        <input type="text" name="title" required value="{{ old('title', $property->title ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        @error('title') <p class="text-sm text-semantic-down mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Status</label>
        <select name="status" class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            <option value="active" {{ old('status', $property->status ?? '') === 'active' ? 'selected' : '' }}>Ativo</option>
            <option value="inactive" {{ old('status', $property->status ?? '') === 'inactive' ? 'selected' : '' }}>Inativo</option>
            <option value="sold" {{ old('status', $property->status ?? '') === 'sold' ? 'selected' : '' }}>Vendido</option>
        </select>
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Preço (R$)</label>
        <input type="number" name="price" step="0.01" value="{{ old('price', $property->price ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Preço de Aluguel (R$)</label>
        <input type="number" name="price_rent" step="0.01" value="{{ old('price_rent', $property->price_rent ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div class="md:col-span-2">
        <label class="text-sm font-medium text-ink">Descrição</label>
        <textarea name="description" rows="3" class="w-full bg-white rounded-xl px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('description', $property->description ?? '') }}</textarea>
        <button type="button" class="text-primary text-xs font-semibold mt-1 hover:underline transition-soft">
            <i class="fa-solid  fa-wand-magic-sparkles mr-1"></i> Gerar com IA
        </button>
    </div>
</div>

<hr class="border-hairline my-6">

<h3 class="font-semibold text-ink text-lg mb-4">📍 Endereço</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="text-sm font-medium text-ink">Rua</label>
        <input type="text" name="street" value="{{ old('street', $property->street ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Bairro</label>
        <input type="text" name="neighborhood" value="{{ old('neighborhood', $property->neighborhood ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Cidade</label>
        <input type="text" name="city" value="{{ old('city', $property->city ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">UF (2 letras)</label>
        <input type="text" name="state" maxlength="2" value="{{ old('state', $property->state ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Latitude</label>
        <input type="text" name="latitude" value="{{ old('latitude', $property->latitude ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Longitude</label>
        <input type="text" name="longitude" value="{{ old('longitude', $property->longitude ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
</div>

<hr class="border-hairline my-6">

<h3 class="font-semibold text-ink text-lg mb-4">📐 Características</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div>
        <label class="text-sm font-medium text-ink">Quartos</label>
        <input type="number" name="bedrooms" min="0" value="{{ old('bedrooms', $property->bedrooms ?? 0) }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Banheiros</label>
        <input type="number" name="bathrooms" min="0" value="{{ old('bathrooms', $property->bathrooms ?? 0) }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Área (m²)</label>
        <input type="number" name="area_sqmt" step="0.01" value="{{ old('area_sqmt', $property->area_sqmt ?? '') }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
    <div>
        <label class="text-sm font-medium text-ink">Vagas</label>
        <input type="number" name="garage_spots" min="0" value="{{ old('garage_spots', $property->garage_spots ?? 0) }}"
               class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>
</div>

<hr class="border-hairline my-6">

<h3 class="font-semibold text-ink text-lg mb-4">📸 Fotos</h3>
<div x-data="{ files: [] }">
    <div class="border-2 border-dashed border-hairline rounded-xl p-8 text-center hover:border-primary transition-soft cursor-pointer"
         @dragover.prevent @drop.prevent="files = Array.from($event.dataTransfer.files)">
        <i class="fa-solid  fa-cloud-arrow-up text-3xl text-muted-soft mb-2 block"></i>
        <p class="text-sm text-muted">Arraste e solte suas imagens aqui, ou <span class="text-primary font-semibold">clique para selecionar</span></p>
        <p class="text-xs text-muted-soft mt-1">Máx. 5MB por imagem · JPG, PNG, WEBP</p>
        <input type="file" name="images[]" multiple accept="image/*" class="hidden"
               @change="files = Array.from($event.target.files)">
    </div>
    <div class="flex flex-wrap gap-2 mt-3">
        <template x-for="(file, index) in files" :key="index">
            <div class="relative w-20 h-20 rounded-lg overflow-hidden border border-hairline">
                <img :src="URL.createObjectURL(file)" class="w-full h-full object-cover">
                <button type="button" class="absolute top-1 right-1 bg-semantic-down text-white rounded-full w-5 h-5 text-xs flex items-center justify-center hover:bg-red-700 transition-soft"
                        @click="files.splice(index, 1)">
                    <i class="fa-solid  fa-xmark"></i>
                </button>
            </div>
        </template>
    </div>
</div>

@if(isset($property) && $property->exists && $property->images->count())
    <div class="mt-4">
        <h4 class="font-medium text-sm text-ink">Fotos existentes:</h4>
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach($property->images as $image)
                <div class="relative w-20 h-20 rounded-lg overflow-hidden border border-hairline group">
                    <img src="{{ $image->url }}" class="w-full h-full object-cover">
                    <button type="button" class="absolute inset-0 bg-black/50 text-white opacity-0 group-hover:opacity-100 transition-soft flex items-center justify-center text-xs"
                            onclick="if(confirm('Remover esta imagem?')) { /* AJAX para remover */ }">
                        <i class="fa-solid  fa-trash-can"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endif
