<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Readers' Verdicts</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Manage the thoughtful critiques and star-marked opinions from our distinguished readers"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-primary/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-secondary/50"></div>
                    <div class="h-px w-8 bg-primary/30"></div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
        {{-- Search & Filter Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-secondary/10 dark:bg-secondary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Search & Filter Reviews</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <input type="text" name="search" id="search" placeholder="Search reviews, users, or books..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="filterBook" id="filterBook"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="filterBook">
                    <option value="">All Books</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>

                <select name="filterUser" id="filterUser"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="filterUser">
                    <option value="">All Reviewers</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                <select name="filterRating" id="filterRating"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="filterRating">
                    <option value="">All Ratings</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>

                <select name="perPage" id="perPage"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="perPage">
                    <option value="15">15 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>

                <select name="sort" id="sort"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="sort">
                    <option value="desc">Newest First</option>
                    <option value="asc">Oldest First</option>
                </select>
            </div>
        </section>

        {{-- Pagination Top --}}
        <div class="flex justify-center">
            {{ $reviews->links() }}
        </div>

        {{-- Reviews List --}}
        <section class="space-y-4">
            @forelse($reviews as $review)
                <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm border-2 border-text/10 hover:border-primary dark:hover:border-secondary hover:shadow-xl transition-all duration-500 overflow-hidden">
                    {{-- Corner ornaments --}}
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="p-6 space-y-4">
                        {{-- Review Header --}}
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3 flex-1">
                                {{-- User Avatar --}}
                                <div class="w-12 h-12 rounded-full bg-primary/10 dark:bg-primary/20 border-2 border-primary/30 flex items-center justify-center flex-shrink-0">
                                    <span class="text-lg font-heading font-bold text-primary">{{ substr($review->user->name, 0, 1) }}</span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="font-heading text-base text-text truncate">
                                        {{$review->user->name}}
                                    </h3>
                                    <p class="text-sm text-text/60 dark:text-text/70 font-serif">
                                        Reviewed
                                        <a href="{{route('book.manage', $review->book->id)}}" class="text-secondary hover:text-primary transition-colors">
                                            "{{$review->book->title}}"
                                        </a>
                                    </p>
                                    <p class="text-xs text-text/50 font-serif mt-1">
                                        {{ $review->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- Rating & Actions --}}
                            <div class="flex items-center gap-3 flex-shrink-0">
                                {{-- Star Rating --}}
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->stars->value ? 'text-yellow-500' : 'text-text/20' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @endfor
                                    <span class="ml-2 text-sm font-heading text-text">{{ $review->stars->value }}/5</span>
                                </div>

                                {{-- Delete Button --}}
                                <button type="button"
                                        wire:click="delete({{$review->id}})"
                                        wire:confirm="Are you sure you want to delete this review?"
                                        class="relative px-4 py-2 font-serif text-sm text-danger bg-danger/10 hover:bg-danger/20 border-2 border-danger/50 rounded-sm transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Review Content --}}
                        <div class="pl-15 pt-4 border-t border-text/10">
                            <p class="text-text/80 dark:text-text/90 font-serif leading-relaxed">
                                {{$review->content}}
                            </p>
                        </div>

                        {{-- Review Meta --}}
                        <div class="flex items-center gap-4 pl-15 pt-2 text-xs text-text/50 font-serif">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Posted {{ $review->created_at->format('M j, Y \a\t g:i A') }}
                            </span>
                        </div>
                    </div>

                    {{-- Bottom corner ornaments --}}
                    <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </article>
            @empty
                <div class="text-center py-16 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-text/10 rounded-sm">
                    <svg class="w-16 h-16 mx-auto text-text/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <h3 class="text-xl font-heading text-text mb-2">No Reviews Found</h3>
                    <p class="text-text/60 font-serif">No verdicts have been rendered yet in the archives.</p>
                </div>
            @endforelse
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $reviews->links() }}
        </div>
    </main>
</div>
