<?php

use Livewire\Volt\Component;
use App\Models\SellerListing;
use Lunar\Facades\CartSession;

new class extends Component {
    public array $quantities = [];
    public string $successMessage = '';

    public function mount(): void
    {
        $listings = SellerListing::where('published', true)->where('stock', '>', 0)->get();

        foreach ($listings as $listing) {
            $this->quantities[$listing->id] = 1;
        }
    }

    public function addToCart(int $listingId): void
    {
        $listing = SellerListing::where('id', $listingId)->where('published', true)->where('stock', '>', 0)->firstOrFail();

        $qty = (int) ($this->quantities[$listingId] ?? 1);

        if ($qty < 1 || $qty > $listing->stock) {
            return;
        }

        try {
            try {
                $cart = CartSession::current();
            } catch (\Exception $e) {
                CartSession::forget();
                $cart = null;
            }

            if (!$cart) {
                $currency = \Lunar\Models\Currency::where('default', true)->first();
                $channel = \Lunar\Models\Channel::where('default', true)->first();

                $cart = \Lunar\Models\Cart::create([
                    'currency_id' => $currency->id,
                    'channel_id' => $channel->id,
                ]);
                CartSession::use($cart);
            }

            CartSession::add($listing->lunarVariant, $qty);
            $this->successMessage = "✅ {$listing->inventory->harvest->productType->name} añadido al carrito.";
        } catch (\Exception $e) {
            $this->successMessage = '❌ Error: ' . $e->getMessage();
        }
    }

    public function with(): array
    {
        return [
            'listings' => SellerListing::with(['inventory.harvest.productType', 'seller.user'])
                ->where('published', true)
                ->where('stock', '>', 0)
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div class="max-w-5xl mx-auto py-10 space-y-6">
    <flux:heading size="xl">Marketplace</flux:heading>
    @if ($successMessage)
        <div
            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg flex justify-between items-center mb-4">
            <span>{{ $successMessage }}</span>
            <flux:button href="{{ route('checkout') }}" variant="primary" size="sm">
                Ir al Checkout →
            </flux:button>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($listings as $listing)
            <flux:card class="space-y-3">
                <div>
                    <p class="font-semibold text-lg">
                        {{ $listing->inventory->harvest->productType->name ?? '—' }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Vendedor: {{ $listing->seller->user->name }}
                    </p>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-green-500">
                        {{ number_format($listing->price, 2) }}€
                    </span>
                    <span class="text-sm text-gray-400">
                        Stock: {{ $listing->stock }}
                    </span>
                </div>

                <div class="flex gap-2 items-center">
                    <flux:input type="number" min="1" max="{{ $listing->stock }}"
                        wire:model="quantities.{{ $listing->id }}" class="w-20" />
                    <flux:button wire:click="addToCart({{ $listing->id }})" variant="primary" class="flex-1">
                        Añadir al carrito
                    </flux:button>
                </div>
            </flux:card>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-20">
                No hay productos disponibles en este momento.
            </div>
        @endforelse
    </div>
</div>
