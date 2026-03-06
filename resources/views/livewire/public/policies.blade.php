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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">Policies & Terms</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Our commitment to transparency and user safety"
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

        {{-- Privacy Policy --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-purple-500 text-xl"></i>
                </div>
                <h2 class="text-3xl font-heading text-text">Privacy Policy</h2>
            </div>

            <div class="prose prose-lg max-w-none text-text/80 font-serif space-y-4">
                <p class="text-sm text-text/60 italic">Last updated: {{ date('F d, Y') }}</p>

                <h3 class="text-xl font-heading text-text mt-6">Information We Collect</h3>
                <p class="leading-relaxed">
                    We collect information that you provide directly to us when you create an account, publish content, or interact with our platform. This includes your name, email address, profile information, and any content you choose to share.
                </p>

                <h3 class="text-xl font-heading text-text mt-6">How We Use Your Information</h3>
                <ul class="space-y-2 list-disc list-inside">
                    <li>To provide, maintain, and improve our services</li>
                    <li>To personalize your experience on Enchanted Quill</li>
                    <li>To communicate with you about updates, features, and support</li>
                    <li>To ensure the security and integrity of our platform</li>
                    <li>To comply with legal obligations</li>
                </ul>

                <h3 class="text-xl font-heading text-text mt-6">Data Security</h3>
                <p class="leading-relaxed">
                    We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.
                </p>

                <h3 class="text-xl font-heading text-text mt-6">Your Rights</h3>
                <p class="leading-relaxed">
                    You have the right to access, update, or delete your personal information at any time. You can manage your account settings through your profile page or contact us for assistance.
                </p>
            </div>
        </section>

        {{-- Terms of Service --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-violet-400/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-violet-400/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-violet-400/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-violet-400/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-violet-400/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-violet-500/10 dark:bg-violet-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-file-contract text-violet-500 text-xl"></i>
                </div>
                <h2 class="text-3xl font-heading text-text">Terms of Service</h2>
            </div>

            <div class="prose prose-lg max-w-none text-text/80 font-serif space-y-4">
                <p class="text-sm text-text/60 italic">Last updated: {{ date('F d, Y') }}</p>

                <h3 class="text-xl font-heading text-text mt-6">Acceptance of Terms</h3>
                <p class="leading-relaxed">
                    By accessing and using Enchanted Quill, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using this platform.
                </p>

                <h3 class="text-xl font-heading text-text mt-6">User Accounts</h3>
                <p class="leading-relaxed">
                    You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. You must notify us immediately of any unauthorized use of your account.
                </p>

                <h3 class="text-xl font-heading text-text mt-6">Content Guidelines</h3>
                <ul class="space-y-2 list-disc list-inside">
                    <li>You retain ownership of the content you publish</li>
                    <li>Content must not violate any laws or infringe on others' rights</li>
                    <li>Content must not contain harmful, offensive, or inappropriate material</li>
                    <li>We reserve the right to remove content that violates our guidelines</li>
                </ul>

                <h3 class="text-xl font-heading text-text mt-6">Intellectual Property</h3>
                <p class="leading-relaxed">
                    All content published on Enchanted Quill remains the intellectual property of its respective authors. By publishing content, you grant us a license to display and distribute your work on our platform.
                </p>

                <h3 class="text-xl font-heading text-text mt-6">Prohibited Conduct</h3>
                <ul class="space-y-2 list-disc list-inside">
                    <li>Impersonating another person or entity</li>
                    <li>Harassing, threatening, or abusing other users</li>
                    <li>Uploading viruses or malicious code</li>
                    <li>Attempting to gain unauthorized access to our systems</li>
                    <li>Using automated systems to scrape content</li>
                </ul>

                <h3 class="text-xl font-heading text-text mt-6">Termination</h3>
                <p class="leading-relaxed">
                    We reserve the right to terminate or suspend your account at any time for violations of these terms or for any other reason we deem appropriate.
                </p>
            </div>
        </section>

        {{-- Copyright Policy --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-copyright text-purple-500 text-xl"></i>
                </div>
                <h2 class="text-3xl font-heading text-text">Copyright Policy</h2>
            </div>

            <div class="prose prose-lg max-w-none text-text/80 font-serif space-y-4">
                <p class="leading-relaxed">
                    Enchanted Quill respects the intellectual property rights of others and expects our users to do the same. If you believe that your copyrighted work has been used in a way that constitutes copyright infringement, please contact us with the following information:
                </p>

                <ul class="space-y-2 list-disc list-inside">
                    <li>A description of the copyrighted work that you claim has been infringed</li>
                    <li>A description of where the material is located on our platform</li>
                    <li>Your contact information</li>
                    <li>A statement that you have a good faith belief that the use is not authorized</li>
                    <li>A statement that the information is accurate and you are authorized to act on behalf of the copyright owner</li>
                </ul>

                <p class="leading-relaxed mt-4">
                    Send copyright notices to: <a href="mailto:legal@enchantedquill.com" class="text-purple-600 dark:text-violet-400 hover:underline">legal@enchantedquill.com</a>
                </p>
            </div>
        </section>

        {{-- Contact Section --}}
        <section class="relative bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 dark:from-purple-500/20 dark:via-violet-500/20 dark:to-purple-500/20 border-2 border-purple-500/20 p-8 lg:p-12 rounded-sm text-center">
            <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

            <h2 class="text-2xl font-heading text-text mb-3">Questions About Our Policies?</h2>
            <p class="text-text/80 font-serif mb-6">
                If you have any questions or concerns about our policies, please don't hesitate to reach out.
            </p>
            <a href="{{ route('public.contact') }}" wire:navigate class="relative inline-block bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-8 py-3 rounded-sm transition-colors duration-300 border-2 border-purple-500/50">
                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                <i class="fa-solid fa-envelope mr-2"></i>Contact Us
            </a>
        </section>

    </main>
</div>
