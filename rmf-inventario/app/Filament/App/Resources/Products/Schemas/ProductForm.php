<?php

namespace App\Filament\App\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identificación')
                ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('sku')
                        ->label('SKU / Código')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Select::make('category_id')
                        ->relationship('category', 'name')
                        // ->relationship(
                        //     name: 'category',
                        //     titleAttribute: 'name',
                        //     modifyQueryUsing: fn(Builder $query) => $query->where('company_id', filament()->getTenant()->id)
                        // )
                        ->searchable()
                        ->preload()
                        ->required(),
                ])->columns(3),

            Section::make('Precios')
                ->schema([
                    TextInput::make('purchase_price')->numeric()->prefix('$'),
                    TextInput::make('sale_price')->numeric()->prefix('$'),
                    TextInput::make('security_stock')->numeric()->label('Stock de Seguridad'),
                ])->columns(3),
        ]);
    }
}
