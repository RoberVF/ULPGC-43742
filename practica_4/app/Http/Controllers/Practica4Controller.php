<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Practica4Controller extends Controller
{
    public function basico()
    {
        return view('practica4.basico');
    }

    public function sensores()
    {
        return view('practica4.sensores');
    }

    public function graficos()
    {
        return view('practica4.graficos');
    }
}