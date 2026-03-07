<div class="space-y-8">
    <header class="relative mb-8 overflow-hidden bg-gradient-to-r from-purple-600/10 via-violet-600/10 to-purple-600/10 border-b-2 border-purple-500/20">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-heading text-white">My Messages</h1>
            <p class="text-white/70 font-serif mt-2">View your support tickets and messages from admins.</p>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4">
        @if (session()->has('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-sm font-serif">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-navbg/40 border border-white/10 rounded-sm overflow-hidden backdrop-blur-sm">
            @forelse($messages as $message)
                <div class="p-6 border-b border-white/10 hover:bg-white/5 transition-colors duration-300">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-xl text-white font-heading">
                                    {{ Str::limit(explode("\n\n", $message->message)[0], 50) }}
                                </h3>
                                <span class="px-2 py-1 text-xs rounded-sm
                                    @if($message->status === 0) bg-primary/20 text-primary
                                    @elseif($message->status === 1) bg-secondary/20 text-secondary
                                    @elseif($message->status === 2) bg-green-500/20 text-green-400
                                    @else bg-gray-500/20 text-gray-400 @endif font-serif">
                                    {{ $message->status_label }}
                                </span>
                            </div>
                            <p class="text-white/60 font-serif text-sm line-clamp-2">{{ $message->message }}</p>
                            <div class="mt-3 text-xs text-white/40 font-serif flex items-center gap-4">
                                <span><i class="fa-regular fa-clock mr-1"></i> {{ $message->updated_at->diffForHumans() }}</span>
                                <span><i class="fa-regular fa-comments mr-1"></i> {{ $message->replies_count }} Replies</span>
                            </div>
                        </div>
                        <button wire:click="viewMessage({{ $message->id }})" class="bg-violet-600 hover:bg-violet-700 text-white px-4 py-2 rounded-sm font-serif text-sm transition-colors border border-violet-500/50 whitespace-nowrap">
                            View Thread
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <i class="fa-regular fa-envelope-open text-4xl text-white/20 mb-4 block"></i>
                    <p class="text-white/60 font-serif">You have no messages.</p>
                    <a href="{{ route('public.contact') }}" wire:navigate class="inline-block mt-4 text-violet-400 hover:text-violet-300 transition-colors font-serif text-sm underline">Contact Support</a>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>

    @if($selectedMessage)
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click.self="closeMessageModal">
            <div class="bg-navbg border border-violet-500/30 rounded-sm shadow-2xl w-full md:max-w-1/2  max-h-[90vh] flex flex-col">
                <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                    <h2 class="text-2xl font-heading text-white">Message Thread</h2>
                    <button wire:click="closeMessageModal" class="text-white/50 hover:text-white transition-colors">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 space-y-6">
                    {{-- Original Message --}}
                    <div class="bg-white/5 border border-white/10 p-4 rounded-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-heading text-sm text-white/80">You</span>
                            <span class="text-xs text-white/40 font-serif">{{ $selectedMessage->created_at->format('M j, Y g:i A') }}</span>
                        </div>
                        <p class="text-white/90 font-serif whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
                    </div>

                    {{-- Replies --}}
                    @foreach($selectedMessage->replies as $reply)
                        <div class="border p-4 rounded-sm {{ $reply->is_from_admin ? 'bg-primary/10 border-primary/30 ml-8' : 'bg-white/5 border-white/10 mr-8' }}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-heading text-sm font-bold {{ $reply->is_from_admin ? 'text-primary' : 'text-white/80' }}">
                                    {{ $reply->is_from_admin ? 'Admin Support' : 'You' }}
                                </span>
                                <span class="text-xs text-white/40 font-serif">{{ $reply->created_at->format('M j, Y g:i A') }}</span>
                            </div>
                            <p class="text-white/90 font-serif whitespace-pre-wrap">{{ $reply->message }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 border-t border-white/10 bg-white/5">
                    <textarea wire:model="replyMessage" rows="3" class="w-full bg-black/40 border border-white/20 rounded-sm text-white px-4 py-3 font-serif focus:border-violet-500 transition-colors" placeholder="Type your reply..."></textarea>
                    @error('replyMessage') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    <div class="flex justify-end mt-3">
                        <button wire:click="sendReply" class="bg-violet-600 hover:bg-violet-700 text-white px-6 py-2 rounded-sm font-serif transition-colors border border-violet-500/50">
                            Send Reply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
