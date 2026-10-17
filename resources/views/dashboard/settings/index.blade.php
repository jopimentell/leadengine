@extends('layouts.dashboard')

@section('title', 'Configurações')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-6 border border-gray-100">
    <h1 class="text-2xl font-bold mb-6">⚙️ Configurações</h1>

    <form method="POST" action="{{ route('dashboard.settings.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-control">
            <label class="label-text">Nome</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="input input-bordered rounded-full">
        </div>
        <div class="form-control mt-4">
            <label class="label-text">Slug (URL pública)</label>
            <input type="text" name="slug" value="{{ old('slug', auth()->user()->slug) }}" class="input input-bordered rounded-full">
            <span class="text-xs text-gray-400 mt-1">Ex: {{ url('/') }}/<span class="font-mono">{{ auth()->user()->slug }}</span></span>
        </div>
        <div class="form-control mt-4">
            <label class="label-text">Telefone (WhatsApp)</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="input input-bordered rounded-full">
        </div>
        <div class="form-control mt-4">
            <label class="label-text">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="input input-bordered rounded-full">
        </div>
        <div class="form-control mt-4">
            <label class="label-text">Cidade</label>
            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" class="input input-bordered rounded-full">
        </div>
        <div class="form-control mt-4">
            <label class="label-text">CRECI</label>
            <input type="text" name="creci" value="{{ old('creci', auth()->user()->creci) }}" class="input input-bordered rounded-full">
        </div>
        <div class="form-control mt-4">
            <label class="label-text">Avatar (imagem)</label>
            <input type="file" name="avatar" accept="image/*" class="file-input file-input-bordered rounded-full">
        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit" class="btn btn-primary rounded-full">Salvar</button>
        </div>
    </form>

    <hr class="my-8">

    <h2 class="text-xl font-bold">📋 Plano atual: <span class="badge badge-primary">{{ ucfirst(auth()->user()->plan_type) }}</span></h2>
    @if(auth()->user()->subscription)
        <p class="text-sm text-gray-500">Válido até: {{ auth()->user()->subscription->current_period_end?->format('d/m/Y') ?? 'N/A' }}</p>
    @endif
    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="border rounded-xl p-4 text-center">
            <h3 class="font-bold">Free</h3>
            <p class="text-sm">1 imóvel</p>
        </div>
        <div class="border rounded-xl p-4 text-center border-primary bg-primary/5">
            <h3 class="font-bold text-primary">Pro</h3>
            <p class="text-sm">10 imóveis</p>
            <span class="badge badge-primary">Recomendado</span>
        </div>
        <div class="border rounded-xl p-4 text-center">
            <h3 class="font-bold">Black</h3>
            <p class="text-sm">Ilimitado</p>
        </div>
    </div>
</div>
@endsection