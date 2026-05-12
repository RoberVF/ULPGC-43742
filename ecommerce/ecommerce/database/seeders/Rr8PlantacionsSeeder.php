<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Rr8PlantacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rr8_plantacions')->insert([
            'fechaInicio' => '2010-01-01',
            'costeProduccion' => 125.30,
            'rr8Producto_id' => 6,
            'fechaFin' => '2010-02-02',
            'valorVenta' => 358.00,
        ]);

        DB::table('rr8_plantacions')->insert([
            'fechaInicio' => '2010-03-03',
            'costeProduccion' => 6570.00,
            'rr8Producto_id' => 7,
            'fechaFin' => NULL,
            'valorVenta' => 00,
        ]);

        DB::table('rr8_plantacions')->insert([
            'fechaInicio' => '2011-04-04',
            'costeProduccion' => 789.45,
            'rr8Producto_id' => 4,
            'fechaFin' => '2011-08-04',
            'valorVenta' => 115.00,
        ]);

        DB::table('rr8_plantacions')->insert([
            'fechaInicio' => '2014-06-05',
            'costeProduccion' => 123.45,
            'rr8Producto_id' => 2,
            'fechaFin' => '2014-08-06',
            'valorVenta' => 654.75,
        ]);

        DB::table('rr8_plantacions')->insert([
            'fechaInicio' => '2015-10-25',
            'costeProduccion' => 89.30,
            'rr8Producto_id' => 3,
            'fechaFin' => NULL,
            'valorVenta' => 00,
        ]);

    }
}
