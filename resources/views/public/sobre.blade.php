@extends('layouts.app')

@section('title', 'Sobre ' . $corretor->name)

@section('content')
<div class="bg-white py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 md:px-8 lg:px-16">

        <h1 class="text-3xl md:text-4xl font-bold text-ink">Sobre o corretor</h1>

        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mt-6">
            @if($corretor->avatar)
                <img src="{{ $corretor->avatar }}" alt="{{ $corretor->name }}" class="w-32 h-32 rounded-full object-cover shadow-soft">
            @else
                <div class="w-32 h-32 rounded-full bg-primary flex items-center justify-center text-white text-4xl font-bold shadow-soft">
                    {{ strtoupper(substr($corretor->name, 0, 1)) }}
                </div>
            @endif

            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold text-ink">{{ $corretor->name }}</h2>
                @if($corretor->creci)
                    <p class="text-muted">CRECI: {{ $corretor->creci }}</p>
                @endif
                <p class="text-muted">📍 {{ $corretor->city ?? 'Cidade não informada' }}</p>
                <p class="text-muted">📱 {{ $corretor->phone }}</p>
                @if($corretor->email)
                    <p class="text-muted">✉️ {{ $corretor->email }}</p>
                @endif
            </div>
        </div>

        <div class="mt-8 bg-surface-soft rounded-xl p-6 border border-hairline">
            <h3 class="font-semibold text-ink">Sobre mim</h3>
            <p class="text-body text-sm leading-relaxed mt-2">
                Profissional dedicado a ajudar você a encontrar o imóvel dos seus sonhos. Atuo com transparência,
                ética e comprometimento para tornar sua experiência imobiliária a melhor possível.
            </p>
            <p class="text-body text-sm leading-relaxed mt-2">
                Entre em contato para mais informações ou agendar uma visita.
            </p>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $corretor->phone) }}" target="_blank"
               class="bg-semantic-up text-white rounded-pill px-6 py-3 text-sm font-semibold hover:bg-green-700 transition-soft">
                <i class="fa-brands fa-whatsapp mr-2"></i> Falar no WhatsApp
            </a>
            <a href="{{ route('public.contato', $corretor->slug) }}" class="bg-white text-ink rounded-pill px-6 py-3 text-sm font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                <i class="fa-solid  fa-envelope mr-2"></i> Enviar e-mail
            </a>
        </div>

    </div>
</div>
@endsection