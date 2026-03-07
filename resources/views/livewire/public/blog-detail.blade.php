<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Blog Header --}}
    <header class="bg-navbg relative py-8 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-4xl mx-auto px-4">
            {{-- Back Link --}}
            <nav class="mb-6" aria-label="Breadcrumb">
                <a href="{{ route('blog') }}" wire:navigate class="text-white/80 hover:text-violet-400 font-serif text-sm transition-colors inline-flex items-center gap-2" aria-label="Return to Blog list">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to Blog
                </a>
            </nav>

            {{-- Blog Title and Meta --}}
            <div class="text-center">
                <h1 id="blog-title" class="text-3xl md:text-4xl font-heading text-white mb-4">{{ $blog->title }}</h1>

                <div class="flex items-center justify-center gap-6 text-white/80 font-serif text-sm" role="contentinfo" aria-label="Article metadata">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        <span class="sr-only">Author:</span>
                        <span class="text-violet-400">{{ $blog->user->name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                        <span class="sr-only">Updated on:</span>
                        <time datetime="{{ $blog->updated_at->toIso8601String() }}">{{ $blog->updated_at->format('M d, Y') }}</time>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock" aria-hidden="true"></i>
                        <span class="sr-only">Reading time:</span>
                        <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                    </div>
                </div>

                {{-- Categories --}}
                @if($blog->categories->count() > 0)
                    <div class="flex flex-wrap justify-center gap-2 mt-4" role="list" aria-label="Article categories">
                        @foreach($blog->categories as $category)
                            <span class="px-3 py-1 bg-purple-500/20 text-white border border-purple-500/30 rounded-full text-sm font-serif" role="listitem">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </header>

    {{-- Featured Image --}}
    @if($blog->image)
        <section class="py-8 bg-gradient-to-b from-lightGray/10 to-transparent dark:from-accent/10" aria-label="Featured image">
            <div class="max-w-full sm:max-w-1/2 lg:max-w-1/3 xl:max-w-1/4 mx-auto px-4">
                <div class="relative">
                    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                    <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>
                    <img src="{{ asset('blogs/' . $blog->image) }}" alt="Featured image for {{ $blog->title }}" class="w-full rounded-none shadow-2xl border-2 border-purple-500/20">
                </div>
            </div>
        </section>
    @endif

    {{-- Blog Content --}}
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <article class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm mb-12">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="prose prose-lg max-w-none text-text/90 font-serif leading-relaxed" aria-labelledby="blog-title">
                    {!! $blog->content !!}
                </div>
            </article>

            {{-- Author Bio --}}
            <aside class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm mb-12" aria-label="About the author">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 bg-purple-500/10 rounded-full flex items-center justify-center flex-shrink-0 border-2 border-purple-500/20">
                        @if($blog->user->profile_image)
                            <img src="{{ asset('storage/' . $blog->user->profile_image) }}" alt="Profile picture of {{ $blog->user->name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <i class="fa-solid fa-user text-2xl text-purple-600 dark:text-violet-400" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-heading text-text mb-2">About the Author</h3>
                        <p class="text-lg font-heading text-text/80">{{ $blog->user->name }}</p>
                        @if($blog->user->bio)
                            <p class="text-text/70 font-serif mt-2">{{ $blog->user->bio }}</p>
                        @endif
                    </div>
                </div>
            </aside>

            {{-- Comments Section --}}
            <section class="border-t-2 border-purple-500/20 pt-12" aria-label="Comments section">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-comments text-purple-500" aria-hidden="true"></i>
                    </div>
                    <h2 class="text-2xl font-heading text-text">Comments</h2>
                </div>

                @guest
                    <div class="text-center py-8 bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm border-2 border-purple-500/20 mb-8" role="alert">
                        <p class="text-text/60 font-serif">
                            <a href="{{ route('login') }}" class="text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 transition-colors">Sign in</a> to join the discussion
                        </p>
                    </div>
                @endguest

                @if($comments->count() > 0)
                    <div class="space-y-6">
                        @foreach($comments as $comment)
                            <div
                                class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm">
                                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                                <div
                                    class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                                <div
                                    class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-purple-500/50"></div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-purple-500/50"></div>

                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center flex-shrink-0 border-2 border-purple-500/20">
                                        @if($comment->user->profile_image)
                                            <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                                 alt="Profile picture of {{ $comment->user->name }}"
                                                 class="w-full h-full rounded-full object-cover">
                                        @else
                                            <i class="fa-solid fa-user text-xl text-purple-600 dark:text-violet-400"
                                               aria-hidden="true"></i>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-3 mb-2">
                                            <a href="{{ route('portal.profile', $comment->user->id) }}" wire:navigate
                                               class="font-heading text-text dark:text-white hover:text-purple-600 dark:hover:text-violet-400 transition-colors"
                                               aria-label="View profile of {{ $comment->user->name }}">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span class="text-text/50 dark:text-white/50 text-sm font-serif">•</span>
                                            <time class="text-text/60 dark:text-white/60 text-sm font-serif"
                                                  datetime="{{ $comment->updated_at->toIso8601String() }}">
                                                {{ $comment->updated_at->diffForHumans() }}
                                            </time>
                                        </div>
                                        <div
                                            class="text-text/80 dark:text-white/80 font-serif leading-relaxed break-words">
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="text-center py-12 bg-white/60 dark:bg-accent/20 backdrop-blur-sm rounded-sm border-2 border-purple-500/20"
                        role="status">
                        <i class="fa-solid fa-comments text-6xl text-purple-500/20 dark:text-violet-400/20 mb-4"
                           aria-hidden="true"></i>
                        <p class="text-text/60 dark:text-white/60 font-serif">No Comments Yet!</p>
                    </div>
                @endif
            </section>
        </div>
    </section>
</div>
