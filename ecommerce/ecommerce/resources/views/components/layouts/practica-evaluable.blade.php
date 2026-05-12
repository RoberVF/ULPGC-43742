<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Evaluable - EcoMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-green-700 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <span class="font-bold text-xl">EcoMarket</span>
            <div class="space-x-6">
                <a href="{{ route('categorias.index') }}" class="hover:underline">Categorias</a>
                <a href="{{ route('productos.index') }}" class="hover:underline">Productos</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-10 px-4">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-gray-400 py-6 mt-10 text-center">
        <p>Practica Programación Web - Roberto Morales</p>
    </footer>
</body>
</html>