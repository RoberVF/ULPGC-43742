@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-gray-50 min-h-screen">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-2">Bloque 1: Manejo básico del DOM</h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entrada de Texto (text-1)</label>
                <input type="text" id="text-1" 
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                    placeholder="Escribe un color (red, blue) o un mensaje...">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Consola de Salida (textarea)</label>
                <textarea id="main-textarea" rows="12" 
                    class="w-full p-4 font-mono text-sm bg-white border border-gray-300 rounded-lg shadow-inner focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                    placeholder="El historial de acciones aparecerá aquí..."></textarea>
            </div>
        </div>

        <div class="space-y-4">
            <button type="button" id="boton1" 
                class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transform active:scale-95 transition-all">
                Añadir texto (Boton 1)
            </button>
            
            <button type="button" id="boton2" 
                class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transform active:scale-95 transition-all">
                Iniciar Timer (Boton 2)
            </button>
            
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <label for="text-2" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Segundos (1-60)</label>
                <input type="number" id="text-2" 
                    class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" 
                    placeholder="Ej: 10">
            </div>
            
            <button type="button" id="boton3" 
                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-md transform active:scale-95 transition-all">
                Cambiar Estilo (Boton 3)
            </button>
        </div>
    </div>
</div>


@vite(['resources/js/practica4/basico.js'])

@endsection