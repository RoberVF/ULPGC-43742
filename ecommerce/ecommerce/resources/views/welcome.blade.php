<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoMarket - Conectando Productores, Vendedores y Clientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        .gradient-text {
            background: linear-gradient(135deg, #22c55e 0%, #4ade80 50%, #86efac 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-glow:hover {
            box-shadow: 0 0 40px rgba(34, 197, 94, 0.15);
        }

        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.4);
        }

        .hero-gradient {
            background: radial-gradient(ellipse at top, rgba(34, 197, 94, 0.15) 0%, transparent 50%);
        }

        .line-connector {
            background: linear-gradient(90deg, transparent 0%, #22c55e 50%, transparent 100%);
        }

        /* Mobile menu con CSS puro */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu-toggle:checked~.mobile-menu {
            max-height: 400px;
        }

        .mobile-menu-toggle {
            display: none;
        }

        .hamburger-icon {
            cursor: pointer;
        }

        .hamburger-icon span {
            display: block;
            width: 24px;
            height: 2px;
            background-color: #a1a1aa;
            margin: 5px 0;
            transition: all 0.3s ease;
        }

        .mobile-menu-toggle:checked~label .hamburger-icon span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-toggle:checked~label .hamburger-icon span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle:checked~label .hamburger-icon span:nth-child(3) {
            transform: rotate(-45deg) translate(5px, -5px);
        }
    </style>
</head>

<body class="bg-zinc-950 text-white antialiased">

    <!-- Navbar -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </header>


    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-zinc-950/80 backdrop-blur-xl border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-zinc-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold">EcoMarket</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#roles" class="text-zinc-400 hover:text-white transition-colors">Roles</a>
                    <a href="#como-funciona" class="text-zinc-400 hover:text-white transition-colors">Como Funciona</a>
                    <a href="#beneficios" class="text-zinc-400 hover:text-white transition-colors">Beneficios</a>
                </div>

                <!-- CTA Buttons Desktop -->
                <div class="hidden md:flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-zinc-400 hover:text-white transition-colors px-4 py-2">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-zinc-400 hover:text-white transition-colors px-4 py-2">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-green-500 hover:bg-green-600 text-zinc-950 font-semibold px-4 py-2 rounded-lg transition-all btn-glow">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Toggle (CSS only) -->
                <div class="md:hidden relative">
                    <input type="checkbox" id="mobile-toggle" class="mobile-menu-toggle">
                    <label for="mobile-toggle" class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                </div>
            </div>

            <!-- Mobile Menu -->
            <input type="checkbox" id="mobile-toggle-menu" class="mobile-menu-toggle md:hidden">
            <div class="mobile-menu md:hidden border-t border-zinc-800">
                <div class="py-4 flex flex-col gap-4">
                    <a href="#roles" class="text-zinc-400 hover:text-white transition-colors">Roles</a>
                    <a href="#como-funciona" class="text-zinc-400 hover:text-white transition-colors">Como Funciona</a>
                    <a href="#beneficios" class="text-zinc-400 hover:text-white transition-colors">Beneficios</a>
                    <div class="pt-4 border-t border-zinc-800 flex flex-col gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-zinc-400 hover:text-white transition-colors px-4 py-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-zinc-400 hover:text-white transition-colors px-4 py-2">
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-green-500 hover:bg-green-600 text-zinc-950 font-semibold px-4 py-2 rounded-lg transition-all btn-glow">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>




    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-16 hero-gradient">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-2 bg-zinc-900 border border-zinc-800 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    <span class="text-sm text-zinc-400">Plataforma de comercio B2B y B2C</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-tight mb-6">
                    Conectamos toda la
                    <span class="gradient-text">cadena de valor</span>
                </h1>

                <p class="text-lg sm:text-xl text-zinc-400 max-w-2xl mx-auto mb-10">
                    EcoMarket une a productores, vendedores y clientes en un unico ecosistema digital.
                    Optimiza tu negocio y alcanza nuevos mercados.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-zinc-950 font-semibold px-8 py-4 rounded-xl transition-all btn-glow text-center">
                        Comenzar Ahora
                    </a>
                    <a href="#como-funciona"
                        class="w-full sm:w-auto bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-semibold px-8 py-4 rounded-xl transition-all text-center">
                        Ver Como Funciona
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-green-400">2.5K+</div>
                        <div class="text-sm text-zinc-500">Productores</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-green-400">8K+</div>
                        <div class="text-sm text-zinc-500">Vendedores</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-bold text-green-400">50K+</div>
                        <div class="text-sm text-zinc-500">Clientes</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative gradient -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-zinc-950 to-transparent"></div>
    </section>

    <!-- Roles Section -->
    <section id="roles" class="py-24 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-green-500 font-semibold text-sm uppercase tracking-wider">Nuestro Ecosistema</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-6">
                    Tres roles, un solo <span class="gradient-text">objetivo</span>
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto">
                    Cada participante en EcoMarket tiene un papel fundamental en la cadena de valor.
                </p>
            </div>

            <!-- Roles Cards -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Productor Card -->
                <div
                    class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 transition-all duration-300 card-glow hover:border-green-500/50">
                    <div class="w-14 h-14 bg-green-500/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Productores</h3>
                    <p class="text-zinc-400 mb-6">
                        Genera productos y los vende directamente a los vendedores. Accede a una red amplia de
                        distribuidores.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Gestion de inventario
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Precios mayoristas
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Analisis de demanda
                        </li>
                    </ul>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-green-500 font-semibold mt-8 hover:text-green-400 transition-colors">
                        Registrarse como Productor
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Vendedor Card -->
                <div
                    class="bg-zinc-900 border border-green-500/30 rounded-2xl p-8 transition-all duration-300 card-glow hover:border-green-500/50 md:-translate-y-4 relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <span class="bg-green-500 text-zinc-950 text-xs font-bold px-3 py-1 rounded-full">MAS
                            POPULAR</span>
                    </div>
                    <div class="w-14 h-14 bg-green-500/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Vendedores</h3>
                    <p class="text-zinc-400 mb-6">
                        Compra a productores y vende a clientes finales. El puente perfecto entre la produccion y el
                        consumo.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Tienda personalizable
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Margen de ganancia flexible
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Herramientas de marketing
                        </li>
                    </ul>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-green-500 font-semibold mt-8 hover:text-green-400 transition-colors">
                        Registrarse como Vendedor
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Cliente Card -->
                <div
                    class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8 transition-all duration-300 card-glow hover:border-green-500/50">
                    <div class="w-14 h-14 bg-green-500/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Clientes</h3>
                    <p class="text-zinc-400 mb-6">
                        Compra productos de calidad a vendedores verificados. Disfruta de la mejor experiencia de
                        compra.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Variedad de productos
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Compra segura
                        </li>
                        <li class="flex items-center gap-3 text-sm text-zinc-300">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Seguimiento de pedidos
                        </li>
                    </ul>
                    <a href="#"
                        class="inline-flex items-center gap-2 text-green-500 font-semibold mt-8 hover:text-green-400 transition-colors">
                        Registrarse como Cliente
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section id="como-funciona" class="py-24 bg-zinc-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-green-500 font-semibold text-sm uppercase tracking-wider">Proceso</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-6">
                    Como <span class="gradient-text">funciona</span>
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto">
                    Un flujo simple que conecta toda la cadena de valor de manera eficiente.
                </p>
            </div>

            <!-- Flow Diagram -->
            <div class="grid md:grid-cols-5 gap-4 items-center">
                <!-- Step 1 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-zinc-900 border-2 border-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Productor</h4>
                    <p class="text-sm text-zinc-500">Crea el producto</p>
                </div>

                <!-- Arrow 1 -->
                <div class="hidden md:flex items-center justify-center">
                    <div class="h-0.5 w-full line-connector"></div>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-zinc-900 border-2 border-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Vendedor</h4>
                    <p class="text-sm text-zinc-500">Distribuye y vende</p>
                </div>

                <!-- Arrow 2 -->
                <div class="hidden md:flex items-center justify-center">
                    <div class="h-0.5 w-full line-connector"></div>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-zinc-900 border-2 border-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Cliente</h4>
                    <p class="text-sm text-zinc-500">Compra y disfruta</p>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid md:grid-cols-3 gap-6 mt-16">
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">1</div>
                    <h4 class="font-semibold mb-2">Registro Sencillo</h4>
                    <p class="text-sm text-zinc-500">Crea tu cuenta en minutos y elige tu rol en la plataforma.</p>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">2</div>
                    <h4 class="font-semibold mb-2">Conecta</h4>
                    <p class="text-sm text-zinc-500">Encuentra productores o vendedores segun tus necesidades.</p>
                </div>
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">3</div>
                    <h4 class="font-semibold mb-2">Comercia</h4>
                    <p class="text-sm text-zinc-500">Realiza transacciones seguras y haz crecer tu negocio.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="beneficios" class="py-24 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="text-green-500 font-semibold text-sm uppercase tracking-wider">Ventajas</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-4 mb-6">
                    Por que elegir <span class="gradient-text">EcoMarket</span>
                </h2>
                <p class="text-zinc-400 max-w-2xl mx-auto">
                    Ofrecemos las mejores herramientas para que tu negocio prospere.
                </p>
            </div>

            <!-- Benefits Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Transacciones Seguras</h3>
                    <p class="text-zinc-500 text-sm">Proteccion en cada operacion con encriptacion de datos y
                        verificacion de usuarios.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Rapidez</h3>
                    <p class="text-zinc-500 text-sm">Procesos optimizados para que tus productos lleguen mas rapido al
                        mercado.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Analiticas</h3>
                    <p class="text-zinc-500 text-sm">Dashboard completo con metricas de ventas, tendencias y
                        comportamiento del mercado.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Pagos Flexibles</h3>
                    <p class="text-zinc-500 text-sm">Multiples metodos de pago y opciones de financiamiento para tu
                        comodidad.</p>
                </div>

                <!-- Benefit 5 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Soporte 24/7</h3>
                    <p class="text-zinc-500 text-sm">Equipo de soporte dedicado disponible en todo momento para
                        ayudarte.</p>
                </div>

                <!-- Benefit 6 -->
                <div class="group p-6 rounded-xl border border-zinc-800 hover:border-green-500/30 transition-colors">
                    <div
                        class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-500/20 transition-colors">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Alcance Global</h3>
                    <p class="text-zinc-500 text-sm">Expande tu negocio mas alla de fronteras con nuestra red
                        internacional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-b from-zinc-900 to-zinc-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div
                class="bg-gradient-to-br from-green-500/10 to-transparent border border-green-500/20 rounded-3xl p-8 sm:p-12">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                    Comienza a crecer con <span class="gradient-text">EcoMarket</span>
                </h2>
                <p class="text-zinc-400 text-lg mb-8 max-w-2xl mx-auto">
                    Unete a miles de productores, vendedores y clientes que ya estan transformando sus negocios.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-zinc-950 font-semibold px-8 py-4 rounded-xl transition-all btn-glow text-center">
                        Crear Cuenta Gratis
                    </a>
                    <a href="#"
                        class="w-full sm:w-auto text-zinc-400 hover:text-white font-semibold px-8 py-4 transition-colors text-center">
                        Contactar Ventas
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-zinc-950 border-t border-zinc-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <a href="#" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-zinc-950" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold">EcoMarket</span>
                    </a>
                    <p class="text-sm text-zinc-500 mb-4">
                        La plataforma que conecta toda la cadena de valor en un solo lugar.
                    </p>
                    <!-- Social Links -->
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-zinc-500 hover:text-green-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-500 hover:text-green-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="text-zinc-500 hover:text-green-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Plataforma -->
                <div>
                    <h4 class="font-semibold mb-4">Plataforma</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-zinc-500 hover:text-white transition-colors">Para
                                Productores</a></li>
                        <li><a href="#" class="text-sm text-zinc-500 hover:text-white transition-colors">Para
                                Vendedores</a></li>
                        <li><a href="#" class="text-sm text-zinc-500 hover:text-white transition-colors">Para
                                Clientes</a></li>
                        <li><a href="#"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Precios</a></li>
                    </ul>
                </div>

                <!-- Empresa -->
                <div>
                    <h4 class="font-semibold mb-4">Empresa</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-zinc-500 hover:text-white transition-colors">Sobre
                                Nosotros</a></li>
                        <li><a href="#"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Carreras</a></li>
                        <li><a href="#"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Contacto</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-3">
                        <li><a href="/terms-and-services"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Terminos de
                                Servicio</a></li>
                        <li><a href="/privacy-policy"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Politica de
                                Privacidad</a></li>
                        <li><a href="/cookies"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Cookies</a></li>
                        <li><a href="/licenses"
                                class="text-sm text-zinc-500 hover:text-white transition-colors">Licencias</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom -->
            <div class="border-t border-zinc-800 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-zinc-500">
                    2026 EcoMarket. Todos los derechos reservados.
                </p>
                <p class="text-sm text-zinc-600">
                    Hecho con <span class="text-green-500">amor</span> para emprendedores
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
