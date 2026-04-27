<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lunar\Models\ProductVariant;

class Harvest extends Model
{
    protected $table = 'harvests';
    protected $fillable = [
        'producer_id',
        'product_type_id',
        'collect_date',
        'quantity',
        'stock',
        'price',
        'unit_measure',
        'temperature',
        'humidity',
        'lunar_variant_id',
        'published',
    ];
    public function producer()
    {
        return $this->belongsTo(Producer::class, 'producer_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    /**
     * Relación con la variante de producto de Lunar.
     */
    public function lunarVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'lunar_variant_id');
    }
}
