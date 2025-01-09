@if(Session::has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="animate-slideIn" {{-- Trigger slide-in animation --}}
        x-transition:leave="transform ease-in duration-300 transition" {{-- Let Alpine.js handle visibility --}}
        @transitionend.window="$el.classList.contains('animate-slideOut') && $el.remove()" {{-- Remove when slide-out ends --}}
        :class="show ? 'animate-slideIn' : 'animate-slideOut'" {{-- Add/remove animations based on `show` state --}}
        class="fixed top-5 right-5 bg-green-500 text-white text-sm font-medium py-2 px-4 rounded shadow-md z-40"
        id="success">
        {{ Session::get('success') }}
    </div>
@endif
