<?php

namespace App\Filament\Admin\Resources\Companies\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl(url('/images/no-logo.png')),

                TextColumn::make('name')
                    ->label('Empresa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Identificador')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('users_count')
                    ->label('Usuarios')
                    ->counts('users')
                    ->alignCenter(),

                ToggleColumn::make('is_active')
                    ->label('Estado Activo'),

                TextColumn::make('created_at')
                    ->label('Alta')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ]);
    }
}