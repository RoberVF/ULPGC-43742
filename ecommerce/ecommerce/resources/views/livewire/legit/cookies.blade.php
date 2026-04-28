<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies - EcoMarket</title>
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
            <h1 class="text-4xl font-extrabold text-white mb-4">Política de <span class="gradient-text">Cookies</span></h1>
            <p class="text-zinc-500 mb-10 text-lg">Información sobre el almacenamiento de datos en su navegador.</p>

            <section class="mb-12 bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden text-sm">
                <div class="p-4 bg-zinc-800/50 border-b border-zinc-800 font-bold text-white">Resumen de Cookies</div>
                <div class="p-6 space-y-4">
                    <p>● Responsable: Roberto Morales Fumero.</p>
                    <p>● Cookies Propias: Técnicas y necesarias para el funcionamiento del portal.</p>
                    <p>● Cookies de Terceros: Stripe (seguridad y prevención de fraude).</p>
                    <p>● Finalidad: Garantizar la seguridad, recordar sesiones y permitir pagos.</p>
                </div>
            </section>

            <div class="space-y-8 text-zinc-400">
                <section>
                    <h2 class="text-xl font-bold text-white mb-3">1. ¿Qué son las cookies?</h2>
                    <p>Las cookies son archivos que se descargan en su dispositivo al acceder a determinadas webs para almacenar y recuperar información sobre la navegación.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-white mb-3 text-white">2. Tipos de Cookies utilizadas</h2>
                    <ul class="list-disc ml-6 space-y-4">
                        <li>Cookies Técnicas (Necesarias): Permiten al usuario la navegación a través del área privada de productores y vendedores, y la gestión del carrito.</li>
                        <li>Cookies de Seguridad (Stripe): Cookies de terceros utilizadas para detectar intentos de fraude en las transacciones económicas.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-white mb-3">3. Gestión y Rechazo</h2>
                    <p>Usted puede permitir, bloquear o eliminar las cookies instaladas en su equipo mediante la configuración de las opciones del navegador. Tenga en cuenta que el bloqueo de cookies técnicas puede impedir el uso de los servicios de EcoMarket.</p>
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
                    <a href="/terms-and-services" class="text-sm text-zinc-500 hover:text-white">Términos</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>