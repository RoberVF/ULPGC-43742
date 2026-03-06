<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index($tipo = null)
    {
        $query = Harvest::with(['productType', 'producer.user']);

        if ($tipo) {
            $query->whereHas('productType', function($q) use ($tipo) {
                $q->where('type', $tipo);
            });
        }

        $products = $query->get();
        $categories = ProductType::all();

        return view('products.index', compact('products', 'categories', 'tipo'));
    }
}