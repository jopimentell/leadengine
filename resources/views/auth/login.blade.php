<x-guest-layout>
    <x-slot name="title">Login - Larnex</x-slot>

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-ink">Entrar</h1>
        <p class="text-sm text-muted mt-1">Acesse seu dashboard e gerencie seus imóveis</p>
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

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- E-mail -->
        <div>
            <label for="email" class="block text-sm font-medium text-ink">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- Senha -->
        <div>
            <label for="password" class="block text-sm font-medium text-ink">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="mt-1 w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <!-- Lembrar-me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-muted">
                <input type="checkbox" name="remember" class="rounded border-hairline text-primary focus:ring-primary">
                Lembrar-me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline transition-soft">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            Entrar
        </button>
    </form>

    <p class="text-center text-sm text-muted mt-6">
        Não tem uma conta? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline transition-soft">Cadastre-se</a>
    </p>
</x-guest-layout>