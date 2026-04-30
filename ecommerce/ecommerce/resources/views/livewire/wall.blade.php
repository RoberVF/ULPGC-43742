<?php

use Livewire\Volt\Component;
use App\Models\WallPost;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('required|string|max:1000')]
    public string $message = '';

    public function post(): void
    {
        $this->validate();

        WallPost::create([
            'user_id' => auth()->id(),
            'message' => $this->message,
        ]);

        $this->reset('message');
    }

    public function delete(int $postId): void
    {
        WallPost::where('id', $postId)
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function with(): array
    {
        return [
            'posts' => WallPost::with('user')
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div class="max-w-2xl mx-auto py-10 space-y-6">
    <flux:heading size="xl">Muro de la Comunidad</flux:heading>

    {{-- Formulario --}}
    <flux:card class="space-y-3">
        <flux:textarea
            wire:model="message"
            placeholder="Escribe un mensaje para la comunidad..."
            rows="3"
        />
        @error('message')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
        <flux:button wire:click="post" variant="primary">
            Publicar
        </flux:button>
    </flux:card>

    {{-- Posts --}}
    <div class="space-y-4">
        @forelse($posts as $post)
            <flux:card class="space-y-2 mb-2">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-sm">{{ $post->user->name }}</p>
                        <p class="text-xs text-gray-400">
                            {{ $post->created_at->diffForHumans() }}
                        </p>
                    </div>
                    @if($post->user_id === auth()->id())
                        <flux:button
                            wire:click="delete({{ $post->id }})"
                            size="sm"
                            variant="danger">
                            🗑
                        </flux:button>
                    @endif
                </div>
                <p class="text-sm">{{ $post->message }}</p>
            </flux:card>
        @empty
            <p class="text-center text-gray-400 py-10">
                Aún no hay mensajes. ¡Sé el primero en escribir!
            </p>
        @endforelse
    </div>
</div>