<?php

namespace App\Filament\App\Resources\Products\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StockMovementsRelationManager extends RelationManager
{
    protected static string $relationship = 'stockMovements';


public function form(Schema $schema): Schema
{
    return $schema
        ->components([
            Grid::make(2) 
                ->schema([
                    \Filament\Forms\Components\Select::make('warehouse_id')
                        ->label('Almacén')
                        ->relationship('warehouse', 'name')
                        ->required()
                        ->preload(),

                    \Filament\Forms\Components\Select::make('type')
                        ->label('Tipo de Operación')
                        ->options(\App\Enums\StockMovementType::class)
                        ->required()
                        ->native(false),

                    \Filament\Forms\Components\TextInput::make('quantity')
                        ->label('Cantidad')
                        ->numeric()
                        ->required()
                        ->helperText('Usa (-) para salidas y (+) para entradas'),

                    \Filament\Forms\Components\TextInput::make('reference')
                        ->label('Nota / Referencia')
                        ->placeholder('Ej: Pedido #50 o Ajuste por rotura')
                        ->maxLength(255),
                ]),

            \Filament\Forms\Components\Hidden::make('user_id')
                ->default(auth()->id()),
            
            \Filament\Forms\Components\Hidden::make('company_id')
                ->default(filament()->getTenant()->id),
        ])->columns(1);
}

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('reference')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),
                TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->color(fn($state) => $state > 0 ? 'success' : 'danger'),
                TextColumn::make('warehouse.name')
                    ->label('Almacén'),
                TextColumn::make('user.name')
                    ->label('Usuario'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Nuevo Movimiento'),
            ]);
    }
}
