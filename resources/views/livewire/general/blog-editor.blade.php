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
                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">{{$blog ? 'Revise Chronicle' : 'Inscribe New Chronicle'}}</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "{{$blog ? 'Refine your tale with the care of a master scribe' : 'Begin your tale upon the enchanted parchment'}}"
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
        {{-- Chronicle Details Section --}}
        <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-secondary/20 dark:border-secondary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-secondary/10 dark:bg-secondary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Chronicle Details</h2>
            </div>

            @if($slug)
                <p class="text-center text-sm font-serif text-text/60 mb-4">
                    <span class="text-text/50">Magical Identifier:</span> <span class="font-mono text-secondary dark:text-primary">{{$slug}}</span>
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

                    @if($status == 3)
                        <div>
                            <x-forms.input-date-time name="Publish Later" modal="publish_at" wire:model="publish_at"/>
                        </div>
                    @endif
                </div>

                <input type="hidden" wire:model="slug">

                {{-- Chronicle Cover Section --}}
                <div class="mt-8 border-t border-text/10 pt-8">
                    <h3 class="text-lg font-heading text-text mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Chronicle Cover
                    </h3>

                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative w-48 h-48 bg-white/40 dark:bg-navbg/40 border-2 border-secondary/20 rounded-sm overflow-hidden">
                            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-b from-secondary/20 to-transparent"></div>
                            <div class="absolute top-0 left-0 right-0 h-px bg-secondary/30"></div>

                            @if($currentImage)
                                <img class="w-full h-full object-cover" src="{{ asset('blogs/' . $currentImage) }}" alt="Chronicle Cover"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-secondary/10 to-primary/10">
                                    <svg class="w-16 h-16 text-text/20" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <x-forms.input-file wire:model="image" modal="image" name="Upload Cover Image"/>
                            @if($image)
                                <p class="mt-2 text-sm text-text/60 font-serif">Image selected: {{ $image->getClientOriginalName() }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-center pt-4">
                    <x-forms.input-submit/>
                </div>
            </form>
        </section>

        {{-- Chronicle Content Section --}}
        @if($blog)
            <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-secondary/20 dark:border-secondary/10 p-6 lg:p-8 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-secondary/10 dark:bg-secondary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-heading text-text">Chronicle Content</h2>
                </div>

                @livewire('general.c-k-editor', ['blogId' => $blog->id, 'isBook' => false])
            </section>
        @endif
    </main>
</div>
