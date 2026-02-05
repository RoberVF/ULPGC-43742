<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasTenants;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_id',
        'is_company_root',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => RoleType::class,
            'is_company_root' => 'boolean',
        ];
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Helper para verificar roles.
     */
    public function isAdmin(): bool
    {
        return $this->role === RoleType::Admin;
    }

    public function isManager(): bool
    {
        return $this->role === RoleType::Manager;
    }

    /**
     * Helper para saber si es el administrador de su empresa
     */
    public function isCompanyRoot(): bool
    {
        return $this->is_company_root;
    }

    /**
     * Devuelve las empresas (tenants) a las que pertenece el usuario.
     */
    public function getTenants(Panel $panel): array | Collection
    {
        return $this->company ? collect([$this->company]) : collect();
    }

    /**
     * Verifica si el usuario puede acceder a una empresa específica.
     */
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->isAdmin() || $this->company_id === $tenant->id;
    }

    /**
     * Para filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        if ($panel->getId() === 'app') {
            return $this->isAdmin() || $this->isManager() || $this->role === \App\Enums\RoleType::Staff;
        }

        return false;
    }
}
