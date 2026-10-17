@extends('layouts.app')

@section('title', 'Contato - ' . $corretor->name)

@section('content')
<div class="bg-white py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 md:px-8 lg:px-16">

        <h1 class="text-3xl md:text-4xl font-bold text-ink">📞 Contato</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

            <!-- Informações -->
            <div class="bg-surface-soft rounded-xl p-6 border border-hairline">
                <h3 class="text-xl font-semibold text-ink">Fale com {{ $corretor->name }}</h3>
                <ul class="mt-4 space-y-3 text-body">
                    <li class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-semantic-up text-xl w-6"></i>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $corretor->phone) }}" target="_blank"
                           class="hover:text-primary transition-soft">{{ $corretor->phone }}</a>
                    </li>
                    @if($corretor->email)
                        <li class="flex items-center gap-3">
                            <i class="fa-solid  fa-envelope text-primary text-xl w-6"></i>
                            <a href="mailto:{{ $corretor->email }}" class="hover:text-primary transition-soft">{{ $corretor->email }}</a>
                        </li>
                    @endif
                    <li class="flex items-center gap-3">
                        <i class="fa-solid  fa-location-dot text-muted text-xl w-6"></i>
                        <span>{{ $corretor->city ?? 'Cidade não informada' }}</span>
                    </li>
                </ul>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $corretor->phone) }}" target="_blank"
                   class="mt-4 block text-center bg-semantic-up text-white rounded-pill px-6 py-3 text-sm font-semibold hover:bg-green-700 transition-soft">
                    <i class="fa-brands fa-whatsapp mr-2"></i> Iniciar conversa
                </a>
            </div>

            <!-- Formulário (placeholder) -->
            <div class="bg-white rounded-xl p-6 border border-hairline shadow-soft">
                <h3 class="text-xl font-semibold text-ink">Envie uma mensagem</h3>
                <form class="mt-4 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-ink">Nome *</label>
                        <input type="text" class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-ink">Telefone *</label>
                        <input type="tel" class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-ink">Mensagem</label>
                        <textarea rows="4" class="w-full bg-white rounded-xl px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
                        <i class="fa-solid  fa-paper-plane mr-2"></i> Enviar mensagem
                    </button>
                </form>
                <p class="text-xs text-muted mt-3 text-center">* Para resposta imediata, use o WhatsApp.</p>
            </div>

        </div>

    </div>
</div>
@endsection