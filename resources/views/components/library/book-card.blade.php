{{-- Book Card Component for Enchanted Quill --}}
@props(['title' => 'Untitled Tome', 'author' => 'Anonymous Scribe', 'cover' => null, 'description' => '', 'href' => '#'])

<article {{ $attributes->merge(['class' => 'group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-text/10 hover:border-primary dark:hover:border-primary/60 hover:shadow-2xl dark:hover:shadow-primary/20 transition-all duration-500 overflow-hidden']) }}>
    {{-- Corner ornaments --}}
    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-primary/50"></div>
    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-primary/50"></div>
    <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-primary/50"></div>
    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-primary/50"></div>

    <a href="{{ $href }}" class="block p-6 space-y-4">
        {{-- Book Cover --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 to-secondary/10 dark:from-primary/5 dark:to-secondary/5 aspect-[2/3] rounded-sm border border-text/20">
            @if($cover)
                <img src="{{ $cover }}" alt="{{ $title }} cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center">
                    <svg class="w-16 h-16 text-primary/30 dark:text-primary/40 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-xs font-heading text-text/50">{{ Str::limit($title, 30) }}</p>
                </div>
            @endif

            {{-- Decorative spine --}}
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary/20"></div>
        </div>

        {{-- Book Details --}}
        <div class="space-y-2">
            <h3 class="font-heading text-lg text-text line-clamp-2 group-hover:text-primary dark:group-hover:text-secondary transition-colors duration-300">
                {{ $title }}
            </h3>

            <p class="text-sm font-serif italic text-text/60 dark:text-text/70">
                by {{ $author }}
            </p>

            @if($description)
                <p class="text-sm text-text/70 dark:text-text/80 line-clamp-3 font-serif">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Decorative flourish bottom --}}
        <div class="flex items-center gap-2 pt-2">
            <div class="h-px flex-1 bg-text/10"></div>
            <svg class="w-3 h-3 text-secondary/50" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
            </svg>
            <div class="h-px flex-1 bg-text/10"></div>
        </div>
    </a>
</article>
