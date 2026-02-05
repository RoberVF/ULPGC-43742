<?php

namespace App\Filament\App\Resources\Warehouses\RelationManagers;

use App\Filament\App\Resources\Products\ProductResource; // Importamos el recurso destino
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use Filament\Actions\Action;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    protected static ?string $title = 'Inventario Local (Stock en este Almacén)';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->recordAction('view_product') 
            ->modifyQueryUsing(function (Builder $query) {
                $warehouseId = $this->getOwnerRecord()->id;
                return $query->select('products.*') 
                    ->groupBy('products.id') 
                    ->withSum(['stockMovements as local_stock' => function ($query) use ($warehouseId) {
                        $query->where('stock_movements.warehouse_id', $warehouseId);
                    }], 'quantity');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Producto')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->badge(),

                Tables\Columns\TextColumn::make('local_stock')
                    ->label('Existencias')
                    ->getStateUsing(fn($record) => $record->local_stock ?? 0)
                    ->badge()
                    ->color(fn($state) => $state > 0 ? 'success' : 'danger')
                    ->suffix(' uds'),
            ])
            ->actions([
                Action::make('view_product')
                    ->label('Ver ficha')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->url(fn (Product $record): string => ProductResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}