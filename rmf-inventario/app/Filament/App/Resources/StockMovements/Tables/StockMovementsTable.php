<?php

namespace App\Filament\App\Resources\StockMovements\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Enums\StockMovementType;

class StockMovementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('product.name')
                    ->label('Producto')
                    ->searchable(),

                TextColumn::make('warehouse.name')
                    ->label('Almacén'),

                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (StockMovementType $state): string => match ($state) {
                        StockMovementType::Entry => 'success',
                        StockMovementType::Exit => 'danger',
                        StockMovementType::Adjustment => 'warning',
                    }),

                TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->weight('bold')
                    ->color(fn ($record): string => $record->quantity >= 0 ? 'success' : 'danger'),

                TextColumn::make('user.name')
                    ->label('Registrado por')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc');
    }
}