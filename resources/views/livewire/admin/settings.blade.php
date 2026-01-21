<x-Layouts.admin>

    <x-slot:title>
        Library Configurations
    </x-slot>

    <div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
        {{-- Header Section --}}
        <header class="relative mb-12 overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center space-y-4">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                        <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    </div>

                    <h1 class="text-text font-heading">Library Configurations</h1>
                    <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                        "Customize your personal sanctuary and strengthen your mystical defenses"
                    </p>

                    <div class="flex items-center justify-center gap-2 mt-6">
                        <div class="h-px w-8 bg-primary/30"></div>
                        <div class="w-1.5 h-1.5 rotate-45 bg-secondary/50"></div>
                        <div class="h-px w-8 bg-primary/30"></div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            {{-- Tab Navigation --}}
            <div class="mb-8">
                <ul class="flex flex-wrap gap-2 justify-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li role="presentation">
                        <button class="relative px-8 py-3 font-serif text-sm text-text bg-white/60 dark:bg-accent/20 hover:bg-white dark:hover:bg-accent/30 border-2 border-primary/30 aria-selected:bg-primary aria-selected:text-white dark:aria-selected:bg-secondary dark:aria-selected:text-white transition-all duration-300 group"
                                id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50 group-aria-selected:border-white/30"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary/50 group-aria-selected:border-white/30"></span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Scrolls
                            </span>
                        </button>
                    </li>
                    <li role="presentation">
                        <button class="relative px-8 py-3 font-serif text-sm text-text bg-white/60 dark:bg-accent/20 hover:bg-white dark:hover:bg-accent/30 border-2 border-primary/30 aria-selected:bg-primary aria-selected:text-white dark:aria-selected:bg-secondary dark:aria-selected:text-white transition-all duration-300 group"
                                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary/50 group-aria-selected:border-white/30"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary/50 group-aria-selected:border-white/30"></span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Protective Wards
                            </span>
                        </button>
                    </li>
                </ul>
            </div>

            {{-- Tab Content --}}
            <div id="default-tab-content">
                <div class="hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
                        <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
                        <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
                        <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
                        <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

                        <livewire:general.personal/>
                    </section>
                </div>
                <div class="hidden" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
                        <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
                        <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
                        <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
                        <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

                        <livewire:general.security/>
                    </section>
                </div>
            </div>
        </main>
    </div>

</x-Layouts.admin>
