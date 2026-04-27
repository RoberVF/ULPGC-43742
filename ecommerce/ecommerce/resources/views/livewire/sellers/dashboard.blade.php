<?php

use Livewire\Volt\Component;
use App\Models\SellerInventory;
use App\Models\SellerListing;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Lunar\Models\Price;
use Lunar\Models\Currency;
use Lunar\Models\TaxClass;
use Lunar\Models\ProductType;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public string $activeTab = 'inventory';

    // Formulario de nuevo listing
    public ?int $selectedInventoryId = null;
    public int $listingQuantity = 1;
    public float $listingPrice = 0.0;

    public function rules(): array
    {
        return [
            'selectedInventoryId' => ['required', 'exists:seller_inventory,id'],
            'listingQuantity' => ['required', 'integer', 'min:1'],
            'listingPrice' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function createListing(): void
    {
        $this->validate();

        $seller = auth()->user()->seller;
        $inventory = SellerInventory::where('id', $this->selectedInventoryId)->where('seller_id', $seller->id)->firstOrFail();

        if ($this->listingQuantity > $inventory->quantity_remaining) {
            $this->addError('listingQuantity', 'No tienes suficiente stock disponible.');
            return;
        }

        DB::transaction(function () use ($seller, $inventory) {
            $harvest = $inventory->harvest;
            $productType = ProductType::first();
            $currency = Currency::where('code', 'EUR')->first();
            $taxClass = TaxClass::first();
            $sellerName = auth()->user()->name;

            // Crear producto Lunar para este listing
            $product = Product::create([
                'product_type_id' => $productType->id,
                'status' => 'draft',
                'attribute_data' => [
                    'name' => new \Lunar\FieldTypes\TranslatedText(collect(['en' => "{$harvest->productType->name} - {$sellerName}"])),
                ],
            ]);

            // Crear variante
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'stock' => $this->listingQuantity,
                'tax_class_id' => $taxClass->id,
            ]);

            // Crear precio
            Price::create([
                'priceable_type' => ProductVariant::class,
                'priceable_id' => $variant->id,
                'currency_id' => $currency->id,
                'price' => (int) ($this->listingPrice * 100), // en céntimos
                'min_quantity' => 1,
            ]);

            // Crear listing y descontar inventario
            SellerListing::create([
                'seller_id' => $seller->id,
                'seller_inventory_id' => $inventory->id,
                'lunar_variant_id' => $variant->id,
                'price' => $this->listingPrice,
                'stock' => $this->listingQuantity,
                'published' => false,
            ]);

            $inventory->decrement('quantity_remaining', $this->listingQuantity);
        });

        $this->reset('selectedInventoryId', 'listingQuantity', 'listingPrice');
        $this->activeTab = 'listings';
    }

    public function togglePublished(int $listingId): void
    {
        $listing = SellerListing::where('id', $listingId)
            ->where('seller_id', auth()->user()->seller->id)
            ->firstOrFail();

        $listing->update(['published' => !$listing->published]);

        if ($listing->lunarVariant?->product) {
            $listing->lunarVariant->product->update([
                'status' => $listing->published ? 'published' : 'draft',
            ]);
        }
    }

    public function with(): array
    {
        $seller = auth()->user()->seller;
        $inventory = SellerInventory::with('harvest.productType')->where('seller_id', $seller->id)->where('quantity_remaining', '>', 0)->get();

        $listings = SellerListing::with('inventory.harvest.productType')->where('seller_id', $seller->id)->latest()->get();

        return [
            'inventory' => $inventory,
            'listings' => $listings,
            'publishedCount' => $listings->where('published', true)->count(),
            'totalStock' => $inventory->sum('quantity_remaining'),
        ];
    }
}; ?>

<div class="max-w-5xl mx-auto py-10 space-y-6">
    <flux:heading size="xl">Panel del Vendedor</flux:heading>

    {{-- Tabs --}}
    <div class="flex gap-2 border-b pb-2">
        <flux:button wire:click="$set('activeTab', 'inventory')"
            variant="{{ $activeTab === 'inventory' ? 'primary' : 'ghost' }}">
            📦 Mi Inventario
        </flux:button>
        <flux:button wire:click="$set('activeTab', 'create')"
            variant="{{ $activeTab === 'create' ? 'primary' : 'ghost' }}">
            ➕ Crear Listing
        </flux:button>
        <flux:button wire:click="$set('activeTab', 'listings')"
            variant="{{ $activeTab === 'listings' ? 'primary' : 'ghost' }}">
            🏪 Mis Listings
        </flux:button>
    </div>

    {{-- Inventario --}}
    @if ($activeTab === 'inventory')
        <flux:card>
            <div class="mb-4 flex gap-4">
                <div class="text-center">
                    <p class="text-sm text-gray-500">Stock disponible total</p>
                    <p class="text-2xl font-bold">{{ $totalStock }}</p>
                </div>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b text-gray-500">
                        <th class="py-2">Producto</th>
                        <th>Comprado</th>
                        <th>Disponible</th>
                        <th>En listings</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventory as $item)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-3">{{ $item->harvest->productType->name ?? '—' }}</td>
                            <td>{{ $item->quantity_purchased }}</td>
                            <td>
                                <span
                                    class="{{ $item->quantity_remaining > 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                                    {{ $item->quantity_remaining }}
                                </span>
                            </td>
                            <td>{{ $item->quantity_purchased - $item->quantity_remaining }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">
                                Tu inventario está vacío. Compra cosechas de productores primero.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </flux:card>
    @endif

    {{-- Crear Listing --}}
    @if ($activeTab === 'create')
        <flux:card class="space-y-4 max-w-lg">
            <flux:heading size="lg">Crear nuevo listing</flux:heading>

            @if ($inventory->isEmpty())
                <p class="text-gray-400">No tienes stock disponible. Compra cosechas primero.</p>
            @else
                <div class="space-y-4">
                    {{-- Seleccionar producto del inventario --}}
                    <div>
                        <flux:label>Producto del inventario</flux:label>
                        <select wire:model="selectedInventoryId"
                            class="w-full mt-1 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-2 text-sm">
                            <option value="">Selecciona un producto...</option>
                            @foreach ($inventory as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->harvest->productType->name ?? '—' }}
                                    (disponible: {{ $item->quantity_remaining }})
                                </option>
                            @endforeach
                        </select>
                        @error('selectedInventoryId')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Cantidad --}}
                    <flux:input wire:model="listingQuantity" type="number" min="1"
                        label="Cantidad a poner en venta" />
                    @error('listingQuantity')
                        <p class="text-red-500 text-xs -mt-2">{{ $message }}</p>
                    @enderror

                    {{-- Precio --}}
                    <flux:input wire:model="listingPrice" type="number" step="0.01" min="0.01"
                        label="Precio por unidad (€)" />
                    @error('listingPrice')
                        <p class="text-red-500 text-xs -mt-2">{{ $message }}</p>
                    @enderror

                    <flux:button wire:click="createListing" variant="primary" class="w-full">
                        Crear listing
                    </flux:button>
                </div>
            @endif
        </flux:card>
    @endif

    {{-- Mis Listings --}}
    @if ($activeTab === 'listings')
        <flux:card>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b text-gray-500">
                        <th class="py-2">Producto</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listings as $listing)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-3">
                                {{ $listing->inventory->harvest->productType->name ?? '—' }}
                            </td>
                            <td>{{ $listing->stock }}</td>
                            <td>{{ number_format($listing->price, 2) }}€</td>
                            <td>
                                @if ($listing->published)
                                    <span class="text-green-500 font-medium">✅ Publicado</span>
                                @else
                                    <span class="text-gray-400">⏸ Oculto</span>
                                @endif
                            </td>
                            <td>
                                <flux:button wire:click="togglePublished({{ $listing->id }})" size="sm"
                                    variant="{{ $listing->published ? 'danger' : 'primary' }}">
                                    {{ $listing->published ? 'Despublicar' : 'Publicar' }}
                                </flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">
                                No tienes listings. Crea uno desde la pestaña "Crear Listing".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </flux:card>
    @endif

    <div class="flex justify-between items-center">
        <flux:heading size="xl">Panel del Vendedor</flux:heading>
        <flux:button href="{{ route('producer.market') }}" variant="ghost">
            🌿 Comprar cosechas
        </flux:button>
    </div>
</div>
