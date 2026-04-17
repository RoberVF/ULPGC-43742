<x-layouts.app>
    <div class="p-6 space-y-8">
        @if (auth()->user()->producer)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 space-y-8 mb-4">
                    <livewire:producers.manage-product-types /> <livewire:producers.add-harvest-form />
                </div>
                <div class="mt-4 lg:col-span-2">
                    <livewire:producers.my-harvests-list />
                </div>
            </div>
        @else
            <flux:heading>Bienvenido, {{ auth()->user()->name }}</flux:heading>
            <flux:subheading>Pronto podrás ver el marketplace aquí.</flux:subheading>
        @endif
    </div>
</x-layouts.app>
