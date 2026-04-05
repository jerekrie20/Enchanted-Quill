<x-layouts.public title="500 - The Quill Has Broken" description="Our scribes are scrambling to mend the magic.">
    <div class="flex-grow flex items-center justify-center py-16 px-4">
        <div class="max-w-2xl w-full text-center">
            <div class="relative mb-8">
                <div class="absolute inset-0 bg-red-500/10 rounded-full blur-3xl" aria-hidden="true"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="Enchanted Quill" class="h-32 mx-auto relative z-10 opacity-50 sepia">
            </div>

            <h1 class="text-6xl font-heading text-red-400 mb-4">500</h1>
            <h2 class="text-3xl font-serif text-white/90 mb-6">The Quill Has Broken</h2>

            <p class="text-lg text-white/70 font-serif leading-relaxed mb-10 max-w-lg mx-auto">
                Something went wrong in the halls of the library. Our scribes have been notified and are scrambling to mend the magic. Please try your search again later.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button onclick="window.location.reload()" class="bg-primary hover:bg-primary/90 text-white font-serif px-8 py-3 rounded-lg transition-all duration-300 shadow-lg group">
                    <i class="fa-solid fa-rotate-right mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                    Try Again
                </button>
                <a href="{{ route('home') }}" class="bg-white/10 hover:bg-white/20 text-white font-serif px-8 py-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                    <i class="fa-solid fa-house mr-2"></i>
                    Back to Library
                </a>
            </div>

            <div class="mt-16 text-primary/30 text-sm font-serif italic" aria-hidden="true">
                "Wait, this wasn't in the script!"
            </div>
        </div>
    </div>
</x-layouts.public>
