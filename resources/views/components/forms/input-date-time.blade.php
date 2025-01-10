@props(['name'])

<label for="{{$name}}"  class="block mb-2 text-lg font-medium">{{ ucfirst($name)}}</label>

<p class="text-sm text-danger">**** Only fill out when publish Later has been selected for status</p>

<input type="datetime-local" class="mb-2 rounded-md bg-accent text-secondaryText w-full" {{ $attributes }}   id="{{ $name }}">

<div>
    @error($name) <span class="text-danger">{{ $message }}</span> @enderror
</div>
