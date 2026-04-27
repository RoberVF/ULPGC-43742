<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lunar\Models\ProductVariant;

class SellerListing extends Model
{
    protected $fillable = [
        'seller_id',
        'seller_inventory_id',
        'lunar_variant_id',
        'price',
        'stock',
        'published',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function inventory()
    {
        return $this->belongsTo(SellerInventory::class, 'seller_inventory_id');
    }

    public function lunarVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'lunar_variant_id');
    }
}