@extends('layouts.dashboard')

@section('title', 'Conta')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">🔐 Configurações da Conta</h1>

    <div class="bg-white rounded-xl border border-hairline p-6 shadow-soft space-y-6">

        <!-- Alterar Senha -->
        <div>
            <h3 class="font-semibold text-ink">Alterar senha</h3>
            <form method="POST" action="{{ route('dashboard.settings.account.password') }}" class="mt-3 space-y-3">
                @csrf @method('PUT')
                <div>
                    <label class="text-sm font-medium text-ink">Senha atual</label>
                    <input type="password" name="current_password"
                           class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="text-sm font-medium text-ink">Nova senha</label>
                    <input type="password" name="new_password"
                           class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="text-sm font-medium text-ink">Confirmar nova senha</label>
                    <input type="password" name="new_password_confirmation"
                           class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit" class="bg-primary text-white rounded-pill px-6 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft">
                    Atualizar senha
                </button>
            </form>
        </div>

        <hr class="border-hairline">

        <!-- Excluir Conta -->
        <div>
            <h3 class="font-semibold text-semantic-down">⚠️ Área de risco</h3>
            <p class="text-sm text-muted mt-1">Ao excluir sua conta, todos os seus dados (imóveis, leads, configurações) serão permanentemente removidos. Esta ação não pode ser desfeita.</p>

            <div x-data="{ showModal: false }">
                <button @click="showModal = true" class="mt-3 bg-semantic-down text-white rounded-pill px-6 py-2.5 text-sm font-semibold hover:bg-red-700 transition-soft">
                    <i class="fa-solid  fa-trash-can mr-1"></i> Excluir minha conta
                </button>

                <!-- Modal de Confirmação -->
                <div x-show="showModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" x-cloak>
                    <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-soft" @click.away="showModal = false">
                        <h3 class="text-lg font-bold text-ink">Tem certeza?</h3>
                        <p class="text-sm text-muted mt-2">Esta ação é irreversível. Todos os seus dados serão apagados permanentemente.</p>
                        <div class="mt-4">
                            <label class="text-sm font-medium text-ink">Confirme sua senha</label>
                            <input type="password" placeholder="Digite sua senha"
                                   class="w-full bg-white rounded-pill px-4 py-2.5 text-sm border border-hairline focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div class="flex gap-3 mt-4">
                            <button class="flex-1 bg-semantic-down text-white rounded-pill py-2.5 text-sm font-semibold hover:bg-red-700 transition-soft">
                                Sim, excluir conta
                            </button>
                            <button @click="showModal = false" class="flex-1 bg-white text-ink rounded-pill py-2.5 text-sm font-semibold border border-hairline hover:bg-gray-50 transition-soft">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection