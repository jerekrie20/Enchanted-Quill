<x-layouts.auth>
    <x-slot name="title">Login - Enchanted Quill</x-slot>

    <div class="w-full  xl:w-1/2 mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-heading text-gray-800 mb-2">Welcome Back</h1>
                <p class="text-gray-600 font-serif">Sign in to continue your journey</p>
            </div>

            {{-- Login Form --}}
            <form action="/login" method="post">
                @csrf

                {{-- Email Field --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                        autofocus
                    >
                    @error('email')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                    >
                    @error('password')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-serif text-lg py-3 rounded-md transition-colors duration-300"
                >
                    Sign In
                </button>
            </form>

            {{-- Footer Links --}}
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-medium transition-colors">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>

</x-layouts.auth>
