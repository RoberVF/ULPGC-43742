<?php

namespace App\Filament\App\Resources\Suppliers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tax_id')
                    ->label('NIF/CIF')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Contacto')
                    ->icon('heroicon-m-envelope'),
                TextColumn::make('purchase_invoices_count')
                    ->label('Facturas')
                    ->counts('purchaseInvoices')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
