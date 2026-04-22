<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Language;
use Lunar\Models\Channel;
use Lunar\Models\ProductType;
use Lunar\Models\TaxClass;
use Lunar\Models\TaxZone;
use Lunar\Models\TaxRate;

class LunarCatalogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CANAL (Usamos solo name para evitar errores de columna)
        Channel::updateOrCreate(['name' => 'Web Store'], ['default' => true]);

        // 2. IDIOMA
        Language::updateOrCreate(['code' => 'en'], ['name' => 'English', 'default' => true]);

        // 3. TIPO DE PRODUCTO
        ProductType::updateOrCreate(['name' => 'General']);

        // 4. CLASE DE IMPUESTO
        $taxClass = TaxClass::updateOrCreate(['name' => 'Default']);

        // 5. ZONA DE IMPUESTOS 
        $taxZone = TaxZone::updateOrCreate(['name' => 'Default Zone'], [
            'active' => true,
            'zone_type' => 'world',
            'price_display' => 'inclusive',
            'default' => true,
        ]);

        // 6. TASA DE IMPUESTO
        TaxRate::updateOrCreate([
            'tax_zone_id' => $taxZone->id,
        ], [
            'priority' => 1,
            'name' => 'Standard Rate',
        ]);
    }
}