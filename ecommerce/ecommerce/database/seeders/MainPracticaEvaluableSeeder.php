<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainPracticaEvaluableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            Rr8CategoriaSeeder::class,
            Rr8ProductoSeeder::class,
            Rr8PlantacionsSeeder::class,
        ]);
    }
}
