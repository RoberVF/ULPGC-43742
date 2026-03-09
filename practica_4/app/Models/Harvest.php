<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    protected $table = 'harvests';
    protected $fillable = ['producer_dni', 'product_type_id', 'quantity', 'harvest_date'];

    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_dni', 'dni');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }
}
