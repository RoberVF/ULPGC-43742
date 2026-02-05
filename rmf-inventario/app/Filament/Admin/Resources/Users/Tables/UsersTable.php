<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Enums\RoleType;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),

                TextColumn::make('company.name')
                    ->label('Empresa')
                    ->badge()
                    ->color('info')
                    ->placeholder('ADMIN GLOBAL'),

                TextColumn::make('role')
                    ->label('Rol')
                    ->badge(),

                IconColumn::make('is_company_root')
                    ->label('Root')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('company_id')
                    ->relationship('company', 'name')
                    ->label('Filtrar por Empresa'),
            ]);
    }
}