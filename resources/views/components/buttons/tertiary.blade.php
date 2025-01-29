@props(['href','text'])

<div class="m-auto text-center p-2">
    <a href="{{$href}}">
        <button  {{ $attributes->merge(['class' => 'bg-accent text-white rounded-md mr-2 ']) }}>{{$text}}</button>

    </a>
</div>


