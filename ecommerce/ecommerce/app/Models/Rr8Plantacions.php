<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rr8Plantacions extends Model
{
    protected $fillable = ['fechaInicio', 'costeProduccion', 'rr8Producto_id', 'fechaFin', 'valorVenta'];

    public function producto()
    {
        return $this->belongsTo(Rr8Producto::class, 'rr8Producto_id');
    }
}
