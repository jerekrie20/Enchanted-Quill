
<label for="password"  class="block mb-2 text-lg font-medium">Password </label>

<input type="password" class="mb-2 rounded-md bg-accent text-secondaryText" {{ $attributes }}   id="password">

<div>
    @error('password') <span class="text-danger" >{{ $message }}</span> @enderror
</div>

