<div
    class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-primary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-primary/40"></div>
                </div>

                <h1 class="text-text font-heading">{{$title ? 'Revise Volume' : 'Inscribe New Volume'}}</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "{{$title ? 'Refine your volume with the precision of a master librarian' : 'Add a new tome to the enchanted collection'}}
                    "
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


        {{-- Volume Details Section --}}
        <section
            class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Volume Details</h2>
            </div>

            <form wire:submit="saveDetails" class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <x-forms.input-text name="Title" wire:model.live="title"/>
                    </div>
                    <div>
                        <x-forms.input-text name="Book Name" readonly wire:model="bookName"/>
                    </div>

                </div>

                <div class="flex justify-center pt-4">
                    <x-forms.input-submit/>
                </div>
            </form>
        </section>

        {{-- Book Content Section --}}

        <section
            class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M14.17 3.25l5.58 5.58c.48.48.48 1.26 0 1.74L9.34 21H3.75v-5.59L14.17 3.25m0-1.41c-.37 0-.74.15-1.02.42L2 13.42V22h8.58L21.75 10.83c.56-.56.56-1.47 0-2.02l-5.58-5.58c-.29-.29-.67-.44-1.02-.44z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Book Content</h2>
            </div>

            @livewire('general.c-k-editor', ['blogId' => $bookId, 'isBook' => true])
        </section>

    </main>
</div>
