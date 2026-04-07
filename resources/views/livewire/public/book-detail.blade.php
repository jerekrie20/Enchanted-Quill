<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Book Header Section --}}
    <section class="bg-navbg relative py-12 border-b-2 border-purple-500/20" aria-labelledby="book-title">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Book Cover --}}
                <div class="md:col-span-1">
                    @if($book->cover)
                        <div class="relative">
                            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>
                            <img src="{{ \Storage::url('books/' . $book->cover) }}" alt="Cover image for {{ $book->title }}" class="w-full rounded-sm shadow-2xl border-2 border-purple-500/30">
                        </div>
                    @else
                        <div class="relative w-full aspect-[3/4] bg-purple-500/10 rounded-sm flex items-center justify-center border-2 border-purple-500/30" role="img" aria-label="Placeholder book cover">
                            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>
                            <svg class="w-24 h-24 text-purple-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Book Info --}}
                <div class="md:col-span-2 text-white">
                    <div class="flex flex-wrap items-center gap-4 mb-4">
                        <h1 id="book-title" class="text-4xl md:text-5xl font-heading">{{ $book->title }}</h1>
                        @if($book->status == 2)
                            <span class="bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-sm flex items-center gap-2 border border-purple-400 shadow-lg">
                                <i class="fa-solid fa-lock"></i> Members Only
                            </span>
                        @endif
                    </div>
                    <p class="text-xl font-serif text-white/80 mb-4">by <span class="text-violet-400">{{ $book->author->name }}</span></p>

                    {{-- Categories --}}
                    <div class="flex flex-wrap gap-2 mb-6" role="list" aria-label="Book categories">
                        @foreach($book->categories as $category)
                            <span class="px-3 py-1 bg-purple-500/20 text-violet-300 rounded-full text-sm font-serif border border-purple-500/30" role="listitem">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    {{-- Rating and Stats --}}
                    <div class="flex items-center gap-6 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center" role="img" aria-label="Average rating: {{ $averageRating }} out of 5 stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $averageRating)
                                        <i class="fa-solid fa-star text-yellow-500" aria-hidden="true"></i>
                                    @elseif($i - 0.5 <= $averageRating)
                                        <i class="fa-solid fa-star-half-stroke text-yellow-500" aria-hidden="true"></i>
                                    @else
                                        <i class="fa-regular fa-star text-yellow-500" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-white/80">{{ $averageRating }} ({{ $book->reviews_count }} {{ str('review')->plural($book->reviews_count) }})</span>
                        </div>
                        <div class="text-white/80">
                            <i class="fa-solid fa-book-open mr-2" aria-hidden="true"></i>{{ $book->chapters_count }} {{ str('chapter')->plural($book->chapters_count) }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    @if($chapters->count() > 0)
                        <div class="flex flex-wrap gap-4" role="group" aria-label="Book actions">
                            @if($canRead)
                                <a href="{{ route('chapter.read', ['bookId' => $book->id, 'chapterNumber' => 1]) }}" wire:navigate class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border-2 border-purple-500/50" aria-label="Start reading {{ $book->title }}">
                                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                    <i class="fa-solid fa-book-open" aria-hidden="true"></i> Start Reading
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border-2 border-purple-500/50" aria-label="Sign in to read {{ $book->title }}">
                                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                    <i class="fa-solid fa-sign-in-alt" aria-hidden="true"></i> Sign In to Read
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </article>
        </div>
    </section>

    {{-- Book Description --}}
    <section class="py-12 border-b-2 border-purple-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-6 lg:p-8 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <h2 id="synopsis-heading" class="text-2xl font-heading text-text mb-4">Synopsis</h2>
                <div class="prose prose-lg max-w-none text-text/80 font-serif">
                    {!! $book->description !!}
                </div>
            </div>
        </div>
    </section>

    {{-- Chapters List --}}
    <section class="py-12 border-b-2 border-purple-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="chapters-heading" class="text-2xl font-heading text-text mb-6 text-center">Chapters</h2>

            @if($chapters->count() > 0)
                <nav aria-label="Book chapters">
                    <ul class="space-y-3">
                        @foreach($chapters as $chapter)
                            <li class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden" wire:key="chapter-{{ $chapter->id }}">
                                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                                <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-purple-500/50"></div>
                                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-purple-500/50"></div>

                                @if($canRead)
                                    <a href="{{ route('chapter.read', ['bookId' => $book->id, 'chapterNumber' => $chapter->chapter_number]) }}" wire:navigate class="block p-4" aria-label="Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <span class="text-3xl font-heading text-purple-500/50 group-hover:text-purple-500 transition-colors" aria-hidden="true">{{ $chapter->chapter_number }}</span>
                                                <div>
                                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors">{{ $chapter->title }}</h3>
                                                    <p class="text-sm text-text/60 font-serif">Added {{ $chapter->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <svg class="w-5 h-5 text-purple-500/50 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </a>
                                @else
                                    <div class="block p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <span class="text-3xl font-heading text-purple-500/50" aria-hidden="true">{{ $chapter->chapter_number }}</span>
                                                <div>
                                                    <h3 class="text-lg font-heading text-text">{{ $chapter->title }}</h3>
                                                    <p class="text-sm text-text/60 font-serif">Added {{ $chapter->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('login') }}" class="text-sm text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 transition-colors">Sign in to read</a>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    {{-- Pagination --}}
                    @if($chapters->hasPages())
                        <div class="mt-6">
                            {{ $chapters->links() }}
                        </div>
                    @endif
                </nav>
            @else
                <div class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm">
                    <svg class="w-16 h-16 text-purple-500/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-text/60 font-serif">No chapters available yet. Check back soon!</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Reviews Section --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 id="reviews-heading" class="text-2xl font-heading text-text">Reader Reviews</h2>
                @guest
                    <a href="{{ route('login') }}" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 border-2 border-purple-500/50" aria-label="Sign in to write a review">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <i class="fa-solid fa-sign-in-alt mr-2" aria-hidden="true"></i>Sign In to Review
                    </a>
                @endguest
            </div>

            @if($reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($reviews as $review)
                        <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 p-6 overflow-hidden" wire:key="review-{{ $review->id }}">
                            <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h4 class="font-heading text-text">{{ $review->user->name }}</h4>
                                    <div class="flex items-center gap-2 mt-1" role="img" aria-label="Rating: {{ $review->stars }} out of 5 stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->stars)
                                                <i class="fa-solid fa-star text-yellow-500 text-sm" aria-hidden="true"></i>
                                            @else
                                                <i class="fa-regular fa-star text-yellow-500 text-sm" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <time class="text-sm text-text/60 font-serif" datetime="{{ $review->created_at->toIso8601String() }}">{{ $review->created_at->diffForHumans() }}</time>
                            </div>
                            <p class="text-text/80 font-serif">{{ $review->content }}</p>
                        </article>
                    @endforeach

                    {{-- Pagination --}}
                    @if($reviews->hasPages())
                        <div class="mt-6">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm">
                    <svg class="w-16 h-16 text-purple-500/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <p class="text-text font-heading text-lg mb-2">No reviews yet</p>
                    <p class="text-text/60 font-serif">Be the first to share your thoughts!</p>
                </div>
            @endif
        </div>
    </section>
</div>
