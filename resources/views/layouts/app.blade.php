<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'MULTICREATH | Soluciones Creativas y Tecnológicas')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        body { font-family: 'Space Grotesk', sans-serif; }
        .material-symbols-outlined { font-size: 24px; }
        /* Portfolio Card Effects */
    .browser-mockup {
        transition: transform 0.3s ease-in-out;
    }
    .project-card:hover .browser-mockup {
        transform: translateY(-8px);
    }
    .project-overlay {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .project-card:hover .project-overlay {
        opacity: 1;
    }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white transition-colors duration-300">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        
        {{-- Navbar --}}
        @include('components.navbar')

        {{-- Main Content --}}
        <main class="flex-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.footer')

    </div>
</body>
</html>