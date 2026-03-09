<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\SensorType;
use Illuminate\Support\Facades\DB;

class WarehouseApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'seller_dni' => 'required|exists:sellers,dni',
            'type' => 'required|string',
            'value' => 'required|numeric'
        ]);

        $type = SensorType::tryFrom($request->type);
        if (!$type) {
            return response()->json(['error' => 'Tipo de sensor no soportado'], 400);
        }

        DB::table('sensors')->insert([
            'seller_dni' => $request->seller_dni,
            'type' => $type->value,
            'value' => $request->value,
            'measured_at' => now()
        ]);

        return response()->json(['message' => 'Lectura registrada correctamente'], 201);
    }

    public function index($seller_dni)
    {
        $data = DB::table('sensors')
            ->where('seller_dni', $seller_dni)
            ->orderBy('measured_at', 'desc')
            ->get();

        return response()->json($data);
    }
}