<div class="max-w-(--breakpoint-xl) mx-auto px-4 py-12">
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-heading text-text mb-2">Bound Pacts</h1>
            <p class="text-text/60 font-serif">Manage the authors you follow and stay updated with their latest works.</p>
        </div>

        <div class="relative w-full md:w-72">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Search authors..."
                   class="w-full bg-white/50 dark:bg-accent/20 border-2 border-purple-500/20 rounded-none px-4 py-2 focus:border-purple-500 focus:ring-0 transition-all font-serif">
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-purple-500/50"></i>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="mb-6 p-4 bg-green-500/10 border-l-4 border-green-500 text-green-700 dark:text-green-400 font-serif" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($this->followedAuthors as $author)
            <article wire:key="author-{{ $author->id }}" class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm p-6 border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 transition-all duration-500">
                {{-- Decorative corners --}}
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                <div class="flex items-start gap-4">
                    <a href="{{ route('portal.profile', $author->id) }}" wire:navigate class="shrink-0 relative">
                        @if($author->profile_image)
                            <img src="{{ asset('storage/' . $author->profile_image) }}" alt="{{ $author->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-purple-500/30">
                        @else
                            <div class="w-16 h-16 rounded-full bg-purple-500/10 flex items-center justify-center border-2 border-purple-500/30">
                                <i class="fa-solid fa-user-nib text-2xl text-purple-500"></i>
                            </div>
                        @endif
                    </a>

                    <div class="flex-1 min-w-0">
                        <a href="{{ route('portal.profile', $author->id) }}" wire:navigate class="block">
                            <h2 class="text-xl font-heading text-text group-hover:text-purple-600 transition-colors truncate">{{ $author->name }}</h2>
                        </a>
                        <p class="text-sm text-text/60 font-serif mt-1 line-clamp-2">
                            {{ $author->bio ?: 'A mysterious scribe who has yet to reveal their story.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 text-sm font-serif text-text/60">
                        <span title="Books authored"><i class="fa-solid fa-book text-purple-500/50 mr-1"></i> {{ $author->books_count ?? $author->books()->count() }}</span>
                        <span title="Chronicles written"><i class="fa-solid fa-scroll text-purple-500/50 mr-1"></i> {{ $author->blogs_count ?? $author->blogs()->count() }}</span>
                    </div>

                    <button wire:click="unfollow({{ $author->id }})"
                            wire:confirm="Are you sure you want to unbind the pact with this author?"
                            class="text-xs font-serif text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors flex items-center gap-1">
                        <i class="fa-solid fa-link-slash"></i>
                        Unbind Pact
                    </button>
                </div>
            </article>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-500/10 mb-4 text-purple-500">
                    <i class="fa-solid fa-user-plus text-3xl"></i>
                </div>
                <h3 class="text-2xl font-heading text-text mb-2">No active pacts found</h3>
                <p class="text-text/60 font-serif max-w-full mx-auto mb-8">You have not bound yourself to any authors yet. Explore the library or chronicles to find scribes whose work resonates with you.</p>
                <a href="{{ route('portal.library') }}" wire:navigate class="bg-purple-600 hover:bg-purple-700 text-white font-serif px-8 py-3 transition-colors">
                    Explore Library
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $this->followedAuthors->links() }}
    </div>
</div>
