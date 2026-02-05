<?php

namespace App\Filament\App\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class LowStockProducts extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = '⚠️ Alerta de Reposición (Stock Bajo)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->withSum('stockMovements', 'quantity')
                    ->havingRaw('COALESCE(stock_movements_sum_quantity, 0) <= security_stock')
            )
            ->columns([
                TextColumn::make('name')->label('Producto'),
                TextColumn::make('sku')->label('SKU'),
                TextColumn::make('stock_movements_sum_quantity')
                    ->label('Stock Actual')
                    ->badge()
                    ->color('danger'),
                TextColumn::make('security_stock')
                    ->label('Mínimo Requerido')
                    ->color('gray'),
            ]);
    }
}