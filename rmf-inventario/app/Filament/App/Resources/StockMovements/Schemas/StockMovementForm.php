<?php

namespace App\Filament\App\Resources\StockMovements\Schemas;

use App\Enums\StockMovementType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detalles del Movimiento')
                ->description('Registra una entrada, salida o ajuste de inventario.')
                ->schema([
                    Select::make('product_id')
                        ->label('Producto')
                        ->relationship('product', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('warehouse_id')
                        ->label('Almacén / Ubicación')
                        ->relationship('warehouse', 'name')
                        ->required(),

                    Select::make('type')
                        ->label('Tipo de Movimiento')
                        ->options(StockMovementType::class)
                        ->required()
                        ->native(false),

                    TextInput::make('quantity')
                        ->label('Cantidad')
                        ->numeric()
                        ->required()
                        ->helperText('Usa valores positivos para entradas y negativos para salidas.'),

                    DateTimePicker::make('created_at')
                        ->label('Fecha del Movimiento')
                        ->default(now())
                        ->required(),

                    // El user_id se asigna automáticamente al usuario identificado
                    \Filament\Forms\Components\Hidden::make('user_id')
                        ->default(auth()->id()),

                ])->columns(2),

            Section::make('Información Adicional')
                ->schema([
                    Textarea::make('reference')
                        ->label('Referencia o Notas')
                        ->placeholder('Ej: Factura #2024-01, Rotura accidental, Stock inicial...')
                        ->columnSpanFull(),
                ])
        ]);
    }
}