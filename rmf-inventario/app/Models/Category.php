<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Cuenta cuantos productos distintos tiene la categoria.
     */
    public function getProductsCountAttribute(): int
    {
        return $this->products()->count();
    }
}
