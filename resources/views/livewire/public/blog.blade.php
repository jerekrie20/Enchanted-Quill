<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-violet-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-purple-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-purple-400/40"></div>
                    <svg class="w-8 h-8 text-violet-500 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-purple-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">Chronicles & Tales</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Insights, stories, and literary adventures from our community"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-violet-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-purple-400/50"></div>
                    <div class="h-px w-8 bg-violet-500/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">

        {{-- Filters Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 dark:border-violet-400/10 p-6 lg:p-8 rounded-sm" aria-labelledby="filters-heading">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-violet-400/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-violet-400/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-violet-500/10 dark:bg-violet-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </div>
                <h2 id="filters-heading" class="text-xl font-heading text-text">Explore & Filter</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search-input" class="block text-sm font-serif text-text/70 mb-2">Search</label>
                    <div class="relative">
                        <input type="text"
                               id="search-input"
                               wire:model.live.debounce.300ms="search"
                               placeholder="Search posts by title or content..."
                               aria-label="Search blog posts"
                               class="w-full px-4 py-2.5 pl-10 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-violet-500 dark:focus:border-purple-400 text-text transition-colors duration-300 font-serif">
                        <svg class="w-5 h-5 text-text/40 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div>
                    <label for="category-filter" class="block text-sm font-serif text-text/70 mb-2">Category</label>
                    <select wire:model.live="category"
                            id="category-filter"
                            aria-label="Filter posts by category"
                            class="w-full px-4 py-2.5 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-violet-500 dark:focus:border-purple-400 text-text transition-colors duration-300 font-serif">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sort-by" class="block text-sm font-serif text-text/70 mb-2">Sort By</label>
                    <select wire:model.live="sortBy"
                            id="sort-by"
                            aria-label="Sort blog posts"
                            class="w-full px-4 py-2.5 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-violet-500 dark:focus:border-purple-400 text-text transition-colors duration-300 font-serif">
                        <option value="latest">Latest Published</option>
                        <option value="oldest">Oldest First</option>
                        <option value="title">Title (A-Z)</option>
                    </select>
                </div>
            </div>

            {{-- Active Filters --}}
            @if($search || $category)
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <span class="text-sm font-serif text-text/70">Active Filters:</span>

                    @if($search)
                        <button wire:click="$set('search', '')"
                                aria-label="Clear search filter"
                                class="px-3 py-1 bg-purple-400/20 text-purple-700 dark:text-purple-300 rounded-full text-sm font-serif flex items-center gap-2 hover:bg-purple-400/30 transition-colors border border-purple-400/30">
                            Search: "{{ $search }}"
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif

                    @if($category)
                        @php
                            $selectedCategory = $categories->find($category);
                        @endphp
                        @if($selectedCategory)
                            <button wire:click="$set('category', '')"
                                    aria-label="Clear category filter"
                                    class="px-3 py-1 bg-violet-500/20 text-violet-700 dark:text-violet-300 rounded-full text-sm font-serif flex items-center gap-2 hover:bg-violet-500/30 transition-colors border border-violet-500/30">
                                {{ $selectedCategory->name }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    @endif

                    <button wire:click="$set('search', ''); $set('category', '')"
                            aria-label="Clear all filters"
                            class="px-3 py-1 bg-text/10 text-text rounded-full text-sm font-serif hover:bg-text/20 transition-colors">
                        Clear All
                    </button>
                </div>
            @endif
        </section>

        {{-- Blog Posts Grid --}}
        <section aria-labelledby="results-heading">
            <div class="mb-6 text-text/80 font-serif flex items-center justify-between" role="status" aria-live="polite">
                <div>
                    <h2 id="results-heading" class="sr-only">Search Results</h2>
                    Found <span class="font-heading text-violet-600 dark:text-purple-400 text-lg">{{ $blogs->total() }}</span> {{ str('post')->plural($blogs->total()) }}
                </div>
                <div wire:loading class="text-sm text-violet-600 dark:text-purple-400">
                    <i class="fa-solid fa-spinner fa-spin mr-2"></i>Loading...
                </div>
            </div>

            @if($blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($blogs as $blog)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-xl dark:hover:shadow-violet-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-violet-400/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-violet-400/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-violet-400/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-violet-400/50"></div>

                            <a href="{{ route('portal.chronicle.show', $blog->id) }}" wire:navigate class="block">
                                @if($blog->image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('storage/' . $blog->image) }}"
                                             alt="Featured image for {{ $blog->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-video bg-violet-400/10 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-violet-400/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-5 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-violet-600 dark:group-hover:text-violet-300 transition-colors line-clamp-2 mb-2">{{ $blog->title }}</h3>
                                    <p class="text-sm text-text/60 font-serif mb-2">by {{ $blog->user->name }}</p>
                                    <time class="text-xs text-text/50 font-serif italic block mb-3" datetime="{{ $blog->publish_at->toIso8601String() }}">
                                        {{ $blog->publish_at->format('M d, Y') }}
                                    </time>
                                    @if($blog->categories->count() > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($blog->categories->take(2) as $category)
                                                <span class="text-xs px-2 py-1 bg-violet-400/10 text-violet-700 dark:text-violet-300 rounded-sm border border-violet-400/20">{{ $category->name }}</span>
                                            @endforeach
                                            @if($blog->categories->count() > 2)
                                                <span class="text-xs px-2 py-1 bg-violet-400/10 text-violet-700 dark:text-violet-300 rounded-sm border border-violet-400/20">+{{ $blog->categories->count() - 2 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <nav class="mt-8" aria-label="Blog pagination">
                    {{ $blogs->links() }}
                </nav>
            @else
                <div class="text-center py-20 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 rounded-sm">
                    <svg class="w-20 h-20 text-violet-400/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-text font-heading text-2xl mb-2">No Posts Found</p>
                    <p class="text-text/60 font-serif text-lg mb-4">We couldn't find any blog posts matching your criteria</p>
                    @if($search || $category)
                        <button wire:click="$set('search', ''); $set('category', '')"
                                class="text-violet-600 dark:text-purple-400 hover:text-violet-700 dark:hover:text-purple-300 font-serif transition-colors">
                            Clear filters and view all posts
                        </button>
                    @endif
                </div>
            @endif
        </section>

    </main>
</div>
