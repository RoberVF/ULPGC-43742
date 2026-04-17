<?php

use App\Models\Harvest;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    #[On('harvest-added')]
    public function getHarvests()
    {
        return auth()->user()->producer->harvests()->with('productType')->latest()->get();
    }

    public function with()
    {
        return [
            'harvests' => $this->getHarvests(),
        ];
    }
}; ?>

<div class="space-y-4">
    <flux:heading size="lg">Mi Historial de Cosechas</flux:heading>
    
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Producto</flux:table.column>
            <flux:table.column>Fecha</flux:table.column>
            <flux:table.column>Stock Actual</flux:table.column>
            <flux:table.column>Precio</flux:table.column>
            <flux:table.column>Sensores</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach($harvests as $harvest)
                <flux:table.row>
                    <flux:table.cell font="medium">{{ $harvest->productType->name }}</flux:table.cell>
                    <flux:table.cell>{{ $harvest->collect_date }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="{{ $harvest->stock > 0 ? 'green' : 'red' }}">
                            {{ $harvest->stock }} / {{ $harvest->quantity }} {{ $harvest->unit_measure }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>{{ $harvest->price }}€</flux:table.cell>
                    <flux:table.cell>
                        @if($harvest->temperature)
                            <span class="text-xs text-zinc-500">{{ $harvest->temperature }}°C | {{ $harvest->humidity }}%</span>
                        @else
                            <span class="text-xs text-zinc-400">Sin datos</span>
                        @endif
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>