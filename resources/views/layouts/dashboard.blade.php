<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard - Larnex')</title>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- DAISYUI (NECESSÁRIO PARA O DRAWER) -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />

    <!-- CHART.JS (ADICIONADO) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- TAILWIND CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#0052ff', active: '#003ecc', disabled: '#a8b8cc' },
                        canvas: '#ffffff',
                        surface: { soft: '#f7f7f7', strong: '#eef0f3', dark: '#0a0b0d', elevated: '#16181c' },
                        ink: '#0a0b0d',
                        body: '#5b616e',
                        muted: '#7c828a',
                        'muted-soft': '#a8acb3',
                        hairline: '#dee1e6',
                        'on-primary': '#ffffff',
                        'on-dark': '#ffffff',
                        'on-dark-soft': '#a8acb3',
                        'semantic-up': '#05b169',
                        'semantic-down': '#cf202f',
                    },
                    fontFamily: {
                        display: ['Inter', 'system-ui', 'sans-serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    borderRadius: {
                        xs: '4px', sm: '8px', md: '12px', lg: '16px', xl: '24px', pill: '100px', full: '9999px',
                    },
                    boxShadow: {
                        soft: '0 4px 12px rgba(0, 0, 0, 0.04)',
                    },
                }
            }
        }
    </script>

    <style>
        .font-display { font-family: 'Inter', system-ui, sans-serif; }
        .font-sans { font-family: 'Inter', system-ui, sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        [x-cloak] { display: none !important; }
        .transition-soft { transition: all 0.25s ease; }

        /* Sidebar scroll */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #dee1e6; border-radius: 9999px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: #a8acb3; }
    </style>

    @stack('styles')
</head>
<body>

    <!-- TOAST -->
    @include('partials.toast')

    <!-- DRAWER CONTAINER -->
    <div class="drawer lg:drawer-open">
        <input id="dashboard-drawer" type="checkbox" class="drawer-toggle" />

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="drawer-content flex flex-col min-h-screen bg-surface-soft">

            <!-- HEADER SUPERIOR -->
            <header class="bg-white border-b border-hairline sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 h-16">

                    <div class="flex items-center gap-3">
                        <label for="dashboard-drawer" class="lg:hidden btn btn-ghost btn-sm">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </label>
                        <span class="font-display font-semibold text-lg text-ink">
                            Lead<span class="text-primary">Engine</span>
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-muted hidden sm:inline">{{ auth()->user()->name }}</span>
                        <div class="avatar placeholder">
                            <div class="w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-ghost btn-sm text-muted hover:text-ink transition-soft">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </header>

            <!-- CONTEÚDO -->
            <main class="flex-1 p-4 md:p-6">
                @yield('content')
            </main>

        </div>

        <!-- SIDEBAR -->
        <div class="drawer-side z-40">
            <label for="dashboard-drawer" class="drawer-overlay"></label>
            <aside class="bg-white w-72 h-full p-4 border-r border-hairline flex flex-col sidebar-scroll overflow-y-auto">

                <div class="flex items-center gap-2 mb-6">
                    <span class="font-display font-bold text-xl text-ink">Lead<span class="text-primary">Engine</span></span>
                </div>

                <nav class="flex-1 space-y-1">
                    <!-- ÍCONES CORRIGIDOS: usar fa-solid para ícones que não têm versão regular -->
                    <a href="{{ route('dashboard.index') }}" class="... {{ request()->routeIs('dashboard.index') ? 'bg-surface-soft text-ink' : '' }}">
                        <i class="fa-solid fa-gauge-high w-5 text-center"></i> Resumo
                    </a>                    </a>
                    <a href="{{ route('dashboard.properties.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft {{ request()->routeIs('dashboard.properties.*') ? 'bg-surface-soft text-ink' : '' }}">
                        <i class="fa-solid fa-building w-5 text-center"></i> Imóveis
                    </a>
                    <a href="{{ route('dashboard.leads.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft {{ request()->routeIs('dashboard.leads.*') ? 'bg-surface-soft text-ink' : '' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i> Leads
                    </a>

                    <hr class="border-hairline my-3">

                    <p class="text-xs font-semibold text-muted-soft uppercase tracking-wider px-3 mt-4">Configurações</p>
                    <a href="{{ route('dashboard.settings.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft {{ request()->routeIs('dashboard.settings.*') ? 'bg-surface-soft text-ink' : '' }}">
                        <i class="fa-solid fa-user w-5 text-center"></i> Perfil
                    </a>
                    <a href="{{ route('dashboard.settings.domain') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft">
                        <i class="fa-solid fa-globe w-5 text-center"></i> Domínio
                    </a>
                    <a href="{{ route('dashboard.settings.subscription') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft">
                        <i class="fa-solid  fa-credit-card w-5 text-center"></i> Assinatura
                    </a>
                    <a href="{{ route('dashboard.settings.credits') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft">
                        <i class="fa-solid fa-wand-magic-sparkles w-5 text-center"></i> Créditos IA
                    </a>
                    <a href="{{ route('dashboard.settings.notifications') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft">
                        <i class="fa-solid  fa-bell w-5 text-center"></i> Notificações
                    </a>
                    <a href="{{ route('dashboard.settings.account') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft hover:text-ink transition-soft">
                        <i class="fa-solid fa-gear w-5 text-center"></i> Conta
                    </a>
                </nav>

                <!-- Link para página pública -->
                <div class="mt-auto pt-4 border-t border-hairline">
                    <a href="{{ route('public.home', auth()->user()->slug) }}" target="_blank"
                       class="flex items-center justify-center gap-2 bg-surface-strong text-ink rounded-pill px-4 py-2.5 text-sm font-medium hover:bg-gray-200 transition-soft">
                        <i class="fa-solid  fa-eye"></i> Ver página pública
                        <i class="fa-solid  fa-arrow-up-right-from-square text-xs"></i>
                    </a>
                </div>

            </aside>
        </div>
    </div>

    @stack('scripts')
</body>
</html>