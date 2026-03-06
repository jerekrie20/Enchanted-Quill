<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Page Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-(--breakpoint-xl) mx-auto px-4 py-8 lg:py-12">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-8 h-8 text-purple-500 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading">My Content</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Manage your volumes and chronicles"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-purple-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-violet-400/50"></div>
                    <div class="h-px w-8 bg-purple-500/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Quick Stats --}}
    <section class="pb-8 max-w-(--breakpoint-xl) mx-auto px-4" aria-labelledby="stats-heading">
        <h2 id="stats-heading" class="sr-only">Content Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" role="list">
            {{-- Total Books --}}
            <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-lg transition-all duration-300" role="listitem" aria-label="Total volumes statistic">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-text/60 font-serif">Total Volumes</p>
                        <p class="text-3xl font-heading text-text mt-1" aria-label="{{ $booksCount }} total volumes">{{ $booksCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center border border-purple-500/20" aria-hidden="true">
                        <i class="fa-solid fa-book text-purple-600 dark:text-violet-400 text-xl"></i>
                    </div>
                </div>
            </article>

            {{-- Published Books --}}
            <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-lg transition-all duration-300" role="listitem" aria-label="Published volumes statistic">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-text/60 font-serif">Published Volumes</p>
                        <p class="text-3xl font-heading text-text mt-1" aria-label="{{ $publishedBooks }} published volumes">{{ $publishedBooks }}</p>
                    </div>
                    <div class="w-12 h-12 bg-violet-500/10 rounded-full flex items-center justify-center border border-violet-500/20" aria-hidden="true">
                        <i class="fa-solid fa-check-circle text-violet-600 dark:text-violet-400 text-xl"></i>
                    </div>
                </div>
            </article>

            {{-- Total Chronicles --}}
            <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-lg transition-all duration-300" role="listitem" aria-label="Total chronicles statistic">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-text/60 font-serif">Total Chronicles</p>
                        <p class="text-3xl font-heading text-text mt-1" aria-label="{{ $blogsCount }} total chronicles">{{ $blogsCount }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center border border-purple-500/20" aria-hidden="true">
                        <i class="fa-solid fa-scroll text-purple-600 dark:text-violet-400 text-xl"></i>
                    </div>
                </div>
            </article>

            {{-- Published Chronicles --}}
            <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-lg transition-all duration-300" role="listitem" aria-label="Published chronicles statistic">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-text/60 font-serif">Published Chronicles</p>
                        <p class="text-3xl font-heading text-text mt-1" aria-label="{{ $publishedBlogs }} published chronicles">{{ $publishedBlogs }}</p>
                    </div>
                    <div class="w-12 h-12 bg-violet-500/10 rounded-full flex items-center justify-center border border-violet-500/20" aria-hidden="true">
                        <i class="fa-solid fa-check-circle text-violet-600 dark:text-violet-400 text-xl"></i>
                    </div>
                </div>
            </article>
        </div>
    </section>

    {{-- My Volumes Section --}}
    <section class="py-8 border-t-2 border-purple-500/20" aria-labelledby="volumes-heading">
        <div class="max-w-(--breakpoint-xl) mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-book text-purple-500"></i>
                    </div>
                    <h2 id="volumes-heading" class="text-2xl font-heading text-text">My Volumes</h2>
                </div>
                <a href="{{ route('book.manage', 'create') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" aria-label="Create new volume">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    <i class="fa-solid fa-plus" aria-hidden="true"></i> New Volume
                </a>
            </div>

            @if($recentBooks->count() > 0)
                <div class="space-y-4" role="list" aria-label="Recent volumes">
                    @foreach($recentBooks as $book)
                        <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-purple-500/20 hover:border-purple-500 hover:shadow-lg dark:hover:shadow-purple-500/10 transition-all duration-300" role="listitem">
                            <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-heading text-text">{{ $book->title }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-sm font-serif border
                                            @if($book->status == App\Models\Book::STATUS_PUBLISHED) bg-violet-500/20 text-violet-700 dark:text-violet-300 border-violet-500/30
                                            @elseif($book->status == App\Models\Book::STATUS_DRAFT) bg-purple-500/20 text-purple-700 dark:text-violet-300 border-purple-500/30
                                            @else bg-text/20 text-text border-text/30
                                            @endif" aria-label="Status: {{ $book->status_label }}">
                                            {{ $book->status_label }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-6 text-sm text-text/60 font-serif" role="list" aria-label="Volume metadata">
                                        <span role="listitem" aria-label="{{ $book->chapters_count }} {{ str('chapter')->plural($book->chapters_count) }}"><i class="fa-solid fa-book-open mr-1" aria-hidden="true"></i> {{ $book->chapters_count }} {{ str('chapter')->plural($book->chapters_count) }}</span>
                                        <span role="listitem" aria-label="{{ $book->reviews_count }} {{ str('review')->plural($book->reviews_count) }}"><i class="fa-solid fa-star mr-1" aria-hidden="true"></i> {{ $book->reviews_count }} {{ str('review')->plural($book->reviews_count) }}</span>
                                        <span role="listitem" aria-label="Updated {{ $book->updated_at->diffForHumans() }}"><i class="fa-solid fa-clock mr-1" aria-hidden="true"></i> Updated {{ $book->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <nav class="flex items-center gap-2" aria-label="Volume actions for {{ $book->title }}">
                                    <a href="{{ route('book.manage', $book->id) }}" wire:navigate class="px-4 py-2 bg-purple-500/10 hover:bg-purple-500/20 text-purple-700 dark:text-violet-300 rounded-sm font-serif transition-colors border border-purple-500/20" aria-label="Edit {{ $book->title }}">
                                        <i class="fa-solid fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="{{ route('chapters.list', $book->id) }}" wire:navigate class="px-4 py-2 bg-violet-500/10 hover:bg-violet-500/20 text-violet-700 dark:text-violet-300 rounded-sm font-serif transition-colors border border-violet-500/20" aria-label="View chapters of {{ $book->title }}">
                                        <i class="fa-solid fa-list" aria-hidden="true"></i> Chapters
                                    </a>
                                </nav>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('admin.books') }}" wire:navigate class="text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 font-serif transition-colors" aria-label="View all volumes">
                        View All Volumes <i class="fa-solid fa-arrow-right ml-1" aria-hidden="true"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm rounded-sm border-2 border-purple-500/20" role="region" aria-label="Empty state for volumes">
                    <i class="fa-solid fa-book text-6xl text-purple-500/20 mb-4" aria-hidden="true"></i>
                    <p class="text-text font-heading text-lg mb-2">No volumes yet</p>
                    <p class="text-text/60 font-serif mb-4">Start your writing journey today!</p>
                    <a href="{{ route('book.manage', 'create') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" aria-label="Create your first volume">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Create Your First Volume
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- My Chronicles Section --}}
    <section class="py-8 border-t-2 border-purple-500/20" aria-labelledby="chronicles-heading">
        <div class="max-w-(--breakpoint-xl) mx-auto px-4">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-scroll text-purple-500"></i>
                    </div>
                    <h2 id="chronicles-heading" class="text-2xl font-heading text-text">My Chronicles</h2>
                </div>
                <a href="{{ route('blog.manage', 'create') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" aria-label="Create new chronicle">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    <i class="fa-solid fa-plus" aria-hidden="true"></i> New Chronicle
                </a>
            </div>

            @if($recentBlogs->count() > 0)
                <div class="space-y-4" role="list" aria-label="Recent chronicles">
                    @foreach($recentBlogs as $blog)
                        <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm p-6 border-2 border-purple-500/20 hover:border-purple-500 hover:shadow-lg dark:hover:shadow-purple-500/10 transition-all duration-300" role="listitem">
                            <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-xl font-heading text-text">{{ $blog->title }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-sm font-serif border
                                            @if($blog->status == App\Models\Blog::STATUS_PUBLISHED) bg-violet-500/20 text-violet-700 dark:text-violet-300 border-violet-500/30
                                            @elseif($blog->status == App\Models\Blog::STATUS_DRAFT) bg-purple-500/20 text-purple-700 dark:text-violet-300 border-purple-500/30
                                            @elseif($blog->status == App\Models\Blog::STATUS_PRIVATE) bg-text/20 text-text border-text/30
                                            @else bg-text/20 text-text border-text/30
                                            @endif" aria-label="Status: {{ $blog->status_label }}">
                                            {{ $blog->status_label }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-6 text-sm text-text/60 font-serif" role="list" aria-label="Chronicle metadata">
                                        <span role="listitem" aria-label="Updated {{ $blog->updated_at->diffForHumans() }}"><i class="fa-solid fa-clock mr-1" aria-hidden="true"></i> Updated {{ $blog->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <nav class="flex items-center gap-2" aria-label="Chronicle actions for {{ $blog->title }}">
                                    <a href="{{ route('blog.manage', $blog->id) }}" wire:navigate class="px-4 py-2 bg-purple-500/10 hover:bg-purple-500/20 text-purple-700 dark:text-violet-300 rounded-sm font-serif transition-colors border border-purple-500/20" aria-label="Edit {{ $blog->title }}">
                                        <i class="fa-solid fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                </nav>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('blogs') }}" wire:navigate class="text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 font-serif transition-colors" aria-label="View all chronicles">
                        View All Chronicles <i class="fa-solid fa-arrow-right ml-1" aria-hidden="true"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm rounded-sm border-2 border-purple-500/20" role="region" aria-label="Empty state for chronicles">
                    <i class="fa-solid fa-scroll text-6xl text-purple-500/20 mb-4" aria-hidden="true"></i>
                    <p class="text-text font-heading text-lg mb-2">No chronicles yet</p>
                    <p class="text-text/60 font-serif mb-4">Share your thoughts with the world!</p>
                    <a href="{{ route('blog.manage', 'create') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-3 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" aria-label="Create your first chronicle">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Create Your First Chronicle
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
