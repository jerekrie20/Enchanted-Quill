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
        });

        // 3. Handle toggling using Event Delegation
        // Attaching the listener to 'document' ensures it works even after Livewire replaces the navbar button
        document.addEventListener('click', function(e) {
            const toggleButton = e.target.closest('#themeToggle');
            if (!toggleButton) return;

            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            localStorage.setItem('theme', newTheme);
            applyTheme();
        });

        console.log('Global theme script initialized');
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireScripts
    @livewireStyles

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Enchanted Quill' }}</title>
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
        <a href="{{ route('portal') }}" class="flex items-center space-x-3 rtl:space-x-reverse group" aria-label="Enchanted Quill Home">
            <div class="relative">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-md group-hover:blur-lg transition-all duration-300" aria-hidden="true"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="" class="h-12 relative z-10 group-hover:scale-105 transition-transform duration-300" aria-hidden="true">
            </div>
            <span class="text-lg font-heading text-white hidden md:block">Enchanted Quill</span>
        </a>

        {{-- Navigation Actions --}}
        <div class="flex items-center space-x-6 rtl:space-x-reverse" role="menubar" aria-label="User actions">
            @auth

                <div role="menubar" aria-label="User actions">
                        <form action="/logout" method="POST" >
                            @csrf
                            {{-- Styled to look like a normal text link --}}
                            <button type="submit" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300" role="menuitem">
                                Logout
                            </button>
                        </form>
                </div>

                <a href="{{route('portal.settings')}}"
                   class="relative font-serif text-sm transition-colors duration-300 {{request()->routeIs('portal.settings') ? 'text-secondary' : 'text-white/80 hover:text-secondary'}}"
                   role="menuitem"
                   aria-current="{{request()->routeIs('portal.settings') ? 'page' : 'false'}}">
                    <span>Settings</span>
                    @if(request()->routeIs('portal.settings'))
                        <span class="absolute -bottom-1 left-0 right-0 h-px bg-secondary" aria-hidden="true"></span>
                    @endif
                </a>

                <a href="{{ route('portal.profile', auth()->user()->id) }}"
                   class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300"
                   role="menuitem">
                    My Profile
                </a>

                <a href="#"
                   class="relative group"
                   role="menuitem"
                   aria-label="Notifications">
                    <x-icons.bell/>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-secondary rounded-full animate-pulse" aria-hidden="true"></span>
                </a>
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
        <div class="flex items-center justify-center">
            <ul class="flex flex-row font-serif mt-0 space-x-8 rtl:space-x-reverse text-sm" role="menubar">
                <li class="relative" role="none">
                    <a href="{{ route('portal') }}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('portal') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('portal') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Home</span>
                        @if(request()->routeIs('portal'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('portal.library')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('portal.library') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('portal.library') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Library</span>
                        @if(request()->routeIs('portal.library'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                <li class="relative" role="none">
                    <a href="{{route('portal.chronicles')}}"
                       wire:navigate.hover
                       class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('portal.chronicles') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                       role="menuitem"
                       aria-current="{{request()->routeIs('portal.chronicles') ? 'page' : 'false'}}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Chronicles</span>
                        @if(request()->routeIs('portal.chronicles'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                        @endif
                    </a>
                </li>
                @auth
                    @if(auth()->user()->role === 'author' || auth()->user()->role === 'admin')
                        <li class="relative" role="none">
                            <a href="{{route('portal.author.dashboard')}}"
                               wire:navigate.hover
                               class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 {{request()->routeIs('portal.author.dashboard') ? 'text-secondary' : 'text-white/90 hover:text-secondary'}}"
                               role="menuitem"
                               aria-current="{{request()->routeIs('portal.author.dashboard') ? 'page' : 'false'}}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>My Content</span>
                                @if(request()->routeIs('portal.author.dashboard'))
                                    <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-secondary" aria-hidden="true"></span>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <li class="relative" role="none">
                            <a href="{{route('admin.dashboard')}}"
                               class="group inline-flex items-center gap-2 py-2 transition-colors duration-300 text-white/90 hover:text-secondary"
                               role="menuitem">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Admin Panel</span>
                            </a>
                        </li>
                    @endif
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
            <a href="/" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Home</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Help & Support</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Policies</a>
            <span class="text-primary/30" aria-hidden="true">•</span>
            <a href="#" class="text-white/80 hover:text-secondary font-serif text-sm transition-colors duration-300">Terms</a>
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
