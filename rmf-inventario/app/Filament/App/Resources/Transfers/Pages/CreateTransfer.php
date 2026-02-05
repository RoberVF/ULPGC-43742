<?php

namespace App\Filament\App\Resources\Transfers\Pages;

use App\Filament\App\Resources\Transfers\TransferResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StockMovement;
use App\Enums\StockMovementType;
use Illuminate\Support\Facades\DB;

class CreateTransfer extends CreateRecord
{
    protected static string $resource = TransferResource::class;

    protected function afterCreate(): void
{
    $transfer = $this->record;

    // Ejecutamos en una transacción para que si falla un movimiento, no se cree nada
    DB::transaction(function () use ($transfer) {
        
        // 1. Movimiento de SALIDA del origen
        StockMovement::create([
            'company_id' => $transfer->company_id,
            'user_id' => $transfer->user_id,
            'product_id' => $transfer->product_id,
            'warehouse_id' => $transfer->from_warehouse_id,
            'quantity' => -$transfer->quantity, // Negativo
            'type' => StockMovementType::Exit,
            'reference' => "Transferencia a " . $transfer->toWarehouse->name . " (Ref: {$transfer->reference})",
        ]);

        // 2. Movimiento de ENTRADA al destino
        StockMovement::create([
            'company_id' => $transfer->company_id,
            'user_id' => $transfer->user_id,
            'product_id' => $transfer->product_id,
            'warehouse_id' => $transfer->to_warehouse_id,
            'quantity' => $transfer->quantity, // Positivo
            'type' => StockMovementType::Entry,
            'reference' => "Transferencia desde " . $transfer->fromWarehouse->name . " (Ref: {$transfer->reference})",
        ]);
    });
}
}
