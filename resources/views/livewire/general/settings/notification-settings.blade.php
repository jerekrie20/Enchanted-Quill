<section aria-labelledby="notifications-section-heading">
    <div class="p-6 border-b-2 border-purple-500/20">
        <h2 id="notifications-section-heading" class="text-xl font-heading text-text flex items-center gap-2">
            <i class="fa-solid fa-bell text-purple-500" aria-hidden="true"></i> Notification Preferences
        </h2>
        <p class="text-sm text-text/60 font-serif mt-1">Manage how you receive updates from the Enchanted Quill.</p>
    </div>

    <div class="p-6">
        @if (session()->has('notifications-updated'))
            <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 text-green-700 dark:text-green-400 rounded-sm font-serif" role="alert">
                <i class="fa-solid fa-check-circle mr-2" aria-hidden="true"></i> {{ session('notifications-updated') }}
            </div>
        @endif

        <form wire:submit="updateNotifications">
            <div class="space-y-6">
                {{-- User Notifications --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-heading text-purple-600 dark:text-violet-400 uppercase tracking-wider">General Notifications</h3>

                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <label for="notify_messages" class="text-base font-serif text-text">Internal Messages</label>
                            <p class="text-sm text-text/60 font-serif italic">Receive email notifications when you receive a new message.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="notify_messages" id="notify_messages" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <label for="notify_book_updates" class="text-base font-serif text-text">Book Updates</label>
                            <p class="text-sm text-text/60 font-serif italic">Receive email notifications when new chapters are added to books you're reading.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="notify_book_updates" id="notify_book_updates" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <label for="notify_author_actions" class="text-base font-serif text-text">Author Actions</label>
                            <p class="text-sm text-text/60 font-serif italic">Receive email notifications when authors you follow publish new works.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="notify_author_actions" id="notify_author_actions" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                        </label>
                    </div>
                </div>

                @if(auth()->user()->role === 'author' || auth()->user()->role === 'admin')
                    <hr class="border-purple-500/20">

                    {{-- Author Notifications --}}
                    <div class="space-y-4">
                        <h3 class="text-sm font-heading text-purple-600 dark:text-violet-400 uppercase tracking-wider">Author Notifications</h3>

                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <label for="notify_publication" class="text-base font-serif text-text">Publication Updates</label>
                                <p class="text-sm text-text/60 font-serif italic">Receive confirmation emails when your scheduled works are published.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="notify_publication" id="notify_publication" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <label for="notify_new_users" class="text-base font-serif text-text">New Readers/Followers</label>
                                <p class="text-sm text-text/60 font-serif italic">Receive notifications when new users follow your profile or subscribe to your works.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="notify_new_users" id="notify_new_users" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <label for="notify_payments" class="text-base font-serif text-text">Payments & Sales</label>
                                <p class="text-sm text-text/60 font-serif italic">Receive notifications for new purchases and royalty payments.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="notify_payments" id="notify_payments" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none dark:bg-navbg peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-purple-500/30 peer-checked:bg-purple-600"></div>
                            </label>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-8">
                <button type="submit" class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" wire:loading.attr="disabled">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    <span wire:loading.remove wire:target="updateNotifications"><i class="fa-solid fa-save" aria-hidden="true"></i> Save Preferences</span>
                    <span wire:loading wire:target="updateNotifications"><i class="fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Saving...</span>
                </button>
            </div>
        </form>
    </div>
</section>
