<?php

namespace App\Filament\App\Resources\Products\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('sale_price')
                    ->label('PVP')
                    ->money('EUR')
                    ->sortable(),

                TextColumn::make('security_stock')
                    ->label('Stock Seg.')
                    ->alignCenter(),

                TextColumn::make('stock_movements_sum_quantity')
                    ->label('Stock Actual')
                    ->getStateUsing(fn($record) => $record->stock_movements_sum_quantity ?? 0)
                    ->badge()
                    ->color(fn($state, $record): string => match (true) {
                        $state <= 0 => 'danger',
                        $state <= $record->security_stock => 'warning',
                        default => 'success',
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filtrar por Categoría'),
            ])
            ->actions([
                EditAction::make(),
            ]);

    }
}
