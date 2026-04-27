<?php

use Livewire\Volt\Component;
use App\Models\Harvest;
use Lunar\Facades\CartSession;

new class extends Component {
    public array $quantities = [];

    public function mount(): void
    {
        $harvests = Harvest::where('published', true)->where('stock', '>', 0)->get();

        foreach ($harvests as $harvest) {
            $this->quantities[$harvest->id] = 1;
        }
    }

    public string $successMessage = '';

    public function addToCart(int $harvestId): void
    {
        $harvest = Harvest::where('id', $harvestId)->where('published', true)->where('stock', '>', 0)->firstOrFail();

        $qty = (int) ($this->quantities[$harvestId] ?? 1);

        if ($qty < 1 || $qty > $harvest->stock) {
            return;
        }

        CartSession::add($harvest->lunarVariant, $qty);

        $this->successMessage = "✅ {$harvest->productType->name} añadido al carrito.";
    }

    public function with(): array
    {
        return [
            'harvests' => Harvest::with(['productType', 'producer.user'])
                ->where('published', true)
                ->where('stock', '>', 0)
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div class="max-w-5xl mx-auto py-10 space-y-6">
    <flux:heading size="xl">Mercado de Productores</flux:heading>
    @if ($successMessage)
        <div
            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg flex justify-between items-center">
            <span>{{ $successMessage }}</span>
            <flux:button href="{{ route('checkout') }}" variant="primary" size="sm">
                Ir al Checkout →
            </flux:button>
        </div>
    @endif
    <p class="text-gray-500 text-sm">Compra cosechas directamente de productores locales para tu inventario.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($harvests as $harvest)
            <flux:card class="space-y-3">
                <div>
                    <p class="font-semibold text-lg">
                        {{ $harvest->productType->name ?? '—' }}
                    </p>
                    <p class="text-sm text-gray-500">
                        Productor: {{ $harvest->producer->user->name ?? '—' }}
                    </p>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-green-500">
                        {{ $harvest->price }}€
                        <span class="text-sm font-normal text-gray-400">/ {{ $harvest->unit_measure }}</span>
                    </span>
                    <span class="text-sm text-gray-400">
                        Stock: {{ $harvest->stock }}
                    </span>
                </div>

                <div class="flex gap-2 items-center">
                    <flux:input type="number" min="1" max="{{ $harvest->stock }}"
                        wire:model="quantities.{{ $harvest->id }}" class="w-20" />
                    <flux:button wire:click="addToCart({{ $harvest->id }})" variant="primary" class="flex-1">
                        Comprar
                    </flux:button>
                </div>
            </flux:card>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-20">
                No hay cosechas disponibles en este momento.
            </div>
        @endforelse
    </div>
</div>
