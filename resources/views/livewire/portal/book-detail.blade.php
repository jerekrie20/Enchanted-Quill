<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Book Header Section --}}
    <section class="bg-navbg relative py-12 border-b-2 border-purple-500/20" aria-labelledby="book-title">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Book Cover --}}
                <div class="md:col-span-1">
                    @if($this->book->cover)
                        <div class="relative">
                            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>
                            <img src="{{ asset('books/' . $this->book->cover) }}" alt="Cover image for {{ $this->book->title }}" class="w-full rounded-sm shadow-2xl border-2 border-purple-500/30">
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
                        <h1 id="book-title" class="text-4xl md:text-5xl font-heading">{{ $this->book->title }}</h1>
                        @if($this->book->status == 2)
                            <span class="bg-purple-600 text-white text-sm font-bold px-3 py-1 rounded-sm flex items-center gap-2 border border-purple-400 shadow-lg">
                                <i class="fa-solid fa-lock"></i> Members Only
                            </span>
                        @endif
                    </div>
                    <p class="text-xl font-serif text-white/80 mb-4">by <a href="{{ route('portal.profile', $this->book->author->id) }}" wire:navigate class="text-violet-400 hover:text-violet-300 transition-colors" aria-label="View author profile for {{ $this->book->author->name }}">{{ $this->book->author->name }}</a></p>

                    {{-- Categories --}}
                    <div class="flex flex-wrap gap-2 mb-6" role="list" aria-label="Book categories">
                        @foreach($this->book->categories as $category)
                            <span class="px-3 py-1 bg-purple-500/20 text-violet-300 rounded-full text-sm font-serif border border-purple-500/30" role="listitem">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    {{-- Rating and Stats --}}
                    <div class="flex items-center gap-6 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center" role="img" aria-label="Average rating: {{ $this->averageRating }} out of 5 stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $this->averageRating)
                                        <i class="fa-solid fa-star" style="color: #eab308;" aria-hidden="true"></i>
                                    @elseif($i - 0.5 <= $this->averageRating)
                                        <i class="fa-solid fa-star-half-stroke" style="color: #eab308;" aria-hidden="true"></i>
                                    @else
                                        <i class="fa-regular fa-star" style="color: #eab308;" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-white/80">{{ $this->averageRating }} ({{ $this->book->reviews_count }} {{ str('review')->plural($this->book->reviews_count) }})</span>
                        </div>
                        <div class="text-white/80">
                            <i class="fa-solid fa-book-open mr-2" aria-hidden="true"></i>{{ $this->book->chapters_count }} {{ str('chapter')->plural($this->book->chapters_count) }}
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mb-6">
                        <span class="px-3 py-1 bg-violet-400/20 text-violet-300 rounded-full font-serif border border-violet-400/30" role="status" aria-label="Book status">
                            {{ $this->book->status_label }}
                            @if($this->book->published_at)
                                -  {{ $this->book->published_at->format('M d, Y') }}
                            @endif
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap gap-4" role="group" aria-label="Book actions">
                        @if($this->chapters->count() > 0)
                            <a href="{{ route('portal.chapter.read', ['bookId' => $this->book->id, 'chapterNumber' => 1]) }}" wire:navigate class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border-2 border-purple-500/50" aria-label="Start reading {{ $this->book->title }}">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <i class="fa-solid fa-book-open" aria-hidden="true"></i> Start Reading
                            </a>
                        @endif
                        @auth
                            <button wire:click="toggleBookmark" wire:loading.attr="disabled" class="relative bg-white/10 hover:bg-white/20 text-white font-serif px-6 py-3 rounded-sm border-2 border-purple-500/30 transition-colors duration-300 inline-flex items-center gap-2" aria-label="{{ $this->isBookmarked ? 'Remove from' : 'Add to' }} your library">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <i class="fa-solid fa-bookmark {{ $this->isBookmarked ? 'text-yellow-400' : '' }}" aria-hidden="true" wire:loading.remove wire:target="toggleBookmark"></i>
                                <i class="fa-solid fa-spinner fa-spin" aria-hidden="true" wire:loading wire:target="toggleBookmark"></i>
                                <span wire:loading.remove wire:target="toggleBookmark">{{ $this->isBookmarked ? 'In Library' : 'Add to Library' }}</span>
                                <span wire:loading wire:target="toggleBookmark">Processing...</span>
                            </button>
                        @endauth
                    </div>
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
                    {!! $this->book->description !!}
                </div>
            </div>
        </div>
    </section>

    {{-- Chapters List --}}
    <section class="py-12 border-b-2 border-purple-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="chapters-heading" class="text-2xl font-heading text-text mb-6 text-center">Chapters</h2>

            @if($this->chapters->count() > 0)
                <nav aria-label="Book chapters">
                    <ul class="space-y-3">
                        @foreach($this->chapters as $chapter)
                            <li class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden" wire:key="chapter-{{ $chapter->id }}">
                                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                                <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-purple-500/50"></div>
                                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-purple-500/50"></div>

                                <a href="{{ route('portal.chapter.read', ['bookId' => $this->book->id, 'chapterNumber' => $chapter->chapter_number]) }}" wire:navigate class="block p-4" aria-label="Chapter {{ $chapter->chapter_number }}: {{ $chapter->title }}">
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
                            </li>
                        @endforeach
                    </ul>

                    {{-- Pagination --}}
                    @if($this->chapters->hasPages())
                        <div class="mt-6">
                            {{ $this->chapters->links() }}
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
                @auth
                    <button wire:click="openReviewModal" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 border-2 border-purple-500/50" aria-label="Write a review for {{ $this->book->title }}">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <i class="fa-solid fa-plus mr-2" aria-hidden="true"></i>{{ $this->userReview ? 'Edit Review' : 'Write a Review' }}
                    </button>
                @endauth
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
                                    <div class="flex items-center gap-2 mt-1" role="img" aria-label="Rating: {{ $review->stars->value }} out of 5 stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->stars->value)
                                                <i class="fa-solid fa-star text-sm" style="color: #eab308;" aria-hidden="true"></i>
                                            @else
                                                <i class="fa-regular fa-star text-sm" style="color: #eab308;" aria-hidden="true"></i>
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

    {{-- Review Modal --}}
    @if($showReviewModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background overlay --}}
                <div class="fixed inset-0 bg-gray-900/75 transition-opacity" aria-hidden="true" wire:click="closeReviewModal"></div>

                {{-- Modal panel --}}
                <div class="inline-block align-bottom bg-white dark:bg-navbg rounded-sm text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full xl:max-w-1/3 border-2 border-purple-500/30">
                    <div class="relative">
                        <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                        <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>

                        <div class="px-6 py-5 border-b-2 border-purple-500/20">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-heading text-text" id="modal-title">
                                    {{ $this->userReview ? 'Edit Your Review' : 'Write a Review' }}
                                </h3>
                                <button wire:click="closeReviewModal" class="text-text/60 hover:text-text transition-colors">
                                    <i class="fa-solid fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <div class="px-6 py-5">
                            <form wire:submit="submitReview">
                                {{-- Rating --}}
                                <div class="mb-5">
                                    <label class="block text-sm font-heading text-text mb-2">Rating</label>
                                    <div class="flex items-center gap-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" wire:click="$set('reviewRating', {{ $i }})" class="text-3xl transition-colors {{ $reviewRating >= $i ? 'text-yellow-500' : 'text-gray-300 dark:text-gray-600' }} hover:text-yellow-500">
                                                <i class="fa-solid fa-star"></i>
                                            </button>
                                        @endfor
                                        <span class="ml-2 text-text font-serif">{{ $reviewRating }} {{ str('star')->plural($reviewRating) }}</span>
                                    </div>
                                    @error('reviewRating') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                {{-- Review Content --}}
                                <div class="mb-5">
                                    <label for="reviewContent" class="block text-sm font-heading text-text mb-2">Your Review</label>
                                    <textarea
                                        wire:model="reviewContent"
                                        id="reviewContent"
                                        rows="5"
                                        class="w-full px-4 py-2 border-2 border-purple-500/30 rounded-sm bg-white dark:bg-accent/20 text-text focus:border-purple-500 focus:outline-none font-serif"
                                        placeholder="Share your thoughts about this book..."
                                    ></textarea>
                                    <p class="mt-1 text-sm text-text/60">Minimum 10 characters, maximum 1000 characters</p>
                                    @error('reviewContent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                {{-- Actions --}}
                                <div class="flex justify-end gap-3">
                                    <button type="button" wire:click="closeReviewModal" class="px-4 py-2 border-2 border-purple-500/30 text-text font-serif rounded-sm hover:bg-purple-500/10 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="submit" wire:loading.attr="disabled" class="relative px-6 py-2 bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif rounded-sm border-2 border-purple-500/50 transition-colors">
                                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                        <span wire:loading.remove wire:target="submitReview">{{ $this->userReview ? 'Update Review' : 'Submit Review' }}</span>
                                        <span wire:loading wire:target="submitReview">
                                            <i class="fa-solid fa-spinner fa-spin mr-2"></i>Submitting...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
