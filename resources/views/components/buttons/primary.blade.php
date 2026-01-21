@props(['href' => '#', 'text' => 'Button'])

<div class="m-auto text-center p-2">
    <a href="{{$href}}">
        <button class="relative px-8 py-2.5 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border-2 border-primary/50 dark:border-secondary/50 hover:border-primary dark:hover:border-secondary transition-all duration-300 group overflow-hidden">
            {{-- Corner ornaments --}}
            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
            <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
            <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>

            <span class="relative z-10">{{$text}}</span>

            {{-- Hover effect --}}
            <span class="absolute inset-0 bg-white/10 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
        </button>
    </a>
</div>
