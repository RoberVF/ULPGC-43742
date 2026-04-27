<?php

use Livewire\Volt\Component;
use App\Models\Harvest;
use Lunar\Models\Order;

new class extends Component {
    public string $activeTab = 'stats';

    public function togglePublished(int $harvestId): void
    {
        $harvest = Harvest::where('id', $harvestId)
            ->where('producer_id', auth()->user()->producer->id)
            ->firstOrFail();

        $harvest->update(['published' => !$harvest->published]);
    }

    public function with(): array
    {
        $producer = auth()->user()->producer;
        $harvests = Harvest::with('lunarVariant', 'productType')->where('producer_id', $producer->id)->latest()->get();

        $variantIds = $harvests->pluck('lunar_variant_id')->filter();

        $orders = Order::whereHas('lines', fn($q) => $q->whereIn('purchasable_id', $variantIds)->where('purchasable_type', 'Lunar\Models\ProductVariant'))->with('lines')->latest()->take(20)->get();

        $totalRevenue = $orders->where('status', 'paid')->sum(fn($o) => $o->lines->whereIn('purchasable_id', $variantIds->toArray())->sum(fn($l) => $l->sub_total->value / 100));

        $totalSold = $orders->where('status', 'paid')->sum(fn($o) => $o->lines->whereIn('purchasable_id', $variantIds->toArray())->sum('quantity'));

        return [
            'harvests' => $harvests,
            'orders' => $orders,
            'totalRevenue' => number_format($totalRevenue, 2),
            'totalSold' => $totalSold,
            'publishedCount' => $harvests->where('published', true)->count(),
        ];
    }
}; ?>

<div class="max-w-5xl mx-auto py-10 space-y-6">
    <flux:heading size="xl">Panel del Productor</flux:heading>

    {{-- Tabs --}}
    <div class="flex gap-2 border-b pb-2">
        <flux:button wire:click="$set('activeTab', 'stats')" variant="{{ $activeTab === 'stats' ? 'primary' : 'ghost' }}">
            📊 Estadísticas
        </flux:button>
        <flux:button wire:click="$set('activeTab', 'harvests')"
            variant="{{ $activeTab === 'harvests' ? 'primary' : 'ghost' }}">
            🌿 Mis Cosechas
        </flux:button>
        <flux:button wire:click="$set('activeTab', 'orders')"
            variant="{{ $activeTab === 'orders' ? 'primary' : 'ghost' }}">
            📦 Mis Ventas
        </flux:button>
    </div>

    {{-- Estadísticas --}}
    @if ($activeTab === 'stats')
        <div class="grid grid-cols-3 gap-4">
            <flux:card class="text-center space-y-1">
                <p class="text-sm text-gray-500">Ingresos totales</p>
                <p class="text-3xl font-bold text-green-500">{{ $totalRevenue }}€</p>
            </flux:card>
            <flux:card class="text-center space-y-1">
                <p class="text-sm text-gray-500">Unidades vendidas</p>
                <p class="text-3xl font-bold">{{ $totalSold }}</p>
            </flux:card>
            <flux:card class="text-center space-y-1">
                <p class="text-sm text-gray-500">Cosechas publicadas</p>
                <p class="text-3xl font-bold text-blue-500">{{ $publishedCount }}</p>
            </flux:card>
        </div>
    @endif

    {{-- Cosechas --}}
    @if ($activeTab === 'harvests')
        <flux:card>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b text-gray-500">
                        <th class="py-2">Producto</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($harvests as $harvest)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-3">{{ $harvest->productType->name ?? '—' }}</td>
                            <td>{{ $harvest->stock }} {{ $harvest->unit_measure }}</td>
                            <td>{{ $harvest->price }}€</td>
                            <td>
                                @if ($harvest->published)
                                    <span class="text-green-500 font-medium">✅ Publicada</span>
                                @else
                                    <span class="text-gray-400">⏸ Oculta</span>
                                @endif
                            </td>
                            <td>
                                <flux:button wire:click="togglePublished({{ $harvest->id }})" size="sm"
                                    variant="{{ $harvest->published ? 'danger' : 'primary' }}">
                                    {{ $harvest->published ? 'Despublicar' : 'Publicar' }}
                                </flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">
                                No tienes cosechas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </flux:card>
    @endif

    {{-- Ventas --}}
    @if ($activeTab === 'orders')
        <flux:card>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b text-gray-500">
                        <th class="py-2">Orden #</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-3">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span
                                    class="px-2 py-1 rounded text-xs font-medium
                                    {{ $order->status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $order->status === 'paid' ? 'Pagado' : 'Pendiente' }}
                                </span>
                            </td>
                            <td>{{ $order->total->formatted() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-400">
                                Aún no tienes ventas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </flux:card>
    @endif
</div>
