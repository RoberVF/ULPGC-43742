<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rr8ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 1,
            'name' => 'col',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 1,
            'name' => 'espinaca',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 1,
            'name' => 'lechuga',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 1,
            'name' => 'escarola',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 1,
            'name' => 'acelga',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 2,
            'name' => 'ajo',
        ]);

        DB::table('rr8_productos')->insert([
            'rr8Categoria_id' => 2,
            'name' => 'cebolla',
        ]);
    }
}
