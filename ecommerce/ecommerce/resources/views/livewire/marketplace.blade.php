<?php

use App\Models\Harvest;
use Lunar\Facades\CartSession;
use Livewire\Volt\Component;

new class extends Component {
    // Función para añadir al carrito de Lunar
    public function addToCart($variantId)
    {
        $purchasable = \Lunar\Models\ProductVariant::find($variantId);

        if ($purchasable) {
            \Lunar\Facades\CartSession::add($purchasable, 1);

            $this->dispatch('cart-updated');

            $this->js("Flux.toast('Añadido al carrito correctamente')");
        } else {
            $this->js("Flux.toast({ variant: 'danger', title: 'Error', description: 'No se encontró el producto' })");
        }
    }

    public function with()
    {
        return [
            // Solo mostramos cosechas que tengan stock y estén vinculadas a Lunar
            'harvests' => Harvest::with(['productType', 'producer.user'])
                ->where('stock', '>', 0)
                ->whereNotNull('lunar_variant_id')
                ->get(),
        ];
    }
}; ?>

<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($harvests as $harvest)
            <flux:card class="flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <flux:heading size="lg">
                                {{ $harvest->productType->name ?? 'Tipo de producto no disponible' }}</flux:heading>
                            <flux:subheading>Producido por:
                                {{ $harvest->producer->user->name ?? 'Productor desconocido' }}</flux:subheading>
                        </div>
                        <flux:badge color="green" size="sm" inset="top">{{ $harvest->price }}€ /
                            {{ $harvest->unit_measure }}</flux:badge>
                    </div>

                    <div class="flex gap-4 text-xs text-zinc-500">
                        <span class="flex items-center gap-1">
                            <flux:icon.calendar variant="micro" /> {{ $harvest->collect_date }}
                        </span>
                        <span class="flex items-center gap-1"><flux:icon.archive-box variant="micro" /> Stock:
                            {{ $harvest->stock }}</span>
                    </div>
                </div>

                <flux:button wire:click="addToCart({{ $harvest->lunar_variant_id }})" variant="primary"
                    icon="shopping-cart" class="mt-6 w-full">
                    Añadir
                </flux:button>
            </flux:card>
        @endforeach
    </div>
</div>
