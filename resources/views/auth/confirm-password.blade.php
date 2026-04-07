<x-layouts.auth>
    <x-slot name="title">Confirm Password - Enchanted Quill</x-slot>

    <div class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-heading text-gray-800 mb-2">Confirm Password</h1>
                <p class="text-gray-600 font-serif text-sm">
                    Please confirm your password before continuing.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-md p-4">
                    <ul class="list-disc list-inside text-red-600 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/user/confirm-password') }}">
                @csrf

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-md focus:border-primary focus:outline-none transition-colors"
                        required
                        autofocus
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-serif text-lg py-3 rounded-md transition-colors duration-300"
                >
                    Confirm
                </button>
            </form>
        </div>
    </div>

</x-layouts.auth>

