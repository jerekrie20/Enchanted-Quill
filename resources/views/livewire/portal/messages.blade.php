<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Decorative Header --}}
    <header class="relative mb-12 lg:mb-16 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                    <svg class="w-8 h-8 text-purple-500 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-violet-400/40"></div>
                </div>

                <h1 class="text-text font-heading text-4xl lg:text-5xl">My Messages</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "View your support tickets and messages from admins."
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
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
        @if (session()->has('success'))
            <div class="mb-6 relative bg-green-50 dark:bg-green-900/20 border-2 border-green-500/50 p-4 rounded-sm" role="alert">
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-green-500/70"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-green-500/70"></div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                    <p class="text-green-800 dark:text-green-200 font-serif">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-purple-500/20 dark:border-purple-400/10 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
            <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

            <div class="divide-y divide-purple-500/10 dark:divide-purple-400/10">
                @forelse($messages as $message)
                    <div class="p-6 hover:bg-purple-500/5 dark:hover:bg-purple-400/5 transition-colors duration-300">
                        <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl text-text font-heading">
                                        {{ Str::limit(explode("\n\n", $message->message)[0], 50) }}
                                    </h3>
                                    <span class="px-2 py-1 text-xs rounded-sm
                                        @if($message->status === 0) bg-primary/20 text-primary
                                        @elseif($message->status === 1) bg-secondary/20 text-secondary
                                        @elseif($message->status === 2) bg-green-500/20 text-green-600 dark:text-green-400
                                        @else bg-gray-500/20 text-text/70 @endif font-serif font-semibold">
                                        {{ $message->status_label }}
                                    </span>
                                </div>
                                <p class="text-text/70 font-serif text-sm line-clamp-2">{{ $message->message }}</p>
                                <div class="mt-3 text-xs text-text/50 font-serif flex items-center gap-4">
                                    <span><i class="fa-regular fa-clock mr-1"></i> {{ $message->updated_at->diffForHumans() }}</span>
                                    <span><i class="fa-regular fa-comments mr-1"></i> {{ $message->replies_count }} Replies</span>
                                </div>
                            </div>
                            <button wire:click="viewMessage({{ $message->id }})" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-purple-500/50 whitespace-nowrap">
                                View Thread
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <i class="fa-regular fa-envelope-open text-4xl text-text/30 mb-4 block"></i>
                        <p class="text-text/60 font-serif mb-4">You have no messages.</p>
                        <a href="{{ route('public.contact') }}" wire:navigate class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-purple-500/50">
                            Contact Support
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        @if($messages->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $messages->links() }}
            </div>
        @endif
    </main>

    @if($selectedMessage)
        <div class="fixed inset-0 bg-navbg/80 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click.self="closeMessageModal">
            <div class="relative bg-white dark:bg-accent/95 rounded-sm border-2 border-purple-500/30 shadow-2xl w-full md:max-w-1/2  max-h-[90vh] flex flex-col">
                <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-purple-500/50"></div>

                <div class="p-6 border-b border-text/10 flex justify-between items-center bg-white/5">
                    <h2 class="text-2xl font-heading text-text">Message Thread</h2>
                    <button wire:click="closeMessageModal" class="text-text/50 hover:text-text transition-colors">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 space-y-6">
                    {{-- Original Message --}}
                    <div class="bg-accent/5 dark:bg-accent/20 border border-text/10 p-4 rounded-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-heading text-sm text-text/80">You</span>
                            <span class="text-xs text-text/50 font-serif">{{ $selectedMessage->created_at->format('M j, Y g:i A') }}</span>
                        </div>
                        <p class="text-text/90 font-serif whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
                    </div>

                    {{-- Replies --}}
                    @foreach($selectedMessage->replies as $reply)
                        <div class="border p-4 rounded-sm {{ $reply->is_from_admin ? 'bg-primary/5 dark:bg-primary/10 border-primary/20 ml-8' : 'bg-accent/5 dark:bg-accent/20 border-text/10 mr-8' }}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-heading text-sm font-bold {{ $reply->is_from_admin ? 'text-primary' : 'text-text/80' }}">
                                    {{ $reply->is_from_admin ? 'Admin Support' : 'You' }}
                                </span>
                                <span class="text-xs text-text/50 font-serif">{{ $reply->created_at->format('M j, Y g:i A') }}</span>
                            </div>
                            <p class="text-text/90 font-serif whitespace-pre-wrap">{{ $reply->message }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 border-t border-text/10 bg-white/5">
                    <textarea wire:model="replyMessage" rows="3" class="w-full px-4 py-3 bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-purple-500 dark:focus:border-violet-400 text-text transition-colors duration-300 font-serif resize-y" placeholder="Type your reply..."></textarea>
                    @error('replyMessage') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block font-serif">{{ $message }}</span> @enderror
                    <div class="flex justify-end mt-3">
                        <button wire:click="sendReply" class="relative bg-purple-600 hover:bg-purple-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 border border-purple-500/50">
                            Send Reply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
