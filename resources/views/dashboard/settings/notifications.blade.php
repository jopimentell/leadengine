@extends('layouts.dashboard')

@section('title', 'Notificações')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-ink mb-6">🔔 Preferências de Notificação</h1>

    <form method="POST" action="{{ route('dashboard.settings.notifications.update') }}" class="bg-white rounded-xl border border-hairline p-6 shadow-soft space-y-6">
        @csrf @method('PUT')

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-medium text-ink">Notificações por WhatsApp</h4>
                    <p class="text-sm text-muted">Receba alertas de novos leads diretamente no seu WhatsApp.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="whatsapp_notifications" value="1"
                           {{ auth()->user()->preferences->whatsapp_notifications ?? true ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-soft"></div>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-medium text-ink">Notificações por E-mail</h4>
                    <p class="text-sm text-muted">Receba resumos semanais e alertas importantes por e-mail.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="email_notifications" value="1"
                           {{ auth()->user()->preferences->email_notifications ?? true ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-soft"></div>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-medium text-ink">Relatório semanal</h4>
                    <p class="text-sm text-muted">Receba um relatório com estatísticas de leads e visualizações.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="weekly_report" value="1"
                           {{ auth()->user()->preferences->weekly_report ?? false ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-soft"></div>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-primary text-white rounded-pill px-8 py-3 text-sm font-semibold hover:bg-primary-active transition-soft">
            <i class="fa-solid  fa-floppy-disk mr-1"></i> Salvar preferências
        </button>

    </form>
</div>
@endsection
