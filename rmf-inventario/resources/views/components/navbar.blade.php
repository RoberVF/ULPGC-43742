<!-- ========== NAVBAR ========== -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent py-5">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2 group">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-foreground text-white transition-transform group-hover:scale-105">
                        <!-- Package Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16.5 9.4 7.55 4.24M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                            <path d="M3.27 6.96 12 12.01l8.73-5.05M12 22.08V12"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight">
                        RMF <span class="text-muted-foreground font-normal">Inventory</span>
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden items-center gap-8 md:flex">
                    <a href="#inicio" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Inicio</a>
                    <a href="#caracteristicas" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Caracteristicas</a>
                    <a href="#pricing" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Precios</a>
                    <a href="#nosotros" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Nosotros</a>
                    <a href="#contacto" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Contacto</a>
                </div>

                <!-- CTA Buttons -->
                <div class="hidden items-center gap-3 md:flex">
                    <a href="/app" class="rounded-full px-5 py-2.5 text-sm font-medium text-foreground transition-colors hover:bg-muted">
                        Panel Cliente
                    </a>
                    <a href="/admin" class="rounded-full bg-foreground px-5 py-2.5 text-sm font-medium text-white transition-all hover:opacity-90">
                        Panel Admin
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button type="button" id="mobile-menu-btn" class="flex h-10 w-10 items-center justify-center rounded-lg transition-colors hover:bg-muted md:hidden" aria-label="Toggle menu">
                    <svg id="menu-icon" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden mt-4 rounded-2xl bg-white p-4 shadow-xl md:hidden animate-fade-in">
                <div class="flex flex-col gap-2">
                    <a href="#inicio" class="rounded-xl px-4 py-3 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Inicio</a>
                    <a href="#caracteristicas" class="rounded-xl px-4 py-3 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Caracteristicas</a>
                    <a href="#pricing" class="rounded-xl px-4 py-3 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Precios</a>
                    <a href="#nosotros" class="rounded-xl px-4 py-3 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Nosotros</a>
                    <a href="#contacto" class="rounded-xl px-4 py-3 text-sm font-medium text-muted-foreground transition-colors hover:bg-muted hover:text-foreground">Contacto</a>
                    <hr class="my-2 border-border">
                    <a href="/app" class="rounded-xl px-4 py-3 text-sm font-medium text-foreground transition-colors hover:bg-muted text-center">Panel Cliente</a>
                    <a href="/admin" class="rounded-xl bg-foreground px-4 py-3 text-sm font-medium text-white text-center">Panel Admin</a>
                </div>
            </div>
        </div>
    </nav>