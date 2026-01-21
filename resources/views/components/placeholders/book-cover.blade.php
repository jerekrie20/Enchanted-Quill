{{-- Book Cover Placeholder Component --}}
@props(['title' => 'Untitled', 'color' => 'primary'])

@php
    $colorClasses = [
        'primary' => 'from-primary/20 to-primary/40 border-primary/30',
        'secondary' => 'from-secondary/20 to-secondary/40 border-secondary/30',
        'accent' => 'from-accent/20 to-accent/40 border-accent/30',
    ];
    $selectedColor = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<div {{ $attributes->merge(['class' => "relative aspect-[2/3] bg-gradient-to-br {$selectedColor} border-2 rounded-sm overflow-hidden group"]) }}>
    {{-- Book spine decoration --}}
    <div class="absolute left-0 top-0 bottom-0 w-2 bg-black/10"></div>
    <div class="absolute left-2 top-0 bottom-0 w-px bg-white/20"></div>

    {{-- Content --}}
    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-center">
        {{-- Decorative top border --}}
        <div class="absolute top-4 left-4 right-4 h-px bg-text/10"></div>

        {{-- Book icon --}}
        <svg class="w-12 h-12 lg:w-16 lg:h-16 text-text/20 dark:text-text/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>

        {{-- Title --}}
        <p class="text-sm lg:text-base font-heading text-text/50 dark:text-text/60 line-clamp-3 px-2">
            {{ $title }}
        </p>

        {{-- Decorative bottom border --}}
        <div class="absolute bottom-4 left-4 right-4 h-px bg-text/10"></div>
    </div>

    {{-- Corner ornaments --}}
    <div class="absolute top-2 left-2 w-3 h-3 border-t border-l border-text/20"></div>
    <div class="absolute top-2 right-2 w-3 h-3 border-t border-r border-text/20"></div>
    <div class="absolute bottom-2 left-2 w-3 h-3 border-b border-l border-text/20"></div>
    <div class="absolute bottom-2 right-2 w-3 h-3 border-b border-r border-text/20"></div>
</div>
