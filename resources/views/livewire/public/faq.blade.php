<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10" x-data="{ activeAccordion: null }">
    {{-- Decorative Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-10 h-10 text-purple-500 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">Frequently Asked Questions</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Find answers to common questions about Enchanted Quill"
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
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-6">

        {{-- General Questions --}}
        <section>
            <h2 class="text-2xl font-heading text-text mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-circle-question text-purple-500"></i>
                </div>
                <span>General Questions</span>
            </h2>

            <div class="space-y-4">
                {{-- FAQ Item 1 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 1 ? null : 1"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">What is Enchanted Quill?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 1 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 1"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Enchanted Quill is a community-driven platform where writers can publish their books and blog posts, and readers can discover captivating stories. We bring together storytellers and book lovers from around the world to celebrate the art of literature.
                    </div>
                </div>

                {{-- FAQ Item 2 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 2 ? null : 2"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">Is Enchanted Quill free to use?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 2 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 2"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Yes! Creating an account, reading books and blog posts, and building your library are all completely free. Authors can also publish their work at no cost.
                    </div>
                </div>

                {{-- FAQ Item 3 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 3 ? null : 3"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">How do I create an account?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 3 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 3"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Click the "Register" button in the top navigation, fill out the registration form with your name, email, and password, and you're all set! You'll be able to start exploring content immediately.
                    </div>
                </div>
            </div>
        </section>

        {{-- For Authors --}}
        <section>
            <h2 class="text-2xl font-heading text-text mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-violet-500/10 dark:bg-violet-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-feather-pointed text-violet-500"></i>
                </div>
                <span>For Authors</span>
            </h2>

            <div class="space-y-4">
                {{-- FAQ Item 4 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>

                    <button @click="activeAccordion = activeAccordion === 4 ? null : 4"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">How do I become an author on Enchanted Quill?</span>
                        <svg class="w-5 h-5 text-violet-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 4 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 4"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Contact our admin team through the contact form to request author access. Once approved, you'll be able to publish books and blog posts through your author dashboard.
                    </div>
                </div>

                {{-- FAQ Item 5 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>

                    <button @click="activeAccordion = activeAccordion === 5 ? null : 5"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">Can I publish multiple books?</span>
                        <svg class="w-5 h-5 text-violet-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 5 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 5"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Absolutely! Once you have author access, you can publish as many books and blog posts as you'd like. There are no limits to your creativity.
                    </div>
                </div>

                {{-- FAQ Item 6 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>

                    <button @click="activeAccordion = activeAccordion === 6 ? null : 6"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">Can I edit my published content?</span>
                        <svg class="w-5 h-5 text-violet-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 6 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 6"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Yes! Authors have full control over their content. You can edit, update, or unpublish your books and blog posts at any time through your author dashboard.
                    </div>
                </div>
            </div>
        </section>

        {{-- For Readers --}}
        <section>
            <h2 class="text-2xl font-heading text-text mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-book-reader text-purple-500"></i>
                </div>
                <span>For Readers</span>
            </h2>

            <div class="space-y-4">
                {{-- FAQ Item 7 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 7 ? null : 7"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">How do I save books to my library?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 7 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 7"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        When viewing any book, simply click the "Add to Library" button. The book will be saved to your personal library where you can access it anytime from your portal.
                    </div>
                </div>

                {{-- FAQ Item 8 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 8 ? null : 8"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">Can I leave reviews for books?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 8 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 8"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Yes! We encourage readers to share their thoughts. Click the "Write a Review" button on any book page to rate it and share your feedback with the community and the author.
                    </div>
                </div>

                {{-- FAQ Item 9 --}}
                <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 rounded-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>

                    <button @click="activeAccordion = activeAccordion === 9 ? null : 9"
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-white/30 dark:hover:bg-accent/30 transition-colors duration-300">
                        <span class="font-heading text-text text-lg">Are books available offline?</span>
                        <svg class="w-5 h-5 text-purple-500 transition-transform duration-300"
                             :class="{ 'rotate-180': activeAccordion === 9 }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="activeAccordion === 9"
                         x-collapse
                         class="px-6 pb-4 text-text/80 font-serif">
                        Currently, books are only available for online reading through our platform. We recommend bookmarking your favorite books for easy access.
                    </div>
                </div>
            </div>
        </section>

        {{-- Still Have Questions? --}}
        <section class="relative bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm text-center mt-12">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <h2 class="text-2xl font-heading text-text mb-3">Still Have Questions?</h2>
            <p class="text-text/80 font-serif mb-6">
                Can't find the answer you're looking for? Our support team is here to help.
            </p>
            <a href="{{ route('public.contact') }}" wire:navigate class="relative inline-block bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 border-2 border-purple-500/50">
                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                <i class="fa-solid fa-envelope mr-2"></i>Contact Support
            </a>
        </section>

    </main>
</div>
