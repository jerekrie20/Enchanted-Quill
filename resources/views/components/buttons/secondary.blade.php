@props(['href','text'])

<div class="m-auto text-center p-2">
    <a href="{{$href}}">
        <button {{ $attributes->merge(['class' => 'bg-secondary text-text rounded-md mr-2 ']) }}>{{$text}}</button>
    </a>
</div>

