<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Rr8CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nameMi' => 'verduras'],
            ['nameMi' => 'otrasHortalizas'],
            ['nameMi' => 'plantasAromaticas'],
            ['nameMi' => 'frutas'],
        ];

        foreach ($categorias as $categoria) {
            \App\Models\Rr8Categoria::create($categoria);
        }
    }
}
