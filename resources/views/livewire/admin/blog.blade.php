<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-secondary dark:text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Chronicles & Tales</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Manage the written narratives and stories that fill our enchanted archives"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-secondary/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-primary/50"></div>
                    <div class="h-px w-8 bg-secondary/30"></div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
        {{-- Add New Chronicle Button --}}
        <div class="flex justify-center">
            <a href="{{route('blog.manage','create')}}"
               class="relative px-8 py-3 font-serif text-sm text-white bg-secondary hover:bg-secondary/90 dark:bg-primary dark:hover:bg-primary/90 border-2 border-secondary/50 dark:border-primary/50 transition-all duration-300 group">
                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
                <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Compose New Chronicle
                </span>
            </a>
        </div>

        {{-- Search & Filters --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-secondary/20 dark:border-secondary/10 p-6 lg:p-8 rounded-sm" x-data="{ show: @entangle('show') }">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Search & Filter Archives</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="Search chronicles..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="status"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="status">
                    <option value="">All Status</option>
                    <option value="0">Draft</option>
                    <option value="1">Published</option>
                    <option value="2">Private</option>
                </select>

                <select name="perPage"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="perPage">
                    <option value="">Per Shelf</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                </select>

                <select name="sort"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="sort">
                    <option value="">Sort</option>
                    <option value="desc">Newest First</option>
                    <option value="asc">Oldest First</option>
                </select>
            </div>

            {{-- Categories Dropdown --}}
            <div class="mt-4 relative">
                <button @click="show = !show"
                        class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 hover:border-secondary dark:hover:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300 flex items-center justify-between">
                    <span>Filter by Category</span>
                    <svg class="w-5 h-5" :class="show ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div @click.away="show = false" x-show="show" x-transition
                     class="absolute left-0 right-0 mt-2 bg-white dark:bg-navbg border-2 border-secondary/20 rounded-sm shadow-xl z-50 max-h-64 overflow-y-auto">
                    <ul class="p-4 grid grid-cols-2 gap-3">
                        @foreach($categories as $category)
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="{{ $category->id }}" value="{{ $category->id }}"
                                       class="rounded border-text/20 text-secondary focus:ring-secondary"
                                       wire:model.live="category">
                                <label for="{{ $category->id }}" class="font-serif text-sm text-text cursor-pointer">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- Pagination --}}
        <div class="flex justify-center">
            {{ $blogs->links() }}
        </div>

        {{-- Chronicles Showcase Grid --}}
        <section>
            {{-- Decorative Scroll Header --}}
            <div class="relative mb-6">
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-gradient-to-r from-transparent via-secondary/30 to-secondary/30"></div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/60 dark:bg-accent/20 border-2 border-secondary/20 rounded-sm">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        <span class="font-heading text-text">The Chronicle Archives</span>
                    </div>
                    <div class="h-px flex-1 bg-gradient-to-l from-transparent via-secondary/30 to-secondary/30"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-6">
                @foreach($blogs as $blog)
                    <article class="group relative" x-data="{ showActions: false }" :class="showActions ? 'z-50' : 'z-0'">
                        {{-- Scroll/Parchment Card --}}
                        <div class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-text/10 hover:border-secondary dark:hover:border-primary rounded-sm overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-secondary/20 dark:hover:shadow-primary/20 hover:-translate-y-2">
                            {{-- Parchment-style corners --}}
                            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            {{-- Chronicle Thumbnail/Banner --}}
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-secondary/10 to-primary/10">
                                {{-- Scroll edge decoration at top --}}
                                <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-b from-secondary/20 to-transparent"></div>
                                <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30"></div>

                                {{-- Banner Image --}}
                                @if($blog->image)
                                    <img src="{{asset('blogs/' . $blog->image)}}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         alt="{{$blog->title}}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-secondary/20 to-primary/20">
                                        <svg class="w-20 h-20 text-text/20" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Overlay on hover with feather quill icon --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-accent/95 via-accent/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-end p-4 gap-2">
                                    <svg class="w-8 h-8 text-secondary/80" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                    <button @click="showActions = !showActions"
                                            class="w-full px-3 py-2 bg-secondary/90 hover:bg-secondary text-white font-serif text-xs rounded-sm transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                        Actions
                                    </button>
                                </div>

                                {{-- Status Badge --}}
                                <div
                                    x-data="{ flash: false }"
                                    x-init="@this.on('status-updated', (event) => { if (event.blogId === {{ $blog->id }}) { flash = true; setTimeout(() => flash = false, 1000); } })"
                                    :class="flash ? 'bg-secondary text-white' : ''"
                                    class="absolute top-3 right-3 px-2 py-1 rounded-sm text-xs font-semibold backdrop-blur-md transition-all duration-500
                                    @if($blog->status == 1) bg-primary/80 text-white
                                    @elseif($blog->status == 0) bg-amber-500/80 text-white
                                    @else bg-text/80 text-white @endif">
                                    {{$blog->status_label}}
                                </div>
                            </div>

                            {{-- Chronicle Content --}}
                            <div class="p-4 space-y-3">
                                <h3 class="font-heading text-base leading-tight text-text line-clamp-2 group-hover:text-secondary dark:group-hover:text-primary transition-colors duration-300 min-h-[2.5rem]">
                                    {{$blog->title}}
                                </h3>

                                <div class="flex items-center gap-2 text-xs text-text/60 dark:text-text/70">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <p class="font-serif italic truncate">
                                        {{$blog->user->name}}
                                    </p>
                                </div>

                                {{-- Categories --}}
                                <div class="flex flex-wrap gap-1">
                                    @foreach($blog->categories->take(3) as $blogCategory)
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary dark:bg-secondary/20 dark:text-secondary">
                                            {{$blogCategory->name}}
                                        </span>
                                    @endforeach
                                    @if($blog->categories->count() > 3)
                                        <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-text/10 text-text/60">
                                            +{{$blog->categories->count() - 3}}
                                        </span>
                                    @endif
                                </div>

                                {{-- Dates Info --}}
                                <div class="pt-3 border-t border-text/5 grid grid-cols-2 gap-2 text-xs font-serif">
                                    <div>
                                        <span class="text-text/50 block">Published</span>
                                        <span class="text-text">{{ $blog->created_at->format('M j, Y') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-text/50 block">Updated</span>
                                        <span class="text-text">{{ $blog->updated_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Bottom corner ornaments --}}
                            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        {{-- Actions Modal/Dropdown --}}
                        <div x-show="showActions"
                             x-transition
                             @click.away="showActions = false"
                             class="absolute left-0 right-0 top-0 bg-white dark:bg-accent border-2 border-secondary/30 rounded-sm shadow-2xl p-4 space-y-3">
                            {{-- Close button --}}
                            <div class="flex items-center justify-between mb-2 pb-2 border-b border-text/10">
                                <h4 class="font-heading text-sm text-text">Manage Chronicle</h4>
                                <button @click="showActions = false" class="text-text/50 hover:text-text">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <a href="{{route('blog.manage', $blog->id)}}"
                               class="block w-full px-4 py-2 text-center font-serif text-xs text-white bg-secondary hover:bg-secondary/90 dark:bg-primary dark:hover:bg-primary/90 border-2 border-secondary/50 dark:border-primary/50 rounded-sm transition-all duration-300">
                                Edit Chronicle
                            </a>

                            <div class="space-y-1">
                                <label class="text-xs font-serif text-text/60">Change Status:</label>
                                <select name="status"
                                        class="w-full px-3 py-2 font-serif text-xs bg-white dark:bg-navbg/40 text-text border-2 border-text/10 rounded-sm transition-colors duration-300"
                                        wire:change="updateStatus({{ $blog->id }}, $event.target.value)">
                                    <option value="0" @if($blog->status == 0) selected @endif>Draft</option>
                                    <option value="1" @if($blog->status == 1) selected @endif>Published</option>
                                    <option value="2" @if($blog->status == 2) selected @endif>Private</option>
                                </select>
                            </div>

                            <button wire:click.prevent="delete({{$blog->id}}); showActions = false"
                                    wire:confirm="Are you sure you want to remove {{$blog->title}} from the archives?"
                                    class="block w-full px-4 py-2 text-center font-serif text-xs text-danger bg-danger/10 hover:bg-danger/20 border-2 border-danger/50 rounded-sm transition-all duration-300">
                                Remove from Archives
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Decorative Scroll Footer --}}
            <div class="relative mt-8 mb-4">
                <div class="h-2 bg-gradient-to-b from-secondary/10 to-secondary/20 rounded-sm"></div>
                <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30"></div>
            </div>
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $blogs->links() }}
        </div>
    </main>
</div>
