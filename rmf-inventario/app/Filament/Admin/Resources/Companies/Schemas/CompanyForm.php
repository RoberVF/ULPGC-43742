<?php

namespace App\Filament\Admin\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Información de la Empresa')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                ])->columns(2),

            Section::make('Usuario Administrador (Root)')
                ->description('Se creará automáticamente un usuario vinculado a esta empresa.')
                ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                ->schema([
                    TextInput::make('user_name')
                        ->label('Nombre del Administrador')
                        ->required(),
                    TextInput::make('user_email')
                        ->label('Email del Administrador')
                        ->email()
                        ->required()
                        ->unique('users', 'email'),
                    TextInput::make('user_password')
                        ->label('Contraseña')
                        ->password()
                        ->required()
                        ->minLength(8),
                ])->columns(3),
        ]);
    }
}
