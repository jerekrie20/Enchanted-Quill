<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Chapter Header --}}
    <header class="bg-navbg relative py-8 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-4xl mx-auto px-4">
            {{-- Book Info --}}
            <nav class="mb-4" aria-label="Breadcrumb">
                <a href="{{ route('portal.book.show', $this->book->id) }}" wire:navigate class="text-white/80 hover:text-violet-400 font-serif text-sm transition-colors inline-flex items-center gap-2" aria-label="Return to {{ $this->book->title }} book page">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to {{ $this->book->title }}
                </a>
            </nav>

            {{-- Chapter Title --}}
            <div class="text-center">
                <span class="text-violet-400 font-serif text-sm uppercase tracking-wider">Chapter {{ $this->chapterNumber }}</span>
                <h1 class="text-3xl md:text-4xl font-heading text-white mt-2" id="chapter-title">{{ $this->chapter->title }}</h1>
                <p class="text-white/60 font-serif text-sm mt-2">by {{ $this->book->author->name }}</p>
            </div>
        </div>
    </header>

    {{-- Chapter Content --}}
    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            {{-- Reading Settings Bar --}}
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-4 rounded-sm mb-8">
                <div class="flex items-center justify-end gap-4">
                    <button class="text-text/60 hover:text-purple-600 dark:hover:text-violet-400 transition-colors" title="Adjust font size" aria-label="Adjust font size">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                    <button class="text-text/60 hover:text-purple-600 dark:hover:text-violet-400 transition-colors" title="Toggle theme" aria-label="Toggle reading theme">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                    </button>
                    <button class="text-text/60 hover:text-purple-600 dark:hover:text-violet-400 transition-colors" title="Bookmark" aria-label="Bookmark this chapter">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Chapter Content --}}
            <article class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="prose prose-lg max-w-none text-text/90 font-serif leading-relaxed" aria-labelledby="chapter-title">
                    {!! $this->chapter->content !!}
                </div>
            </article>

            {{-- Chapter Navigation --}}
            <nav class="mt-12 pt-8 border-t-2 border-purple-500/20" aria-label="Chapter navigation">
                <div class="flex items-center justify-between gap-4">
                    @if($this->previousChapter)
                        <a href="{{ route('portal.chapter.read', ['bookId' => $this->bookId, 'chapterNumber' => $this->previousChapter->chapter_number]) }}" wire:navigate class="group flex-1 relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden p-6" aria-label="Previous chapter: {{ $this->previousChapter->title }}">
                            <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8 text-purple-500/50 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <div class="text-left">
                                    <span class="text-sm text-text/60 font-serif block">Previous</span>
                                    <span class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors">Chapter {{ $this->previousChapter->chapter_number }}: {{ $this->previousChapter->title }}</span>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="flex-1"></div>
                    @endif

                    @if($this->nextChapter)
                        <a href="{{ route('portal.chapter.read', ['bookId' => $this->bookId, 'chapterNumber' => $this->nextChapter->chapter_number]) }}" wire:navigate class="group flex-1 relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-violet-400/30 dark:border-violet-400/20 hover:border-violet-500 hover:shadow-xl dark:hover:shadow-violet-500/10 transition-all duration-500 overflow-hidden p-6" aria-label="Next chapter: {{ $this->nextChapter->title }}">
                            <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>
                            <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-violet-400/50"></div>
                            <div class="flex items-center justify-end gap-4">
                                <div class="text-right">
                                    <span class="text-sm text-text/60 font-serif block">Next</span>
                                    <span class="text-lg font-heading text-text group-hover:text-violet-600 dark:group-hover:text-violet-300 transition-colors">Chapter {{ $this->nextChapter->chapter_number }}: {{ $this->nextChapter->title }}</span>
                                </div>
                                <svg class="w-8 h-8 text-violet-400/50 group-hover:text-violet-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    @else
                        <div class="flex-1"></div>
                    @endif
                </div>

                {{-- Back to Book --}}
                <div class="text-center mt-8">
                    <a href="{{ route('portal.book.show', $this->book->id) }}" wire:navigate class="relative inline-flex items-center gap-2 px-6 py-3 bg-purple-500/10 hover:bg-purple-500/20 text-purple-700 dark:text-violet-300 rounded-sm font-serif transition-colors duration-300 border-2 border-purple-500/30" aria-label="View all chapters of {{ $this->book->title }}">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-purple-500/50"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-purple-500/50"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        View All Chapters
                    </a>
                </div>
            </nav>
        </div>
    </main>

    {{-- Comments Section --}}
    <section class="py-12 border-t-2 border-purple-500/20">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-heading text-text mb-6 text-center" id="comments-heading">Chapter Comments</h2>
            <div class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm">
                <svg class="w-16 h-16 text-purple-500/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="text-text/60 font-serif">Comments coming soon!</p>
            </div>
        </div>
    </section>
</div>
