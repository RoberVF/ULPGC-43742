<?php

namespace App\Filament\App\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StockOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Productos Totales', Product::count())
                ->description('Variedad de catálogo')
                ->descriptionIcon('heroicon-m-cube')
                ->color('info'),

            Stat::make('Stock Global', Product::withSum('stockMovements', 'quantity')->get()->sum('stock_movements_sum_quantity') ?? 0)
                ->description('Unidades totales en almacenes')
                ->descriptionIcon('heroicon-m-circle-stack')
                ->color('success'),

            Stat::make('Alertas de Stock', Product::whereRaw('(select sum(quantity) from stock_movements where product_id = products.id) <= security_stock')->count())
                ->description('Productos bajo el mínimo')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
