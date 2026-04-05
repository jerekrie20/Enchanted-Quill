<x-layouts.public title="404 - Story Not Found" description="The page you are looking for has vanished into the mists of the Enchanted Forest.">
    <div class="flex-grow flex items-center justify-center py-16 px-4">
        <div class="max-w-2xl w-full text-center">
            <div class="relative mb-8">
                <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl" aria-hidden="true"></div>
                <img src="{{ asset('graphic/quill.webp') }}" alt="Enchanted Quill" class="h-32 mx-auto relative z-10 opacity-50 grayscale">
            </div>

            <h1 class="text-6xl font-heading text-primary mb-4">404</h1>
            <h2 class="text-3xl font-serif text-white/90 mb-6">A Missing Chapter</h2>

            <p class="text-lg text-white/70 font-serif leading-relaxed mb-10 max-w-lg mx-auto">
                It seems the page you were looking for has vanished into the mists of the Enchanted Forest. The ink has faded, and the quill has moved on to other tales.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="bg-secondary hover:bg-secondary/90 text-white font-serif px-8 py-3 rounded-lg transition-all duration-300 shadow-lg hover:shadow-secondary/20 group">
                    <i class="fa-solid fa-house mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Return Home
                </a>
                <a href="{{ route('books') }}" class="bg-white/10 hover:bg-white/20 text-white font-serif px-8 py-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                    <i class="fa-solid fa-book-open mr-2"></i>
                    Browse Books
                </a>
            </div>

            <div class="mt-16 text-primary/30 text-sm font-serif italic" aria-hidden="true">
                "Not all those who wander are lost, but this page definitely is."
            </div>
        </div>
    </div>
</x-layouts.public>
