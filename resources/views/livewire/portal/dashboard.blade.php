<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header with Fantasy Elements --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        {{-- Ornamental border top --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center space-y-4">
                {{-- Decorative flourish --}}
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-8 h-8 text-purple-500 dark:text-violet-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading">Welcome to Enchanted Quill</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto ">
                    "Discover captivating stories, explore magical realms, and immerse yourself in the art of storytelling"
                </p>

                {{-- Decorative flourish bottom --}}
                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-purple-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-violet-400/50"></div>
                    <div class="h-px w-8 bg-purple-500/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-16">

        {{-- Recently Updated Books --}}
        <section aria-labelledby="recent-books-heading" class="relative">
            <div class="text-center mb-8">
                <h2 id="recent-books-heading" class="text-2xl lg:text-3xl font-heading text-text mb-2">Recently Updated Volumes</h2>
                <div class="flex items-center justify-center gap-3">
                    <div class="h-px w-12 bg-text/20"></div>
                    <span class="text-sm text-text/60 font-serif">✦</span>
                    <div class="h-px w-12 bg-text/20"></div>
                </div>
            </div>

            @if($recentBooks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentBooks as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.book.show', $book->id) }}" wire:navigate class="block">
                                @if($book->cover)
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset('books/' . $book->cover) }}"
                                             alt="Cover of {{ $book->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
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
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach($book->categories as $category)
                                            <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-700 dark:text-violet-300 rounded-sm border border-purple-500/20">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <x-general.empty-state
                    icon="fa-book"
                    title="The Archives are Quiet"
                    message="No volumes have been recently updated. Our authors are busy inscribing new tales!"
                    action-text="Explore All Volumes"
                    :action-url="route('portal.library')"
                />
            @endif
        </section>

    {{-- Popular Books --}}
    <section aria-labelledby="popular-books-heading" class="relative">
        <div class="absolute inset-0 bg-white/40 dark:bg-accent/5 rounded-sm"></div>
        <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 dark:border-violet-400/10 p-8 lg:p-10">
            <div class="text-center mb-8">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-20 bg-violet-400/30"></div>
                    <svg class="w-6 h-6 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <div class="h-px w-20 bg-violet-400/30"></div>
                </div>
                <h2 id="popular-books-heading" class="text-2xl lg:text-3xl font-heading text-text">Popular Volumes</h2>
                <p class="text-sm text-text/60 font-serif italic mt-2">Most reviewed and cherished</p>
            </div>

            @if($popularBooks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($popularBooks as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-xl dark:hover:shadow-violet-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-violet-400/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-violet-400/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-violet-400/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-violet-400/50"></div>

                            <a href="{{ route('portal.book.show', $book->id) }}" wire:navigate class="block">
                                @if($book->cover)
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset('books/' . $book->cover) }}"
                                             alt="Cover of {{ $book->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-[3/4] bg-violet-400/10 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-violet-400/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-violet-600 dark:group-hover:text-violet-300 transition-colors line-clamp-2">{{ $book->title }}</h3>
                                    <p class="text-sm text-text/60 font-serif mt-1">by {{ $book->author->name }}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="text-sm text-text/80 font-serif">{{ $book->reviews_count }} {{ str('review')->plural($book->reviews_count) }}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach($book->categories as $category)
                                            <span class="text-xs px-2 py-1 bg-violet-400/10 text-violet-700 dark:text-violet-300 rounded-sm border border-violet-400/20">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <x-general.empty-state
                    icon="fa-star"
                    title="A New Legend Awaits"
                    message="No popular books yet. Be the first to share your thoughts and help a tale rise to fame!"
                    action-text="Discover New Tales"
                    :action-url="route('portal.library')"
                />
            @endif
        </div>
    </section>

    {{-- Recent Chronicles --}}
    <section aria-labelledby="recent-chronicles-heading" class="relative">
        <div class="text-center mb-8">
            <h2 id="recent-chronicles-heading" class="text-2xl lg:text-3xl font-heading text-text mb-2">Latest Chronicles</h2>
            <div class="flex items-center justify-center gap-3">
                <div class="h-px w-12 bg-text/20"></div>
                <span class="text-sm text-text/60 font-serif">✦</span>
                <div class="h-px w-12 bg-text/20"></div>
            </div>
        </div>

            @if($recentChronicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentChronicles as $chronicle)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.chronicle.show', $chronicle->id) }}" wire:navigate class="block">
                                @if($chronicle->image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('blogs/' . $chronicle->image) }}"
                                             alt="Featured image for {{ $chronicle->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-video bg-purple-500/10 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-purple-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">{{ $chronicle->title }}</h3>
                                    <p class="text-sm text-text/60 font-serif mt-1">by {{ $chronicle->user->name }}</p>
                                    <p class="text-sm text-text/60 mt-2 font-serif italic">
                                        @if($chronicle->publish_at)
                                            <time datetime="{{ $chronicle->publish_at->toIso8601String() }}">{{ $chronicle->publish_at->diffForHumans() }}</time>
                                        @else
                                            <time datetime="{{ $chronicle->updated_at->toIso8601String() }}">{{ $chronicle->updated_at->diffForHumans() }}</time>
                                        @endif
                                    </p>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach($chronicle->categories as $category)
                                            <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-700 dark:text-violet-300 rounded-sm border border-purple-500/20">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <x-general.empty-state
                    icon="fa-feather"
                    title="Silence in the Chronicles"
                    message="No recent chronicles found. Check back soon for new insights from our community!"
                    action-text="Browse Chronicles"
                    :action-url="route('blog')"
                />
            @endif
    </section>

    </main>
</div>
</div>
