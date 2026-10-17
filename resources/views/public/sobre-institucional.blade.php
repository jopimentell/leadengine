@extends('layouts.app')

@section('title', 'Sobre - Larnex')
@section('meta_description', 'Conheça o Larnex, a plataforma para corretores de imóveis criarem sua vitrine digital.')

@section('content')
<div class="bg-white py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 md:px-8 lg:px-16">
        <h1 class="text-3xl md:text-4xl font-bold text-ink">Sobre o Larnex</h1>
        <p class="text-body text-lg mt-4">Somos uma plataforma feita para corretores de imóveis que querem se destacar no digital.</p>

        <div class="mt-8 space-y-6 text-body leading-relaxed">
            <p>
                O Larnex nasceu para resolver um problema simples: como um corretor autônomo pode ter uma presença digital profissional
                sem precisar contratar agências caras ou aprender programação.
            </p>
            <p>
                Nossa missão é empoderar corretores com ferramentas que capturam leads, organizam imóveis e aumentam vendas,
                tudo em uma página que cabe no seu link da bio.
            </p>
            <p>
                Hoje, centenas de corretores já usam o Larnex para transformar visitantes em clientes.
            </p>
        </div>

        <div class="mt-10 bg-surface-soft rounded-xl p-6 border border-hairline">
            <h3 class="font-semibold text-ink">Nossos valores</h3>
            <ul class="mt-3 space-y-2 text-sm">
                <li class="flex items-center gap-2"><span class="text-primary">✓</span> Simplicidade e usabilidade</li>
                <li class="flex items-center gap-2"><span class="text-primary">✓</span> Foco no corretor autônomo</li>
                <li class="flex items-center gap-2"><span class="text-primary">✓</span> Transparência e preços justos</li>
                <li class="flex items-center gap-2"><span class="text-primary">✓</span> Tecnologia acessível</li>
            </ul>
        </div>
    </div>
</div>
@endsection