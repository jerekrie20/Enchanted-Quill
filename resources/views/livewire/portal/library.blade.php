<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-8 h-8 text-purple-500 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading">Library of Volumes</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Explore our collection of enchanting stories"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-purple-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-violet-400/50"></div>
                    <div class="h-px w-8 bg-purple-500/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">

        {{-- Filters Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 dark:border-purple-400/10 p-6 lg:p-8 rounded-sm" aria-labelledby="filters-heading">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </div>
                <h2 id="filters-heading" class="text-xl font-heading text-text">Search & Filter</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search-input" class="block text-sm font-serif text-text/70 mb-2">Search</label>
                    <input type="text"
                           id="search-input"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Search by title or description..."
                           aria-label="Search books by title or description"
                           class="w-full px-4 py-2 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300">
                </div>

                <div>
                    <label for="category-filter" class="block text-sm font-serif text-text/70 mb-2">Categories</label>
                    <select wire:model.live="selectedCategories"
                            id="category-filter"
                            multiple
                            aria-label="Filter books by categories"
                            aria-describedby="category-help"
                            class="w-full px-4 py-2 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category-help" class="sr-only">Hold Ctrl or Cmd to select multiple categories</span>
                </div>

                <div>
                    <label for="sort-by" class="block text-sm font-serif text-text/70 mb-2">Sort By</label>
                    <select wire:model.live="sortBy"
                            id="sort-by"
                            aria-label="Sort books by criteria"
                            class="w-full px-4 py-2 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300">
                        <option value="latest">Latest Published</option>
                        <option value="oldest">Oldest First</option>
                        <option value="title">Title (A-Z)</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>

            {{-- Active Filters --}}
            @if($search || !empty($selectedCategories))
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <span class="text-sm font-serif text-text/70">Active Filters:</span>

                    @if($search)
                        <button wire:click="$set('search', '')"
                                aria-label="Remove search filter for {{ $search }}"
                                class="px-3 py-1 bg-violet-400/20 text-violet-700 dark:text-violet-300 rounded-full text-sm font-serif flex items-center gap-2 hover:bg-violet-400/30 transition-colors border border-violet-400/30">
                            Search: "{{ $search }}"
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif

                    @foreach($selectedCategories as $catId)
                        @php
                            $category = $categories->find($catId);
                        @endphp
                        @if($category)
                            <button wire:click="$set('selectedCategories', {{ collect($selectedCategories)->filter(fn($id) => $id !== $catId)->values()->toJson() }})"
                                    aria-label="Remove category filter {{ $category->name }}"
                                    class="px-3 py-1 bg-purple-500/20 text-purple-700 dark:text-violet-300 rounded-full text-sm font-serif flex items-center gap-2 hover:bg-purple-500/30 transition-colors border border-purple-500/30">
                                {{ $category->name }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    @endforeach

                    <button wire:click="$set('search', ''); $set('selectedCategories', [])"
                            aria-label="Clear all filters"
                            class="px-3 py-1 bg-text/10 text-text rounded-full text-sm font-serif hover:bg-text/20 transition-colors">
                        Clear All
                    </button>
                </div>
            @endif
        </section>

        {{-- Books Grid --}}
        <section aria-labelledby="results-heading">
            <div class="mb-6 text-text/80 font-serif" role="status" aria-live="polite">
                <h2 id="results-heading" class="sr-only">Search Results</h2>
                Found <span class="font-heading text-purple-600 dark:text-violet-400">{{ $books->total() }}</span> {{ str('volume')->plural($books->total()) }}
            </div>

            @if($books->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($books as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.book.show', $book->id) }}" wire:navigate class="block">
                                @if($book->cover)
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset('books/' . $book->cover) }}" alt="Cover image for {{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-[3/4] bg-purple-500/10 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-purple-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">{{ $book->title }}</h3>
                                    <p class="text-sm text-text/60 font-serif mt-1">by {{ $book->author->name }}</p>

                                    @if($book->categories->count() > 0)
                                        <div class="flex flex-wrap gap-1 mt-3">
                                            @foreach($book->categories->take(2) as $category)
                                                <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-700 dark:text-violet-300 rounded-sm border border-purple-500/20">{{ $category->name }}</span>
                                            @endforeach
                                            @if($book->categories->count() > 2)
                                                <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-700 dark:text-violet-300 rounded-sm border border-purple-500/20">+{{ $book->categories->count() - 2 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <nav class="mt-8">
                    {{ $books->links() }}
                </nav>
            @else
                <x-general.empty-state
                    icon="fa-magnifying-glass"
                    title="No Volumes Found"
                    message="The library is vast, but it seems this specific scroll has not been written yet. Try adjusting your filters or search terms!"
                    :action-text="$search || !empty($selectedCategories) ? 'Clear All Filters' : null"
                    action-wire-click="clearFilters"
                />
            @endif
        </section>

    </main>
</div>
