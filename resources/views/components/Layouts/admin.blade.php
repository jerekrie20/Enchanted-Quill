<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
    @livewireStyles

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Page Title' }}</title>
    <script src="https://kit.fontawesome.com/9a1bef43f6.js" crossorigin="anonymous"></script>

</head>
<body class="min-h-screen flex flex-col">


{{-- Enchanted Quill Primary Navigation --}}
<nav class="bg-navbg relative">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-0.5 bg-primary/30"></div>

    <div class="flex flex-wrap justify-between items-center mx-auto max-w-(--breakpoint-xl) p-4">
        {{-- Logo with ornate frame --}}
        <a href="{{ route('login') }}" class="flex items-center space-x-3 rtl:space-x-reverse group">
            <div class="relative">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-md group-hover:blur-lg transition-all duration-300"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="Enchanted Quill Logo" class="h-12 relative z-10 group-hover:scale-105 transition-transform duration-300">
            </div>
            <span class="text-lg font-heading text-white hidden md:block">Enchanted Quill</span>
        </a>

        {{-- Navigation Actions --}}
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="{{route('admin.settings')}}"
               class="relative font-serif text-sm transition-colors duration-300 {{request()->routeIs('admin.settings') ? 'text-secondary' : 'text-white/80 hover:text-secondary'}}">
                <span>Settings</span>
                @if(request()->routeIs('admin.settings'))
                    <span class="absolute -bottom-1 left-0 right-0 h-px bg-secondary"></span>
                @endif
            </a>

            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">My Space</a>

            <a href="#" class="relative group">
                <x-icons.bell/>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
            </a>

            <button id="themeToggle" class="flex items-center p-2 rounded-full hover:bg-white/10 transition-colors duration-300">
                <x-icons.moon />
                <x-icons.sun />
            </button>
        </div>
    </div>

    {{-- Decorative bottom border --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-primary/20"></div>
</nav>

{{-- Enchanted Quill Secondary Navigation --}}
<nav class="bg-secondarynavbg relative border-b-2 border-primary/20">
    <div class="max-w-(--breakpoint-xl) px-4 py-4 mx-auto">
        <div class="flex items-center justify-center">
            <ul class="flex flex-row font-serif mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li class="relative">
                    <a href="{{ route('admin.dashboard') }}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.dashboard') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       aria-current="page">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.users')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.users') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Readers</span>
                        @if(request()->routeIs('admin.users'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.books')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.books') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Volumes</span>
                        @if(request()->routeIs('admin.books'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('blogs')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('blogs') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Chronicles</span>
                        @if(request()->routeIs('blogs'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


{{$slot}}




{{-- Enchanted Quill Footer --}}
<footer class="bg-navbg mt-auto relative border-t-2 border-primary/20">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30"></div>

    <div class="max-w-(--breakpoint-xl) mx-auto px-4 py-8">
        {{-- Decorative flourish --}}
        <div class="flex items-center justify-center gap-4 mb-6">
            <div class="h-px w-16 bg-primary/30"></div>
            <svg class="w-6 h-6 text-primary/50" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
            </svg>
            <div class="h-px w-16 bg-primary/30"></div>
        </div>

        {{-- Footer Links --}}
        <div class="flex flex-wrap justify-center items-center gap-6 mb-6">
            <a href="/" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Home</a>
            <span class="text-primary/30">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Help & Support</a>
            <span class="text-primary/30">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Policies</a>
            <span class="text-primary/30">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Terms</a>
        </div>

        {{-- Copyright --}}
        <div class="flex items-center justify-center">
            <p class="text-white/70 text-sm font-serif">
                <i class="fa-regular fa-copyright"></i> {{date("Y")}} Enchanted Quill
                <span class="text-primary/50 mx-2">|</span>
                <span class="italic text-xs">Where Words Weave Magic</span>
            </p>
        </div>
    </div>
</footer>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('themeToggle');
        const sunIcon = document.querySelector('#themeToggle .sun-icon');
        const moonIcon = document.querySelector('#themeToggle .moon-icon');

        // Check and initialize theme
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);

        // Set the initial icon visibility based on the current theme
        if (currentTheme === 'light') {
            moonIcon.classList.remove('hidden');
            sunIcon.classList.add('hidden');
        } else {
            moonIcon.classList.add('hidden');
            sunIcon.classList.remove('hidden');
        }

        // Add event listener to toggle theme
        toggleButton.addEventListener('click', () => {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            // Update theme on <html> element and save to localStorage
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Toggle the visibility of the icons
            if (newTheme === 'light') {
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
            } else {
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
            }
        });
    });

</script>

@vite('resources/js/ckeditor5.js')
</body>
</html>

