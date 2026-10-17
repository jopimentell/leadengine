@extends('layouts.app')

@section('title', 'Contato - ' . $user->name)

@section('content')
<section class="py-12 md:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">📞 Contato</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Informações de contato -->
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                <h3 class="text-xl font-semibold mb-4">Fale com {{ $user->name }}</h3>
                <ul class="space-y-4 text-gray-700">
                    <li class="flex items-center gap-3">
                        <span class="text-2xl">📱</span>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone ?? '') }}" target="_blank"
                           class="text-primary hover:underline">{{ $user->phone ?? 'Não informado' }}</a>
                    </li>
                    @if($user->email)
                        <li class="flex items-center gap-3">
                            <span class="text-2xl">✉️</span>
                            <a href="mailto:{{ $user->email }}" class="text-primary hover:underline">{{ $user->email }}</a>
                        </li>
                    @endif
                    <li class="flex items-center gap-3">
                        <span class="text-2xl">📍</span>
                        <span>{{ $user->city ?? 'Cidade não informada' }}</span>
                    </li>
                </ul>
                <div class="mt-6">
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone ?? '') }}" target="_blank"
                       class="btn btn-primary rounded-full w-full">Enviar WhatsApp</a>
                </div>
            </div>

            <!-- Formulário de contato rápido -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md">
                <h3 class="text-xl font-semibold mb-4">Mande uma mensagem</h3>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="label-text text-sm font-medium">Nome</label>
                        <input type="text" name="name" required class="input input-bordered w-full rounded-full">
                    </div>
                    <div>
                        <label class="label-text text-sm font-medium">Telefone</label>
                        <input type="tel" name="phone" required class="input input-bordered w-full rounded-full">
                    </div>
                    <div>
                        <label class="label-text text-sm font-medium">Mensagem</label>
                        <textarea name="message" rows="4" class="textarea textarea-bordered w-full rounded-2xl"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-full w-full">Enviar mensagem</button>
                </form>
                <p class="text-xs text-gray-400 mt-2">* Este formulário é ilustrativo. Use o WhatsApp para resposta imediata.</p>
            </div>
        </div>
    </div>
</section>
@endsection
