@props(['name', 'errorKey' => null])

@php
    $errorKey = $errorKey ?? $name;
@endphp

<label for="{{$name}}"  class="block mb-2 text-lg font-medium">{{ ucfirst($name)}}</label>

<input type="text" class="mb-2 rounded-md bg-accent text-white w-full" {{ $attributes }}   id="{{ $name }}">

<div>
    @error($errorKey) <span class="text-danger">{{ $message }}</span> @enderror
</div>
