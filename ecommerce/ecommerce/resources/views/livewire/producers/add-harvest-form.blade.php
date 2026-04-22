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

new class extends Component {
    public $product_type_id;
    public $collect_date;
    public $quantity;
    public $price;
    public $unit_measure = 'kg';
    public $temperature;
    public $humidity;

    public function mount()
    {
        $types = ProductType::all();
        if ($types->count() === 1) {
            $this->product_type_id = $types->first()->id;
        }
    }

    public function save()
    {
        $this->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'collect_date' => 'required|date',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'unit_measure' => 'required|string',
            'temperature' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
        ]);

        // 1. Pre-verificación de cimientos (Si esto falla, no entramos en la transacción)
        $currency = Currency::getDefault() ?? Currency::where('code', 'EUR')->first();
        $lunarType = LunarProductType::first();
        // Buscamos una clase de impuesto de forma segura
        $taxClass = TaxClass::where('default', 1)->first() ?? TaxClass::first();

        if (!$currency || !$lunarType || !$taxClass) {
            $this->js("Flux.toast({ variant: 'danger', title: 'Error Crítico', description: 'Faltan datos base en Lunar (Moneda, Tipo o Impuestos).' })");
            return;
        }

        DB::transaction(function () use ($currency, $lunarType, $taxClass) {
            // 2. Crear Cosecha propia
            $harvest = Harvest::create([
                'producer_id' => auth()->user()->producer->id,
                'product_type_id' => $this->product_type_id,
                'collect_date' => $this->collect_date,
                'quantity' => $this->quantity,
                'stock' => $this->quantity,
                'price' => $this->price,
                'unit_measure' => $this->unit_measure,
                'temperature' => $this->temperature,
                'humidity' => $this->humidity,
            ]);

            // 3. Crear Producto Lunar
            $lunarProduct = Product::create([
                'status' => 'published',
                'product_type_id' => $lunarType->id,
                'attribute_data' => [
                    'name' => new TranslatedText([
                        'en' => "Cosecha #{$harvest->id} - " . \App\Models\ProductType::find($this->product_type_id)->name,
                    ]),
                ],
            ]);

            // 4. Crear Variante
            $variant = ProductVariant::create([
                'product_id' => $lunarProduct->id,
                'sku' => "HARV-{$harvest->id}-" . uniqid(), // SKU siempre único
                'tax_class_id' => $taxClass->id,
                'stock' => (int) $this->quantity,
                'purchasable' => 'always',
            ]);

            // 5. CREACIÓN DEL PRECIO (Vía Relación - No puede fallar)
            $variant->prices()->create([
                'currency_id' => $currency->id,
                'price' => (int) ($this->price * 100),
                'min_quantity' => 1,
            ]);

            // 6. Vincular
            $harvest->update(['lunar_variant_id' => $variant->id]);
        });

        $this->reset(['collect_date', 'quantity', 'price', 'temperature', 'humidity']);
        $this->dispatch('harvest-added');
        $this->js("Flux.toast('Cosecha publicada correctamente')");
    }

    public function with()
    {
        return [
            'types' => ProductType::all(),
        ];
    }

    #[On('product-type-created')]
    public function refreshTypes()
    {
        $this->mount(); // Re-chequeamos si hay uno solo para auto-seleccionar
    }
}; ?>

<flux:card class="space-y-6 mb-4">
    <form wire:submit="save" class="space-y-6">
        <flux:heading size="lg">Registrar Nueva Cosecha</flux:heading>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:select wire:model.live="product_type_id" label="Tipo de Producto" placeholder="Selecciona...">
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
