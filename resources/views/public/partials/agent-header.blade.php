<header class="bg-white border-b border-hairline sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="flex items-center justify-between h-20">

            {{-- ══════ LOGO + NOME DO CORRETOR ══════ --}}
            <div class="flex items-center gap-3 min-w-0">
                {{-- Logo Larnex (leva para home institucional) --}}
                <a href="/" class="font-display font-bold text-xl text-primary hover:opacity-80 transition-soft flex-shrink-0">
                    Larnex
                </a>

                {{-- Divisor vertical --}}
                <span class="w-px h-6 bg-hairline flex-shrink-0"></span>

                {{-- Nome do corretor (leva para vitrine – scroll topo) --}}
                <a href="{{ route('public.home', $user->slug) }}"
                   class="font-display font-semibold text-base md:text-xl text-ink hover:text-primary transition-soft truncate">
                    {{ $user->name }}
                </a>
            </div>

            {{-- ══════ NAV DESKTOP ══════ --}}
            <nav class="hidden lg:flex items-center gap-7 text-sm font-medium">
                <a href="{{ route('public.home', $user->slug) }}#destaques"
                   class="text-body hover:text-ink transition-soft">Destaques</a>
                <a href="{{ route('public.home', $user->slug) }}#imoveis"
                   class="text-body hover:text-ink transition-soft">Imóveis</a>
                <a href="{{ route('public.home', $user->slug) }}#tipos"
                   class="text-body hover:text-ink transition-soft">Tipos</a>
                <a href="{{ route('public.sobre', $user->slug) }}"
                   class="text-body hover:text-ink transition-soft">Sobre</a>
                <a href="{{ route('public.contato', $user->slug) }}"
                   class="text-body hover:text-ink transition-soft">Contato</a>
            </nav>

            {{-- ══════ AÇÕES (direita) ══════ --}}
            <div class="flex items-center gap-2 flex-shrink-0">

                {{-- ──── USUÁRIO LOGADO ──── --}}
                @auth
                    {{-- Dropdown do usuário --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                                class="flex items-center gap-2 rounded-pill border border-hairline hover:bg-surface-soft transition-soft pl-1 pr-3 py-1">
                            {{-- Avatar --}}
                            @if(auth()->user()->avatar)
                                <img src="{{ asset(auth()->user()->avatar) }}"
                                     alt="{{ auth()->user()->name }}"
                                     class="w-7 h-7 rounded-full object-cover">
                            @else
                                <span class="w-7 h-7 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif
                            {{-- Nome --}}
                            <span class="hidden sm:inline text-sm font-medium text-ink truncate max-w-[100px]">
                                {{ explode(' ', auth()->user()->name)[0] }}
                            </span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-muted"></i>
                        </button>

                        {{-- Menu dropdown --}}
                        <div x-show="open" x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-2 w-52 bg-white rounded-xl border border-hairline shadow-soft py-1.5 z-50">

                            {{-- Header do dropdown --}}
                            <div class="px-4 py-2 border-b border-hairline-soft">
                                <p class="text-xs text-muted">Logado como</p>
                                <p class="text-sm font-semibold text-ink truncate">{{ auth()->user()->name }}</p>
                            </div>

                            {{-- Dashboard --}}
                            <a href="{{ route('dashboard.index') }}"
                               class="flex items-center gap-2.5 px-4 py-2 text-sm text-body hover:bg-surface-soft hover:text-ink transition-soft">
                                <i class="fa-solid fa-gauge-high w-4 text-center text-muted"></i>
                                Dashboard
                            </a>

                            {{-- Admin (só se for admin) --}}
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.index') }}"
                                   class="flex items-center gap-2.5 px-4 py-2 text-sm text-body hover:bg-surface-soft hover:text-ink transition-soft">
                                    <i class="fa-solid fa-shield-halved w-4 text-center text-muted"></i>
                                    Painel Admin
                                </a>
                            @endif

                            {{-- Editar perfil --}}
                            <a href="{{ route('dashboard.settings.profile') }}"
                               class="flex items-center gap-2.5 px-4 py-2 text-sm text-body hover:bg-surface-soft hover:text-ink transition-soft">
                                <i class="fa-solid fa-user w-4 text-center text-muted"></i>
                                Meu perfil
                            </a>

                            {{-- Divider --}}
                            <hr class="my-1.5 border-hairline-soft">

                            {{-- Sair --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-semantic-down hover:bg-red-50 transition-soft text-left">
                                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                {{-- ──── VISITANTE ──── --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline-block text-sm font-medium text-body hover:text-ink transition-soft px-3">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}"
                       class="hidden sm:inline-block bg-white text-ink rounded-pill px-4 py-2 text-sm font-semibold border border-hairline hover:bg-surface-soft transition-soft">
                        Criar conta
                    </a>
                @endguest

                {{-- ──── WHATSAPP (sempre presente) ──── --}}
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                   class="hidden md:inline-flex items-center gap-2 bg-primary text-white rounded-pill px-4 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span class="hidden lg:inline">WhatsApp</span>
                </a>

                {{-- Mobile: botão WhatsApp compacto --}}
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                   class="md:hidden w-10 h-10 rounded-full bg-semantic-up text-white flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

                {{-- Mobile: menu hamburger --}}
                <button class="lg:hidden w-10 h-10 rounded-full border border-hairline flex items-center justify-center text-ink"
                        x-data @click="$dispatch('open-mobile-menu')">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>
    </div>

    {{-- ══════ MENU MOBILE (drawer) ══════ --}}
    <div x-data="{ open: false }"
         @open-mobile-menu.window="open = true"
         x-show="open" x-cloak
         class="lg:hidden fixed inset-0 z-50">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/50" @click="open = false"></div>

        {{-- Drawer --}}
        <aside class="absolute right-0 top-0 bottom-0 w-72 bg-white shadow-xl p-6 flex flex-col"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0">

            <div class="flex items-center justify-between mb-6">
                <span class="font-display font-bold text-primary">Larnex</span>
                <button @click="open = false" class="w-8 h-8 rounded-full hover:bg-surface-soft flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav class="flex-1 space-y-1">
                <a href="{{ route('public.home', $user->slug) }}#destaques" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Destaques</a>
                <a href="{{ route('public.home', $user->slug) }}#imoveis" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Imóveis</a>
                <a href="{{ route('public.home', $user->slug) }}#tipos" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Tipos</a>
                <a href="{{ route('public.sobre', $user->slug) }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Sobre</a>
                <a href="{{ route('public.contato', $user->slug) }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Contato</a>

                @auth
                    <hr class="my-3 border-hairline-soft">
                    <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">
                        <i class="fa-solid fa-gauge-high w-4"></i> Dashboard
                    </a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">
                            <i class="fa-solid fa-shield-halved w-4"></i> Painel Admin
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-semantic-down hover:bg-red-50 text-left">
                            <i class="fa-solid fa-arrow-right-from-bracket w-4"></i> Sair
                        </button>
                    </form>
                @endauth

                @guest
                    <hr class="my-3 border-hairline-soft">
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-body hover:bg-surface-soft">Entrar</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2.5 rounded-lg text-sm font-semibold text-white bg-primary text-center mt-2">Criar conta</a>
                @endguest
            </nav>

            <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
               class="mt-6 bg-semantic-up text-white rounded-pill py-3 text-sm font-semibold flex items-center justify-center gap-2">
                <i class="fa-brands fa-whatsapp"></i>
                WhatsApp
            </a>
        </aside>
    </div>
</header>
