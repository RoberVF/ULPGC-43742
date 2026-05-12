<?php

namespace App\Http\Controllers;

use App\Models\Rr8Plantacions;
use App\Models\Rr8Producto;

class Rr8ProductoController extends Controller
{
    public function index()
    {
        $productos = Rr8Producto::with('categoria')->get();
        return view('livewire.practica-evaluable.productos', compact('productos'));
    }

    public function showProduccion(Int $id)
    {
        $producto = Rr8Producto::findOrFail($id);
        $plantaciones = Rr8Plantacions::where('rr8Producto_id', $id)->get();

        return view('livewire.practica-evaluable.produccion_detalle', compact('producto', 'plantaciones'));
    }
}
