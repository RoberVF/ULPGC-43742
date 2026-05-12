<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rr8Producto extends Model
{
    protected $fillable = ['name', 'rr8Categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Rr8Categoria::class, 'rr8Categoria_id');
    }

    public function plantaciones()
    {
        return $this->hasMany(Rr8Plantacions::class, 'rr8Producto_id');
    }
}
