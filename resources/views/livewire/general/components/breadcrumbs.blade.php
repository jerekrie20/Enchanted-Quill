<nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm font-serif">
        @foreach($items as $index => $item)
            @if($loop->last)
                <li class="flex items-center">
                    <span class="text-text/60 dark:text-white/60">{{ $item['label'] }}</span>
                </li>
            @else
                <li class="flex items-center">
                    <a href="{{ $item['url'] }}"
                       @if(isset($item['wire:navigate']) && $item['wire:navigate'])
                           wire:navigate
                       @endif
                       class="text-primary dark:text-secondary hover:text-secondary dark:hover:text-primary transition-colors duration-300">
                        {{ $item['label'] }}
                    </a>
                    <svg class="w-4 h-4 mx-2 text-text/40 dark:text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
