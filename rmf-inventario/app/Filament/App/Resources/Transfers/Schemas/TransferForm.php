<?php

namespace App\Filament\App\Resources\Transfers\Schemas;

use App\Models\StockMovement;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TransferForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                Select::make('product_id')
                    ->label('Producto a mover')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->live()
                    ->preload(),

                TextInput::make('quantity')
                    ->label('Cantidad a transferir')
                    ->numeric()
                    ->required()
                    ->minValue(0.01)
                    ->rules([
                        fn (Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                            $productId = $get('product_id');
                            $fromWarehouseId = $get('from_warehouse_id');

                            if (!$productId || !$fromWarehouseId) {
                                return;
                            }

                            $currentStock = StockMovement::where('product_id', $productId)
                                ->where('warehouse_id', $fromWarehouseId)
                                ->sum('quantity');

                            if ($value > $currentStock) {
                                $fail("Stock insuficiente. Solo hay {$currentStock} unidades disponibles en el almacén de origen.");
                            }
                        },
                    ]),

                Select::make('from_warehouse_id')
                    ->label('Origen')
                    ->relationship('fromWarehouse', 'name')
                    ->required()
                    ->reactive()
                    ->live(),

                Select::make('to_warehouse_id')
                    ->label('Destino')
                    ->relationship('toWarehouse', 'name')
                    ->required()
                    ->different('from_warehouse_id')
                    ->helperText('Debe ser distinto al origen'),
                
                TextInput::make('reference')
                    ->label('Referencia / Motivo')
                    ->columnSpanFull(),

                Hidden::make('user_id')
                    ->default(auth()->id()),

                Hidden::make('company_id')
                    ->default(filament()->getTenant()->id),
            ])->columnSpanFull()
        ]);
    }
}