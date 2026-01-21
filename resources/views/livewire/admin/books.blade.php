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
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Library Volume Collection</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Curate and manage the precious tomes within our enchanted archives"
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
        {{-- Add New Book Button --}}
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
                    Inscribe New Volume
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
                <input type="text" name="search" placeholder="Search volumes..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="status"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="status">
                    <option value="">All Status</option>
                    <option value="0">Draft</option>
                    <option value="1">Published</option>
                    <option value="3">Archived</option>
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
            {{ $books->links() }}
        </div>

        {{-- Books Grid --}}
        <section class="space-y-6">
            @foreach($books as $book)
                <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-text/10 hover:border-secondary dark:hover:border-primary hover:shadow-xl dark:hover:shadow-secondary/10 transition-all duration-500 overflow-hidden">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

                    <div class="flex flex-col sm:flex-row">
                        {{-- Book Cover --}}
                        <div class="sm:w-1/4 relative overflow-hidden bg-gradient-to-br from-secondary/10 to-primary/10">
                            <img src="{{asset('graphic/forest-8765686_640.jpg')}}" class="w-full h-48 sm:h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{$book->title}}">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary/30"></div>
                        </div>

                        {{-- Book Details --}}
                        <div class="flex-1 p-6 space-y-4">
                            <div>
                                <h3 class="font-heading text-xl text-text group-hover:text-secondary dark:group-hover:text-primary transition-colors">
                                    {{$book->title}}
                                </h3>
                                <p class="text-sm font-serif italic text-text/60 dark:text-text/70 mt-1">
                                    by {{$book->author->first_name}} {{$book->author->last_name}}
                                </p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                @foreach($book->categories as $bookCategory)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary dark:bg-secondary/20 dark:text-secondary">
                                        {{$bookCategory->name}}
                                    </span>
                                @endforeach
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm font-serif">
                                <div
                                    x-data="{ flash: false }"
                                    x-init="@this.on('status-updated', (event) => { if (event.bookId === {{ $book->id }}) { flash = true; setTimeout(() => flash = false, 1000); } })"
                                    :class="flash ? 'bg-secondary/20 dark:bg-primary/20' : ''"
                                    class="transition-all duration-500 rounded px-2 py-1">
                                    <span class="text-text/50">Status:</span>
                                    <span class="font-semibold text-text">{{$book->status_label}}</span>
                                </div>
                                <div>
                                    <span class="text-text/50">Published:</span>
                                    <span class="text-text">{{ $book->created_at->format('M j, Y') }}</span>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-wrap gap-3 pt-4 border-t border-text/10">
                                <a href="{{route('blog.manage', $book->id)}}"
                                   class="relative px-6 py-2 font-serif text-sm text-white bg-secondary hover:bg-secondary/90 dark:bg-primary dark:hover:bg-primary/90 border-2 border-secondary/50 dark:border-primary/50 transition-all duration-300">
                                    <span class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-white/30"></span>
                                    <span class="absolute top-0 right-0 w-1.5 h-1.5 border-t border-r border-white/30"></span>
                                    Edit
                                </a>

                                <select name="status"
                                        class="px-4 py-2 font-serif text-sm bg-accent/10 dark:bg-accent/20 text-text border-2 border-accent/30 rounded-sm transition-colors duration-300"
                                        wire:change="updateStatus({{ $book->id }}, $event.target.value)">
                                    <option disabled value="">Change Status</option>
                                    <option value="0" @if($book->status == 0) selected @endif>Draft</option>
                                    <option value="1" @if($book->status == 1) selected @endif>Published</option>
                                    <option value="3" @if($book->status == 3) selected @endif>Archived</option>
                                </select>

                                <button wire:click.prevent="delete({{$book->id}})"
                                        wire:confirm="Are you sure you want to remove {{$book->title}} from the archives?"
                                        class="relative px-6 py-2 font-serif text-sm text-danger bg-danger/10 hover:bg-danger/20 border-2 border-danger/50 transition-all duration-300">
                                    <span class="absolute bottom-0 left-0 w-1.5 h-1.5 border-b border-l border-danger/30"></span>
                                    <span class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-danger/30"></span>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $books->links() }}
        </div>
    </main>
</div>
