

<label for="password_confirmation"  class="block mb-2 text-lg font-medium">Confirm Password</label>

<input type="password" class="mb-2 rounded-md bg-accent text-secondaryText" {{ $attributes }}   id="password_confirmation">

<div>
    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
</div>


