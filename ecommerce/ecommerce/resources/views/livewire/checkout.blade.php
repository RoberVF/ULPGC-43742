<?php

use Lunar\Facades\CartSession;
use Lunar\Stripe\Facades\Stripe;
use Livewire\Volt\Component;

new class extends Component {
    public string $clientSecret = '';

    public function mount()
    {
        try {
            $cart = CartSession::current();
        } catch (\Exception $e) {
            CartSession::forget();
            return redirect()->route('marketplace');
        }

        if (!$cart || $cart->lines->isEmpty()) {
            return redirect()->route('marketplace');
        }
        // $cart = CartSession::current();

        if (!$cart || $cart->lines->isEmpty()) {
            return redirect()->to('/dashboard');
        }

        $country = \Lunar\Models\Country::where('iso2', 'ES')->first();

        if (!$country) {
            dd('País ES no encontrado en la base de datos.');
        }

        if ($cart->order && $cart->order->status === 'paid') {
            CartSession::forget();
            return redirect()->to('/dashboard');
        }

        $addressData = [
            'country_id' => $country->id,
            'first_name' => auth()->user()->name,
            'last_name' => 'Productor',
            'line_one' => 'Calle de la ULPGC, 1',
            'city' => 'Las Palmas',
            'postcode' => '35001',
            'contact_email' => auth()->user()->email,
        ];

        $cart = $cart->setBillingAddress($addressData);
        $cart = $cart->setShippingAddress($addressData);
        $cart = $cart->calculate();

        try {
            if ($cart->order && $cart->order->status === 'awaiting-payment') {
                $oldOrder = $cart->order;
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                $oldOrder->lines()->delete();
                $oldOrder->addresses()->delete();
                $oldOrder->transactions()->delete();
                $oldOrder->delete();
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                $cart->update(['merged_id' => null]);
                $cart->refresh();
            }

            $order = $cart->createOrder();
            $paymentIntent = Stripe::createIntent($cart);

            if (!$paymentIntent || !$paymentIntent->client_secret) {
                throw new \Exception('Stripe no generó el secreto.');
            }

            $this->clientSecret = $paymentIntent->client_secret;
        } catch (\Exception $e) {
            dd('Error al crear la orden: ' . $e->getMessage());
        }
    }

    public function with()
    {
        return [
            'cart' => CartSession::current(),
        ];
    }
}; ?>

<div class="max-w-xl mx-auto py-12">
    <flux:card class="space-y-6">
        <flux:heading size="xl">Finalizar Compra</flux:heading>

        <div class="border-b pb-4">
            <p class="text-sm text-gray-500">Total a pagar:</p>
            <p class="text-2xl font-bold">{{ $cart->total->formatted() }}</p>
        </div>

        <div wire:ignore>
            <form id="payment-form" class="space-y-4">
                <div id="link-authentication-element"></div>
                <div id="payment-element"></div>

                <flux:button id="submit" type="submit" variant="primary" class="w-full">
                    <span id="button-text">Pagar Ahora</span>
                    <span id="spinner" class="hidden ml-2 animate-spin">⌛</span>
                </flux:button>

                <div id="payment-message" class="hidden text-red-500 text-sm mt-4 text-center p-2 bg-red-50 rounded">
                </div>
            </form>
        </div>
    </flux:card>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stripe = Stripe("{{ config('services.stripe.public_key') }}");
        const clientSecret = "{{ $clientSecret }}";

        if (!clientSecret) {
            console.error("❌ No hay Client Secret.");
            return;
        }

        const elements = stripe.elements({
            clientSecret,
            appearance: {
                theme: 'night'
            }
        });

        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");

        const form = document.getElementById('payment-form');
        const submitBtn = document.getElementById('submit');
        const spinner = document.getElementById('spinner');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            submitBtn.disabled = true;
            spinner.classList.remove('hidden');

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('order-success') }}",
                },
            });

            if (error) {
                const messageContainer = document.querySelector('#payment-message');
                messageContainer.textContent = error.message;
                messageContainer.classList.remove('hidden');

                submitBtn.disabled = false;
                spinner.classList.add('hidden');
            }
        });
    });
</script>
