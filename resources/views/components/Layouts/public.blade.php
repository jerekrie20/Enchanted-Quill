<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <script>
        // Define the theme logic globally
        function applyTheme() {
            const theme = localStorage.getItem('theme') || 'light';
            const html = document.documentElement;

            // Apply theme to HTML tag
            html.className = theme;
            html.setAttribute('data-theme', theme);

            // Update icons if they exist in the new DOM
            const sunIcon = document.querySelector('#themeToggle .sun-icon');
            const moonIcon = document.querySelector('#themeToggle .moon-icon');

            if (sunIcon && moonIcon) {
                if (theme === 'light') {
                    moonIcon.style.display = 'inline-block';
                    sunIcon.style.display = 'none';
                } else {
                    moonIcon.style.display = 'none';
                    sunIcon.style.display = 'inline-block';
                }
            }
        }

        // 1. Apply immediately on first load to prevent flash
        applyTheme();

        // 2. Re-apply after Livewire navigates
        // (Because Livewire morphs the DOM and might overwrite the <html> tag with the server's default state)
        document.addEventListener('livewire:navigated', () => {
            applyTheme();
            console.log('Theme re-applied after Livewire navigation');

            // Close mobile menu on navigation
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
            const mobileMenuBtn = document.getElementById('mobileMenuToggle');
            if (mobileMenuBtn) {
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
            }
        });

        // 3. Handle toggling using Event Delegation
        // Attaching the listener to 'document' ensures it works even after Livewire replaces the navbar button
        document.addEventListener('click', function(e) {
            const toggleButton = e.target.closest('#themeToggle');
            if (toggleButton) {
                const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';

                localStorage.setItem('theme', newTheme);
                applyTheme();
                return;
            }

            const mobileMenuBtn = e.target.closest('#mobileMenuToggle');
            if (mobileMenuBtn) {
                const mobileMenu = document.getElementById('mobile-menu');
                if (mobileMenu) {
                    mobileMenu.classList.toggle('hidden');
                    mobileMenuBtn.setAttribute('aria-expanded', !mobileMenu.classList.contains('hidden'));
                }

            }
        });

        console.log('Global theme script initialized');
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
    @livewireStyles

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Enchanted Quill - Where Words Weave Magic' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/9a1bef43f6.js" crossorigin="anonymous"></script>

</head>
<body class="min-h-screen flex flex-col">

{{-- Skip to main content link for keyboard navigation --}}
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-secondary focus:text-white focus:px-4 focus:py-2 focus:rounded">
    Skip to main content
</a>

{{-- Enchanted Quill Primary Navigation --}}
<nav class="bg-navbg relative" role="navigation" aria-label="Primary navigation">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-0.5 bg-primary/30" aria-hidden="true"></div>

    <div class="flex flex-wrap justify-between items-center mx-auto max-w-(--breakpoint-xl) p-4">
        {{-- Logo with ornate frame --}}
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse group" aria-label="Enchanted Quill Home">
            <div class="relative">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-md group-hover:blur-lg transition-all duration-300" aria-hidden="true"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="" class="h-12 relative z-10 group-hover:scale-105 transition-transform duration-300" aria-hidden="true">
            </div>
            <span class="text-lg font-heading text-white hidden md:block">Enchanted Quill</span>
        </a>

        {{-- Mobile menu button --}}
        <button id="mobileMenuToggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-white rounded-lg md:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        {{-- Navigation Actions (Desktop) --}}
        <div class="hidden md:flex items-center space-x-6 rtl:space-x-reverse" role="menubar" aria-label="User actions">
            @auth
                <a href="{{ route('portal') }}"
                   class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300"
                   role="menuitem">
                    My Portal
                </a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300"
                       role="menuitem">
                        Admin Panel
                    </a>
                @endif

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300" role="menuitem">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300"
                   role="menuitem">
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                   class="bg-secondary/80 hover:bg-secondary text-white font-serif text-sm px-4 py-2 rounded transition-colors duration-300"
                   role="menuitem">
                    Register
                </a>
            @endauth

            <button id="themeToggle"
                    class="flex items-center p-2 rounded-full hover:bg-white/10 transition-colors duration-300"
                    aria-label="Toggle dark mode"
                    role="menuitem">
                <x-icons.moon />
                <x-icons.sun />
            </button>
        </div>
    </div>

    {{-- Decorative bottom border --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-primary/20" aria-hidden="true"></div>
</nav>

{{-- Enchanted Quill Secondary Navigation --}}
<nav class="bg-secondarynavbg relative border-b-2 border-primary/20" role="navigation" aria-label="Main navigation">
    <div class="max-w-(--breakpoint-xl) px-4 py-4 mx-auto">
        {{-- Desktop Menu --}}
        <div class="hidden md:flex items-center justify-center">
            <ul class="flex flex-row font-serif mt-0 space-x-8 rtl:space-x-reverse text-sm" role="menubar">
                <li class="relative" role="none">
                    <a href="{{ route('home') }}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('home') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('home') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home</span>
                        @if(request()->routeIs('home'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('books')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('books') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('books') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Books</span>
                        @if(request()->routeIs('books'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('blog')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('blog') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('blog') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Blog</span>
                        @if(request()->routeIs('blog'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('public.about')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('public.about') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('public.about') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>About</span>
                        @if(request()->routeIs('public.about'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('public.contact')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('public.contact') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('public.contact') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Contact</span>
                        @if(request()->routeIs('public.contact'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('public.faq')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('public.faq') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('public.faq') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>FAQ</span>
                        @if(request()->routeIs('public.faq'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('public.policies')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('public.policies') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('public.policies') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Policies</span>
                        @if(request()->routeIs('public.policies'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        {{-- Mobile Menu (Hidden by default) --}}
        <div id="mobile-menu" class="hidden md:hidden">
            <ul class="flex flex-col font-serif space-y-4 mt-4" role="menubar">
                <li role="none">
                    <a href="{{ route('home') }}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Home</a>
                </li>
                <li role="none">
                    <a href="{{route('books')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Books</a>
                </li>
                <li role="none">
                    <a href="{{route('blog')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Blog</a>
                </li>
                <li role="none">
                    <a href="{{route('public.about')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">About</a>
                </li>
                <li role="none">
                    <a href="{{route('public.contact')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Contact</a>
                </li>
                <li role="none">
                    <a href="{{route('public.faq')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">FAQ</a>
                </li>
                <li role="none">
                    <a href="{{route('public.policies')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Policies</a>
                </li>

                @auth
                    <li role="none" class="border-t border-white/20 pt-4">
                        <a href="{{ route('portal') }}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">My Portal</a>
                    </li>
                    @if(auth()->user()->role === 'admin')
                        <li role="none">
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Admin Panel</a>
                        </li>
                    @endif
                    <li role="none">
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="block py-2 text-white/90 hover:text-secondary transition-colors w-full text-left" role="menuitem">Logout</button>
                        </form>
                    </li>
                @else
                    <li role="none" class="border-t border-white/20 pt-4">
                        <a href="{{ route('login') }}" class="block py-2 text-white/90 hover:text-secondary transition-colors" role="menuitem">Sign In</a>
                    </li>
                    <li role="none">
                        <a href="{{ route('register') }}" class="block py-2 bg-secondary/80 hover:bg-secondary text-white px-4 rounded transition-colors" role="menuitem">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main id="main-content" role="main">
    {{$slot}}
</main>

{{-- Enchanted Quill Footer --}}
<footer class="bg-navbg mt-auto relative border-t-2 border-primary/20" role="contentinfo" aria-label="Site footer">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30" aria-hidden="true"></div>

    <div class="max-w-(--breakpoint-xl) mx-auto px-4 py-8">
        {{-- Decorative flourish --}}
        <div class="flex items-center justify-center gap-4 mb-6" aria-hidden="true">
            <div class="h-px w-16 bg-primary/30"></div>
            <svg class="w-6 h-6 text-primary/50" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
            </svg>
            <div class="h-px w-16 bg-primary/30"></div>
        </div>

        {{-- Footer Links --}}
        <nav class="flex flex-wrap justify-center items-center gap-6 mb-6" aria-label="Footer navigation">
            <a href="{{ route('home') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Home</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="{{ route('public.about') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">About</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="{{ route('public.contact') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Contact</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="{{ route('public.faq') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">FAQ</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="{{ route('public.policies') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Policies</a>
        </nav>

        {{-- Copyright --}}
        <div class="flex items-center justify-center">
            <p class="text-white/70 text-sm font-serif">
                <i class="fa-regular fa-copyright" aria-hidden="true"></i>
                <span>{{date("Y")}} Enchanted Quill</span>
                <span class="text-primary/50 mx-2" aria-hidden="true">|</span>
                <span class="italic text-xs">Where Words Weave Magic</span>
            </p>
        </div>
    </div>
</footer>


</body>
</html>
