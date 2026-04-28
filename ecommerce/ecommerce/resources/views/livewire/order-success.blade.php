<?php

use Lunar\Facades\CartSession;
use App\Models\Harvest;
use App\Models\SellerInventory;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public function mount()
    {
        $paymentIntentId = request()->query('payment_intent');

        if (!$paymentIntentId) {
            return redirect()->route('home');
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.key'));
        $intent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        if ($intent->status !== 'succeeded') {
            return redirect()->route('checkout');
        }

        $order = \Lunar\Models\Order::where('status', 'awaiting-payment')
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('home');
        }

        $buyer = auth()->user();

        DB::transaction(function () use ($order, $buyer) {
            $order->update(['status' => 'paid']);

            foreach ($order->lines as $line) {
                $variant = $line->purchasable;
                if (!$variant) continue;

                $quantity = $line->quantity;

                // Reducir stock de Lunar y de la cosecha
                $variant->decrement('stock', $quantity);

                $harvest = Harvest::where('lunar_variant_id', $variant->id)->first();
                if ($harvest) {
                    $harvest->decrement('stock', $quantity);

                    // ✅ Si el comprador es vendedor, crear inventario
                    if ($buyer->isSeller()) {
                        $seller = $buyer->seller;

                        // Acumular si ya compró esta cosecha antes
                        $existing = SellerInventory::where('seller_id', $seller->id)
                            ->where('harvest_id', $harvest->id)
                            ->first();

                        if ($existing) {
                            $existing->increment('quantity_purchased', $quantity);
                            $existing->increment('quantity_remaining', $quantity);
                        } else {
                            SellerInventory::create([
                                'seller_id'          => $seller->id,
                                'harvest_id'         => $harvest->id,
                                'order_id'           => $order->id,
                                'quantity_purchased' => $quantity,
                                'quantity_remaining' => $quantity,
                            ]);
                        }
                    }
                }
            }

            CartSession::forget();
        });
    }
}; ?>

<div class="max-w-xl mx-auto py-20 text-center">
    <flux:card class="space-y-4">
        <flux:icon.check-circle variant="solid" class="text-green-500 size-12 mx-auto" />
        <flux:heading size="xl">¡Pago completado!</flux:heading>
        <p class="text-gray-600">Tu pedido ha sido procesado correctamente.</p>
        @if(auth()->user()->isSeller())
            <p class="text-sm text-blue-500">El stock ha sido añadido a tu inventario.</p>
            {{-- <flux:button href="{{ route('sellers.dashboard') }}" variant="primary">
                Ver mi inventario
            </flux:button> --}}
        @else
            <flux:button href="{{ route('home') }}" variant="primary">Volver al inicio</flux:button>
        @endif
    </flux:card>
</div>