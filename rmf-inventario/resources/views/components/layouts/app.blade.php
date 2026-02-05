<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RMF Inventory' }}</title>
    <meta name="description"
        content="Sistema moderno de gestion de inventario para empresas. Controla tu stock, optimiza procesos y toma decisiones inteligentes.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        background: '#ffffff',
                        foreground: '#0d0d0d',
                        card: '#fafafa',
                        'card-foreground': '#0d0d0d',
                        muted: '#f0f0f0',
                        'muted-foreground': '#666666',
                        accent: '#7c3aed',
                        'accent-foreground': '#ffffff',
                        border: '#e5e5e5',
                        input: '#e5e5e5',
                    }
                }
            }
        }
    </script>

    <style>
        /* Base styles */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #0d0d0d;
        }

        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Animations */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }

        .animation-delay-200 {
            animation-delay: 200ms;
        }

        .animation-delay-400 {
            animation-delay: 400ms;
        }

        .animation-delay-600 {
            animation-delay: 600ms;
        }

        .animation-delay-800 {
            animation-delay: 800ms;
        }

        /* Focus styles */
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #0d0d0d;
            box-shadow: 0 0 0 1px #0d0d0d;
        }
    </style>

    @livewireStyles
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased">

    <x-navbar />

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <x-footer />

    @livewireScripts

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('glass', 'shadow-lg', 'py-3');
                navbar.classList.remove('bg-transparent', 'py-5');
            } else {
                navbar.classList.remove('glass', 'shadow-lg', 'py-3');
                navbar.classList.add('bg-transparent', 'py-5');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var menuIcon = document.getElementById('menu-icon');
            var closeIcon = document.getElementById('close-icon');
            
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(function(link) {
            link.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.add('hidden');
                document.getElementById('menu-icon').classList.remove('hidden');
                document.getElementById('close-icon').classList.add('hidden');
            });
        });
    </script>
</body>

</html>
