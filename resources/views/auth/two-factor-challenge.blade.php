<x-Layouts.admin>


    <div class="max-w-md mx-auto mt-8">
        <h1 class="text-xl font-semibold mb-4">Two-Factor Challenge</h1>

        <p class="mb-4">Please enter your authentication code to log in.</p>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/two-factor-challenge">
            @csrf

            <div class="mb-4">
                <label for="code" class="block mb-1">Authentication Code</label>
                <input
                    id="code"
                    type="text"
                    name="code"
                    class="w-full p-2 border border-gray-300 rounded"
                    autocomplete="one-time-code"
                />
            </div>

            <div class="mb-4">
                <p class="text-gray-600 mb-2">Or use a recovery code</p>
                <input
                    type="text"
                    name="recovery_code"
                    class="w-full p-2 border border-gray-300 rounded"
                    placeholder="XXXX-XXXX"
                />
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Log In
            </button>
        </form>
    </div>


</x-Layouts.admin>
