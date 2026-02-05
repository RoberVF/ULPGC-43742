<?php

namespace App\Filament\Admin\Resources\Companies\Pages;

use App\Filament\Admin\Resources\Companies\CompanyResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Enums\RoleType;
use Illuminate\Support\Facades\Hash;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    /**
     * Se ejecuta después de que la empresa se haya guardado en la BD
     */
    protected function afterCreate(): void
    {
        $data = $this->form->getRawState();
        $company = $this->record;

        // Creamos el usuario vinculado a la empresa recién creada
        User::create([
            'name' => $data['user_name'],
            'email' => $data['user_email'],
            'password' => Hash::make($data['user_password']),
            'company_id' => $company->id,
            'role' => RoleType::Staff, // O el que prefieras por defecto
            'is_company_root' => true,
        ]);
    }

    /**
     * Limpiamos los datos del usuario antes de que Filament 
     * intente guardarlos en la tabla 'companies'
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Quitamos los campos del usuario para que no den error de "columna no encontrada"
        unset($data['user_name'], $data['user_email'], $data['user_password']);

        return $data;
    }
}
