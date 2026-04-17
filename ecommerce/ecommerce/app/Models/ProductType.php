<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['name', 'type'];

    public function harvests()
    {
        return $this->hasMany(Harvest::class, 'product_type_id');
    }
}
