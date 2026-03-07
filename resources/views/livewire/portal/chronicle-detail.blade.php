<div
    class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Chronicle Header --}}
    <header class="bg-navbg relative py-8 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-4xl mx-auto px-4">
            {{-- Back Link --}}
            <nav class="mb-6" aria-label="Breadcrumb">
                <a href="{{ route('portal.chronicles') }}" wire:navigate
                   class="text-white/80 hover:text-violet-400 font-serif text-sm transition-colors inline-flex items-center gap-2"
                   aria-label="Return to Chronicles list">
                    <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to Chronicles
                </a>
            </nav>

            {{-- Chronicle Title and Meta --}}
            <div class="text-center">
                <h1 id="chronicle-title"
                    class="text-3xl md:text-4xl font-heading text-white mb-4">{{ $chronicle->title }}</h1>

                <div class="flex items-center justify-center gap-6 text-white/80 font-serif text-sm" role="contentinfo"
                     aria-label="Article metadata">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                        <span class="sr-only">Author:</span>
                        <a href="{{ route('portal.profile', $chronicle->user->id) }}" wire:navigate
                           class="hover:text-violet-400 transition-colors"
                           aria-label="View profile of {{ $chronicle->user->name }}">
                            {{ $chronicle->user->name }}
                        </a>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar" aria-hidden="true"></i>
                        <span class="sr-only">Updated on:</span>
                        <time
                            datetime="{{ $chronicle->updated_at->toIso8601String() }}">{{ $chronicle->updated_at->format('M d, Y') }}</time>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock" aria-hidden="true"></i>
                        <span class="sr-only">Reading time:</span>
                        <span>{{ ceil(str_word_count(strip_tags($chronicle->content)) / 200) }} min read</span>
                    </div>
                </div>

                {{-- Categories --}}
                @if($chronicle->categories->count() > 0)
                    <div class="flex flex-wrap justify-center gap-2 mt-4" role="list" aria-label="Article categories">
                        @foreach($chronicle->categories as $category)
                            <span
                                class="px-3 py-1 bg-purple-500/20 text-white border border-purple-500/30 rounded-full text-sm font-serif"
                                role="listitem">{{ $category->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </header>

    {{-- Featured Image --}}
    @if($chronicle->image)
        <section class="py-8 bg-gradient-to-b from-lightGray/10 to-transparent dark:from-accent/10"
                 aria-label="Featured image">
            <div class="max-w-1/6 mx-auto px-4">
                <div class="relative">
                    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                    <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>
                    <img src="{{ asset('blogs/' . $chronicle->image) }}"
                         alt="Featured image for {{ $chronicle->title }}"
                         class="w-full rounded-none shadow-2xl border-2 border-purple-500/20">
                </div>
            </div>
        </section>
    @endif

    {{-- Chronicle Content --}}
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <article
                class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm mb-12">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div
                    class="prose prose-lg dark:prose-invert max-w-none text-text/90 dark:text-white/90 font-serif leading-relaxed"
                    aria-labelledby="chronicle-title">
                    {!! $chronicle->content !!}
                </div>
            </article>

            {{-- Share and Actions --}}
            <div
                class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm mb-12">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4" role="group" aria-label="Share this article">
                        <span class="text-text/60 dark:text-white/60 font-serif text-sm" id="share-label">Share this chronicle:</span>
                        <button
                            class="w-10 h-10 bg-purple-500/10 hover:bg-purple-500/20 text-purple-600 dark:text-violet-400 rounded-full flex items-center justify-center transition-colors border border-purple-500/20"
                            aria-label="Share on Twitter">
                            <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                        </button>
                        <button
                            class="w-10 h-10 bg-purple-500/10 hover:bg-purple-500/20 text-purple-600 dark:text-violet-400 rounded-full flex items-center justify-center transition-colors border border-purple-500/20"
                            aria-label="Share on Facebook">
                            <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                        </button>
                        <button
                            class="w-10 h-10 bg-purple-500/10 hover:bg-purple-500/20 text-purple-600 dark:text-violet-400 rounded-full flex items-center justify-center transition-colors border border-purple-500/20"
                            aria-label="Share on LinkedIn">
                            <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                        </button>
                        <button
                            class="w-10 h-10 bg-purple-500/10 hover:bg-purple-500/20 text-purple-600 dark:text-violet-400 rounded-full flex items-center justify-center transition-colors border border-purple-500/20"
                            aria-label="Copy link to clipboard">
                            <i class="fa-solid fa-link" aria-hidden="true"></i>
                        </button>
                    </div>
                    @auth
                        <button
                            class="relative px-4 py-2 bg-violet-500/10 hover:bg-violet-500/20 text-violet-600 dark:text-violet-300 rounded-sm font-serif transition-colors inline-flex items-center gap-2 border border-violet-500/30"
                            aria-label="Save this article to your bookmarks">
                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-violet-500/50"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-violet-500/50"></span>
                            <i class="fa-solid fa-bookmark" aria-hidden="true"></i> Save
                        </button>
                    @endauth
                </div>
            </div>

            {{-- Author Bio --}}
            <aside
                class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm"
                aria-label="About the author">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="flex items-start gap-4">
                    <div
                        class="w-16 h-16 bg-purple-500/10 rounded-full flex items-center justify-center flex-shrink-0 border-2 border-purple-500/20">
                        @if($chronicle->user->profile_image)
                            <img src="{{ asset('storage/' . $chronicle->user->profile_image) }}"
                                 alt="Profile picture of {{ $chronicle->user->name }}"
                                 class="w-full h-full rounded-full object-cover">
                        @else
                            <i class="fa-solid fa-user text-2xl text-purple-600 dark:text-violet-400"
                               aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-heading text-text dark:text-white mb-2">About the Author</h3>
                        <p class="text-lg font-heading text-text/80 dark:text-white/80">
                            <a href="{{ route('portal.profile', $chronicle->user->id) }}" wire:navigate
                               class="hover:text-purple-600 dark:hover:text-violet-400 transition-colors"
                               aria-label="View full profile of {{ $chronicle->user->name }}">
                                {{ $chronicle->user->name }}
                            </a>
                        </p>
                        @if($chronicle->user->bio)
                            <p class="text-text/70 dark:text-white/70 font-serif mt-2">{{ $chronicle->user->bio }}</p>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </section>

    {{-- Comments Section (Future Implementation) --}}
    <section class="py-12 border-t-2 border-purple-500/20" aria-label="Comments section">
        <div class="max-w-4xl mx-auto px-4">
            <x-alerts.success/>
            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-comments text-purple-500 dark:text-violet-400" aria-hidden="true"></i>
                </div>
                <h2 class="text-2xl font-heading text-text dark:text-white">Comments</h2>
            </div>

            @auth
                <div
                    class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm mb-8">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                    <form wire:submit="leaveComment">
                        <label for="comment-input" class="sr-only">Write your comment</label>
                        <textarea wire:model="reviewContent" id="comment-input" placeholder="Share your thoughts..."
                                  class="w-full px-4 py-3 bg-white dark:bg-navbg/40 border-2 border-text/10 dark:border-purple-500/30 rounded-sm focus:border-purple-500 dark:focus:border-violet-400 focus:outline-none text-text dark:text-white font-serif transition-colors"
                                  rows="4" aria-label="Comment text area"></textarea>
                        @error('reviewContent') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        <small class="text-text/60 dark:text-white/60 text-sm font-serif mt-2">
                            * Your comment will be visible to everyone. <br>
                            ** If you have a comment already published, it will be updated instead.
                        </small>
                        <div class="mt-3 flex justify-end">
                            <button type="submit"
                                    class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 border border-violet-500/50"
                                    aria-label="Post your comment">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div
                    class="text-center py-8 bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm border-2 border-purple-500/20 mb-8"
                    role="alert">
                    <p class="text-text/60 dark:text-white/60 font-serif">
                        <a href="{{ route('login') }}"
                           class="text-purple-600 dark:text-violet-400 hover:text-purple-700 dark:hover:text-violet-300 transition-colors">Sign
                            in</a> to join the discussion
                    </p>
                </div>
            @endauth

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
        </div>
    </section>
</div>
