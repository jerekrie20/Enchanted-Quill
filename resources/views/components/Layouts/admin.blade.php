<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite('resources/css/app.css')
    @livewireStyles
    @livewireScripts
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    <script src="https://kit.fontawesome.com/9a1bef43f6.js" crossorigin="anonymous"></script>

</head>
<body class="min-h-screen flex flex-col">


<nav class="bg-navbg ">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="{{ route('login') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('graphic/quill.webp') }}" alt="logo" class="h-12">
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:5541251234" class="text-secondaryText hover:underline">Settings</a>
            <a href="#" class="text-secondaryText  hover:underline">My Space</a>
            <a href="#" ><x-icons.bell/></a>
            <button id="themeToggle" class="flex items-center">
                <x-icons.moon />
                <x-icons.sun />
            </button>
        </div>
    </div>

</nav>

<nav class="bg-secondarynavbg ">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center justify-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="{{ route('admin.dashboard') }}" wire:navigate.hover class="hover:text-secondary {{request()->routeIs('admin.dashboard') ? 'text-secondary' : 'text-secondaryText '}}" aria-current="page">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin.users')}}" wire:navigate.hover class="hover:text-secondary {{request()->routeIs('admin.users') ? 'text-secondary' : 'text-secondaryText '}}">Users</a>
                </li>
                <li>
                    <a href="#" class="text-secondaryText  hover:text-secondary active:text-secondary">Books</a>
                </li>
                <li>
                    <a href="#" class="text-secondaryText  hover:text-secondary active:text-secondary">Blogs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


{{$slot}}




<footer class="bg-navbg mt-auto">
    <div class="flex flex-wrap justify-center items-center mx-auto max-w-screen-xl p-4">
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="/" class="text-secondaryText hover:underline">Home</a>
            <a href="#" class="text-secondaryText  hover:underline">Help/Support</a>
            <a href="#" class="text-secondaryText  hover:underline">Policies</a>
            <a href="#" class="text-secondaryText  hover:underline">Terms</a>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <a href="" class="text-secondaryText "><i class="fa-regular fa-copyright"></i> {{date("Y")}} Enchanted Quill</a>
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

</body>
</html>
