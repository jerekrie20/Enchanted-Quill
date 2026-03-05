<div
    class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    @livewire('general.components.breadcrumbs', ['items' => $breadcrumbs])

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

                <h1 class="text-text font-heading">Chapters of {{ $bookName }}</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Manage all volumes of this enchanted tome"
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
        {{-- Actions Section --}}
        <div class="flex justify-end">
            <a href="{{ route('chapter.manage', ['id' => $bookId]) }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary/90 text-white font-heading rounded-sm transition-all duration-300 hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Chapter
            </a>
        </div>

        {{-- Chapters List Section --}}
        <section
            class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 rounded-sm overflow-hidden">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

            <div class="p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-heading text-text">All Chapters</h2>
                </div>

                @if($chapters->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-text/30 mx-auto mb-4" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-text/60 font-serif italic">No chapters yet. Begin your tale by adding a new
                            chapter.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="border-b-2 border-primary/20">
                                <th class="text-left py-3 px-4 font-heading text-text">Chapter #</th>
                                <th class="text-left py-3 px-4 font-heading text-text">Title</th>
                                <th class="text-right py-3 px-4 font-heading text-text">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chapters as $chapter)
                                <tr class="border-b border-primary/10 hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors"
                                    wire:key="chapter-{{ $chapter->id }}">
                                    <td class="py-4 px-4 text-text font-semibold">{{ $chapter->chapter_number }}</td>
                                    <td class="py-4 px-4 text-text">{{ $chapter->title }}</td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('chapter.manage', ['id' => $bookId, 'chapterNumber' => $chapter->chapter_number]) }}"
                                               class="inline-flex items-center gap-1 px-3 py-2 bg-primary/10 hover:bg-primary/20 text-primary font-heading text-sm rounded-sm transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button wire:click="deleteChapter({{ $chapter->id }})"
                                                    wire:confirm="Are you sure you want to delete this chapter?"
                                                    class="inline-flex items-center gap-1 px-3 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-600 dark:text-red-400 font-heading text-sm rounded-sm transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section>
    </main>
</div>
