<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16">
        <div class="flex items-center justify-between h-16">

            <!-- LOGO -->
            <a href="/" class="flex items-center gap-0 font-display font-semibold text-xl text-ink">
                <span class="text-primary">Lar</span>nex
            </a>

            <!-- NAV DESKTOP -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="/" class="text-body hover:text-ink transition-soft">Início</a>
                <a href="#recursos" class="text-body hover:text-ink transition-soft">Recursos</a>
                <a href="#precos" class="text-body hover:text-ink transition-soft">Preços</a>
                <a href="/sobre" class="text-body hover:text-ink transition-soft">Sobre</a>
                <a href="/contato" class="text-body hover:text-ink transition-soft">Contato</a>
            </nav>

            <!-- AÇÕES -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard.index') }}" class="text-sm font-medium text-body hover:text-ink transition-soft">
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
            </div>

            <!-- MENU MOBILE -->
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded-full transition-soft">
                    <i class="fa-solid fa-bars text-xl text-ink"></i>
                </button>

                <div x-show="open" x-cloak @click.away="open = false"
                     class="absolute left-0 right-0 top-16 bg-white border-b border-gray-200 shadow-soft p-4 flex flex-col gap-3">
                    <a href="/" class="text-body hover:text-ink transition-soft py-1">Início</a>
                    <a href="#recursos" class="text-body hover:text-ink transition-soft py-1">Recursos</a>
                    <a href="#precos" class="text-body hover:text-ink transition-soft py-1">Preços</a>
                    <a href="/sobre" class="text-body hover:text-ink transition-soft py-1">Sobre</a>
                    <a href="/contato" class="text-body hover:text-ink transition-soft py-1">Contato</a>
                    @guest
                        <hr class="border-gray-200">
                        <a href="{{ route('login') }}" class="text-body hover:text-ink transition-soft py-1">Entrar</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white rounded-pill px-5 py-2.5 text-sm font-semibold text-center hover:bg-primary-active transition-soft">
                            Começar Grátis
                        </a>
                    @endguest
                    @auth
                        <hr class="border-gray-200">
                        <a href="{{ route('dashboard.index') }}" class="text-body hover:text-ink transition-soft py-1">Dashboard</a>
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