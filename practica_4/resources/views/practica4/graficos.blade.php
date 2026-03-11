@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-gray-50 min-h-screen">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800">Panel de Monitorización - ODS 12</h2>
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                <select id="sensor_id_graf" class="p-2 border rounded shadow-sm outline-none">
                    @foreach ($sellers as $seller)
                        <option value="{{ $seller->dni }}">
                            {{ $seller->user->name ?? $seller->dni }}
                        </option>
                    @endforeach
                </select>
                <button id="btn-actualizar"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition-all shadow-md">
                    Actualizar Datos
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="text-lg font-bold text-red-600 mb-4 flex items-center">
                    <span class="mr-2">🌡️</span> Histórico de Temperatura
                </h3>
                <div class="h-80">
                    <canvas id="tempChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                <h3 class="text-lg font-bold text-blue-600 mb-4 flex items-center">
                    <span class="mr-2">💧</span> Histórico de Humedad
                </h3>
                <div class="h-80">
                    <canvas id="humChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/js/practica4/graficos.js'])
@endsection
