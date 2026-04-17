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

        // Avisamos a los demás componentes y a nosotros mismos de que cambió
        $this->dispatch('cart-updated');

        $this->js("Flux.toast('Producto eliminado')");
    }
}; ?>

<div class="p-4 space-y-4">
    <flux:heading size="lg">Tu Cesta</flux:heading>

    @if ($cart && $cart->lines->count() > 0)
        <div class="space-y-4">
            @foreach ($cart->lines as $line)
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-medium text-sm">{{ $line->purchasable->product->attr('name') }}</p>
                        <p class="text-xs text-zinc-500">{{ $line->quantity }} x {{ $line->unitPrice->formatted }}</p>
                    </div>
                    <flux:button wire:click="removeItem({{ $line->id }})" variant="ghost" icon="trash"
                        size="sm" />
                </div>
            @endforeach

            <div class="pt-4 border-t">
                <div class="flex justify-between font-bold">
                    <span>Total:</span>
                    <span>{{ $cart->total->formatted }}</span>
                </div>
                <flux:button variant="primary" class="w-full mt-4">Finalizar Compra</flux:button>
            </div>
        </div>
    @else
        <p class="text-sm text-zinc-500">La cesta está vacía.</p>
    @endif
</div>
