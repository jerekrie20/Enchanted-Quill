@props(['value' => 'Submit', 'target' => null])

<button type="submit"
        wire:loading.attr="disabled"
        @if($target) wire:target="{{ $target }}" @endif
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-10 py-2 bg-transparent hover:bg-secondary border-2 border-secondary text-text rounded-md transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed group relative overflow-hidden font-serif']) }}>

    <span class="relative z-10 flex items-center gap-2">
        <span wire:loading.remove @if($target) wire:target="{{ $target }}" @endif>
            {{ $value }}
        </span>
        <span wire:loading @if($target) wire:target="{{ $target }}" @endif class="flex items-center gap-2">
            <i class="fa-solid fa-spinner fa-spin"></i>
            {{ $value === 'Submit' ? 'Submitting...' : 'Processing...' }}
        </span>
    </span>
</button>
