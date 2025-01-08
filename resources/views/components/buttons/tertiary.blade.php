@props(['href','text'])

<div class="m-auto text-center p-2">
    <a href="{{$href}}">
        <button  {{ $attributes->merge(['class' => 'bg-accent text-secondaryText rounded-md mr-2 ']) }}>{{$text}}</button>

    </a>
</div>


