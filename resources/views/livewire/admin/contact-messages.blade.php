<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Messenger Scrolls</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Tend to the correspondence from seekers and wanderers across the realm"
                </p>

                @if($unreadCount > 0)
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 dark:bg-primary/20 border-2 border-primary/30 rounded-sm">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-7v2h2v-2h-2zm0-8v6h2V7h-2z"/>
                        </svg>
                        <span class="font-heading text-primary">{{ $unreadCount }} unread message(s)</span>
                    </div>
                @endif

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-primary/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-secondary/50"></div>
                    <div class="h-px w-8 bg-primary/30"></div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
        {{-- Search & Filter Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-secondary/10 dark:bg-secondary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-heading text-text">Search & Filter Scrolls</h2>
                </div>
                <button wire:click="openComposeModal" class="px-4 py-2 bg-primary text-white rounded-sm font-serif text-sm hover:bg-primary/90 transition-colors">
                    <i class="fa-solid fa-pen-nib mr-2"></i>Compose Message
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <input type="text" name="search" id="search" placeholder="Search messages..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="filterStatus" id="filterStatus"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="filterStatus">
                    <option value="">All Status</option>
                    <option value="0">Unread</option>
                    <option value="1">Read</option>
                    <option value="2">Replied</option>
                    <option value="3">Archived</option>
                </select>

                <select name="perPage" id="perPage"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="perPage">
                    <option value="15">15 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>

                <select name="sort" id="sort"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="sort">
                    <option value="desc">Newest First</option>
                    <option value="asc">Oldest First</option>
                </select>
            </div>
        </section>

        {{-- Pagination Top --}}
        <div class="flex justify-center">
            {{ $messages->links() }}
        </div>

        {{-- Messages Inbox --}}
        <section class="space-y-4">
            @forelse($messages as $message)
                <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-sm border-2 border-text/10 hover:border-primary dark:hover:border-secondary hover:shadow-xl transition-all duration-500 overflow-hidden
                    {{ $message->status === 0 ? 'bg-primary/5 dark:bg-primary/10' : '' }}">
                    {{-- Corner ornaments --}}
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            {{-- Message Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start gap-3">
                                    {{-- Unread indicator --}}
                                    @if($message->status === 0)
                                        <div class="w-3 h-3 rounded-full bg-primary dark:bg-secondary flex-shrink-0 mt-1.5"></div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <h3 class="font-heading text-lg text-text {{ $message->status === 0 ? 'font-bold' : '' }}">
                                                {{ $message->name }}
                                            </h3>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                                                @if($message->status === 0) bg-primary/20 text-primary
                                                @elseif($message->status === 1) bg-secondary/20 text-secondary
                                                @elseif($message->status === 2) bg-green-500/20 text-green-600 dark:text-green-400
                                                @else bg-text/20 text-text/70 @endif">
                                                {{ $message->status_label }}
                                            </span>
                                        </div>

                                        <a href="mailto:{{ $message->email }}" class="text-sm text-secondary hover:text-primary transition-colors font-serif">
                                            {{ $message->email }}
                                        </a>

                                        <p class="text-sm text-text/70 font-serif mt-2 line-clamp-2">
                                            {{ $message->message }}
                                        </p>

                                        <p class="text-xs text-text/50 font-serif mt-2">
                                            {{ $message->created_at->format('M j, Y \a\t g:i A') }} • {{ $message->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-col gap-2 flex-shrink-0">
                                <button wire:click="viewMessage({{ $message->id }})"
                                        class="px-4 py-2 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border border-primary/50 dark:border-secondary/50 rounded-sm transition-all duration-300">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View
                                </button>

                                <button wire:click="delete({{ $message->id }})"
                                        wire:confirm="Are you sure you want to delete this message?"
                                        class="px-4 py-2 font-serif text-sm text-danger bg-danger/10 hover:bg-danger/20 border border-danger/50 rounded-sm transition-all duration-300">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom corner ornaments --}}
                    <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-primary/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </article>
            @empty
                <div class="text-center py-16 bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-text/10 rounded-sm">
                    <svg class="w-16 h-16 mx-auto text-text/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-heading text-text mb-2">No Messages Found</h3>
                    <p class="text-text/60 font-serif">The messenger scroll inbox is currently empty.</p>
                </div>
            @endforelse
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $messages->links() }}
        </div>
    </main>

    {{-- Message Detail Modal --}}
    @if($showMessageModal && $selectedMessage)
        <div class="fixed inset-0 bg-navbg/80 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click.self="closeMessageModal">
            <div class="relative bg-white dark:bg-accent/95 rounded-sm border-2 border-primary/30 shadow-2xl w-full md:max-w-1/2  max-h-[90vh] overflow-y-auto">
                {{-- Modal ornaments --}}
                <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-primary"></div>
                <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-primary"></div>
                <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-primary"></div>
                <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-primary"></div>

                <div class="p-8">
                    {{-- Header --}}
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center gap-3 mb-4">
                            <div class="h-px w-12 bg-primary/30"></div>
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div class="h-px w-12 bg-primary/30"></div>
                        </div>
                        <h2 class="font-heading text-text text-2xl">Message Details</h2>
                    </div>

                    {{-- Message Content --}}
                    <div class="space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b border-text/10">
                            <div>
                                <h3 class="font-heading text-xl text-text">{{ $selectedMessage->name }}</h3>
                                <a href="mailto:{{ $selectedMessage->email }}" class="text-sm text-secondary hover:text-primary transition-colors font-serif">
                                    {{ $selectedMessage->email }}
                                </a>
                            </div>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold
                                @if($selectedMessage->status === 0) bg-primary/20 text-primary
                                @elseif($selectedMessage->status === 1) bg-secondary/20 text-secondary
                                @elseif($selectedMessage->status === 2) bg-green-500/20 text-green-600 dark:text-green-400
                                @else bg-text/20 text-text/70 @endif">
                                {{ $selectedMessage->status_label }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-serif text-text/60 mb-2">Message:</label>
                            <div class="bg-accent/10 dark:bg-accent/20 rounded-sm p-4 border border-text/10 mb-4">
                                <p class="text-text font-serif leading-relaxed whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
                            </div>
                            <div class="text-xs text-text/50 font-serif mb-6">
                                Received {{ $selectedMessage->created_at->format('F j, Y \a\t g:i A') }} ({{ $selectedMessage->created_at->diffForHumans() }})
                            </div>

                            @if($selectedMessage->replies && $selectedMessage->replies->count() > 0)
                                <div class="mt-6 space-y-4">
                                    <label class="block text-sm font-serif text-text/60 mb-2">Replies:</label>
                                    @foreach($selectedMessage->replies as $reply)
                                        <div class="p-4 rounded-sm border {{ $reply->is_from_admin ? 'bg-primary/5 border-primary/20 ml-8' : 'bg-secondary/5 border-secondary/20 mr-8' }}">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="font-heading text-sm font-bold {{ $reply->is_from_admin ? 'text-primary' : 'text-secondary' }}">
                                                    {{ $reply->is_from_admin ? 'Admin (' . $reply->name . ')' : $reply->name }}
                                                </span>
                                                <span class="text-xs text-text/50">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-text font-serif text-sm whitespace-pre-wrap">{{ $reply->message }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Reply Form --}}
                        <div class="pt-6 border-t border-text/10 mt-6">
                            <label class="block text-sm font-serif text-text/70 mb-2">Send a Reply:</label>
                            <textarea wire:model="replyMessage" rows="3" class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2 font-serif transition-colors duration-300 mb-2" placeholder="Write your reply..."></textarea>
                            @error('replyMessage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            <div class="flex justify-end">
                                <button wire:click="sendReply" class="px-4 py-2 font-serif text-sm text-white bg-primary hover:bg-primary/90 rounded-sm transition-colors">
                                    Send Reply {{ !$selectedMessage->user_id ? '(via Email)' : '' }}
                                </button>
                            </div>
                        </div>

                        {{-- Status Update --}}
                        <div class="pt-4 border-t border-text/10">
                            <label class="block text-sm font-serif text-text/70 mb-2">Update Status:</label>
                            <div class="flex gap-2">
                                <button wire:click="updateStatus({{ $selectedMessage->id }}, 1)"
                                        class="flex-1 px-4 py-2 font-serif text-sm {{ $selectedMessage->status === 1 ? 'text-white bg-secondary' : 'text-text bg-white/50 dark:bg-navbg/50' }} border-2 border-secondary/50 rounded-sm transition-all duration-300">
                                    Mark as Read
                                </button>
                                <button wire:click="updateStatus({{ $selectedMessage->id }}, 2)"
                                        class="flex-1 px-4 py-2 font-serif text-sm {{ $selectedMessage->status === 2 ? 'text-white bg-green-600' : 'text-text bg-white/50 dark:bg-navbg/50' }} border-2 border-green-500/50 rounded-sm transition-all duration-300">
                                    Mark as Replied
                                </button>
                                <button wire:click="updateStatus({{ $selectedMessage->id }}, 3)"
                                        class="flex-1 px-4 py-2 font-serif text-sm {{ $selectedMessage->status === 3 ? 'text-white bg-text' : 'text-text bg-white/50 dark:bg-navbg/50' }} border-2 border-text/50 rounded-sm transition-all duration-300">
                                    Archive
                                </button>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-4 pt-6 border-t border-text/10">
                            <a href="mailto:{{ $selectedMessage->email }}"
                               class="flex-1 text-center px-6 py-3 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border-2 border-primary/50 dark:border-secondary/50 rounded-sm transition-all duration-300">
                                Reply via Email
                            </a>

                            <button type="button" wire:click="closeMessageModal"
                                    class="flex-1 px-6 py-3 font-serif text-sm text-text bg-white/50 dark:bg-navbg/50 hover:bg-white dark:hover:bg-navbg border-2 border-text/20 hover:border-text/40 rounded-sm transition-all duration-300">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Compose Message Modal --}}
    @if($showComposeModal)
        <div class="fixed inset-0 bg-navbg/80 backdrop-blur-sm flex items-center justify-center z-50 p-4" wire:click.self="closeComposeModal">
            <div class="relative bg-white dark:bg-accent/95 rounded-sm border-2 border-primary/30 shadow-2xl w-full md:max-w-1/2  max-h-[90vh] overflow-y-auto">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h2 class="font-heading text-text text-2xl">Send a Message</h2>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-serif text-text/70 mb-1">Select User:</label>
                            <select wire:model="composeUserId" class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary text-text px-4 py-2 font-serif">
                                <option value="">Select a user...</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                @endforeach
                            </select>
                            @error('composeUserId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-serif text-text/70 mb-1">Subject:</label>
                            <input type="text" wire:model="composeSubject" class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary text-text px-4 py-2 font-serif" placeholder="Message subject...">
                            @error('composeSubject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-serif text-text/70 mb-1">Message:</label>
                            <textarea wire:model="composeMessage" rows="5" class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary text-text px-4 py-2 font-serif" placeholder="Write your message..."></textarea>
                            @error('composeMessage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4 pt-6 border-t border-text/10">
                            <button wire:click="sendMessage" class="flex-1 px-6 py-3 font-serif text-sm text-white bg-primary hover:bg-primary/90 rounded-sm transition-all duration-300">
                                Send Message
                            </button>
                            <button type="button" wire:click="closeComposeModal" class="flex-1 px-6 py-3 font-serif text-sm text-text bg-white/50 dark:bg-navbg/50 hover:bg-white border-2 border-text/20 rounded-sm transition-all duration-300">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
