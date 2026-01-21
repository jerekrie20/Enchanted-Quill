{{-- Bookshelf Component for Enchanted Quill --}}
@props(['title' => 'Library Collection'])

<section {{ $attributes->merge(['class' => 'relative']) }}>
    {{-- Shelf Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <div class="h-px flex-1 bg-primary/20"></div>
            <h2 class="text-2xl lg:text-3xl font-heading text-text">{{ $title }}</h2>
            <div class="h-px flex-1 bg-primary/20"></div>
        </div>
        <div class="flex items-center justify-center gap-2">
            <div class="h-px w-12 bg-secondary/30"></div>
            <svg class="w-4 h-4 text-secondary/50" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
            </svg>
            <div class="h-px w-12 bg-secondary/30"></div>
        </div>
    </div>

    {{-- Bookshelf Container with wooden shelf effect --}}
    <div class="relative">
        {{-- Books Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 lg:gap-6 pb-6">
            {{ $slot }}
        </div>

        {{-- Decorative shelf bottom --}}
        <div class="absolute bottom-0 left-0 right-0 h-3 bg-gradient-to-b from-accent/20 to-accent/40 dark:from-accent/10 dark:to-accent/30 border-t-2 border-primary/20"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-secondary/30"></div>
    </div>
</section>
