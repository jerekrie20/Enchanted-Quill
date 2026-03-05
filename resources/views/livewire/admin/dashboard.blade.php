<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header with Fantasy Elements --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        {{-- Ornamental border top --}}
        <div class="absolute top-0 left-0 right-0 h-1 bg-primary/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-secondary/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center space-y-4">
                {{-- Decorative flourish --}}
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">The Grand Library Archives</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "A sanctuary of knowledge, where every page tells a story and every number weaves a tale"
                </p>

                {{-- Decorative flourish bottom --}}
                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-primary/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-secondary/50"></div>
                    <div class="h-px w-8 bg-primary/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-16">

        {{-- Chronicle of Numbers (Main Stats) --}}
        <section aria-labelledby="chronicle-heading" class="relative">
            <div class="text-center mb-8">
                <h2 id="chronicle-heading" class="text-2xl lg:text-3xl font-heading text-text mb-2">Chronicle of All Time</h2>
                <div class="flex items-center justify-center gap-3">
                    <div class="h-px w-12 bg-text/20"></div>
                    <span class="text-sm text-text/60 font-serif">∞</span>
                    <div class="h-px w-12 bg-text/20"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Readers Tome (Total Users) - Clickable --}}
                <a href="{{route('admin.users')}}" wire:navigate class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-primary/30 dark:border-primary/20 hover:border-primary hover:shadow-xl dark:hover:shadow-primary/10 transition-all duration-500 overflow-hidden block cursor-pointer">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

                    <div class="p-6 relative">
                        <div class="flex flex-col items-center text-center space-y-4">
                            <div class="relative">
                                <div class="absolute inset-0 bg-primary/10 dark:bg-primary/20 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                                <div class="relative w-16 h-16 rounded-full border-2 border-primary/40 bg-primary/5 dark:bg-primary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-serif uppercase tracking-wider text-text/70 dark:text-text/80">Readers of the Realm</h3>
                                <p class="text-4xl lg:text-5xl font-heading font-bold text-primary group-hover:scale-105 transition-transform duration-300">
                                    {{ number_format($totalUsers) }}
                                </p>
                                <span class="inline-block text-xs text-text/50 font-serif italic">Scholars & Seekers</span>
                                @if($userTrend['direction'] !== 'neutral')
                                    <div class="flex items-center justify-center gap-1 text-xs mt-2">
                                        @if($userTrend['direction'] === 'up')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-green-600 dark:text-green-400 font-semibold">+{{$userTrend['percentage']}}%</span>
                                        @else
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-red-600 dark:text-red-400 font-semibold">-{{$userTrend['percentage']}}%</span>
                                        @endif
                                        <span class="text-text/50">this week</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Literary Collection (Total Books) - Clickable --}}
                <a href="{{route('admin.books')}}" wire:navigate class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-secondary/30 dark:border-secondary/20 hover:border-secondary hover:shadow-xl dark:hover:shadow-secondary/10 transition-all duration-500 overflow-hidden block cursor-pointer">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

                    <div class="p-6 relative">
                        <div class="flex flex-col items-center text-center space-y-4">
                            <div class="relative">
                                <div class="absolute inset-0 bg-secondary/10 dark:bg-secondary/20 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                                <div class="relative w-16 h-16 rounded-full border-2 border-secondary/40 bg-secondary/5 dark:bg-secondary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-serif uppercase tracking-wider text-text/70 dark:text-text/80">Literary Collection</h3>
                                <p class="text-4xl lg:text-5xl font-heading font-bold text-secondary group-hover:scale-105 transition-transform duration-300">
                                    {{ number_format($totalBooks) }}
                                </p>
                                <span class="inline-block text-xs text-text/50 font-serif italic">Tomes of Knowledge</span>
                                @if($bookTrend['direction'] !== 'neutral')
                                    <div class="flex items-center justify-center gap-1 text-xs mt-2">
                                        @if($bookTrend['direction'] === 'up')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-green-600 dark:text-green-400 font-semibold">+{{$bookTrend['percentage']}}%</span>
                                        @else
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-red-600 dark:text-red-400 font-semibold">-{{$bookTrend['percentage']}}%</span>
                                        @endif
                                        <span class="text-text/50">this week</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Scribes' Insights (Comments) - Clickable --}}
                <a href="{{route('admin.comments')}}" wire:navigate class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-primary/30 dark:border-primary/20 hover:border-primary hover:shadow-xl dark:hover:shadow-primary/10 transition-all duration-500 overflow-hidden block cursor-pointer">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-primary/50"></div>

                    <div class="p-6 relative">
                        <div class="flex flex-col items-center text-center space-y-4">
                            <div class="relative">
                                <div class="absolute inset-0 bg-primary/10 dark:bg-primary/20 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                                <div class="relative w-16 h-16 rounded-full border-2 border-primary/40 bg-primary/5 dark:bg-primary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-serif uppercase tracking-wider text-text/70 dark:text-text/80">Scribes' Insights</h3>
                                <p class="text-4xl lg:text-5xl font-heading font-bold text-primary group-hover:scale-105 transition-transform duration-300">
                                    {{ number_format($totalComments) }}
                                </p>
                                <span class="inline-block text-xs text-text/50 font-serif italic">Words of Wisdom</span>
                            </div>
                        </div>
                    </div>
                </a>

                {{-- Chronicles & Tales (Blogs) - Clickable --}}
                <a href="{{route('blogs')}}" wire:navigate class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-secondary/30 dark:border-secondary/20 hover:border-secondary hover:shadow-xl dark:hover:shadow-secondary/10 transition-all duration-500 overflow-hidden block cursor-pointer">
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

                    <div class="p-6 relative">
                        <div class="flex flex-col items-center text-center space-y-4">
                            <div class="relative">
                                <div class="absolute inset-0 bg-secondary/10 dark:bg-secondary/20 rounded-full blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                                <div class="relative w-16 h-16 rounded-full border-2 border-secondary/40 bg-secondary/5 dark:bg-secondary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                    <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-sm font-serif uppercase tracking-wider text-text/70 dark:text-text/80">Chronicles & Tales</h3>
                                <p class="text-4xl lg:text-5xl font-heading font-bold text-secondary group-hover:scale-105 transition-transform duration-300">
                                    {{ number_format($totalBlogs) }}
                                </p>
                                <span class="inline-block text-xs text-text/50 font-serif italic">Written Narratives</span>
                                @if($blogTrend['direction'] !== 'neutral')
                                    <div class="flex items-center justify-center gap-1 text-xs mt-2">
                                        @if($blogTrend['direction'] === 'up')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-green-600 dark:text-green-400 font-semibold">+{{$blogTrend['percentage']}}%</span>
                                        @else
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-red-600 dark:text-red-400 font-semibold">-{{$blogTrend['percentage']}}%</span>
                                        @endif
                                        <span class="text-text/50">this week</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        {{-- Weekly Ledger --}}
        <section aria-labelledby="weekly-heading" class="relative">
            <div class="absolute inset-0 bg-white/40 dark:bg-accent/5 rounded-sm"></div>
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-8 lg:p-10">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-20 bg-primary/30"></div>
                        <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 2v20h12V2H6zm10 18H8V4h8v16zm-2-14h-4v2h4V6zm0 4h-4v2h4v-2zm0 4h-4v2h4v-2z"/>
                        </svg>
                        <div class="h-px w-20 bg-primary/30"></div>
                    </div>
                    <h2 id="weekly-heading" class="text-2xl lg:text-3xl font-heading text-text">Weekly Ledger</h2>
                    <p class="text-sm text-text/60 font-serif italic mt-2">Last 7 Days of Activity</p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-primary/30 dark:border-primary/20">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary"></div>
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Readers</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-primary">
                            {{ number_format($weeklyUsers) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-secondary/30 dark:border-secondary/20">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-secondary"></div>
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-secondary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Volumes</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-secondary">
                            {{ number_format($weeklyBooks) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-primary/30 dark:border-primary/20">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-primary"></div>
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-primary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Insights</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-primary">
                            {{ number_format($weeklyComments) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-secondary/30 dark:border-secondary/20">
                        <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-secondary"></div>
                        <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-secondary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Chronicles</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-secondary">
                            {{ number_format($weeklyBlogs) }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Monthly Annals --}}
        <section aria-labelledby="monthly-heading" class="relative">
            <div class="absolute inset-0 bg-white/40 dark:bg-accent/5 rounded-sm"></div>
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-secondary/20 dark:border-secondary/10 p-8 lg:p-10">
                <div class="text-center mb-8">
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div class="h-px w-20 bg-secondary/30"></div>
                        <svg class="w-6 h-6 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
                        </svg>
                        <div class="h-px w-20 bg-secondary/30"></div>
                    </div>
                    <h2 id="monthly-heading" class="text-2xl lg:text-3xl font-heading text-text">Monthly Annals</h2>
                    <p class="text-sm text-text/60 font-serif italic mt-2">Last 30 Days of Activity</p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-secondary/30 dark:border-secondary/20">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-secondary"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-secondary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Readers</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-secondary">
                            {{ number_format($monthlyUsers) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-primary/30 dark:border-primary/20">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-primary"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Volumes</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-primary">
                            {{ number_format($monthlyBooks) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-secondary/30 dark:border-secondary/20">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-secondary"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-secondary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Insights</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-secondary">
                            {{ number_format($monthlyComments) }}
                        </p>
                    </div>
                    <div class="relative bg-white dark:bg-navbg/40 p-6 border border-primary/30 dark:border-primary/20">
                        <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-primary"></div>
                        <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-primary"></div>
                        <h3 class="text-xs font-serif uppercase tracking-wider text-text/60 dark:text-text/70 mb-3">New Chronicles</h3>
                        <p class="text-3xl lg:text-4xl font-heading font-bold text-primary">
                            {{ number_format($monthlyBlogs) }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>
