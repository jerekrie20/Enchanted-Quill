@props(['name','modal'])

<label for="{{$name}}"  class="block mb-2 text-lg font-medium">{{ ucfirst($name)}}</label>

<input type="datetime-local" class="mb-2 rounded-md bg-accent text-secondaryText w-full" {{ $attributes }}   id="{{ $name }}">

<div>
    @error($modal) <span class="text-danger">{{ $message }}</span> @enderror
</div>

