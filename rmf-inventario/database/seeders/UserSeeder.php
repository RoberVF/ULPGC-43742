<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Roberto',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('password'),
            'role' => RoleType::Admin,
        ]);

        User::create([
            'name' => 'Staff Roberto',
            'email' => 'user@ejemplo.com',
            'password' => Hash::make('password'),
            'role' => RoleType::Staff,
        ]);
    }
}
