<x-guest-layout>
    <x-slot name="title">Recuperar senha - Larnex</x-slot>

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-ink">Recuperar senha</h1>
        <p class="text-sm text-muted mt-1">Informe seu e-mail para receber o link de recuperação.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 bg-green-50 border border-green-200 text-semantic-up text-sm rounded-pill px-4 py-3">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-semantic-down text-sm rounded-pill px-4 py-3">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-ink">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            Enviar link de recuperação
        </button>
    </form>

    <p class="text-center text-sm text-muted mt-6">
        <a href="{{ route('login') }}" class="text-primary hover:underline transition-soft">Voltar para o login</a>
    </p>
</x-guest-layout>