<?php

namespace App\Filament\App\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identificación Fiscal')
                    ->description('Datos oficiales para el libro de acreedores')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Razón Social / Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('tax_id')
                            ->label('NIF / CIF')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('B12345678'),
                    ]),

                Section::make('Contacto y Pagos')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email(),
                        TextInput::make('phone')
                            ->label('Teléfono'),
                        Textarea::make('address')
                            ->label('Dirección Fiscal')
                            ->columnSpanFull(),
                        TextInput::make('account_number')
                            ->label('Cuenta Bancaria (IBAN)')
                            ->placeholder('ES00 0000...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
