<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="flex items-center justify-between h-16">

            <!-- LOGO -->
            <a href="/" class="flex items-center gap-2 font-display font-semibold text-xl text-ink" style="gap: 0;">
                <span class="text-primary mr-0">Lar</span>nex
            </a>

            <!-- NAV DESKTOP -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                @isset($user)
                    <!-- Vitrine do corretor -->
                    <a href="{{ route('public.home', $user->slug) }}" class="text-body hover:text-ink transition-soft">Início</a>
                    <a href="{{ route('public.sobre', $user->slug) }}" class="text-body hover:text-ink transition-soft">Sobre</a>
                    <a href="{{ route('public.contato', $user->slug) }}" class="text-body hover:text-ink transition-soft">Contato</a>
                @else
                    <!-- Landing institucional -->
                    <a href="/" class="text-body hover:text-ink transition-soft">Início</a>
                    <a href="/sobre" class="text-body hover:text-ink transition-soft">Sobre</a>
                    <a href="/contato" class="text-body hover:text-ink transition-soft">Contato</a>
                    <a href="/recursos" class="text-body hover:text-ink transition-soft">Recursos</a>
                @endisset
            </nav>

            <!-- AÇÕES -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-body hover:text-ink transition-soft">
                        <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-body hover:text-ink transition-soft">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-body hover:text-ink transition-soft">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary text-white rounded-pill px-5 py-2.5 text-sm font-semibold hover:bg-primary-active transition-soft">
                        Começar Grátis
                    </a>
                @endauth

                @isset($user)
                    <!-- Informações do corretor (apenas na vitrine) -->
                    <div class="flex items-center gap-2 ml-2 pl-2 border-l border-hairline">
                        <span class="text-sm text-muted hidden sm:inline">{{ $user->name }}</span>
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                           class="bg-semantic-up text-white rounded-pill px-3 py-1.5 text-xs font-semibold hover:bg-green-700 transition-soft">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                @endisset
            </div>

            <!-- MENU MOBILE -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded-full transition-soft">
                    <i class="fa-solid fa-bars text-xl text-ink"></i>
                </button>

                <div x-show="open" x-cloak @click.away="open = false"
                     class="absolute left-0 right-0 top-16 bg-white border-b border-gray-200 shadow-soft p-4 flex flex-col gap-3">
                    @isset($user)
                        <!-- Vitrine do corretor -->
                        <a href="{{ route('public.home', $user->slug) }}" class="text-body hover:text-ink transition-soft py-1">Início</a>
                        <a href="{{ route('public.sobre', $user->slug) }}" class="text-body hover:text-ink transition-soft py-1">Sobre</a>
                        <a href="{{ route('public.contato', $user->slug) }}" class="text-body hover:text-ink transition-soft py-1">Contato</a>
                    @else
                        <!-- Landing institucional -->
                        <a href="/" class="text-body hover:text-ink transition-soft py-1">Início</a>
                        <a href="/sobre" class="text-body hover:text-ink transition-soft py-1">Sobre</a>
                        <a href="/contato" class="text-body hover:text-ink transition-soft py-1">Contato</a>
                        <a href="/recursos" class="text-body hover:text-ink transition-soft py-1">Recursos</a>
                    @endisset
                    <hr class="border-gray-200">
                    @guest
                        <a href="{{ route('login') }}" class="text-body hover:text-ink transition-soft py-1">Entrar</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white rounded-pill px-5 py-2.5 text-sm font-semibold text-center hover:bg-primary-active transition-soft">
                            Começar Grátis
                        </a>
                    @endguest
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-body hover:text-ink transition-soft py-1">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-body hover:text-ink transition-soft py-1 w-full text-left">Sair</button>
                        </form>
                    @endauth
                </div>
            </div>

        </div>
    </div>
</header>