<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Larnex')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#0052ff', active: '#003ecc', disabled: '#a8b8cc' },
                        ink: '#0a0b0d',
                        body: '#5b616e',
                        muted: '#7c828a',
                        hairline: '#dee1e6',
                        semantic: { up: '#05b169', down: '#cf202f' },
                    },
                    borderRadius: { pill: '100px' },
                    boxShadow: { soft: '0 4px 12px rgba(0, 0, 0, 0.04)' },
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .transition-soft { transition: all 0.25s ease; }
    </style>
    @stack('styles')
</head>
<body>

    @include('partials.toast')

    <div class="flex min-h-screen bg-gray-50">

        <!-- SIDEBAR ADMIN -->
        <aside class="w-64 bg-white border-r border-hairline p-4 flex flex-col h-screen sticky top-0 overflow-y-auto">
            <div class="flex items-center gap-2 mb-6">
                <span class="font-bold text-xl text-ink">Lead<span class="text-primary">Engine</span></span>
                <span class="text-xs bg-primary/10 text-primary font-semibold rounded-pill px-2 py-0.5">Admin</span>
            </div>

            <nav class="flex-1 space-y-1">
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-gray-50 hover:text-ink transition-soft {{ request()->routeIs('admin.index') ? 'bg-gray-50 text-ink' : '' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center"></i> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-gray-50 hover:text-ink transition-soft {{ request()->routeIs('admin.users') ? 'bg-gray-50 text-ink' : '' }}">
                    <i class="fa-solid fa-users w-5 text-center"></i> Usuários
                </a>
                <a href="{{ route('admin.properties') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-gray-50 hover:text-ink transition-soft {{ request()->routeIs('admin.properties') ? 'bg-gray-50 text-ink' : '' }}">
                    <i class="fa-solid fa-building w-5 text-center"></i> Imóveis
                </a>
                <a href="{{ route('admin.transactions') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-gray-50 hover:text-ink transition-soft {{ request()->routeIs('admin.transactions') ? 'bg-gray-50 text-ink' : '' }}">
                    <i class="fa-solid fa-credit-card w-5 text-center"></i> Transações
                </a>
                <a href="{{ route('admin.logs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-gray-50 hover:text-ink transition-soft {{ request()->routeIs('admin.logs') ? 'bg-gray-50 text-ink' : '' }}">
                    <i class="fa-solid fa-list w-5 text-center"></i> Logs
                </a>
            </nav>

            <div class="pt-4 border-t border-hairline">
                <!-- CORRIGIDO: USAR admin.index, NÃO dashboard.index -->
                <a href="{{ route('admin.index') }}" class="flex items-center gap-2 text-sm text-muted hover:text-ink transition-soft">
                    <i class="fa-solid fa-arrow-left"></i> Painel Admin
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-sm text-muted hover:text-semantic-down transition-soft">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTEÚDO -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>

    </div>

    @stack('scripts')
</body>
</html>