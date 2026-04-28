<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos del Servicio - EcoMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #22c55e 0%, #4ade80 50%, #86efac 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-300 antialiased">

    <nav class="fixed top-0 left-0 right-0 z-50 bg-zinc-950/80 backdrop-blur-xl border-b border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-zinc-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">EcoMarket</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20 px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-extrabold text-white mb-4">Términos del <span class="gradient-text">Servicio</span></h1>
            <p class="text-zinc-500 mb-10 text-lg">Contrato de uso de plataforma B2B/B2C</p>

            <div class="space-y-10 text-zinc-400">
                <section>
                    <h2 class="text-xl font-bold text-white mb-4">1. Identidad del Portal</h2>
                    <p>En cumplimiento de la <strong>LSSI-CE</strong>, se informa que EcoMarket es un portal gestionado por Roberto Morales Fumero, con NIF 111111111A. Este sitio actúa como intermediario tecnológico entre productores, vendedores y clientes finales.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-white mb-4">2. Roles y Responsabilidades</h2>
                    <ul class="list-disc ml-6 space-y-4">
                        <li><strong>Productores:</strong> Responsables de la veracidad de la información técnica y stock de los productos cargados.</li>
                        <li><strong>Vendedores:</strong> Responsables de la atención al cliente y gestión logística hacia el consumidor final.</li>
                        <li><strong>Clientes:</strong> Sujetos a la Ley de Derechos de Consumidores y Usuarios.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-white mb-4">3. Propiedad Intelectual</h2>
                    <p>Todos los derechos de propiedad intelectual del diseño, código fuente y contenidos de EcoMarket pertenecen al titular. Se prohíbe el uso de imágenes de productos para fines ajenos a la plataforma sin consentimiento expreso.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-white mb-4">4. Régimen de Garantías</h2>
                    <p>Conforme al régimen de garantías aplicable a la venta de productos digitales y servicios, EcoMarket asegura la disponibilidad de la plataforma. La garantía de los productos físicos recae sobre el Vendedor o Productor correspondiente según la legislación vigente.</p>
                </section>

                <section class="bg-zinc-900 border border-green-500/20 p-6 rounded-2xl">
                    <h2 class="text-xl font-bold text-green-500 mb-2 font-bold">Nota sobre Pagos</h2>
                    <p class="text-sm">EcoMarket no procesa ni almacena fondos. Todas las transacciones se realizan a través de <strong>Stripe</strong>, cuyo contrato de servicio el usuario acepta al utilizar nuestras funciones de pago.</p>
                </section>
            </div>
        </div>
    </main>

    <footer class="bg-zinc-950 border-t border-zinc-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-zinc-500">2026 EcoMarket. Todos los derechos reservados.</p>
                <div class="flex gap-4">
                    <a href="/privacy-policy" class="text-sm text-zinc-500 hover:text-white">Privacidad</a>
                    <a href="#" class="text-sm text-zinc-500 hover:text-white">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>