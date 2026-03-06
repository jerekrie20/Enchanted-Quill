<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    {{-- Page Header --}}
    <section class="bg-navbg relative py-12 border-b-2 border-purple-500/20" aria-labelledby="settings-heading">
        <div class="absolute top-0 left-0 right-0 h-1 bg-purple-500/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-violet-400/30"></div>

        <div class="max-w-(--breakpoint-xl) mx-auto px-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-cog text-purple-500 text-xl" aria-hidden="true"></i>
                </div>
                <h1 id="settings-heading" class="text-3xl md:text-4xl font-heading text-white">Account Settings</h1>
            </div>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-12">
        {{-- Profile Information --}}
        <section class="mb-8" aria-labelledby="profile-section-heading">
            <div class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 overflow-hidden">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                <div class="p-6 border-b-2 border-purple-500/20">
                    <h2 id="profile-section-heading" class="text-xl font-heading text-text flex items-center gap-2">
                        <i class="fa-solid fa-user text-purple-500" aria-hidden="true"></i> Profile Information
                    </h2>
                    <p class="text-sm text-text/60 font-serif mt-1">Update your account's profile information and email address.</p>
                </div>

                <div class="p-6">
                    @if (session()->has('profile-updated'))
                        <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 text-green-700 dark:text-green-400 rounded-sm font-serif" role="alert">
                            <i class="fa-solid fa-check-circle mr-2" aria-hidden="true"></i> {{ session('profile-updated') }}
                        </div>
                    @endif

                    <form wire:submit="updateProfile">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-serif text-text mb-2">Name</label>
                            <input type="text" id="name" wire:model="name" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors" required>
                            @error('name') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-serif text-text mb-2">Email</label>
                            <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors" required>
                            @error('email') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="bio" class="block text-sm font-serif text-text mb-2">Bio</label>
                            <textarea id="bio" wire:model="bio" rows="3" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors resize-none" placeholder="Tell us a bit about yourself..."></textarea>
                            @error('bio') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" wire:loading.attr="disabled">
                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                            <span wire:loading.remove wire:target="updateProfile"><i class="fa-solid fa-save" aria-hidden="true"></i> Save Changes</span>
                            <span wire:loading wire:target="updateProfile"><i class="fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Saving...</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        {{-- Profile Image --}}
        <section class="mb-8" aria-labelledby="profile-image-heading">
            <div class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 overflow-hidden">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                <div class="p-6 border-b-2 border-purple-500/20">
                    <h2 id="profile-image-heading" class="text-xl font-heading text-text flex items-center gap-2">
                        <i class="fa-solid fa-image text-purple-500" aria-hidden="true"></i> Profile Image
                    </h2>
                    <p class="text-sm text-text/60 font-serif mt-1">Update your profile picture.</p>
                </div>

                <div class="p-6">
                    @if (session()->has('image-updated'))
                        <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 text-green-700 dark:text-green-400 rounded-sm font-serif" role="alert">
                            <i class="fa-solid fa-check-circle mr-2" aria-hidden="true"></i> {{ session('image-updated') }}
                        </div>
                    @endif

                    @if (session()->has('image-removed'))
                        <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 text-green-700 dark:text-green-400 rounded-sm font-serif" role="alert">
                            <i class="fa-solid fa-check-circle mr-2" aria-hidden="true"></i> {{ session('image-removed') }}
                        </div>
                    @endif

                    <div class="flex items-start gap-6">
                        <div class="w-24 h-24 bg-purple-500/10 rounded-full flex items-center justify-center flex-shrink-0 border-4 border-purple-500/30" role="img" aria-label="Current profile picture">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile picture" class="w-full h-full rounded-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-4xl text-purple-500 dark:text-violet-400" aria-hidden="true"></i>
                            @endif
                        </div>

                        <div class="flex-1">
                            <form wire:submit="updateProfileImage">
                                <div class="mb-4">
                                    <label for="profile_image" class="block text-sm font-serif text-text mb-2">Choose New Image</label>
                                    <input type="file" id="profile_image" wire:model="profile_image" accept="image/*" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors">
                                    @error('profile_image') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                                    <p class="text-xs text-text/60 font-serif mt-1">Maximum file size: 2MB</p>
                                </div>

                                <div class="flex gap-3">
                                    <button type="submit" class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50 text-sm" wire:loading.attr="disabled" wire:target="profile_image, updateProfileImage">
                                        <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                        <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                        <span wire:loading.remove wire:target="updateProfileImage"><i class="fa-solid fa-upload" aria-hidden="true"></i> Upload</span>
                                        <span wire:loading wire:target="updateProfileImage"><i class="fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Uploading...</span>
                                    </button>

                                    @if(auth()->user()->profile_image)
                                        <button type="button" wire:click="removeProfileImage" class="relative bg-red-600 hover:bg-red-700 text-white font-serif px-4 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-red-500/50 text-sm" wire:loading.attr="disabled" wire:target="removeProfileImage">
                                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                            <span wire:loading.remove wire:target="removeProfileImage"><i class="fa-solid fa-trash" aria-hidden="true"></i> Remove</span>
                                            <span wire:loading wire:target="removeProfileImage"><i class="fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Removing...</span>
                                        </button>
                                    @endif
                                </div>
                            </form>

                            <div wire:loading wire:target="profile_image" class="mt-2 text-sm text-purple-600 dark:text-violet-400 font-serif">
                                <i class="fa-solid fa-spinner fa-spin mr-1" aria-hidden="true"></i> Loading preview...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Update Password --}}
        <section class="mb-8" aria-labelledby="password-section-heading">
            <div class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm rounded-none border-2 border-purple-500/30 dark:border-purple-400/20 overflow-hidden">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-purple-500/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-purple-500/50"></div>

                <div class="p-6 border-b-2 border-purple-500/20">
                    <h2 id="password-section-heading" class="text-xl font-heading text-text flex items-center gap-2">
                        <i class="fa-solid fa-lock text-purple-500" aria-hidden="true"></i> Update Password
                    </h2>
                    <p class="text-sm text-text/60 font-serif mt-1">Ensure your account is using a strong password to stay secure.</p>
                </div>

                <div class="p-6">
                    @if (session()->has('password-updated'))
                        <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 text-green-700 dark:text-green-400 rounded-sm font-serif" role="alert">
                            <i class="fa-solid fa-check-circle mr-2" aria-hidden="true"></i> {{ session('password-updated') }}
                        </div>
                    @endif

                    <form wire:submit="updatePassword">
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-serif text-text mb-2">Current Password</label>
                            <input type="password" id="current_password" wire:model="current_password" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors" required>
                            @error('current_password') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="block text-sm font-serif text-text mb-2">New Password</label>
                            <input type="password" id="new_password" wire:model="new_password" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors" required>
                            @error('new_password') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="new_password_confirmation" class="block text-sm font-serif text-text mb-2">Confirm New Password</label>
                            <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation" class="w-full px-4 py-2 bg-white/50 dark:bg-navbg/50 border-2 border-purple-500/30 dark:border-purple-400/20 focus:border-purple-500 focus:outline-none text-text font-serif rounded-none transition-colors" required>
                            @error('new_password_confirmation') <span class="text-red-500 text-sm font-serif mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="relative bg-violet-600 hover:bg-violet-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-serif px-6 py-2 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-violet-500/50" wire:loading.attr="disabled">
                            <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                            <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                            <span wire:loading.remove wire:target="updatePassword"><i class="fa-solid fa-key" aria-hidden="true"></i> Update Password</span>
                            <span wire:loading wire:target="updatePassword"><i class="fa-solid fa-spinner fa-spin" aria-hidden="true"></i> Updating...</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
