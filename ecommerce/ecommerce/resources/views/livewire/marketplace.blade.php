<?php

use App\Models\Harvest;
use Lunar\Facades\CartSession;
use Livewire\Volt\Component;

new class extends Component {
    public array $quantities = [];
    public function addToCart($variantId)
    {
        $this->resetErrorBag("quantities.$variantId");

        $requestedQty = (int) ($this->quantities[$variantId] ?? 1);
        $variant = \Lunar\Models\ProductVariant::find($variantId);

        if (!$variant) {
            $this->addError("quantities.$variantId", 'El producto ya no existe.');
            return;
        }

        if ($requestedQty > $variant->stock) {
            $this->addError("quantities.$variantId", "Solo quedan {$variant->stock} disponibles.");
            return;
        }

        $currentCart = \Lunar\Facades\CartSession::current();
        $existingLine = $currentCart?->lines()->where('purchasable_id', $variantId)->first();
        $qtyInCart = $existingLine?->quantity ?? 0;

        if ($requestedQty + $qtyInCart > $variant->stock) {
            $this->addError("quantities.$variantId", "Ya tienes $qtyInCart en el carrito. No puedes añadir $requestedQty más.");
            return;
        }

        \Lunar\Facades\CartSession::add($variant, $requestedQty);

        $this->dispatch('cart-updated');
        $this->js("Flux.toast('Añadido al carrito correctamente')");
        $this->quantities[$variantId] = 1;
    }

    public function with()
    {
        return [
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
            <flux:card class="space-y-4">
                <div class="flex justify-between">
                    <flux:heading size="lg">{{ $harvest->productType->name }}</flux:heading>
                    <flux:badge variant="success" size="sm">
                        {{ number_format($harvest->price, 2) }}€ / {{ $harvest->unit_measure }}
                    </flux:badge>
                </div>

                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <flux:icon.archive-box variant="micro" />
                    <span>Disponible: <strong>{{ number_format($harvest->stock, 2) }}
                            {{ $harvest->unit_measure }}</strong></span>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="flex gap-2">
                        <flux:input wire:model="quantities.{{ $harvest->lunar_variant_id }}" type="number"
                            min="1" :invalid="$errors->has('quantities.'.$harvest->lunar_variant_id)"
                            placeholder="Cant." class="w-24" />

                        <flux:button wire:click="addToCart({{ $harvest->lunar_variant_id }})" variant="primary"
                            class="flex-1">
                            Añadir
                        </flux:button>
                    </div>

                    @error('quantities.' . $harvest->lunar_variant_id)
                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </flux:card>
        @endforeach
    </div>
</div>
