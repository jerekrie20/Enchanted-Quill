<x-Layouts.admin>

    <h1 class="text-center  mt-14">Login</h1>

    <form action="/login" method="post" class="text-center mt-10">
        @csrf
        <div class="flex flex-col justify-center p-4 ">
            <input type="email" name="email" id="email" class="border-2 mb-2 rounded-md">
            <input type="password" name="password" id="password" class="border-2 mb-2 rounded-md">
            <input type="submit" value="submit" class="w-1/2 m-auto p-2  bg-primary text-secondaryText rounded-md text-2xl">
        </div>

    </form>

</x-Layouts.admin>
