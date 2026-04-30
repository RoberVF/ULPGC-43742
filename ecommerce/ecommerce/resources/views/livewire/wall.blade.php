<?php

use Livewire\Volt\Component;
use App\Models\WallPost;
use App\Models\WallPostLike;
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
            'pinned'  => false,
        ]);

        $this->reset('message');
    }

    public function delete(int $postId): void
    {
        WallPost::where('id', $postId)
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function toggleLike(int $postId): void
    {
        $existing = WallPostLike::where('user_id', auth()->id())
            ->where('wall_post_id', $postId)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            WallPostLike::create([
                'user_id'      => auth()->id(),
                'wall_post_id' => $postId,
            ]);
        }
    }

    public function togglePin(int $postId): void
    {
        $post = WallPost::where('id', $postId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $post->update(['pinned' => !$post->pinned]);
    }

    public function getRoleBadge($user): string
    {
        if ($user->isProducer()) return '🌱 Productor';
        if ($user->isSeller())   return '🏪 Vendedor';
        return '';
    }

    public function with(): array
    {
        $posts = WallPost::with(['user', 'likes'])
            ->orderByDesc('pinned')
            ->latest()
            ->get();

        return [
            'posts'  => $posts,
            'userId' => auth()->id(),
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
            <flux:card class="space-y-3 mb-2 {{ $post->pinned ? 'border-yellow-400 dark:border-yellow-500 border-2' : '' }}">

                {{-- Cabecera --}}
                <div class="flex justify-between items-start">
                    <div class="space-y-0.5">
                        <div class="flex items-center gap-2">
                            {{-- Nombre --}}
                            <p class="font-semibold text-sm">{{ $post->user->name }}</p>

                            {{-- Badge de rol --}}
                            <span class="text-xs px-2 py-0.5 rounded-full
                                {{ $post->user->isProducer()
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                    : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' }}">
                                {{ $this->getRoleBadge($post->user) }}
                            </span>

                            {{-- Badge fijado --}}
                            @if($post->pinned)
                                <span class="text-xs text-yellow-500 font-medium">📌 Fijado</span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                    </div>

                    {{-- Acciones del autor --}}
                    @if($post->user_id === $userId)
                        <div class="flex gap-2">
                            <flux:button
                                wire:click="togglePin({{ $post->id }})"
                                size="sm"
                                variant="{{ $post->pinned ? 'primary' : 'ghost' }}"
                                title="{{ $post->pinned ? 'Desfijar' : 'Fijar mensaje' }}">
                                📌
                            </flux:button>
                            <flux:button
                                wire:click="delete({{ $post->id }})"
                                size="sm"
                                variant="danger">
                                🗑
                            </flux:button>
                        </div>
                    @endif
                </div>

                {{-- Mensaje --}}
                <p class="text-sm leading-relaxed">{{ $post->message }}</p>

                {{-- Footer: likes --}}
                <div class="flex items-center gap-3 pt-1 border-t border-gray-100 dark:border-white/10">
                    <button
                        wire:click="toggleLike({{ $post->id }})"
                        class="flex items-center gap-1.5 text-sm transition-colors
                            {{ $post->isLikedBy($userId)
                                ? 'text-red-500'
                                : 'text-gray-400 hover:text-red-400' }}">
                        {{ $post->isLikedBy($userId) ? '❤️' : '🤍' }}
                        <span>{{ $post->likes->count() }}</span>
                    </button>
                </div>

            </flux:card>
        @empty
            <p class="text-center text-gray-400 py-10">
                Aún no hay mensajes. ¡Sé el primero en escribir!
            </p>
        @endforelse
    </div>
</div>