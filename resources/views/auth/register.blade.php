<x-layouts.auth>
    <x-slot name="title">Register - Enchanted Quill</x-slot>

    <div class="w-full xl:w-1/2 mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8">
            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-heading text-gray-800 mb-2">Join Enchanted Quill</h1>
                <p class="text-gray-600 font-serif">Begin your literary adventure today</p>
            </div>

            {{-- Registration Form --}}
            <form action="/register" method="post">
                @csrf

                {{-- Name Field --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                        autofocus
                    >
                    @error('name')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

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
                    >
                    @error('email')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Create a strong password"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                    >
                    @error('password')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password Confirmation Field --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Re-enter your password"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                    >
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-serif text-lg py-3 rounded-md transition-colors duration-300"
                >
                    Create Account
                </button>
            </form>

            {{-- Footer Links --}}
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-medium transition-colors">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>

</x-layouts.auth>
