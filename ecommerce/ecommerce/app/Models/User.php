<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lunar\Base\Traits\LunarUser;
use Lunar\Base\LunarUser as LunarUserInterface;


class User extends Authenticatable implements LunarUserInterface
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, LunarUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'dni',
        'password',
        'image_path',
        'ubi',
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
        ];
    }

    /**
     * Genera las iniciales del usuario para el avatar.
     */
    public function initials(): string
    {
        return collect(explode(' ', $this->name))
            ->map(fn($segment) => mb_substr($segment, 0, 1))
            ->join('');
    }

    public function producer()
    {
        return $this->hasOne(Producer::class);
    }
    public function seller()
    {
        return $this->hasOne(Seller::class);
    }
    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
