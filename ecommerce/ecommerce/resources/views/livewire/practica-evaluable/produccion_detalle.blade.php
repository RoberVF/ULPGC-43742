<x-layouts.practica-evaluable>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-green-800">Produccion: {{ $producto->name }}</h1>
            <p class="text-gray-500">Historial de plantaciones y rentabilidad</p>
        </div>
        <a href="{{ route('productos.index') }}" class="text-blue-600 hover:underline">Volver a productos</a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 font-bold text-gray-700">Fecha Inicio</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Coste de Produccion</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Fecha Fin</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Valor de Venta</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($plantaciones as $plan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-600">{{ $plan->fechaInicio }}</td>
                        <td class="px-6 py-4 font-medium text-red-600">{{ number_format($plan->costeProduccion, 2) }}€</td>
                        <td class="px-6 py-4 italic text-gray-500">{{ $plan->fechaFin ?? 'Cultivo activo' }}</td>
                        <td class="px-6 py-4 font-bold text-green-600">{{ number_format($plan->valorVenta, 2) }}€</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">No hay datos de produccion registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.practica-evaluable>