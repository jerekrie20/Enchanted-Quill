{{-- Scroll Card Component - Parchment style card --}}
@props(['title' => '', 'icon' => null])

<article {{ $attributes->merge(['class' => 'group relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-primary/30 dark:border-primary/20 hover:border-primary dark:hover:border-secondary hover:shadow-xl dark:hover:shadow-primary/10 transition-all duration-500 p-6 rounded-sm overflow-hidden']) }}>
    {{-- Decorative corners --}}
    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

    {{-- Optional Icon/Header --}}
    @if($title || $icon)
        <header class="flex items-center gap-3 mb-4 pb-4 border-b border-text/10">
            @if($icon)
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    {{ $icon }}
                </div>
            @endif

            @if($title)
                <h3 class="font-heading text-lg text-text">{{ $title }}</h3>
            @endif
        </header>
    @endif

    {{-- Card Content --}}
    <div class="relative z-10 text-text/80 dark:text-text/90 font-serif">
        {{ $slot }}
    </div>

    {{-- Decorative flourish bottom --}}
    <div class="flex items-center gap-2 mt-4 pt-4 border-t border-text/5">
        <div class="h-px flex-1 bg-text/10"></div>
        <div class="w-1.5 h-1.5 rotate-45 bg-primary/30"></div>
        <div class="h-px flex-1 bg-text/10"></div>
    </div>
</article>
