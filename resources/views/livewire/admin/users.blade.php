<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-primary dark:text-secondary" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Readers of the Realm</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic  mx-auto">
                    "Manage the scholars, scribes, and seekers who grace our library halls"
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
        {{-- Success Alert --}}
        <x-alerts.success/>

        {{-- Search & Filter Section --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-primary/20 dark:border-primary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-primary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-primary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-secondary/10 dark:bg-secondary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Search & Filter</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" id="search" placeholder="Search by name or email..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="sortRole" id="sortRole"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="sortRole">
                    <option value="">All Roles</option>
                    <option value="admin">Librarian (Admin)</option>
                    <option value="author">Scribe (Author)</option>
                    <option value="reader">Scholar (Reader)</option>
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
            {{ $users->links() }}
        </div>

        {{-- Users Grid --}}
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($users as $user)
                <article class="group relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-text/10 hover:border-primary dark:hover:border-secondary hover:shadow-xl dark:hover:shadow-primary/10 transition-all duration-500 overflow-hidden">
                    {{-- Corner ornaments --}}
                    <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-primary/50"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-primary/50"></div>
                    <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-primary/50"></div>
                    <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-primary/50"></div>

                    <div class="p-6 space-y-4">
                        {{-- User Avatar/Initial --}}
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-primary/10 dark:bg-primary/20 border-2 border-primary/30 flex items-center justify-center">
                                <span class="text-2xl font-heading font-bold text-primary">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-heading text-lg text-text group-hover:text-primary dark:group-hover:text-secondary transition-colors">
                                    {{$user->name}}
                                </h3>
                                <p class="text-sm text-text/60 dark:text-text/70 font-serif">{{$user->email}}</p>
                            </div>
                        </div>

                        {{-- User Details --}}
                        <div class="space-y-2 pt-4 border-t border-text/10">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-serif uppercase tracking-wider text-text/50">Role:</span>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($user->role === 'admin') bg-primary/20 text-primary
                                    @elseif($user->role === 'author') bg-secondary/20 text-secondary
                                    @else bg-accent/20 text-accent dark:text-text
                                    @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>

                            <p class="text-sm text-text/70 dark:text-text/80 font-serif">
                                <span class="font-semibold">Last Seen:</span>
                                {{$user->last_active ? $user->last_active->diffForHumans() : 'Never'}}
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2 pt-4 border-t border-text/10">
                            <button wire:click="openModal({{$user->id}})"
                                    class="flex-1 relative px-4 py-2 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border-2 border-primary/50 dark:border-secondary/50 transition-all duration-300 group">
                                <span class="absolute top-0 left-0 w-1.5 h-1.5 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-1.5 h-1.5 border-t border-r border-white/30"></span>
                                Edit
                            </button>

                            <button type="button"
                                    wire:click="delete({{$user->id}})"
                                    wire:confirm="Are you sure you want to remove {{$user->name}} from the registry?"
                                    class="flex-1 relative px-4 py-2 font-serif text-sm text-danger dark:text-danger bg-danger/10 hover:bg-danger/20 border-2 border-danger/50 transition-all duration-300">
                                <span class="absolute bottom-0 left-0 w-1.5 h-1.5 border-b border-l border-danger/30"></span>
                                <span class="absolute bottom-0 right-0 w-1.5 h-1.5 border-b border-r border-danger/30"></span>
                                Delete
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $users->links() }}
        </div>
    </main>

    {{-- Edit User Modal --}}
    <div wire:key="edit-user-modal" class="{{ $displayModel ? 'block' : 'hidden' }}">
        <div class="fixed inset-0 bg-navbg/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="relative bg-white dark:bg-accent/95 rounded-sm border-2 border-primary/30 shadow-2xl max-w-1/2 w-full max-h-[90vh] overflow-y-auto">
                {{-- Modal ornaments --}}
                <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-primary"></div>
                <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-primary"></div>
                <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-primary"></div>
                <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-primary"></div>

                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center gap-3 mb-4">
                            <div class="h-px w-12 bg-primary/30"></div>
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L9.5 8.5L3 9.5L7.5 14L6.5 20.5L12 17L17.5 20.5L16.5 14L21 9.5L14.5 8.5L12 2Z"/>
                            </svg>
                            <div class="h-px w-12 bg-primary/30"></div>
                        </div>
                        <h2 class="font-heading text-text text-2xl">Edit Reader</h2>
                        <p class="text-sm text-text/60 font-serif italic mt-2">Update the reader's information in the registry</p>
                    </div>

                    <form wire:submit="update" class="space-y-6">
                        <div class="space-y-4">
                            <x-forms.input-text name="name" wire:model.blur="name"/>
                            <x-forms.input-email name="email" wire:model.blur="email"/>
                            <x-forms.input-select name="role" wire:model.blur="role" :data="$roleArray"/>
                        </div>

                        <div class="pt-4 border-t border-text/10">
                            <p class="text-sm font-serif text-text/60 mb-4">Leave password fields empty to keep current password</p>
                            <div class="space-y-4">
                                <x-forms.input-password wire:model.blur="password"/>
                                <x-forms.input-conf-password wire:model.blur="password_confirmation"/>
                            </div>
                        </div>

                        <div class="flex gap-4 pt-6 border-t border-text/10">
                            <button type="submit"
                                    class="flex-1 relative px-6 py-3 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border-2 border-primary/50 dark:border-secondary/50 transition-all duration-300">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
                                <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>
                                Save Changes
                            </button>

                            <button type="button" wire:click.prevent="closeModal"
                                    class="flex-1 relative px-6 py-3 font-serif text-sm text-text bg-white/50 dark:bg-navbg/50 hover:bg-white dark:hover:bg-navbg border-2 border-text/20 hover:border-text/40 transition-all duration-300">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
