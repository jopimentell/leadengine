<x-guest-layout>
    <x-slot name="title">Cadastro - Larnex</x-slot>

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-ink">Crie sua conta</h1>
        <p class="text-sm text-muted mt-1">Comece sua vitrine digital gratuitamente</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-semantic-down text-sm rounded-pill px-4 py-3">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nome -->
        <div>
            <label for="name" class="block text-sm font-medium text-ink">Nome completo *</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- E-mail -->
        <div>
            <label for="email" class="block text-sm font-medium text-ink">E-mail *</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- Telefone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-ink">Telefone (WhatsApp) *</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required placeholder="(11) 99999-9999"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- Senha -->
        <div>
            <label for="password" class="block text-sm font-medium text-ink">Senha *</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- Confirmar senha -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-ink">Confirmar senha *</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            Criar conta grátis
        </button>
    </form>

    <p class="text-center text-sm text-muted mt-6">
        Já tem uma conta? <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline transition-soft">Entre aqui</a>
    </p>

    <p class="text-center text-xs text-muted-soft mt-3">
        Ao criar sua conta, você concorda com os <a href="#" class="hover:text-body transition-soft">Termos de Uso</a> e <a href="#" class="hover:text-body transition-soft">Política de Privacidade</a>.
    </p>
</x-guest-layout>
