<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-primary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-primary/40"></div>
                </div>

                <h1 class="text-text font-heading">{{$book ? 'Revise Volume' : 'Inscribe New Volume'}}</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "{{$book ? 'Refine your volume with the precision of a master librarian' : 'Add a new tome to the enchanted collection'}}"
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

        {{-- Add New Chapter Button --}}
        <div class="flex justify-center">
            <a href="{{route('chapter.manage',['id' => $book->id, 'slug' => 'create'])}}"
               class="relative px-8 py-3 font-serif text-sm text-white bg-secondary hover:bg-secondary/90 dark:bg-primary dark:hover:bg-primary/90 border-2 border-secondary/50 dark:border-primary/50 transition-all duration-300 group">
                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
                <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Inscribe New Chapter
                </span>
            </a>
        </div>

        {{-- Volume Details Section --}}
        <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Volume Details</h2>
            </div>

            @if($slug)
                <p class="text-center text-sm font-serif text-text/60 mb-4">
                    <span class="text-text/50">Magical Identifier:</span> <span class="font-mono text-primary dark:text-secondary">{{$slug}}</span>
                </p>
            @endif

            <form wire:submit="saveDetails" class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <x-forms.input-text name="Title" wire:model.live="title"/>
                    </div>
                    <div>
                        <x-forms.input-dropdown-checkbox name="Categories" modal="category" :data="$categories"/>
                    </div>
                    <div>
                        <x-forms.input-select name="Status" :data="$statusData" wire:model.live.debounce.500ms="status"/>
                    </div>

                    @if($status == 2)
                        <div>
                            <x-forms.input-date-time name="Publish Later" modal="publish_at" wire:model="publish_at"/>
                        </div>
                    @endif
                </div>

                <input type="hidden" wire:model="slug">

                {{-- Book Cover Section --}}
                <div class="mt-8 border-t border-text/10 pt-8">
                    <h3 class="text-lg font-heading text-text mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Book Cover
                    </h3>

                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative w-48 aspect-[2/3] bg-white/40 dark:bg-navbg/40 border-2 border-primary/20 rounded-sm overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-primary/30 via-primary/40 to-primary/30"></div>
                            <div class="absolute left-1.5 top-0 bottom-0 w-px bg-primary/20"></div>

                            @if($currentCover)
                                <img class="w-full h-full object-cover" src="{{ asset('books/' . $currentCover) }}" alt="Book Cover"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10">
                                    <svg class="w-16 h-16 text-text/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <x-forms.input-file wire:model="cover" modal="cover" name="Upload Book Cover"/>
                            @if($cover)
                                <p class="mt-2 text-sm text-text/60 font-serif">Cover selected: {{ $cover->getClientOriginalName() }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <x-forms.input-submit/>
                </div>
            </form>
        </section>

        {{-- Book Content Section --}}
        @if($book)
            <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.17 3.25l5.58 5.58c.48.48.48 1.26 0 1.74L9.34 21H3.75v-5.59L14.17 3.25m0-1.41c-.37 0-.74.15-1.02.42L2 13.42V22h8.58L21.75 10.83c.56-.56.56-1.47 0-2.02l-5.58-5.58c-.29-.29-.67-.44-1.02-.44z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-heading text-text">Book Content</h2>
                </div>

                @livewire('general.c-k-editor', ['blogId' => $book->id, 'isBook' => true])
            </section>
        @endif
    </main>
</div>
