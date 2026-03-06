<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-10 h-10 text-purple-500 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">About Enchanted Quill</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto ">
                    "Uniting readers and writers in a celebration of storytelling"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-purple-500/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-violet-400/50"></div>
                    <div class="h-px w-8 bg-purple-500/30"></div>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-12">

        {{-- Our Story Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-book-open text-purple-500 text-xl"></i>
                </div>
                <h2 class="text-3xl font-heading text-text">Our Story</h2>
            </div>

            <div class="prose prose-lg max-w-none text-text/80 font-serif space-y-4">
                <p class="leading-relaxed">
                    Enchanted Quill was born from a simple belief: that stories have the power to connect us, inspire us, and transform us. We are a community-driven platform dedicated to celebrating the art of storytelling in all its forms.
                </p>
                <p class="leading-relaxed">
                    Whether you're a seasoned author looking to share your latest masterpiece, or an eager reader searching for your next literary adventure, Enchanted Quill provides a magical space where words truly weave their magic.
                </p>
                <p class="leading-relaxed">
                    Our platform brings together writers and readers from around the world, fostering meaningful connections through the universal language of stories.
                </p>
            </div>
        </section>

        {{-- Mission & Vision Section --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Mission --}}
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-compass text-purple-500"></i>
                    </div>
                    <h3 class="text-2xl font-heading text-text">Our Mission</h3>
                </div>

                <p class="text-text/80 font-serif leading-relaxed">
                    To create an inclusive, supportive platform where storytellers can share their work, connect with readers, and grow their craft while readers discover captivating tales that enrich their lives.
                </p>
            </div>

            {{-- Vision --}}
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 p-8 rounded-sm">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-violet-400/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-violet-400/50"></div>

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-violet-500/10 dark:bg-violet-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-eye text-violet-500"></i>
                    </div>
                    <h3 class="text-2xl font-heading text-text">Our Vision</h3>
                </div>

                <p class="text-text/80 font-serif leading-relaxed">
                    To become the world's most beloved literary community, where every story finds its audience and every reader discovers magic between the pages.
                </p>
            </div>
        </section>

        {{-- What We Offer Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <h2 class="text-3xl font-heading text-text mb-8 text-center">What We Offer</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- For Writers --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-feather-pointed text-purple-500 text-2xl"></i>
                        <h3 class="text-xl font-heading text-text">For Writers</h3>
                    </div>
                    <ul class="space-y-3 text-text/80 font-serif">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-purple-500 mt-1 flex-shrink-0"></i>
                            <span>Publish your books and blog posts with ease</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-purple-500 mt-1 flex-shrink-0"></i>
                            <span>Build your author profile and grow your audience</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-purple-500 mt-1 flex-shrink-0"></i>
                            <span>Receive feedback and reviews from readers</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-purple-500 mt-1 flex-shrink-0"></i>
                            <span>Connect with fellow writers and readers</span>
                        </li>
                    </ul>
                </div>

                {{-- For Readers --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-book-reader text-violet-500 text-2xl"></i>
                        <h3 class="text-xl font-heading text-text">For Readers</h3>
                    </div>
                    <ul class="space-y-3 text-text/80 font-serif">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-violet-500 mt-1 flex-shrink-0"></i>
                            <span>Discover books across multiple genres</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-violet-500 mt-1 flex-shrink-0"></i>
                            <span>Read engaging blog posts and literary content</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-violet-500 mt-1 flex-shrink-0"></i>
                            <span>Create your personal reading library</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-violet-500 mt-1 flex-shrink-0"></i>
                            <span>Share reviews and connect with authors</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- Join Us Section --}}
        <section class="relative bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm text-center">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <h2 class="text-3xl font-heading text-text mb-4">Join Our Community</h2>
            <p class="text-lg text-text/80 font-serif mb-6 mx-auto">
                Whether you're here to write, read, or simply explore the world of stories, we welcome you with open arms. Your literary journey begins here.
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('register') }}" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 border-2 border-purple-500/50">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    <i class="fa-solid fa-user-plus mr-2"></i>Get Started
                </a>
                <a href="{{ route('public.contact') }}" wire:navigate class="relative bg-white/10 dark:bg-white/5 hover:bg-white/20 dark:hover:bg-white/10 text-text font-serif px-8 py-3 rounded-sm border-2 border-purple-500/30 transition-colors duration-300">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-purple-500/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-purple-500/30"></span>
                    <i class="fa-solid fa-envelope mr-2"></i>Contact Us
                </a>
            </div>
        </section>

    </main>
</div>
