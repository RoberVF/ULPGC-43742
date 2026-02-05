<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'company_id',
        'sku',
        'name',
        'description',
        'image_path',
        'purchase_price',
        'sale_price',
        'security_stock'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Calcula el stock actual sumando todos los movimientos.
     */
    public function getCurrentStockAttribute(): int
    {
        return $this->stockMovements()->sum('quantity');
    }

    /**
     * Determina si el producto esta por debajo del stock de seguridad.
     */
    public function hasLowStock(): bool
    {
        return $this->current_stock <= $this->security_stock;
    }

    /**
     * Formatea el precio de venta para la interfaz.
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->sale_price, 2, ',', '.') . ' €';
    }

    /**
     * Accesor para obtener el stock actual del producto.
     */
    public function getStockAttribute(): int
    {
        return $this->stockMovements()->sum('quantity');
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
