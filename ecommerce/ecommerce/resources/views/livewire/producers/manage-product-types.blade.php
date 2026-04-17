<?php

use App\Models\ProductType;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $type = '';

    public function saveType()
    {
        $this->validate([
            'name' => 'required|string|max:50|unique:product_types,name',
            'type' => 'nullable|string|max:50',
        ]);

        ProductType::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        $this->reset(['name', 'type']);

        // Notificamos al formulario de cosechas para que actualice su lista
        $this->dispatch('product-type-created');
        $this->js("Flux.toast('Nuevo tipo de producto añadido')");
    }

    public function with()
    {
        return [
            'existingTypes' => ProductType::all(),
        ];
    }
}; ?>

<flux:card class="space-y-6 mb-4">
    <form wire:submit="saveType" class="space-y-4">
        <flux:heading size="lg">Creaciónde Productos</flux:heading>
        <flux:subheading class="mb-4">Define las categorías de tus productos (ej: Tomate/Hortaliza, Lentaja/Legumbre,
            etc.) para posteriormente atribuirle una cosecha.</flux:subheading>

        <flux:input wire:model="name" label="Nombre" class="mb-4" placeholder="Ej: Lechuga Batavia" />
        <flux:input wire:model="type" label="Categoría (Opcional)" placeholder="Ej: Verdura" />

        <flux:button type="submit" variant="filled" class="w-full mt-4">Guardar Tipo</flux:button>
    </form>

    <flux:separator />

    <div class="space-y-2">
        <p class="text-sm font-medium">Tipos registrados:</p>
        <div class="flex flex-wrap gap-2">
            @foreach ($existingTypes as $t)
                <flux:badge size="sm" inset="top">{{ $t->name }} ({{ $t->type ?? 'Sin categoría' }})
                </flux:badge>
            @endforeach
        </div>
    </div>
</flux:card>
