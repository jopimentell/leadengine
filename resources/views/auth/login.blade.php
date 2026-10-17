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

    {{-- ═══════════════════════════════════════════════════════════
     CREDENCIAIS DE DEMONSTRAÇÃO (VANILLA JS – SEM ALPINE)
     ═══════════════════════════════════════════════════════════ --}}
<div class="mt-8 pt-6 border-t border-hairline-soft">
    <p class="text-center text-xs font-semibold text-muted uppercase tracking-wider mb-3">
        🔑 Credenciais para demonstração
    </p>

    <div class="space-y-2">
        {{-- Botão Admin --}}
        <button type="button"
                onclick="fillLogin('admin@larnex.com', 'password')"
                class="w-full text-left p-3 rounded-xl border border-hairline-soft bg-surface-soft hover:bg-white hover:border-primary/30 hover:shadow-soft transition-all duration-200 group">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-shield-halved text-primary text-xs"></i>
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-ink">Administrador</p>
                    <p class="text-[11px] text-muted font-mono truncate">admin@larnex.com / password</p>
                </div>
                <i class="fa-solid fa-arrow-right text-[10px] text-muted group-hover:text-primary transition-colors"></i>
            </div>
        </button>

        {{-- Botão Corretor --}}
        <button type="button"
                onclick="fillLogin('joao@exemplo.com', 'password')"
                class="w-full text-left p-3 rounded-xl border border-hairline-soft bg-surface-soft hover:bg-white hover:border-primary/30 hover:shadow-soft transition-all duration-200 group">
            <div class="flex items-center gap-2">
                <span class="w-7 h-7 rounded-full bg-semantic-up/10 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-user-tie text-semantic-up text-xs"></i>
                </span>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-ink">Corretor</p>
                    <p class="text-[11px] text-muted font-mono truncate">joao@exemplo.com / password</p>
                </div>
                <i class="fa-solid fa-arrow-right text-[10px] text-muted group-hover:text-primary transition-colors"></i>
            </div>
        </button>
    </div>

    <p class="text-center text-[10px] text-muted-soft mt-3">
        Clique em uma credencial para preencher automaticamente
    </p>
</div>

{{-- Script inline (não depende de @push/@stack) --}}
<script>
    function fillLogin(email, password) {
        // Tenta por atributo name (padrão Breeze)
        var emailInput = document.querySelector('input[name="email"]');
        var passwordInput = document.querySelector('input[name="password"]');

        // Fallback por ID (caso o name seja diferente)
        if (!emailInput) emailInput = document.getElementById('email');
        if (!passwordInput) passwordInput = document.getElementById('password');

        if (emailInput) {
            emailInput.value = email;
            emailInput.dispatchEvent(new Event('input', { bubbles: true }));
            emailInput.dispatchEvent(new Event('change', { bubbles: true }));
        }

        if (passwordInput) {
            passwordInput.value = password;
            passwordInput.dispatchEvent(new Event('input', { bubbles: true }));
            passwordInput.dispatchEvent(new Event('change', { bubbles: true }));
        }

        // Feedback visual: foca no botão "Entrar" para o usuário já clicar
        var submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.focus();
    }
</script>
</x-guest-layout>