<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-b-2 border-purple-500/20">
        {{-- Decorative top border --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="text-center space-y-6">
                {{-- Decorative flourish --}}
                <div class="flex items-center justify-center gap-4 mb-6">
                    <div class="h-px w-20 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-10 h-10 text-purple-500 dark:text-violet-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
                    </svg>
                    <div class="h-px w-20 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading text-text mb-4">
                    Welcome to <span class="text-purple-600 dark:text-violet-400">Enchanted Quill</span>
                </h1>
                <p class="text-xl lg:text-2xl text-text/80 font-serif italic max-w-3xl mx-auto leading-relaxed">
                    "Where Words Weave Magic - Discover captivating stories, explore magical realms, and immerse yourself in the art of storytelling"
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 justify-center mt-8">
                    <a href="{{ route('books') }}" wire:navigate class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 border-2 border-purple-500/50">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <i class="fa-solid fa-book-open mr-2" aria-hidden="true"></i>Browse Books
                    </a>
                    <a href="{{ route('blog') }}" wire:navigate class="relative bg-white/10 dark:bg-white/5 hover:bg-white/20 dark:hover:bg-white/10 text-text font-serif px-8 py-3 rounded-sm border-2 border-purple-500/30 transition-colors duration-300">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-purple-500/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-purple-500/30"></span>
                        <i class="fa-solid fa-scroll mr-2" aria-hidden="true"></i>Read Blog
                    </a>
                </div>

                {{-- Decorative flourish bottom --}}
                <div class="flex items-center justify-center gap-2 mt-8">
                    <div class="h-px w-12 bg-purple-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-violet-400/50"></div>
                    <div class="h-px w-12 bg-purple-500/30"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">

        {{-- Featured Books Section --}}
        <section aria-labelledby="featured-books-heading" class="relative">
            <div class="text-center mb-8">
                <h2 id="featured-books-heading" class="text-3xl lg:text-4xl font-heading text-text mb-3">Featured Books</h2>
                <div class="flex items-center justify-center gap-3">
                    <div class="h-px w-16 bg-text/20"></div>
                    <span class="text-sm text-text/60 font-serif">Recently Published</span>
                    <div class="h-px w-16 bg-text/20"></div>
                </div>
            </div>

            @if($featuredBooks->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($featuredBooks as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('public.book.show', $book->id) }}" wire:navigate class="block">
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
                                <div class="p-5 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2 mb-2">{{ $book->title }}</h3>
                                    <p class="text-sm text-text/60 font-serif mb-3">by {{ $book->author->name }}</p>
                                    @if($book->categories->count() > 0)
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($book->categories->take(2) as $category)
                                                <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-700 dark:text-violet-300 rounded-sm border border-purple-500/20">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                {{-- View All Books Link --}}
                <div class="text-center mt-10">
                    <a href="{{ route('books') }}" wire:navigate class="inline-flex items-center gap-2 text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 font-serif text-lg transition-colors">
                        View All Books
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-16 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm">
                    <svg class="w-16 h-16 text-purple-500/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-text/60 font-serif text-lg">No books available yet. Check back soon!</p>
                </div>
            @endif
        </section>

        {{-- Recent Blog Posts Section --}}
        <section aria-labelledby="recent-blog-heading" class="relative">
            <div class="relative bg-white/40 dark:bg-accent/10 rounded-sm p-8 lg:p-12 border-2 border-violet-400/20 dark:border-violet-400/10">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-20 bg-violet-400/30"></div>
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="h-px w-20 bg-violet-400/30"></div>
                    </div>
                    <h2 id="recent-blog-heading" class="text-3xl lg:text-4xl font-heading text-text">Latest from the Blog</h2>
                    <p class="text-sm text-text/60 font-serif italic mt-2">Stories, insights, and literary adventures</p>
                </div>

                @if($recentBlogs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($recentBlogs as $blog)
                            <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-xl dark:hover:shadow-violet-500/10 transition-all duration-500 overflow-hidden">
                                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-violet-400/50"></div>
                                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-violet-400/50"></div>
                                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-violet-400/50"></div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-violet-400/50"></div>

                                <a href="{{ route('public.blog.show', $blog->id) }}" wire:navigate class="block">
                                    @if($blog->image)
                                        <div class="aspect-video overflow-hidden">
                                            <img src="{{ asset('blogs/' . $blog->image) }}"
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
                                        <time class="text-xs text-text/50 font-serif italic" datetime="{{ $blog->updated_at->toIso8601String() }}">
                                            {{ $blog->updated_at->format('M d, Y') }}
                                        </time>
                                        @if($blog->categories->count() > 0)
                                            <div class="flex flex-wrap gap-1 mt-3">
                                                @foreach($blog->categories->take(2) as $category)
                                                    <span class="text-xs px-2 py-1 bg-violet-400/10 text-violet-700 dark:text-violet-300 rounded-sm border border-violet-400/20">{{ $category->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    {{-- View All Blog Link --}}
                    <div class="text-center mt-10">
                        <a href="{{ route('blog') }}" wire:navigate class="inline-flex items-center gap-2 text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300 font-serif text-lg transition-colors">
                            View All Posts
                            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-12 bg-white dark:bg-navbg/40 border border-violet-400/20">
                        <svg class="w-16 h-16 text-violet-400/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-text/60 font-serif">No blog posts available yet. Check back soon!</p>
                    </div>
                @endif
            </div>
        </section>

    </main>
</div>
