@props(['name','modal'])

<label for="{{$name}}"  class="block mb-2 text-lg font-medium">{{ ucfirst($name)}}</label>

<input type="file" {{$attributes}} accept="image/*" class="block w-full mt-2 text-sm text-secondaryText rounded-lg cursor-pointer bg-text focus:outline-none">
<p class="mt-1 text-sm text-text text-center" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 2MB).</p>

<div>
    @error($modal) <span class="text-danger">{{ $message }}</span> @enderror
</div>

