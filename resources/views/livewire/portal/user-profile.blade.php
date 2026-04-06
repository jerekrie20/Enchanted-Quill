<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Profile Header --}}
    <section class="bg-navbg relative py-12 border-b-2 border-purple-500/20" aria-labelledby="profile-heading">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-(--breakpoint-xl) mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                {{-- Profile Image --}}
                <div class="w-32 h-32 bg-purple-500/10 rounded-full flex items-center justify-center flex-shrink-0 border-4 border-purple-500/30" role="img" aria-label="Profile picture for {{ $this->user->name }}">
                    @if($this->user->profile_image)
                        <img src="{{ asset('storage/' . $this->user->profile_image) }}" alt="Profile picture of {{ $this->user->name }}" class="w-full h-full rounded-full object-cover">
                    @else
                        <i class="fa-solid fa-user text-6xl text-purple-500 dark:text-violet-400" aria-hidden="true"></i>
                    @endif
                </div>

                {{-- Profile Info --}}
                <div class="flex-1 text-center md:text-left">
                    <h1 id="profile-heading" class="text-3xl md:text-4xl font-heading text-white mb-2">{{ $this->user->name }}</h1>

                    @if($this->user->role === 'author' || $this->user->role === 'admin')
                        <span class="inline-block px-3 py-1 bg-violet-500/20 text-violet-300 border border-violet-400/30 rounded-full text-sm font-serif mb-4" role="status" aria-label="User role: Author">
                            <i class="fa-solid fa-feather-pointed mr-1" aria-hidden="true"></i> Author
                        </span>
                    @endif

                    @if($this->user->bio)
                        <p class="text-white/80 font-serif text-lg">{{ $this->user->bio }}</p>
                    @endif

                    {{-- Active Title & Vocation --}}
                    <div class="flex items-center gap-2 flex-wrap mt-2">
                        @if($this->user->active_title)
                            <span class="text-violet-300 font-serif text-sm italic">{{ $this->user->active_title }}</span>
                        @endif
                        @if($this->user->vocation)
                            <span class="px-2 py-0.5 bg-amber-500/10 text-amber-400 border border-amber-500/30 text-xs font-serif rounded-full"
                                  title="{{ $this->user->vocation->bonus_description }}">
                                <i class="fa-solid fa-hat-wizard mr-1" aria-hidden="true"></i>{{ $this->user->vocation->name }}
                            </span>
                        @endif
                        @if($this->user->ink_total > 0)
                            <span class="px-2 py-0.5 bg-purple-500/10 text-purple-300 border border-purple-500/20 text-xs font-serif rounded-full"
                                  title="{{ number_format($this->user->ink_total) }} Ink">
                                <i class="fa-solid fa-droplet mr-1" aria-hidden="true"></i>{{ $this->user->inkTierLabel() }}
                            </span>
                        @endif
                    </div>

                    {{-- Stats --}}
                    <div class="flex items-center justify-center md:justify-start gap-6 mt-6 text-white/80 font-serif" role="list" aria-label="User statistics">
                        <div role="listitem" aria-label="{{ $this->publishedBooks->count() }} published {{ str('volume')->plural($this->publishedBooks->count()) }}">
                            <span class="text-2xl font-heading text-white block">{{ $this->publishedBooks->count() }}</span>
                            <span class="text-sm">{{ str('Volume')->plural($this->publishedBooks->count()) }}</span>
                        </div>
                        <div class="w-px h-8 bg-white/20" aria-hidden="true"></div>
                        <div role="listitem" aria-label="{{ $this->publishedChronicles->count() }} published {{ str('chronicle')->plural($this->publishedChronicles->count()) }}">
                            <span class="text-2xl font-heading text-white block">{{ $this->publishedChronicles->count() }}</span>
                            <span class="text-sm">{{ str('Chronicle')->plural($this->publishedChronicles->count()) }}</span>
                        </div>
                        <div class="w-px h-8 bg-white/20" aria-hidden="true"></div>
                        <div role="listitem" aria-label="{{ $this->user->followers()->count() }} followers">
                            <span class="text-2xl font-heading text-white block">{{ $this->user->followers()->count() }}</span>
                            <span class="text-sm">{{ str('Follower')->plural($this->user->followers()->count()) }}</span>
                        </div>
                        <div class="w-px h-8 bg-white/20" aria-hidden="true"></div>
                        <div role="listitem" aria-label="{{ number_format($this->user->ink_total) }} Ink earned">
                            <span class="text-2xl font-heading text-white block">{{ number_format($this->user->ink_total) }}</span>
                            <span class="text-sm">Ink Earned</span>
                        </div>
                        <div class="w-px h-8 bg-white/20" aria-hidden="true"></div>
                        <div role="listitem" aria-label="Member since {{ $this->user->created_at->format('Y') }}">
                            <span class="text-2xl font-heading text-white block">{{ $this->user->created_at->format('Y') }}</span>
                            <span class="text-sm">Member Since</span>
                        </div>
                    </div>

                    @if(auth()->check() && auth()->id() === $this->user->id)
                        <div class="mt-6">
                            <a href="{{ route('portal.settings') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" aria-label="Edit your profile settings">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <i class="fa-solid fa-cog" aria-hidden="true"></i> Edit Profile
                            </a>
                        </div>
                    @elseif(auth()->check() && ($this->user->role === 'author' || $this->user->role === 'admin'))
                        <div class="mt-6">
                            <button wire:click="toggleFollow" class="relative {{ auth()->user()->isFollowing($this->user) ? 'bg-transparent border-violet-400 text-violet-300' : 'bg-violet-600 hover:bg-violet-700 text-white' }} font-serif px-8 py-2 rounded-sm transition-all duration-300 inline-flex items-center gap-2 border-2" aria-label="{{ auth()->user()->isFollowing($this->user) ? 'Unfollow author' : 'Follow author' }}">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <i class="fa-solid {{ auth()->user()->isFollowing($this->user) ? 'fa-user-minus' : 'fa-user-plus' }}" aria-hidden="true"></i>
                                {{ auth()->user()->isFollowing($this->user) ? 'Release Pact (Unfollow)' : 'Bind Pact (Follow)' }}
                            </button>
                        </div>
                    @elseif(!auth()->check() && ($this->user->role === 'author' || $this->user->role === 'admin'))
                        <div class="mt-6">
                            <a href="{{ route('login') }}" wire:navigate class="relative bg-violet-600 hover:bg-violet-700 text-white font-serif px-8 py-2 rounded-sm transition-all duration-300 inline-flex items-center gap-2 border-2 border-violet-500/50">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <i class="fa-solid fa-user-plus" aria-hidden="true"></i> Bind Pact (Follow)
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Badge Showcase --}}
    @php $earnedBadges = $this->user->achievements()->where('type', 'badge')->get(); @endphp
    @if($earnedBadges->count() > 0)
        <section class="py-8 border-b-2 border-purple-500/20" aria-labelledby="badge-showcase-heading">
            <div class="max-w-(--breakpoint-xl) mx-auto px-4">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-full bg-amber-500/10 dark:bg-amber-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-shield-halved text-amber-500"></i>
                    </div>
                    <h2 id="badge-showcase-heading" class="text-2xl font-heading text-text">Badge Showcase</h2>
                </div>

                <div class="flex flex-wrap gap-4" role="list" aria-label="Earned badges">
                    @foreach($earnedBadges as $badge)
                        <div class="group relative flex flex-col items-center gap-2 p-4 bg-white/80 dark:bg-accent/30 border-2 border-amber-500/20 hover:border-amber-500/50 transition-all duration-300 w-28"
                             role="listitem" aria-label="{{ $badge->name }}">
                            <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-amber-500/30"></div>
                            <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-amber-500/30"></div>
                            <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-amber-500/30"></div>
                            <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-amber-500/30"></div>

                            {{-- Badge Icon (placeholder if no icon_path) --}}
                            <div class="w-14 h-14 rounded-full bg-amber-500/10 border-2 border-amber-500/30 flex items-center justify-center"
                                 role="img" aria-label="{{ $badge->name }} badge icon">
                                @if($badge->icon_path)
                                    <img src="{{ asset($badge->icon_path) }}" alt="{{ $badge->name }}" class="w-10 h-10 object-contain">
                                @else
                                    <i class="fa-solid fa-award text-2xl text-amber-500/60" aria-hidden="true"></i>
                                @endif
                            </div>
                            <span class="text-xs font-serif text-text/70 text-center leading-tight">{{ $badge->name }}</span>
                            <span class="text-xs font-serif text-text/40 italic text-center leading-tight">{{ $badge->pivot->earned_at->format('M Y') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Published Volumes --}}
    @if($this->publishedBooks->count() > 0)
        <section class="py-12" aria-labelledby="published-volumes-heading">
            <div class="max-w-(--breakpoint-xl) mx-auto px-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-book text-purple-500"></i>
                    </div>
                    <h2 id="published-volumes-heading" class="text-2xl font-heading text-text">Published Volumes</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" role="list" aria-label="List of published volumes">
                    @foreach($this->publishedBooks as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden" role="listitem">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.book.show', $book->id) }}" wire:navigate class="block" aria-label="View {{ $book->title }}">
                                @if($book->cover)
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset('books/' . $book->cover) }}" alt="Cover image for {{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-[3/4] bg-purple-500/10 flex items-center justify-center" role="img" aria-label="No cover image available for {{ $book->title }}">
                                        <i class="fa-solid fa-book text-6xl text-purple-500/30" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">{{ $book->title }}</h3>
                                    <div class="flex items-center gap-4 text-sm text-text/60 font-serif mt-2" role="list" aria-label="Book statistics">
                                        <span role="listitem" aria-label="{{ $book->chapters_count }} chapters"><i class="fa-solid fa-book-open mr-1" aria-hidden="true"></i> {{ $book->chapters_count }} chapters</span>
                                        <span role="listitem" aria-label="{{ $book->reviews_count }} reviews"><i class="fa-solid fa-star mr-1" aria-hidden="true"></i> {{ $book->reviews_count }} reviews</span>
                                    </div>
                                    <p class="text-sm text-text/60 mt-2"><time datetime="{{ $book->published_at->format('Y-m') }}">{{ $book->published_at->format('M Y') }}</time></p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Published Chronicles --}}
    @if($this->publishedChronicles->count() > 0)
        <section class="py-12 @if($this->publishedBooks->count() > 0) border-t-2 border-purple-500/20 @endif" aria-labelledby="published-chronicles-heading">
            <div class="max-w-(--breakpoint-xl) mx-auto px-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-scroll text-purple-500"></i>
                    </div>
                    <h2 id="published-chronicles-heading" class="text-2xl font-heading text-text">Recent Chronicles</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" role="list" aria-label="List of recent chronicles">
                    @foreach($this->publishedChronicles as $chronicle)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden" role="listitem">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.chronicle.show', $chronicle->id) }}" wire:navigate class="block" aria-label="View {{ $chronicle->title }}">
                                @if($chronicle->image)
                                    <div class="aspect-video overflow-hidden">
                                        <img src="{{ asset('blogs/' . $chronicle->image) }}" alt="Featured image for {{ $chronicle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-video bg-purple-500/10 flex items-center justify-center" role="img" aria-label="No featured image available for {{ $chronicle->title }}">
                                        <i class="fa-solid fa-scroll text-4xl text-purple-500/30" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">{{ $chronicle->title }}</h3>
                                    <p class="text-sm text-text/60 mt-2">
                                        @if($chronicle->publish_at)
                                            <time datetime="{{ $chronicle->publish_at->toIso8601String() }}">{{ $chronicle->publish_at->diffForHumans() }}</time>
                                        @else
                                            <time datetime="{{ $chronicle->updated_at->toIso8601String() }}">{{ $chronicle->updated_at->diffForHumans() }}</time>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Bookmarked Volumes --}}
    @if(auth()->check() && auth()->id() === $this->user->id && $this->bookmarkedBooks->count() > 0)
        <section class="py-12 @if($this->publishedBooks->count() > 0 || $this->publishedChronicles->count() > 0) border-t-2 border-purple-500/20 @endif" aria-labelledby="bookmarked-volumes-heading">
            <div class="max-w-(--breakpoint-xl) mx-auto px-4">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-bookmark text-purple-500"></i>
                    </div>
                    <h2 id="bookmarked-volumes-heading" class="text-2xl font-heading text-text">Bookmarked Volumes</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" role="list" aria-label="List of bookmarked volumes">
                    @foreach($this->bookmarkedBooks as $book)
                        <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 hover:border-purple-500 hover:shadow-xl dark:hover:shadow-purple-500/10 transition-all duration-500 overflow-hidden" role="listitem">
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                            <a href="{{ route('portal.book.show', $book->id) }}" wire:navigate class="block" aria-label="View {{ $book->title }}">
                                @if($book->cover)
                                    <div class="aspect-[3/4] overflow-hidden">
                                        <img src="{{ asset('books/' . $book->cover) }}" alt="Cover image for {{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-[3/4] bg-purple-500/10 flex items-center justify-center" role="img" aria-label="No cover image available for {{ $book->title }}">
                                        <i class="fa-solid fa-book text-6xl text-purple-500/30" aria-hidden="true"></i>
                                    </div>
                                @endif
                                <div class="p-4 relative">
                                    <h3 class="text-lg font-heading text-text group-hover:text-purple-600 dark:group-hover:text-violet-400 transition-colors line-clamp-2">{{ $book->title }}</h3>
                                    <div class="flex items-center gap-4 text-sm text-text/60 font-serif mt-2" role="list" aria-label="Book statistics">
                                        <span role="listitem" aria-label="{{ $book->chapters_count }} chapters"><i class="fa-solid fa-book-open mr-1" aria-hidden="true"></i> {{ $book->chapters_count }} chapters</span>
                                        <span role="listitem" aria-label="{{ $book->reviews_count }} reviews"><i class="fa-solid fa-star mr-1" aria-hidden="true"></i> {{ $book->reviews_count }} reviews</span>
                                    </div>
                                    <p class="text-sm text-text/60 mt-2"><time datetime="{{ $book->published_at->format('Y-m') }}">{{ $book->published_at->format('M Y') }}</time></p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Empty State --}}
    @if($this->publishedBooks->count() === 0 && $this->publishedChronicles->count() === 0 && $this->user->role !== 'reader')
        <section class="py-12" aria-labelledby="empty-state-heading">
            <div class="max-w-(--breakpoint-xl) mx-auto px-4">
                <x-general.empty-state
                    icon="fa-feather-pointed"
                    title="The Pen is Currently Resting"
                    message="This author hasn't published any volumes or chronicles yet. Check back soon for their first masterpiece!"
                />
            </div>
        </section>
    @endif
</div>
