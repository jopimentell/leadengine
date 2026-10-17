@extends('layouts.dashboard')

@section('title', 'Perfil')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">👤 Meu Perfil</h1>

    <form method="POST" action="{{ route('dashboard.settings.profile.update') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-hairline p-6 shadow-soft">
        @csrf @method('PUT')

        <!-- Avatar -->
        <div class="flex items-center gap-6 mb-6">
            <div class="relative">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-hairline">
                @else
                    <div class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold border-2 border-hairline">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <label class="absolute bottom-0 right-0 bg-primary text-white rounded-full w-7 h-7 flex items-center justify-center cursor-pointer hover:bg-primary-active transition-soft">
                    <i class="fa-solid  fa-camera text-xs"></i>
                    <input type="file" name="avatar" accept="image/*" class="hidden">
                </label>
            </div>
            <div>
                <p class="font-medium text-ink">{{ auth()->user()->name }}</p>
                <p class="text-sm text-muted">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium text-ink">Nome *</label>
                <input type="text" name="name" required value="{{ old('name', auth()->user()->name) }}"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="text-sm font-medium text-ink">E-mail *</label>
                <input type="email" name="email" required value="{{ old('email', auth()->user()->email) }}"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="text-sm font-medium text-ink">Telefone (WhatsApp) *</label>
                <input type="text" name="phone" required value="{{ old('phone', auth()->user()->phone) }}"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="text-sm font-medium text-ink">Cidade</label>
                <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="text-sm font-medium text-ink">CRECI</label>
                <input type="text" name="creci" value="{{ old('creci', auth()->user()->creci) }}"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="text-sm font-medium text-ink">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', auth()->user()->instagram ?? '') }}"
                       placeholder="@seu_usuario"
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
        </div>

        <div class="mt-4">
            <label class="text-sm font-medium text-ink">Slug (URL pública)</label>
            <div class="flex items-center gap-2">
                <span class="text-sm text-muted whitespace-nowrap">{{ url('/') }}/</span>
                <input type="text" name="slug" value="{{ old('slug', auth()->user()->slug) }}"
                    class="flex-1 bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <p class="text-xs text-muted-soft mt-1">
                Use apenas letras minúsculas, números e hífens. Ex: <code>joao-silva</code>
            </p>
            @error('slug') <p class="text-sm text-semantic-down mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="mt-6 bg-primary text-white rounded-pill px-8 py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            <i class="fa-solid  fa-floppy-disk mr-1"></i> Salvar alterações
        </button>

    </form>
</div>
@endsection