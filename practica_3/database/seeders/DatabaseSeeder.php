<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            ['dni' => '12345678X', 'name' => 'Roberto Productor', 'email' => 'roberto@eco.com', 
                'password' => bcrypt('1234'), 'ubi' => 'Tenerife'],
            ['dni' => '87654321Y', 'name' => 'Ana Vendedora', 'email' => 'ana@eco.com', 
                'password' => bcrypt('1234'), 'ubi' => 'Gran Canaria'],
            ['dni' => '11223344Z', 'name' => 'Juan Cliente', 'email' => 'juan@eco.com', 
                'password' => bcrypt('1234'), 'ubi' => 'Lanzarote'],
        ]);

        DB::table('producers')->insert([
            ['dni' => '12345678X', 'iban' => 'ES7620770024003102575766', 'cert_ods' => 'certificado_ods.pdf'],
        ]);

        DB::table('sellers')->insert([
            ['dni' => '87654321Y', 'iban' => 'ES7620770024003102575766', 'delivery' => true],
        ]);

        DB::table('clients')->insert([
            ['dni' => '11223344Z', 'birth_date' => '1990-01-01'],
        ]);

        DB::table('product_types')->insert([
            ['name' => 'Plátano Canario', 'type' => 'Fruta'],
            ['name' => 'Tomate de Aldea', 'type' => 'Verdura']
        ]);

        DB::table('harvests')->insert([
            'producer_dni' => '12345678X',
            'type_id' => 1,
            'collect_date' => now(),
            'quantity' => 500.00,
            'stock' => 500.00,
            'price' => 1.20,
            'unit_measure' => 'kg',
            'temperature' => 24.5,
            'humidity' => 55.0
        ]);

        DB::table('seller_inventory')->insert([
            'seller_dni' => '87654321Y', 
            'harvest_id' => 1, 
            'stock' => 100.00, 
            'sale_price' => 1.80
        ]);

        DB::table('bills')->insert([
            'bill_num' => 'FACT-001', 
            'transmitter_dni' => '87654321Y', 
            'receiver_dni' => '11223344Z', 
            'total_amount' => 18.00
            ]);

        DB::table('bill_details')->insert([
            'bill_num' => 'FACT-001', 
            'harvest_id' => 1, 
            'quantity' => 10.00, 
            'price' => 1.80
        ]);
    }
}
