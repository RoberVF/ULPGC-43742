<x-layouts.practica-evaluable>
    <h1 class="text-3xl font-bold mb-8 text-green-800">Nuestras Categorias</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categorias as $cat)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-gray-200">
                <img src="{{ asset('images/' . $cat->nameMi . '.jpg') }}" class="w-full h-48 object-cover" alt="{{ $cat->nameMi }}">
                <div class="p-4">
                    <h3 class="text-xl font-bold capitalize text-gray-700">{{ $cat->nameMi }}</h3>
                    <p class="text-gray-500 text-sm mb-4">Productos frescos del día.</p>
                    <a href="{{ route('pagina.personal', $cat->nameMi) }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors w-full text-center">
                        Ver detalles
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.practica-evaluable>