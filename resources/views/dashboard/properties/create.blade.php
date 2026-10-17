@extends('layouts.dashboard')

@section('title', 'Novo Imóvel')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">Cadastrar Novo Imóvel</h1>
    <form method="POST" action="{{ route('dashboard.properties.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-hairline p-6 shadow-soft">
        @csrf
        @include('dashboard.properties._form', ['property' => null])
        <div class="flex flex-wrap gap-3 mt-6 pt-4 border-t border-hairline">
            <button type="submit" class="bg-primary text-white rounded-pill px-8 py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
                <i class="fa-solid  fa-floppy-disk mr-1"></i> Salvar
            </button>
            <a href="{{ route('dashboard.properties.index') }}" class="bg-white text-ink rounded-pill px-8 py-3 text-sm font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
