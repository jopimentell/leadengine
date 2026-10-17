@extends('layouts.admin')

@section('title', 'Logs')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-ink">📋 Logs do Sistema</h1>
    <span class="text-xs text-muted">
        Atualizado em {{ now()->format('d/m/Y H:i:s') }}
    </span>
</div>

<div class="grid grid-cols-1 gap-6">
    @foreach($logs as $channel => $lines)
        <div class="bg-white rounded-xl border border-hairline shadow-soft p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-semibold text-ink uppercase tracking-wider text-sm flex items-center gap-2">
                    @if($channel === 'app') <i class="fa-solid fa-server text-primary"></i> Aplicação
                    @elseif($channel === 'leads') <i class="fa-solid fa-inbox text-semantic-up"></i> Leads
                    @elseif($channel === 'auth') <i class="fa-solid fa-shield-halved text-primary"></i> Autenticação
                    @elseif($channel === 'performance') <i class="fa-solid fa-gauge-high text-yellow-500"></i> Performance
                    @elseif($channel === 'security') <i class="fa-solid fa-lock text-semantic-down"></i> Segurança
                    @endif
                </h3>
                <span class="text-xs text-muted">{{ count($lines) }} entradas</span>
            </div>
            <div class="bg-gray-950 rounded-lg p-3 font-mono text-xs text-gray-200 overflow-x-auto max-h-64 overflow-y-auto">
                @foreach($lines as $line)
                    <div class="border-b border-gray-800 py-0.5 last:border-0 break-all">{{ $line }}</div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection