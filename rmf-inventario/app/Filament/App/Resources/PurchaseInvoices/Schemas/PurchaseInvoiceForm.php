<?php

namespace App\Filament\App\Resources\PurchaseInvoices\Schemas;

use App\Models\PurchaseInvoice;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PurchaseInvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos de la Factura')
                    ->columns(3)
                    ->schema([
                        Select::make('supplier_id')
                            ->relationship('supplier', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('number')
                            ->label('Referencia Interna')
                            ->default(function () {
                                $lastInvoice = PurchaseInvoice::latest('id')->first();
                                $nextNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
                                return 'INV-' . date('Y') . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                            })
                            ->readOnly()
                            ->disabled()
                            ->required()
                            ->dehydrated(),
                        DatePicker::make('date')
                            ->label('Fecha Emisión')
                            ->default(now())
                            ->required(),

                        TextInput::make('total_amount')
                            ->label('Total Factura (€)')
                            ->numeric()
                            ->readOnly()
                            ->prefix('€')
                            ->dehydrated()
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'font-bold text-lg']),
                    ]),

                Section::make('Detalle de Artículos')
                    ->schema([
                        Repeater::make('lines')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpan(2),
                                TextInput::make('quantity')
                                    ->label('Cant.')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, $set, $get) =>
                                    $set('subtotal', $state * $get('unit_price'))),
                                TextInput::make('unit_price')
                                    ->label('Precio U.')
                                    ->numeric()
                                    ->prefix('€')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, $set, $get) =>
                                    $set('subtotal', $state * $get('quantity'))),
                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->prefix('€')
                                    ->readonly()
                                    ->dehydrated(),
                            ])
                            ->columns(2)
                            ->live()
                            ->defaultItems(1)
                            ->reorderable(false)
                            ->afterStateUpdated(function ($state, $set) {
                                $total = collect($state)->sum('subtotal');
                                $set('total_amount', $total);
                            })
                    ]),

            ]);
    }
}
