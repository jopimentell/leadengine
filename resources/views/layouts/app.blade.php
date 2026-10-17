<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Larnex - Sua vitrine digital para imóveis')">
    <title>@yield('title', 'Larnex')</title>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- TAILWIND -->
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
                    fontFamily: { display: ['Inter', 'sans-serif'], sans: ['Inter', 'sans-serif'], mono: ['"JetBrains Mono"', 'monospace'] },
                    borderRadius: { xs: '4px', sm: '8px', md: '12px', lg: '16px', xl: '24px', pill: '100px', full: '9999px' },
                    boxShadow: { soft: '0 4px 12px rgba(0, 0, 0, 0.04)' },
                }
            }
        }
    </script>

    <!-- SWIPER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        .font-display { font-family: 'Inter', sans-serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        [x-cloak] { display: none !important; }
        .swiper-button-next, .swiper-button-prev {
            color: #0052ff !important;
            background: white;
            width: 44px !important;
            height: 44px !important;
            border-radius: 9999px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 18px !important;
            font-weight: 700;
        }
        .swiper-pagination-bullet { background: #dee1e6; opacity: 1; }
        .swiper-pagination-bullet-active { background: #0052ff; }
        .transition-soft { transition: all 0.25s ease; }
    </style>
    @stack('styles')
</head>
<body>

    @include('partials.toast')

    {{-- Header global: só aparece quando a view NÃO declarar @section('hide-global-header') --}}
    @unless(View::hasSection('hide-global-header'))
        @include('public.partials.header')
    @endunless

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('public.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>