<?php

namespace App\Filament\App\Resources\Warehouses\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class WarehousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Almacén')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Ubicación')
                    ->limit(30),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
            ]);
    }
}