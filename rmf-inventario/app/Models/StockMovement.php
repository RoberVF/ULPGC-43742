<?php

namespace App\Models;

use App\Enums\StockMovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'user_id',
        'quantity',
        'type',
        'reference'
    ];

    protected $casts = [
        'type' => StockMovementType::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comprueba si el movimiento es de entrada.
     */
    public function isEntry(): bool
    {
        return $this->type === StockMovementType::Entry;
    }

    /**
     * Comprueba si el movimiento es de salida.
     */
    public function isExit(): bool
    {
        return $this->type === StockMovementType::Exit;
    }

    /**
     * Devuelve la cantidad con formato.
     */
    public function getSignedQuantityAttribute(): string
    {
        $prefix = $this->quantity > 0 ? '+' : '';
        return "{$prefix}{$this->quantity}";
    }
}
