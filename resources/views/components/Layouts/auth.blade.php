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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Enchanted Quill' }}</title>
    <script src="https://kit.fontawesome.com/9a1bef43f6.js" crossorigin="anonymous"></script>

</head>
<body class="min-h-screen flex flex-col bg-gray-50">

{{-- Skip to main content link for keyboard navigation --}}
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-secondary focus:text-white focus:px-4 focus:py-2 focus:rounded">
    Skip to main content
</a>

{{-- Simple Header for Auth Pages --}}
<header class="bg-navbg relative" role="banner">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-0.5 bg-primary/30" aria-hidden="true"></div>

    <div class="flex justify-center items-center mx-auto max-w-(--breakpoint-xl) p-6">
        {{-- Logo with ornate frame --}}
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse group" aria-label="Enchanted Quill Home">
            <div class="relative">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-md group-hover:blur-lg transition-all duration-300" aria-hidden="true"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="" class="h-16 relative z-10 group-hover:scale-105 transition-transform duration-300" aria-hidden="true">
            </div>
            <span class="text-2xl font-heading text-white">Enchanted Quill</span>
        </a>
    </div>

    {{-- Decorative bottom border --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-primary/20" aria-hidden="true"></div>
</header>

{{-- Main Content --}}
<main id="main-content" role="main" class="flex-grow flex items-center justify-center py-12 px-4">
    {{$slot}}
</main>

{{-- Simple Footer --}}
<footer class="bg-navbg mt-auto relative border-t-2 border-primary/20 py-6" role="contentinfo" aria-label="Site footer">
    {{-- Decorative top border --}}
    <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30" aria-hidden="true"></div>

    <div class="max-w-(--breakpoint-xl) mx-auto px-4">
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
