<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rr8Categoria extends Model
{
    protected $fillable = ['nameMi'];

    public function productos()
    {
        return $this->hasMany(Rr8Producto::class, 'rr8Categoria_id');
    }
}
