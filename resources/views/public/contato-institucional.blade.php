@extends('layouts.app')

@section('title', 'Contato - Larnex')

@section('content')
<div class="bg-white py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 md:px-8 lg:px-16">
        <h1 class="text-3xl md:text-4xl font-bold text-ink">📞 Fale conosco</h1>
        <p class="text-body text-lg mt-4">Tem dúvidas? Entre em contato com nosso time.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="font-semibold text-ink">E-mail</h3>
                <p class="text-muted mt-1"><a href="mailto:contato@larnex.com.br" class="text-primary hover:underline">contato@larnex.com.br</a></p>
                <h3 class="font-semibold text-ink mt-4">WhatsApp</h3>
                <p class="text-muted mt-1"><a href="https://wa.me/5511999999999" target="_blank" class="text-primary hover:underline">(11) 99999-9999</a></p>
            </div>
            <div class="bg-white rounded-xl p-6 border border-hairline shadow-soft">
                <h3 class="font-semibold text-ink">Envie uma mensagem</h3>
                <form class="mt-3 space-y-3">
                    <input type="text" placeholder="Seu nome" class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:ring-2 focus:ring-primary focus:border-transparent">
                    <input type="email" placeholder="Seu e-mail" class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:ring-2 focus:ring-primary focus:border-transparent">
                    <textarea rows="4" placeholder="Sua mensagem" class="w-full bg-white rounded-xl px-4 py-2.5 text-sm border border-hairline focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    <button type="submit" class="bg-primary text-white rounded-pill px-6 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
