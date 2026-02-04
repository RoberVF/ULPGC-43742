<?php

namespace App\Enums;

enum RoleType: string
{
    case Admin = 'admin';
    case Staff = 'staff';
    case Manager = 'manager';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Administrador',
            self::Staff => 'Personal',
            self::Manager => 'Gerente',
        };
    }
}
