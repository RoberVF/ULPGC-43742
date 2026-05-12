<?php

namespace App\Http\Controllers;
use App\Models\Rr8Categoria;

class Rr8CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Rr8Categoria::all();

        return view('livewire.practica-evaluable.categorias', [ 'categorias' => $categorias ]);
    }
}