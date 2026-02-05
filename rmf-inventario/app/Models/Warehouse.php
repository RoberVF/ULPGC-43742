<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    protected $fillable = [
        'name',
        'location',
        'is_active',
        'company_id',
    ];

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Obtiene el stock total de un producto especifico en almacen.
     */
    public function getStockOfProduct(int $productId): int
    {
        return $this->stockMovements()
            ->where('product_id', $productId)
            ->sum('quantity');
    }

    /**
     * Calcula el valor total del inventario en almacen, sobre el precio de compra.
     */
    public function getTotalValueAttribute(): float
    {
        return $this->stockMovements()
            ->with('product')
            ->get()
            ->sum(fn($m) => $m->quantity * $m->product->purchase_price);
    }

    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            if (auth()->check() && auth()->user()->company_id) {
                $builder->where('company_id', auth()->user()->company_id);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->company_id) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }
}
