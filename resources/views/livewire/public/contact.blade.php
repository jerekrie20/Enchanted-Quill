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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">Get in Touch</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "We'd love to hear from you. Send us a message and we'll respond as soon as possible"
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
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="mb-8 relative bg-green-50 dark:bg-green-900/20 border-2 border-green-500/50 p-4 rounded-sm" role="alert">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-green-500/70"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-green-500/70"></div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                    <p class="text-green-800 dark:text-green-200 font-serif">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Contact Form --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <form wire:submit="submit" class="space-y-6">
                {{-- Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-heading text-text mb-2">
                        Your Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           wire:model="name"
                           class="w-full px-4 py-3 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300 font-serif @error('name') border-red-500 @enderror"
                           placeholder="Enter your full name">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-serif">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email" class="block text-sm font-heading text-text mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           wire:model="email"
                           class="w-full px-4 py-3 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300 font-serif @error('email') border-red-500 @enderror"
                           placeholder="your.email@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-serif">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Subject Field --}}
                <div>
                    <label for="subject" class="block text-sm font-heading text-text mb-2">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="subject"
                           wire:model="subject"
                           class="w-full px-4 py-3 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300 font-serif @error('subject') border-red-500 @enderror"
                           placeholder="What is this regarding?">
                    @error('subject')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-serif">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Message Field --}}
                <div>
                    <label for="message" class="block text-sm font-heading text-text mb-2">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="message"
                        wire:model="message"
                        rows="6"
                        class="w-full px-4 py-3 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300 font-serif resize-y @error('message') border-red-500 @enderror"
                        placeholder="Tell us more about your inquiry..."></textarea>
                    @error('message')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 font-serif">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-text/60 font-serif">Minimum 10 characters</p>
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center justify-between pt-4">
                    <p class="text-sm text-text/60 font-serif">
                        <span class="text-red-500">*</span> Required fields
                    </p>
                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 border-2 border-purple-500/50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                        <span wire:loading.remove wire:target="submit">
                            <i class="fa-solid fa-paper-plane mr-2"></i>Send Message
                        </span>
                        <span wire:loading wire:target="submit">
                            <i class="fa-solid fa-spinner fa-spin mr-2"></i>Sending...
                        </span>
                    </button>
                </div>
            </form>
        </section>

        {{-- Contact Information --}}
        <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm text-center">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-envelope text-purple-500 text-xl"></i>
                </div>
                <h3 class="font-heading text-text mb-1">Email Us</h3>
                <p class="text-sm text-text/60 font-serif">support@enchantedquill.com</p>
            </div>

            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 p-6 rounded-sm text-center">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-violet-400/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-violet-400/50"></div>
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-violet-500/10 dark:bg-violet-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-clock text-violet-500 text-xl"></i>
                </div>
                <h3 class="font-heading text-text mb-1">Response Time</h3>
                <p class="text-sm text-text/60 font-serif">Within 24-48 hours</p>
            </div>

            <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-6 rounded-sm text-center">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="w-12 h-12 mx-auto mb-3 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-question-circle text-purple-500 text-xl"></i>
                </div>
                <h3 class="font-heading text-text mb-1">Need Help?</h3>
                <a href="{{ route('public.faq') }}" wire:navigate class="text-sm text-purple-600 dark:text-violet-400 hover:underline font-serif">Visit our FAQ</a>
            </div>
        </section>

    </main>
</div>
