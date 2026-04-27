<?php
// resources/views/livewire/order-success.blade.php

use Lunar\Facades\CartSession;
use App\Models\Harvest;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public function mount()
    {
        $paymentIntentId = request()->query('payment_intent');

        if (!$paymentIntentId) {
            return redirect()->route('home');
        }

        // Verificar estado directamente en Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.key'));
        $intent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        if ($intent->status !== 'succeeded') {
            return redirect()->route('checkout');
        }

        // Buscar la orden por el cart que tiene este intent
        $order = \Lunar\Models\Order::where('status', 'awaiting-payment')->latest()->first();

        if (!$order) {
            return redirect()->route('home');
        }

        DB::transaction(function () use ($order) {
            $order->update(['status' => 'paid']);

            foreach ($order->lines as $line) {
                $variant = $line->purchasable;
                if (!$variant) {
                    continue;
                }

                $variant->decrement('stock', $line->quantity);

                $harvest = \App\Models\Harvest::where('lunar_variant_id', $variant->id)->first();
                if ($harvest) {
                    $harvest->decrement('stock', $line->quantity);
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
        <p class="text-white">Tu pedido ha sido procesado y el stock se ha actualizado correctamente.</p>

        <flux:button href="/dashboard" variant="primary">Volver al Mercado</flux:button>
    </flux:card>
</div>
