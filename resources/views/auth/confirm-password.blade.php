<x-Layouts.admin>

    <div class="max-w-md mx-auto mt-8">
        <h1 class="text-xl font-semibold mb-4">Confirm Password</h1>

        <p class="mb-4">
            Please confirm your password before continuing.
        </p>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/user/confirm-password') }}">
            @csrf

            <div class="mb-4">
                <label for="password" class="block mb-1">Current Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="w-full p-2 border border-gray-300 rounded"
                    required
                    autofocus
                >
            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Confirm
            </button>
        </form>
    </div>

</x-Layouts.admin>

