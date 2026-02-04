<?php

namespace App\Enums;

enum StockMovementType: string
{
    case Entry = 'entry';
    case Exit = 'exit';
    case Adjustment = 'adjustment';
    case Transfer = 'transfer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Entry => 'Entrada',
            self::Exit => 'Salida',
            self::Adjustment => 'Ajuste',
            self::Transfer => 'Transferencia',
        };
    }
}