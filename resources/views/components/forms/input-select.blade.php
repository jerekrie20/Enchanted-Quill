@props(['name', 'data'])

<label for="{{$name}}" class="block mb-2 text-lg font-medium ">Select a {{ ucfirst($name)}}</label>

<select class="rounded-md bg-accent  focus:ring-secondary focus:border-secondary block w-full p-2.5 text-secondaryText mb-2" {{ $attributes }}   id="{{ $name }}">
    <option disabled value="">Choose {{ ucfirst($name)}}</option>
    @foreach($data as $opt)
        <option value="{{$opt}}">{{$opt}}</option>
    @endforeach
</select>

<div>
    @error($name) <span class="text-danger">{{ $message }}</span> @enderror
</div>

