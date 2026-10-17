<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Larnex - Autenticação')</title>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- TAILWIND -->
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
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        pill: '100px',
                        xl: '24px',
                    },
                    boxShadow: {
                        soft: '0 4px 12px rgba(0, 0, 0, 0.04)',
                    }
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
<body class="bg-surface-soft font-sans antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-ink mb-8">
            Lar<span class="text-primary">nex</span>
        </a>

        <!-- Conteúdo principal -->
        <div class="w-full max-w-md bg-white rounded-xl border border-hairline p-6 shadow-soft">
            {{ $slot }}
        </div>

        <!-- Rodapé simples -->
        <p class="text-xs text-muted mt-6">
            &copy; {{ date('Y') }} Larnex. Todos os direitos reservados.
        </p>
    </div>

    @stack('scripts')
</body>
</html>
