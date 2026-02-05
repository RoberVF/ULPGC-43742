<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class StockTrends extends ChartWidget
{
    protected ?string $heading = 'Stock Trends';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $data = Trend::model(\App\Models\StockMovement::class)
            ->between(start: now()->subDays(6), end: now())
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Movimientos de Stock',
                    'data' => $data->map(fn($value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                ],
            ],
            'labels' => $data->map(fn($value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
