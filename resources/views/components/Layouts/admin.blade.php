<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                return;
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

        {{-- Mobile menu button --}}
        <button id="mobileMenuToggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-white rounded-lg md:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>

        {{-- Navigation Actions --}}
        <div class="hidden md:flex items-center space-x-6 rtl:space-x-reverse">
            <a href="{{route('admin.settings')}}"
               class="relative font-serif text-sm transition-colors duration-300 {{request()->routeIs('admin.settings') ? 'text-secondary' : 'text-white/80 hover:text-secondary'}}">
                <span>Settings</span>
                @if(request()->routeIs('admin.settings'))
                    <span class="absolute -bottom-1 left-0 right-0 h-px bg-secondary"></span>
                @endif
            </a>

            <a href="{{ route('portal') }}" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Portal</a>

            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">
                    Logout
                </button>
            </form>

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
        <div class="hidden md:flex items-center justify-center">
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
                <li class="relative">
                    <a href="{{route('admin.comments')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.comments') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <span>Comments</span>
                        @if(request()->routeIs('admin.comments'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.reviews')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.reviews') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        <span>Reviews</span>
                        @if(request()->routeIs('admin.reviews'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.categories')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.categories') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span>Categories</span>
                        @if(request()->routeIs('admin.categories'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.contact-messages')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.contact-messages') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Messages</span>
                        @if(request()->routeIs('admin.contact-messages'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
                <li class="relative">
                    <a href="{{route('admin.bosses')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('admin.bosses') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}">
                        <i class="fa-solid fa-dragon w-4 h-4" aria-hidden="true"></i>
                        <span>Bosses</span>
                        @if(request()->routeIs('admin.bosses'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary"></span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        {{-- Mobile Menu (Hidden by default) --}}
        <div id="mobile-menu" class="hidden md:hidden">
            <ul class="flex flex-col font-serif space-y-4 mt-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin.users')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Readers</a>
                </li>
                <li>
                    <a href="{{route('admin.books')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Volumes</a>
                </li>
                <li>
                    <a href="{{route('blogs')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Chronicles</a>
                </li>
                <li>
                    <a href="{{route('admin.comments')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Comments</a>
                </li>
                <li>
                    <a href="{{route('admin.reviews')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Reviews</a>
                </li>
                <li>
                    <a href="{{route('admin.categories')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Categories</a>
                </li>
                <li>
                    <a href="{{route('admin.contact-messages')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Messages</a>
                </li>
                <li>
                    <a href="{{route('admin.bosses')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Bosses</a>
                </li>
                <li class="border-t border-white/20 pt-4">
                    <a href="{{route('admin.settings')}}" wire:navigate class="block py-2 text-white/90 hover:text-secondary transition-colors">Settings</a>
                </li>
                <li>
                    <a href="{{ route('portal') }}" class="block py-2 text-white/90 hover:text-secondary transition-colors">Portal</a>
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="block py-2 text-white/90 hover:text-secondary transition-colors w-full text-left">Logout</button>
                    </form>
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

</body>
</html>

