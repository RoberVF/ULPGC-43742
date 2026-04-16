<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerInventory extends Model
{
    protected $table = 'seller_inventory';
    public $timestamps = false;
    protected $fillable = ['seller_dni', 'harvest_id', 'stock', 'sale_price'];
    protected $primaryKey = ['seller_dni', 'harvest_id'];
    public $incrementing = false;

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_dni', 'dni');
    }

    public function harvest()
    {
        return $this->belongsTo(Harvest::class, 'harvest_id');
    }
}
