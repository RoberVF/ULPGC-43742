<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use App\Enums\RoleType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Información Personal')
                ->description('Datos básicos de acceso a la plataforma.')
                ->schema([
                    TextInput::make('name')
                        ->label('Nombre Completo')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Correo Electrónico')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('password')
                        ->label('Contraseña')
                        ->password()
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->maxLength(255),
                ])->columns(3),

            Section::make('Permisos y Empresa')
                ->description('Define el rango del usuario y a qué organización pertenece.')
                ->schema([
                    Select::make('role')
                        ->label('Rol de Sistema')
                        ->options(RoleType::class)
                        ->required()
                        ->native(false),

                    Select::make('company_id')
                        ->label('Empresa Asociada')
                        ->relationship('company', 'name')
                        ->searchable()
                        ->preload()
                        ->helperText('Deja este campo vacío para Administradores de RMF Inventory.'),

                    Toggle::make('is_company_root')
                        ->label('Privilegios de Root de Empresa')
                        ->helperText('Si se activa, este usuario podrá gestionar la configuración y usuarios de su propia empresa.')
                        ->default(false),
                ])->columns(3),
        ]);
    }
}