<?php

use Lunar\Facades\CartSession;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    #[On('cart-updated')]
    public function refreshCart() {}
    public function with(): array
    {
        return [
            'cart' => CartSession::current(),
        ];
    }

    public function removeItem($lineId)
    {
        CartSession::remove($lineId);

        $this->dispatch('cart-updated');

        $this->js("Flux.toast('Producto eliminado')");
    }
}; ?>

<div class="p-4 space-y-4">
    <flux:heading size="lg">Tu Cesta</flux:heading>

    @if ($cart && $cart->lines->count() > 0)
        <div class="space-y-4">
            @foreach ($cart->lines as $line)
                @php
                    $harvest = \App\Models\Harvest::where('lunar_variant_id', $line->purchasable->id)->first();
                    $unit = $harvest->unit_measure ?? 'ud';
                @endphp

                <div class="py-4 border-b border-gray-700 last:border-0">
                    <div class="flex justify-between items-start mb-1">
                        <span
                            class="font-bold text-white">{{ $line->purchasable->product->translateAttribute('name') }}</span>

                        <button wire:click="removeItem({{ $line->id }})"
                            class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                            <flux:icon.trash variant="micro" />
                        </button>
                    </div>

                    <div class="flex justify-between items-end text-sm">
                        <div class="text-gray-500">
                            {{ $line->quantity }}{{ $unit }} x
                            {{ $line->unitPrice->formatted() }}/{{ $unit }}
                        </div>

                        <div class="text-right">
                            <span class="text-xs text-gray-400 block uppercase tracking-wider">Subtotal</span>
                            <span class="font-semibold text-white">{{ $line->subTotal->formatted() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pt-4">
                <div class="flex justify-between font-bold">
                    <span>Total:</span>
                    <span>{{ $cart->total->formatted }}</span>
                </div>
                <flux:button variant="primary" class="w-full mt-4" href="{{ route('checkout') }}">Finalizar Compra</flux:button>
            </div>
        </div>
    @else
        <p class="text-sm text-zinc-500">La cesta está vacía.</p>
    @endif
</div>
