<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class Practica4Controller extends Controller
{
    public function basico()
    {
        return view('practica4.basico');
    }

    public function sensores()
    {
        $sellers = Seller::with('user')->get(); 
        return view('practica4.sensores', compact('sellers'));
    }

    public function graficos()
    {
        $sellers = Seller::with('user')->get();
        return view('practica4.graficos', compact('sellers'));
    }
}