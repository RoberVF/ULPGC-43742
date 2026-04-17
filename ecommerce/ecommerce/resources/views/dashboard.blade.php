<x-layouts.app>
    <div class="p-6">
        @if(auth()->user()->producer)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-8">
                    <livewire:producers.manage-product-types />
                    <livewire:producers.add-harvest-form />
                </div>
                <div class="lg:col-span-2">
                    <livewire:producers.my-harvests-list />
                </div>
            </div>
        @else
            <div class="flex gap-8">
                <div class="flex-1">
                    <flux:heading size="xl" class="mb-6">Mercado de Productos</flux:heading>
                    <livewire:marketplace />
                </div>
                
                <aside class="w-80 bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg h-fit sticky top-6">
                    <livewire:cart-drawer />
                </aside>
            </div>
        @endif
    </div>
</x-layouts.app>