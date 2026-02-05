<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InventoryOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        $totalValue = \App\Models\Product::query()
            ->withSum('stockMovements', 'quantity')
            ->get()
            ->sum(fn($p) => ($p->stock_movements_sum_quantity ?? 0) * $p->purchase_price);

        return [
            Stat::make('Valor Total del Inventario', number_format($totalValue, 2, ',', '.') . ' €')
                ->description('Inversión actual en stock')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Movimientos (24h)', \App\Models\StockMovement::where('created_at', '>=', now()->subDay())->count())
                ->description('Actividad registrada hoy')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),

            Stat::make('Almacenes Activos', \App\Models\Warehouse::where('is_active', true)->count())
                ->description('Puntos de distribución operativos')
                ->descriptionIcon('heroicon-m-building-office'),
        ];
    }
}
