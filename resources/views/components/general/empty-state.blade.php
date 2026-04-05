@props([
    'icon' => 'fa-book-open',
    'title' => 'No content found',
    'message' => 'Check back later for new updates!',
    'actionText' => null,
    'actionUrl' => null,
    'actionWireClick' => null,
])

<div {{ $attributes->merge(['class' => 'text-center py-16 px-4 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm relative overflow-hidden']) }}>
    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

    <div class="relative z-10">
        <div class="w-20 h-20 bg-purple-500/10 dark:bg-purple-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid {{ $icon }} text-4xl text-purple-500/40"></i>
        </div>

        <h3 class="text-2xl font-heading text-text mb-2">{{ $title }}</h3>
        <p class="text-lg text-text/60 font-serif max-w-md mx-auto mb-8">
            {{ $message }}
        </p>

        @if($actionText && ($actionUrl || $actionWireClick))
            @if($actionUrl)
                <a href="{{ $actionUrl }}" wire:navigate class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border-2 border-purple-500/50">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    {{ $actionText }}
                </a>
            @else
                <button wire:click="{{ $actionWireClick }}" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border-2 border-purple-500/50">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    {{ $actionText }}
                </button>
            @endif
        @endif
    </div>
</div>
