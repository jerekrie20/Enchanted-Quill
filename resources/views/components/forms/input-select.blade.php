@props(['name', 'data'])

<label for="{{$name}}" class="block mb-2 text-lg font-medium "> {{ ucfirst($name)}}</label>

<select class="rounded-md bg-accent  focus:ring-secondary focus:border-secondary block w-full p-2.5 text-white mb-2" {{ $attributes }}   id="{{ $name }}">
    <option disabled value="">Choose {{ ucfirst($name)}}</option>
    @foreach($data as $key => $value)
        <option value="{{$key}}">{{$value}}</option>
    @endforeach
</select>

<div>
    @error($name) <span class="text-danger">{{ $message }}</span> @enderror
</div>

