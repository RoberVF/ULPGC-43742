@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-8">
        <h2 class="text-2xl font-bold text-green-700 mb-6 border-b-2 border-green-100 pb-2">
            Gestión de Sensores - Desarrollo Sostenible (ODS 12)
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <form id="sensor-form" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Seller DNI</label>
                        <input type="text" id="sensor_id" class="w-full p-2 border rounded shadow-sm focus:ring-green-500"
                            placeholder="Ej: 12345678A">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Tipo de Sensor</label>
                        <select id="nombre" class="w-full p-2 border rounded shadow-sm">
                            <option value="temperature">Temperatura</option>
                            <option value="humidity">Humedad</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Periodicidad</label>
                        <select id="periodicidad" class="w-full p-2 border rounded">
                            <option value="minuto">Minuto</option>
                            <option value="horas">Horas</option>
                            <option value="días">Días</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Fecha</label>
                        <input type="date" id="fecha" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Hora</label>
                        <input type="time" id="hora" class="w-full p-2 border rounded">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Valor</label>
                        <input type="number" id="valor" step="0.01" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Repetir N</label>
                        <input type="number" id="repetirNveces" value="1" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600">Incremento</label>
                        <input type="number" id="incrementoValor" value="0" class="w-full p-2 border rounded">
                    </div>
                </div>

                <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg border border-gray-200">
                    <input type="checkbox" id="soloLocal" class="h-5 w-5 text-green-600 rounded">
                    <label for="soloLocal" class="text-sm font-bold text-gray-700">Modo Solo Local (Habilita
                        botones)</label>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-4">
                    <button type="button" id="añadir1vez"
                        class="sensor-btn bg-blue-500 text-white p-2 rounded hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
                        disabled>Añadir 1 vez</button>
                    <button type="button" id="añadirNveces"
                        class="sensor-btn bg-indigo-500 text-white p-2 rounded hover:bg-indigo-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
                        disabled>Añadir N veces</button>
                    <button type="button" id="cargarSensores"
                        class="sensor-btn bg-emerald-500 text-white p-2 rounded hover:bg-emerald-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
                        disabled>Cargar Sensores</button>
                    <button type="button" id="cargarDatosSensor"
                        class="sensor-btn bg-teal-500 text-white p-2 rounded hover:bg-teal-600 disabled:bg-gray-300 disabled:cursor-not-allowed"
                        disabled>Cargar Datos Sensor</button>
                    <button type="button" id="borrar"
                        class="col-span-2 bg-red-500 text-white p-2 rounded hover:bg-red-600">Borrar Log</button>
                </div>
            </form>

            <div class="flex flex-col">
                <label class="text-sm font-bold text-gray-600 mb-1 uppercase">Simulación de llamadas API (Log)</label>
                <textarea id="log-textarea"
                    class="flex-grow p-4 bg-gray-900 text-green-400 font-mono text-xs rounded-lg border-2 border-gray-700 shadow-inner resize-none"
                    readonly placeholder="Esperando interacción local..."></textarea>
            </div>
        </div>
    </div>

    @vite(['resources/js/practica4/sensores.js'])
@endsection
