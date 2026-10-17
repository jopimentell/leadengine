<footer class="bg-surface-soft border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 md:px-8 lg:px-16 py-12 md:py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

            <!-- COLUNA 1 – Sobre / Logo -->
            <div class="col-span-2 md:col-span-1">
                <span class="font-display font-semibold text-xl text-ink">
                    @isset($user)
                        {{ $user->name }}
                    @else
                        Lead<span class="text-primary">Engine</span>
                    @endisset
                </span>
                <p class="text-sm text-muted mt-2 max-w-xs">
                    @isset($user)
                        CRECI: {{ $user->creci ?? 'Não informado' }}<br>
                        @if($user->city) 📍 {{ $user->city }} @endif
                    @else
                        Sua vitrine digital completa para corretores de imóveis. Capture leads, gerencie imóveis e venda mais.
                    @endisset
                </p>
                @isset($user)
                    <div class="flex flex-wrap items-center gap-3 mt-3 text-sm">
                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank"
                           class="bg-semantic-up text-white rounded-pill px-4 py-1.5 text-sm font-semibold hover:bg-green-700 transition-soft inline-flex items-center gap-1">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                        @if($user->email)
                            <a href="mailto:{{ $user->email }}" class="text-primary hover:underline transition-soft">
                                <i class="fa-solid  fa-envelope"></i> {{ $user->email }}
                            </a>
                        @endif
                    </div>
                @else
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="text-muted hover:text-ink transition-soft"><i class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="text-muted hover:text-ink transition-soft"><i class="fa-brands fa-youtube text-xl"></i></a>
                        <a href="#" class="text-muted hover:text-ink transition-soft"><i class="fa-brands fa-linkedin text-xl"></i></a>
                    </div>
                @endisset
            </div>

            <!-- COLUNA 2 – Links -->
            <div>
                <h4 class="font-semibold text-sm text-ink uppercase tracking-wider">
                    @isset($user) Imóveis @else Produto @endisset
                </h4>
                <ul class="mt-3 space-y-2 text-sm text-muted">
                    @isset($user)
                        <li><a href="{{ route('public.home', $user->slug) }}" class="hover:text-ink transition-soft">Ver todos</a></li>
                        <li><a href="{{ route('public.contato', $user->slug) }}" class="hover:text-ink transition-soft">Solicitar visita</a></li>
                        <li><a href="{{ route('public.sobre', $user->slug) }}" class="hover:text-ink transition-soft">Sobre o corretor</a></li>
                    @else
                        <li><a href="/recursos" class="hover:text-ink transition-soft">Recursos</a></li>
                        <li><a href="#precos" class="hover:text-ink transition-soft">Preços</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Integrações</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Changelog</a></li>
                    @endisset
                </ul>
            </div>

            <!-- COLUNA 3 – Contato / Empresa -->
            <div>
                <h4 class="font-semibold text-sm text-ink uppercase tracking-wider">
                    @isset($user) Contato @else Empresa @endisset
                </h4>
                <ul class="mt-3 space-y-2 text-sm text-muted">
                    @isset($user)
                        <li><a href="https://wa.me/{{ preg_replace('/\D/', '', $user->phone) }}" target="_blank" class="hover:text-ink transition-soft">
                            <i class="fa-brands fa-whatsapp mr-1"></i> WhatsApp
                        </a></li>
                        @if($user->email)
                            <li><a href="mailto:{{ $user->email }}" class="hover:text-ink transition-soft">
                                <i class="fa-solid  fa-envelope mr-1"></i> {{ $user->email }}
                            </a></li>
                        @endif
                        <li><span class="text-muted"><i class="fa-solid  fa-location-dot mr-1"></i> {{ $user->city ?? 'Cidade não informada' }}</span></li>
                    @else
                        <li><a href="/sobre" class="hover:text-ink transition-soft">Sobre</a></li>
                        <li><a href="/contato" class="hover:text-ink transition-soft">Contato</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Blog</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Carreiras</a></li>
                    @endisset
                </ul>
            </div>

            <!-- COLUNA 4 – Suporte / Links rápidos -->
            <div>
                <h4 class="font-semibold text-sm text-ink uppercase tracking-wider">
                    @isset($user) Links @else Suporte @endisset
                </h4>
                <ul class="mt-3 space-y-2 text-sm text-muted">
                    @isset($user)
                        <li><a href="{{ route('public.home', $user->slug) }}" class="hover:text-ink transition-soft">Início</a></li>
                        <li><a href="{{ route('public.sobre', $user->slug) }}" class="hover:text-ink transition-soft">Sobre</a></li>
                        <li><a href="{{ route('public.contato', $user->slug) }}" class="hover:text-ink transition-soft">Contato</a></li>
                    @else
                        <li><a href="#" class="hover:text-ink transition-soft">Ajuda</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Documentação</a></li>
                        <li><a href="#" class="hover:text-ink transition-soft">Status</a></li>
                        <li><a href="/contato" class="hover:text-ink transition-soft">Contato</a></li>
                    @endisset
                </ul>
            </div>

        </div>

        <!-- LEGAL -->
        <div class="border-t border-gray-200 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-muted-soft">
            <span>
                @isset($user)
                    &copy; {{ date('Y') }} {{ $user->name }}. Todos os direitos reservados.
                @else
                    &copy; {{ date('Y') }} Larnex. Todos os direitos reservados.
                @endisset
            </span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-body transition-soft">Política de Privacidade</a>
                <a href="#" class="hover:text-body transition-soft">Termos de Uso</a>
                <a href="#" class="hover:text-body transition-soft">Cookies</a>
            </div>
        </div>
    </div>
</footer>