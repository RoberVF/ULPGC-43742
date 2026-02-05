<?php

namespace App\Filament\App\Resources\Warehouses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Información del Almacén')
                ->schema([
                    TextInput::make('name')
                        ->label('Nombre del Almacén')
                        ->required()
                        ->placeholder('Ej: Almacén Central'),
                    TextInput::make('location')
                        ->label('Ubicación')
                        ->placeholder('Dirección física...'),
                    Toggle::make('is_active')
                        ->label('Estado Activo')
                        ->default(true),
                ])->columns(2)
        ]);
    }
}
