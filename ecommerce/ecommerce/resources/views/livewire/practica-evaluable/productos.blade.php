<x-layouts.practica-evaluable>
    <h1 class="text-3xl font-bold mb-8 text-green-800">Catálogo de Productos</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($productos as $producto)
            <div class="bg-white p-6 rounded-xl shadow border border-gray-200 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-800">{{ $producto->name }}</h2>
                        <a href="{{ route('pagina.personal', $producto->categoria->nameMi) }}" 
                           class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full hover:bg-green-200">
                            {{ $producto->categoria->nameMi }}
                        </a>
                    </div>
                    <p class="text-gray-600 mb-4 text-sm">Gestión de cultivos y estadísticas de cosecha.</p>
                </div>
                
                <a href="{{ route('productos.produccion', $producto->id) }}" 
                   class="bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700 transition font-semibold">
                    Ver Producción
                </a>
            </div>
        @endforeach
    </div>
</x-layouts.practica-evaluable>