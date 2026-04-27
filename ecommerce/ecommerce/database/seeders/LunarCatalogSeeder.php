<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Lunar\Models\Language;
use Lunar\Models\Channel;
use Lunar\Models\ProductType;
use Lunar\Models\TaxClass;
use Lunar\Models\TaxZone;
use Lunar\Models\TaxRate;
use Lunar\Models\Country;

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

        // 7. COUNTRY
        Country::firstOrCreate([
            'iso2' => 'ES',
        ], [
            'name' => 'Spain',
            'iso3' => 'ESP',
            'phonecode' => 34,
            'currency' => 'EUR',
            'emoji' => '🇪🇸',
            'emoji_u' => 'U+1F1EA U+1F1F8',
        ]);

        // // 8. SHIPPING ZONE
        // $shippingZone = \Lunar\Models\ShippingZone::firstOrCreate(
        //     ['name' => 'Default Zone'],
        //     ['type' => 'countries'] // 'unrestricted' no es un tipo válido en Lunar 1.x
        // );

        // // Asocia España a la zona
        // $spain = Country::where('iso2', 'ES')->first();
        // $shippingZone->countries()->syncWithoutDetaching([$spain->id]);

        // // 9. SHIPPING METHOD (dentro de la zona)
        // \Lunar\Models\ShippingMethod::firstOrCreate(
        //     ['handle' => 'standard-delivery'],
        //     [
        //         'shipping_zone_id' => $shippingZone->id,
        //         'name'             => 'Envío Estándar',
        //         'driver'           => 'ship-by',
        //         'data'             => ['minimum_spend' => []],
        //         'enabled'          => true,
        //         'cutoff'           => null,
        //         'capacity'         => null,
        //         'max_weight'       => null,
        //     ]
        // );

        // // 10. SHIPPING RATE (el precio real del método)
        // $method = \Lunar\Models\ShippingMethod::where('handle', 'standard-delivery')->first();
        // \Lunar\Models\ShippingRate::firstOrCreate(
        //     ['shipping_method_id' => $method->id],
        //     [
        //         'price'         => 0,     // gratis
        //         'tax_class_id'  => $taxClass->id,
        //         'currency_id'   => \Lunar\Models\Currency::where('code', 'EUR')->first()?->id,
        //         'min_spend'     => null,
        //         'max_spend'     => null,
        //         'min_weight'    => null,
        //         'max_weight'    => null,
        //     ]
        // );
    }
}
