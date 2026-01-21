@if(Session::has('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="animate-slideIn"
        x-transition:leave="transform ease-in duration-300 transition"
        @transitionend.window="$el.classList.contains('animate-slideOut') && $el.remove()"
        :class="show ? 'animate-slideIn' : 'animate-slideOut'"
        class="fixed top-5 right-5 bg-white/90 dark:bg-accent/90 backdrop-blur-md border-2 border-secondary text-text font-serif text-sm py-3 px-6 shadow-xl z-50"
        id="success">
        {{-- Corner ornaments --}}
        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-secondary"></span>
        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-secondary"></span>
        <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-secondary"></span>
        <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-secondary"></span>

        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ Session::get('success') }}</span>
        </div>
    </div>
@endif
