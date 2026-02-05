<?php

namespace App\Filament\App\Widgets;

use App\Models\Warehouse;
use Filament\Widgets\ChartWidget;

class StockByWarehouse extends ChartWidget
{
    protected ?string $heading = 'Reparto de Stock por Almacén';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1; 

    protected function getData(): array
    {
        $data = Warehouse::query()
            ->withSum('stockMovements', 'quantity')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Unidades',
                    'data' => $data->pluck('stock_movements_sum_quantity')->toArray(),
                    'backgroundColor' => ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}