<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Client;
use App\Models\Producer;
use App\Models\Seller;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $dni = '';
    public string $role = '';
    public string $ubi = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'dni' => ['required', 'string', 'lowercase', 'max:255', 'unique:' . User::class],
            'role' => ['required', 'in:client,seller,producer'],
            'ubi' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'dni' => $validated['dni'],
                'password' => $validated['password'],
            ]);

            match ($validated['role']) {
                'client' => Client::create(['user_id' => $user->id, 'dni' => $user->dni]),
                'seller' => Seller::create(['user_id' => $user->id, 'dni' => $user->dni, 'iban' => '']), // IBAN vacío por ahora
                'producer' => Producer::create(['user_id' => $user->id, 'dni' => $user->dni, 'iban' => '']),
            };

            event(new Registered($user));
            Auth::login($user);
        });

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header title="Create an account" description="Enter your details below to create your account" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <div class="grid gap-2">
            <flux:input wire:model="name" id="name" label="{{ __('Name') }}" type="text" name="name" required
                autofocus autocomplete="name" placeholder="Full name" />
        </div>

        <!-- Email Address -->
        <div class="grid gap-2">
            <flux:input wire:model="email" id="email" label="{{ __('Email address') }}" type="email"
                name="email" required autocomplete="email" placeholder="email@example.com" />
        </div>

        <!-- DNI -->
        <div class="grid gap-2">
            <flux:input wire:model="dni" id="dni" label="{{ __('DNI') }}" type="text" name="dni"
                required autocomplete="dni" placeholder="DNI number" />
        </div>

        <!-- ROLE -->
        <div class="grid gap-2">
            <flux:radio.group wire:model="role" label="Tipo de cuenta" variant="cards" class="flex-col">
                <flux:radio value="client" label="Cliente" description="Quiero comprar productos frescos." />
                <flux:radio value="seller" label="Vendedor" description="Tengo una tienda y quiero vender stock." />
                <flux:radio value="producer" label="Productor" description="Produzco cosechas y busco vendedores." />
            </flux:radio.group>
            <flux:error name="role" />
        </div>

        <!-- UBI -->
        <div class="grid gap-2">
            <flux:input wire:model="ubi" id="ubi" label="{{ __('Location') }}" type="text" name="ubi"
                required autocomplete="ubi" placeholder="City, Country" />
        </div>


        <!-- Password -->
        <div class="grid gap-2">
            <flux:input wire:model="password" id="password" label="{{ __('Password') }}" type="password"
                name="password" required autocomplete="new-password" placeholder="Password" />
        </div>

        <!-- Confirm Password -->
        <div class="grid gap-2">
            <flux:input wire:model="password_confirmation" id="password_confirmation"
                label="{{ __('Confirm password') }}" type="password" name="password_confirmation" required
                autocomplete="new-password" placeholder="Confirm password" />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        Already have an account?
        <x-text-link href="{{ route('login') }}">Log in</x-text-link>
    </div>
</div>
