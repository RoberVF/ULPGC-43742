
<x-layouts.app :title="$title ?? 'RMF Inventory'">
    <!-- ========== HERO SECTION ========== -->
    <section id="inicio" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Background Elements -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-1/4 left-1/4 h-96 w-96 rounded-full bg-accent/10 blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 h-96 w-96 rounded-full bg-muted blur-3xl"></div>
        </div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 -z-10 bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:4rem_4rem]" style="mask-image: radial-gradient(ellipse 60% 50% at 50% 0%, #000 70%, transparent 110%);"></div>

        <div class="mx-auto max-w-7xl px-6 py-20 text-center">
            <!-- Badge -->
            <div class="mb-8 inline-flex items-center gap-2 rounded-full border border-border bg-white px-4 py-2 text-sm animate-fade-in-up">
                <svg class="h-4 w-4 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
                </svg>
                <span class="text-muted-black">Nuevo: Integraciones con IA</span>
                <svg class="h-3 w-3 text-muted-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </div>

            <!-- Headline -->
            <h1 class="mx-auto max-w-4xl text-5xl font-bold tracking-tight text-black sm:text-6xl lg:text-7xl animate-fade-in-up animation-delay-200" style="text-wrap: balance;">
                Control total de tu inventario
                <span class="relative inline-block">
                    <span class="relative z-10">empresarial</span>
                    <span class="absolute bottom-2 left-0 -z-0 h-4 w-full bg-accent/20 rounded"></span>
                </span>
            </h1>

            <!-- Subheadline -->
            <p class="mx-auto mt-8 max-w-2xl text-lg text-muted-black leading-relaxed animate-fade-in-up animation-delay-400">
                Optimiza tu cadena de suministro, reduce costos y toma decisiones inteligentes con nuestra plataforma de gestion de inventario de ultima generacion.
            </p>

            <!-- CTA Buttons -->
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row animate-fade-in-up animation-delay-600">
                <a href="#pricing" class="group bg-black flex items-center gap-2 rounded-full bg-black px-8 py-4 text-sm font-semibold text-white transition-all hover:opacity-90 hover:gap-3">
                    Comenzar ahora
                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#caracteristicas" class="group flex items-center gap-2 rounded-full border border-border px-8 py-4 text-sm font-semibold text-black transition-colors hover:bg-muted">
                    Ver caracteristicas
                </a>
            </div>

            <!-- Stats -->
            <div class="mt-20 grid grid-cols-2 gap-8 sm:grid-cols-4 animate-fade-in-up animation-delay-800">
                <div class="text-center">
                    <div class="text-3xl font-bold text-black sm:text-4xl">+500</div>
                    <div class="mt-1 text-sm text-muted-black">Empresas activas</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-black sm:text-4xl">99.9%</div>
                    <div class="mt-1 text-sm text-muted-black">Uptime garantizado</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-black sm:text-4xl">+1M</div>
                    <div class="mt-1 text-sm text-muted-black">Productos gestionados</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-black sm:text-4xl">24/7</div>
                    <div class="mt-1 text-sm text-muted-black">Soporte tecnico</div>
                </div>
            </div>

            <!-- Dashboard Preview -->
            <div class="relative mt-20 animate-fade-in-up animation-delay-800">
                <div class="mx-auto max-w-5xl overflow-hidden rounded-2xl border border-border bg-card shadow-2xl">
                    <div class="flex items-center gap-2 border-b border-border bg-muted/50 px-4 py-3">
                        <div class="h-3 w-3 rounded-full bg-red-400"></div>
                        <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                        <div class="h-3 w-3 rounded-full bg-green-400"></div>
                        <span class="ml-4 text-xs text-muted-black">RMF Inventory Dashboard</span>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <div class="rounded-xl bg-muted/50 p-4 text-left">
                                <div class="text-xs text-muted-black">Total Productos</div>
                                <div class="mt-1 text-2xl font-bold text-black">12,847</div>
                                <div class="mt-1 text-xs text-green-600">+12% vs. ayer</div>
                            </div>
                            <div class="rounded-xl bg-muted/50 p-4 text-left">
                                <div class="text-xs text-muted-black">En Stock</div>
                                <div class="mt-1 text-2xl font-bold text-black">10,234</div>
                                <div class="mt-1 text-xs text-green-600">+8% vs. ayer</div>
                            </div>
                            <div class="rounded-xl bg-muted/50 p-4 text-left">
                                <div class="text-xs text-muted-black">Bajo Stock</div>
                                <div class="mt-1 text-2xl font-bold text-black">156</div>
                                <div class="mt-1 text-xs text-red-500">-23% vs. ayer</div>
                            </div>
                            <div class="rounded-xl bg-muted/50 p-4 text-left">
                                <div class="text-xs text-muted-black">Pedidos Hoy</div>
                                <div class="mt-1 text-2xl font-bold text-black">89</div>
                                <div class="mt-1 text-xs text-green-600">+45% vs. ayer</div>
                            </div>
                        </div>
                        <div class="mt-4 h-40 rounded-xl bg-muted/30 flex items-center justify-center">
                            <div class="flex items-end gap-2 h-24">
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 40%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 65%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 45%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 80%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 55%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 90%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 70%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 85%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 60%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 75%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 95%;"></div>
                                <div class="w-6 sm:w-8 rounded-t bg-black/80 transition-all hover:bg-black" style="height: 50%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Glow effect -->
                <div class="absolute -inset-4 -z-10 bg-gradient-to-r from-accent/20 via-transparent to-accent/20 blur-3xl opacity-50"></div>
            </div>
        </div>
    </section>

    <!-- ========== FEATURES SECTION ========== -->
    <section id="caracteristicas" class="py-24 bg-muted/30">
        <div class="mx-auto max-w-7xl px-6">
            <!-- Header -->
            <div class="text-center">
                <h2 class="mt-6 text-4xl font-bold tracking-tight text-black sm:text-5xl" style="text-wrap: balance;">
                    Todo lo que necesitas para gestionar tu inventario
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-muted-black">
                    Herramientas potentes y faciles de usar para optimizar cada aspecto de tu cadena de suministro.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16.5 9.4 7.55 4.24M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <path d="M3.27 6.96 12 12.01l8.73-5.05M12 22.08V12"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Gestion de Stock</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Control completo de entradas, salidas y movimientos de inventario en tiempo real.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Analiticas Avanzadas</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Dashboards intuitivos con metricas clave para tomar decisiones informadas.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Automatizacion</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Alertas automaticas de stock bajo, reordenes y reportes programados.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Sincronizacion</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Integracion con tus sistemas existentes: ERP, e-commerce y mas.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>

                <!-- Feature 5 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Seguridad</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Encriptacion de datos, backups automaticos y control de acceso por roles.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>

                <!-- Feature 6 -->
                <div class="group relative overflow-hidden rounded-2xl border border-border bg-white p-8 transition-all hover:shadow-xl hover:border-black/20">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-black text-white transition-transform group-hover:scale-110">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-black">Historial Completo</h3>
                    <p class="mt-2 text-muted-black leading-relaxed">Trazabilidad total de cada producto con historial de movimientos detallado.</p>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-accent/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>
            </div>
        </div>
    </section>

    <x-pricing />

    <!-- ========== ABOUT SECTION ========== -->
    <section id="nosotros" class="py-24 bg-muted/30">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid gap-16 lg:grid-cols-2 lg:items-center">
                <!-- Content -->
                <div>
                    <h2 class="mt-6 text-4xl font-bold tracking-tight text-black sm:text-5xl" style="text-wrap: balance;">
                        Transformando la gestion de inventarios desde 2015
                    </h2>
                    <p class="mt-6 text-lg text-muted-black leading-relaxed">
                        En RMF Inventory, creemos que cada empresa merece tener el control total de su inventario. 
                        Nacimos con la vision de eliminar la complejidad de la gestion logistica y ofrecer una 
                        plataforma intuitiva que cualquier equipo pueda dominar.
                    </p>
                    <p class="mt-4 text-lg text-muted-black leading-relaxed">
                        Hoy, mas de 500 empresas confian en nosotros para gestionar millones de productos, 
                        desde startups hasta corporativos multinacionales.
                    </p>

                    <!-- Metrics -->
                    <div class="mt-10 grid grid-cols-3 gap-8">
                        <div>
                            <div class="text-3xl font-bold text-black">2015</div>
                            <div class="text-sm text-muted-black">Fundacion</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-black">50+</div>
                            <div class="text-sm text-muted-black">Empleados</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-black">12</div>
                            <div class="text-sm text-muted-black">Paises</div>
                        </div>
                    </div>
                </div>

                <!-- Values Grid -->
                <div class="grid gap-6 sm:grid-cols-2">
                    <!-- Value 1 -->
                    <div class="group rounded-2xl border border-border bg-white p-6 transition-all hover:shadow-lg hover:border-black/20">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-black text-white transition-transform group-hover:scale-110">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-black">Nuestra Mision</h3>
                        <p class="mt-2 text-sm text-muted-black leading-relaxed">Democratizar el acceso a herramientas profesionales de gestion de inventario para empresas de todos los tamanos.</p>
                    </div>

                    <!-- Value 2 -->
                    <div class="group rounded-2xl border border-border bg-white p-6 transition-all hover:shadow-lg hover:border-black/20">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-black text-white transition-transform group-hover:scale-110">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-black">Nuestro Equipo</h3>
                        <p class="mt-2 text-sm text-muted-black leading-relaxed">Mas de 50 profesionales apasionados por crear soluciones que simplifiquen la logistica empresarial.</p>
                    </div>

                    <!-- Value 3 -->
                    <div class="group rounded-2xl border border-border bg-white p-6 transition-all hover:shadow-lg hover:border-black/20">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-black text-white transition-transform group-hover:scale-110">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-black">Nuestra Experiencia</h3>
                        <p class="mt-2 text-sm text-muted-black leading-relaxed">10+ anos de experiencia en el sector logistico y tecnologico, atendiendo a cientos de empresas.</p>
                    </div>

                    <!-- Value 4 -->
                    <div class="group rounded-2xl border border-border bg-white p-6 transition-all hover:shadow-lg hover:border-black/20">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-lg bg-black text-white transition-transform group-hover:scale-110">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-black">Nuestro Compromiso</h3>
                        <p class="mt-2 text-sm text-muted-black leading-relaxed">Innovacion continua para ofrecer siempre las mejores herramientas del mercado a nuestros clientes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== LOGIN SECTION ========== -->
    <section id="login" class="py-24 bg-black">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid gap-16 lg:grid-cols-2 lg:items-center">
                <!-- Content -->
                <div class="text-center lg:text-left">
                    <span class="inline-block rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-white/80">
                        Acceso Rapido
                    </span>
                    <h2 class="mt-6 text-4xl font-bold tracking-tight text-white sm:text-5xl" style="text-wrap: balance;">
                        Ingresa a tu panel de control
                    </h2>
                    <p class="mt-6 text-lg text-white/70 leading-relaxed">
                        Accede a todas las herramientas de gestion de inventario. 
                        Monitorea tu stock, genera reportes y optimiza tu operacion desde cualquier lugar.
                    </p>

                    <!-- Quick Access Links -->
                    <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:gap-6 justify-center lg:justify-start">
                        <a href="/app" class="group flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-black transition-all hover:opacity-90 hover:gap-3">
                            Panel de Cliente
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <a href="/admin" class="flex items-center justify-center gap-2 rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition-all hover:bg-white/10">
                            Panel de Administrador
                        </a>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="mx-auto w-full max-w-md">
                    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-white">Iniciar Sesion</h3>
                            <p class="mt-2 text-sm text-white/60">
                                Ingresa tus credenciales para continuar
                            </p>
                        </div>

                        <form action="/app" method="GET" class="space-y-5">
                            <div>
                                <label for="login-email" class="block text-sm font-medium text-white/80">
                                    Email
                                </label>
                                <div class="relative mt-2">
                                    <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-white/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                    <input type="email" id="login-email" name="email" class="w-full rounded-xl border border-white/20 bg-white/10 py-3 pl-11 pr-4 text-sm text-white placeholder:text-white/40 focus:border-white/40 transition-colors" placeholder="tu@empresa.com" required>
                                </div>
                            </div>

                            <div>
                                <label for="login-password" class="block text-sm font-medium text-white/80">
                                    Contrasena
                                </label>
                                <div class="relative mt-2">
                                    <svg class="absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-white/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                    </svg>
                                    <input type="password" id="login-password" name="password" class="w-full rounded-xl border border-white/20 bg-white/10 py-3 pl-11 pr-4 text-sm text-white placeholder:text-white/40 focus:border-white/40 transition-colors" placeholder="********" required>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="h-4 w-4 rounded border-white/20 bg-white/10 text-accent">
                                    <span class="text-sm text-white/60">Recordarme</span>
                                </label>
                                <a href="#" class="text-sm text-white/60 hover:text-white transition-colors">
                                    Olvidaste tu contrasena?
                                </a>
                            </div>

                            <button type="submit" class="w-full rounded-full bg-white py-3 text-sm font-semibold text-black transition-all hover:opacity-90">
                                Iniciar Sesion
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-white/60">
                                No tienes cuenta?
                                <a href="#pricing" class="font-medium text-white hover:underline">Ver planes</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT SECTION ========== -->
    <section id="contacto" class="py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid gap-16 lg:grid-cols-2">
                <!-- Info -->
                <div>
                    <span class="inline-block rounded-full bg-black/5 px-4 py-1.5 text-sm font-medium text-black">
                        Contacto
                    </span>
                    <h2 class="mt-6 text-4xl font-bold tracking-tight text-black sm:text-5xl" style="text-wrap: balance;">
                        Hablemos sobre tu proyecto
                    </h2>
                    <p class="mt-6 text-lg text-muted-black leading-relaxed">
                        Nuestro equipo esta listo para ayudarte a encontrar la solucion perfecta para tu negocio. 
                        Agenda una demo o contactanos para resolver tus dudas.
                    </p>

                    <!-- Contact Info -->
                    <div class="mt-10 space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-muted">
                                <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-muted-black">Email</div>
                                <div class="font-medium text-black">contacto@rmfinventory.com</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-muted">
                                <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-muted-black">Telefono</div>
                                <div class="font-medium text-black">+34 111 111 111</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-muted">
                                <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-muted-black">ULPGC</div>
                                <div class="font-medium text-black">Universidad de Las Palmas de Gran Canaria</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="rounded-2xl border border-border bg-card p-8">
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-black">
                                    Nombre
                                </label>
                                <input type="text" id="name" name="name" class="mt-2 w-full rounded-xl border border-input bg-white px-4 py-3 text-sm text-black placeholder:text-muted-black transition-colors" placeholder="Tu nombre" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-black">
                                    Email
                                </label>
                                <input type="email" id="email" name="email" class="mt-2 w-full rounded-xl border border-input bg-white px-4 py-3 text-sm text-black placeholder:text-muted-black transition-colors" placeholder="tu@empresa.com" required>
                            </div>
                        </div>
                        <div>
                            <label for="company" class="block text-sm font-medium text-black">
                                Empresa
                            </label>
                            <input type="text" id="company" name="company" class="mt-2 w-full rounded-xl border border-input bg-white px-4 py-3 text-sm text-black placeholder:text-muted-black transition-colors" placeholder="Nombre de tu empresa">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-black">
                                Mensaje
                            </label>
                            <textarea id="message" name="message" rows="4" class="mt-2 w-full resize-none rounded-xl border border-input bg-white px-4 py-3 text-sm text-black placeholder:text-muted-black transition-colors" placeholder="Cuentanos sobre tu proyecto..." required></textarea>
                        </div>
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-black px-6 py-3 text-sm font-semibold text-white transition-all hover:opacity-90">
                            Enviar mensaje
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
