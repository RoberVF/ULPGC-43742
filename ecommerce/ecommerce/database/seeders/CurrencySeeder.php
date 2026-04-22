<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::firstOrCreate([
            'code' => 'EUR',
        ], [
            'name' => 'Euro',
            'exchange_rate' => 1,
            'decimal_places' => 2,
            'default' => true,
            'enabled' => true,
        ]);
    }
}