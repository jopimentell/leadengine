@extends('layouts.app')

@section('title', 'Login - Larnex')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center bg-surface-soft py-12">
    <div class="w-full max-w-md bg-white rounded-xl border border-hairline p-8 shadow-soft">

        <h1 class="text-2xl font-bold text-ink text-center">Entrar na sua conta</h1>
        <p class="text-muted text-sm text-center mt-1">Acesse o dashboard do Larnex</p>

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf

            <!-- E-mail -->
            <div>
                <label class="text-sm font-medium text-ink">E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('email')
                    <p class="text-sm text-semantic-down mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Senha -->
            <div>
                <label class="text-sm font-medium text-ink">Senha</label>
                <input type="password" name="password" required
                       class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                @error('password')
                    <p class="text-sm text-semantic-down mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lembrar-me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-muted">
                    <input type="checkbox" name="remember" class="text-primary focus:ring-primary rounded border-hairline">
                    Lembrar-me
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline transition-soft">
                    Esqueceu a senha?
                </a>
            </div>

            <button type="submit" class="w-full bg-primary text-white rounded-pill py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
                Entrar
            </button>
        </form>

        <p class="text-center text-sm text-muted mt-4">
            Não tem uma conta? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline transition-soft">Cadastre-se</a>
        </p>

    </div>
</div>
@endsection