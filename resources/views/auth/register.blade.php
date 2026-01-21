<x-Layouts.admin>

    <h1 class="text-center mt-14">Register</h1>

    <form action="/register" method="post" class="text-center mt-10">
        @csrf
        <div class="flex flex-col sm:flex-row md:flex-wrap justify-center p-4 mx-auto gap-4">
            <div class="sm:w-1/2 md:w-1/3">
                <input type="text" name="name" id="name" placeholder="Name" class="w-full border-2 mb-2 rounded-md p-2"
                       required autofocus>
                @error('name') <span class="text-danger text-sm mb-2">{{ $message }}</span> @enderror
            </div>

            <div class="sm:w-1/2 md:w-1/3">
                <input type="email" name="email" id="email" placeholder="Email" class="w-full border-2 mb-2 rounded-md p-2"
                       required>
                @error('email') <span class="text-danger text-sm mb-2">{{ $message }}</span> @enderror
            </div>
            <div class="sm:w-1/2 md:w-1/3">
                <input type="password" name="password" id="password" placeholder="Password"
                       class="w-full border-2 mb-2 rounded-md p-2" required>
                @error('password') <span class="text-danger text-sm mb-2">{{ $message }}</span> @enderror
            </div>
            <div class="sm:w-1/2 md:w-1/3">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       placeholder="Confirm Password" class="w-full border-2 mb-2 rounded-md p-2" required>
            </div>
            <div class="w-full">
                <input type="submit" value="Register"
                       class="w-full max-w-md mx-auto mt-4 p-2 bg-primary text-white rounded-md text-2xl cursor-pointer">
            </div>
            <div class="w-full">
                <a href="{{ route('login') }}" class="mt-4 text-primary hover:underline">Already registered?</a>
            </div>
        </div>

    </form>

</x-Layouts.admin>
