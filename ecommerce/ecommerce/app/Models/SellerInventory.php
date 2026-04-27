<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lunar\Models\Order;

class SellerInventory extends Model
{
    protected $table = 'seller_inventory';

    protected $fillable = [
        'seller_id',
        'harvest_id',
        'order_id',
        'quantity_purchased',
        'quantity_remaining',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function harvest()
    {
        return $this->belongsTo(Harvest::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function listings()
    {
        return $this->hasMany(SellerListing::class);
    }
}