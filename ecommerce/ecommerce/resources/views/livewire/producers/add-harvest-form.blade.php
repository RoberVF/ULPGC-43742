<?php

use App\Models\Harvest;
use App\Models\ProductType;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Lunar\Models\Currency;
use Lunar\Models\Price;
use Lunar\Models\ProductType as LunarProductType;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\TaxClass;
use Lunar\Models\Currency;
use Lunar\Models\Price;

new class extends Component {
    public $product_type_id;
    public $collect_date;
    public $quantity;
    public $price;
    public $unit_measure = 'kg';
    public $temperature;
    public $humidity;

    public function save()
    {
        $validated = $this->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'collect_date' => 'required|date',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit_measure' => 'required|string',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
        ]);

        DB::transaction(function () use ($validated) {
            $producer = auth()->user()->producer;

            // 1. Crear la cosecha en TU lógica
            $harvest = Harvest::create([
                'producer_id' => $producer->id,
                'product_type_id' => $this->product_type_id,
                'collect_date' => $this->collect_date,
                'quantity' => $this->quantity,
                'stock' => $this->quantity, // Al empezar, el stock es igual a la cantidad
                'price' => $this->price,
                'unit_measure' => $this->unit_measure,
                'temperature' => $this->temperature,
                'humidity' => $this->humidity,
            ]);

            // 2. Crear el "Espejo" en Lunar para el carrito
            $lunarProduct = Product::create([
                'status' => 'published',
                'product_type_id' => LunarProductType::first()->id,
                'attribute_data' => [
                    'name' => new TranslatedText([
                        'en' => "Cosecha #{$harvest->id} - " . \App\Models\ProductType::find($this->product_type_id)->name,
                    ]),
                ],
            ]);

            $variant = ProductVariant::create([
                'product_id' => $lunarProduct->id,
                'sku' => "HARV-{$harvest->id}",
                'tax_class_id' => TaxClass::getDefault()->id,
            ]);


            Price::create([
                'priceable_type' => ProductVariant::class,
                'priceable_id' => $variant->id,
                'currency_id' => Currency::getDefault()->id,
                'price' => $this->price * 100,
            ]);

            // 3. Vincular la cosecha con la variante de Lunar
            $harvest->update(['lunar_variant_id' => $variant->id]);
        });

        $this->reset();
        $this->dispatch('harvest-added');
        $this->js("Flux.toast('Cosecha registrada y publicada en el marketplace')");
    }

    public function with()
    {
        return [
            'types' => ProductType::all(),
        ];
    }

    #[On('product-type-created')]
    public function refreshTypes() {}
}; ?>

<flux:card class="space-y-6 mb-4">
    <form wire:submit="save" class="space-y-6">
        <flux:heading size="lg">Registrar Nueva Cosecha</flux:heading>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:select wire:model="product_type_id" label="Tipo de Producto" placeholder="Selecciona...">
                @foreach ($types as $type)
                    <flux:select.option value="{{ $type->id }}">{{ $type->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model="collect_date" type="date" label="Fecha de Recogida" />

            <flux:input wire:model="quantity" type="number" step="0.01" label="Cantidad Total" />

            <flux:select wire:model="unit_measure" label="Unidad">
                <flux:select.option value="kg">Kilogramos (kg)</flux:select.option>
                <flux:select.option value="unit">Unidades</flux:select.option>
                <flux:select.option value="box">Cajas</flux:select.option>
            </flux:select>

            <flux:input wire:model="price" type="number" step="0.01" label="Precio por Unidad (€)"
                icon="currency-euro" />
        </div>

        <flux:separator label="Datos de Sensores (Opcional)" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:input wire:model="temperature" type="number" step="0.1" label="Temperatura (°C)"
                icon="sun" />
            <flux:input wire:model="humidity" type="number" step="0.1" label="Humedad (%)" icon="cloud" />
        </div>

        <flux:button type="submit" variant="primary" class="w-full">Publicar Cosecha</flux:button>
    </form>
</flux:card>
