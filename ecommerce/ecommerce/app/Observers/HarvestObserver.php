<?php

namespace App\Observers;

use App\Models\Harvest;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Lunar\Models\Currency;
use Lunar\Models\Price;

class HarvestObserver
{
    public function created(Harvest $harvest)
    {
        // Crear el producto en Lunar
        $product = Product::create([
            'status' => 'published',
            'product_type_id' => 1,
            'attribute_data' => [
                'name' => ['en' => "Cosecha #{$harvest->id} - {$harvest->productType->name}"],
            ],
        ]);

        // Crear la variante (es lo que se añade al carrito)
        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => "HARVEST-{$harvest->id}",
        ]);

        // Asignar el precio de la tabla
        Price::create([
            'priceable_type' => ProductVariant::class,
            'priceable_id' => $variant->id,
            'currency_id' => Currency::first()->id,
            'price' => $harvest->price * 100,
        ]);
        
        // Guardamos la referencia en la tabla
        $harvest->update(['lunar_variant_id' => $variant->id]);
    }
}