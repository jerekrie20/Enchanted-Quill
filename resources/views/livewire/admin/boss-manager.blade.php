<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">

    {{-- Header --}}
    <header class="relative mb-10 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-primary/20"></div>
        <div class="absolute top-1 left-0 right-0 h-px bg-secondary/30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <i class="fa-solid fa-dragon text-2xl text-secondary" aria-hidden="true"></i>
                        <h1 class="text-text font-heading text-2xl">The Great Encounters</h1>
                    </div>
                    <p class="text-text/60 font-serif text-sm">Summon and manage Boss fights fueled by site activity.</p>
                </div>
                <button wire:click="openForm()"
                        class="relative bg-secondary hover:bg-secondary/80 text-white font-serif px-5 py-2.5 rounded-sm transition-colors duration-300 inline-flex items-center gap-2 border border-secondary/50">
                    <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                    <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                    Summon Boss
                </button>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">

        {{-- Summon / Edit Form --}}
        @if($showForm)
            <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-secondary/40 p-6" aria-labelledby="form-heading">
                <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
                <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>
                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2 border-secondary/50"></div>
                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2 border-secondary/50"></div>

                <h2 id="form-heading" class="font-heading text-text text-xl mb-6">
                    {{ $editingBossId ? 'Edit Boss' : 'Summon a New Boss' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <div class="md:col-span-2">
                        <label for="boss-name" class="block text-sm font-serif text-text/80 mb-1">Boss Name <span class="text-red-500">*</span></label>
                        <input id="boss-name" type="text" wire:model="name" placeholder="e.g. The Void Eater"
                               class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label for="boss-desc" class="block text-sm font-serif text-text/80 mb-1">Description</label>
                        <textarea id="boss-desc" wire:model="description" rows="3" placeholder="Lore or flavour text for the event…"
                                  class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors resize-none"></textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Scope / Type --}}
                    <div>
                        <label for="boss-type" class="block text-sm font-serif text-text/80 mb-1">Scope <span class="text-red-500">*</span></label>
                        <select id="boss-type" wire:model.live="type"
                                class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                            <option value="site">🌍 World Boss (Site-Wide)</option>
                            <option value="author">✒️ Author's Trial (Author-Specific)</option>
                            <option value="book">📖 Tome Guardian (Book-Specific)</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Target --}}
                    @if($type === 'author')
                        <div>
                            <label for="boss-target-author" class="block text-sm font-serif text-text/80 mb-1">Featured Author <span class="text-red-500">*</span></label>
                            <select id="boss-target-author" wire:model="targetId"
                                    class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                                <option value="">— Select Author —</option>
                                @foreach($this->authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('targetId') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                        </div>
                    @elseif($type === 'book')
                        <div>
                            <label for="boss-target-book" class="block text-sm font-serif text-text/80 mb-1">High-Performing Volume <span class="text-red-500">*</span></label>
                            <select id="boss-target-book" wire:model="targetId"
                                    class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                                <option value="">— Select Book —</option>
                                @foreach($this->books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }} (by {{ $book->author->name }})</option>
                                @endforeach
                            </select>
                            @error('targetId') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                        </div>
                    @else
                        <div></div>
                    @endif

                    {{-- Max HP --}}
                    <div>
                        <label for="boss-hp" class="block text-sm font-serif text-text/80 mb-1">Max HP <span class="text-red-500">*</span></label>
                        <input id="boss-hp" type="number" wire:model="maxHp" min="1"
                               class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                        <p class="text-xs text-text/40 font-serif mt-1">Chapter: 500 dmg · Review: 100 dmg · Bookmark: 50 dmg</p>
                        @error('maxHp') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Reward Code --}}
                    <div>
                        <label for="boss-reward" class="block text-sm font-serif text-text/80 mb-1">Reward Code</label>
                        <input id="boss-reward" type="text" wire:model="rewardCode" placeholder="e.g. BOON25"
                               class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                        <p class="text-xs text-text/40 font-serif mt-1">Discount code or identifier awarded to victors.</p>
                        @error('rewardCode') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Starts At --}}
                    <div>
                        <label for="boss-starts" class="block text-sm font-serif text-text/80 mb-1">Starts At</label>
                        <input id="boss-starts" type="datetime-local" wire:model="startsAt"
                               class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                        @error('startsAt') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>

                    {{-- Ends At --}}
                    <div>
                        <label for="boss-ends" class="block text-sm font-serif text-text/80 mb-1">Ends At</label>
                        <input id="boss-ends" type="datetime-local" wire:model="endsAt"
                               class="w-full bg-white dark:bg-navbg border border-primary/30 focus:border-secondary text-text font-serif text-sm px-4 py-2.5 outline-none transition-colors">
                        @error('endsAt') <p class="text-red-500 text-xs mt-1 font-serif">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <button wire:click="saveBoss"
                            class="relative bg-secondary hover:bg-secondary/80 text-white font-serif px-6 py-2.5 rounded-sm transition-colors duration-300 border border-secondary/50 inline-flex items-center gap-2">
                        <i class="fa-solid fa-fist-raised" aria-hidden="true"></i>
                        {{ $editingBossId ? 'Update Boss' : 'Summon' }}
                    </button>
                    <button wire:click="cancelForm"
                            class="text-text/60 hover:text-text font-serif text-sm transition-colors">
                        Cancel
                    </button>
                </div>
            </section>
        @endif

        {{-- Boss List --}}
        @if($this->bosses->isEmpty())
            <div class="text-center py-16">
                <i class="fa-solid fa-dragon text-6xl text-primary/20 mb-4 block" aria-hidden="true"></i>
                <p class="font-serif text-text/60 italic">No bosses have been summoned yet. The realm is quiet… for now.</p>
            </div>
        @else
            <section aria-label="Active and Inactive Bosses" class="space-y-4">
                @foreach($this->bosses as $boss)
                    <article class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 {{ $boss->is_active ? 'border-secondary/50' : 'border-primary/20' }} p-5 transition-all duration-300"
                             aria-label="{{ $boss->name }}">
                        <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 {{ $boss->is_active ? 'border-secondary/60' : 'border-primary/30' }}"></div>
                        <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 {{ $boss->is_active ? 'border-secondary/60' : 'border-primary/30' }}"></div>
                        <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 {{ $boss->is_active ? 'border-secondary/60' : 'border-primary/30' }}"></div>
                        <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 {{ $boss->is_active ? 'border-secondary/60' : 'border-primary/30' }}"></div>

                        <div class="flex flex-col md:flex-row md:items-start gap-4">
                            {{-- Info --}}
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <h3 class="font-heading text-text text-lg">{{ $boss->name }}</h3>

                                    @if($boss->is_active)
                                        <span class="px-2 py-0.5 bg-secondary/20 text-secondary border border-secondary/30 text-xs font-serif rounded-full">
                                            <i class="fa-solid fa-circle-dot animate-pulse mr-1" aria-hidden="true"></i>Active
                                        </span>
                                    @elseif($boss->isDefeated())
                                        <span class="px-2 py-0.5 bg-green-500/10 text-green-600 dark:text-green-400 border border-green-500/30 text-xs font-serif rounded-full">Defeated</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-primary/10 text-text/50 border border-primary/20 text-xs font-serif rounded-full">Dormant</span>
                                    @endif

                                    <span class="px-2 py-0.5 bg-primary/10 text-text/60 border border-primary/20 text-xs font-serif rounded-full capitalize">
                                        {{ $boss->type === 'site' ? '🌍 World' : ($boss->type === 'author' ? '✒️ Author' : '📖 Tome') }}
                                    </span>
                                </div>

                                @if($boss->description)
                                    <p class="text-sm font-serif text-text/60 italic mb-3">{{ $boss->description }}</p>
                                @endif

                                {{-- HP Bar --}}
                                <div class="mb-3" role="meter" aria-label="{{ $boss->name }} HP" aria-valuenow="{{ $boss->current_hp }}" aria-valuemax="{{ $boss->max_hp }}">
                                    <div class="flex justify-between text-xs font-serif text-text/50 mb-1">
                                        <span>HP</span>
                                        <span>{{ number_format($boss->current_hp) }} / {{ number_format($boss->max_hp) }}</span>
                                    </div>
                                    <div class="h-3 bg-primary/10 dark:bg-primary/20 rounded-full overflow-hidden">
                                        <div class="h-full transition-all duration-500 rounded-full
                                            {{ $boss->hpPercentage() > 50 ? 'bg-green-500' : ($boss->hpPercentage() > 20 ? 'bg-amber-500' : 'bg-red-500') }}"
                                             style="width: {{ $boss->hpPercentage() }}%"></div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-4 text-xs font-serif text-text/50">
                                    @if($boss->reward_code)
                                        <span><i class="fa-solid fa-gift mr-1" aria-hidden="true"></i>Reward: <code class="text-secondary">{{ $boss->reward_code }}</code></span>
                                    @endif
                                    @if($boss->ends_at)
                                        <span><i class="fa-regular fa-clock mr-1" aria-hidden="true"></i>Ends {{ $boss->ends_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <button wire:click="toggleActive({{ $boss->id }})"
                                        class="px-3 py-1.5 text-xs font-serif border transition-colors duration-200
                                            {{ $boss->is_active
                                                ? 'border-amber-500/40 text-amber-600 dark:text-amber-400 hover:bg-amber-500/10'
                                                : 'border-green-500/40 text-green-600 dark:text-green-400 hover:bg-green-500/10' }}"
                                        aria-label="{{ $boss->is_active ? 'Deactivate' : 'Activate' }} {{ $boss->name }}">
                                    {{ $boss->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button wire:click="openForm({{ $boss->id }})"
                                        class="px-3 py-1.5 text-xs font-serif border border-primary/30 text-text/60 hover:text-text hover:border-primary/60 transition-colors duration-200"
                                        aria-label="Edit {{ $boss->name }}">
                                    Edit
                                </button>
                                <button wire:click="deleteBoss({{ $boss->id }})"
                                        wire:confirm="Banish {{ $boss->name }} permanently?"
                                        class="px-3 py-1.5 text-xs font-serif border border-red-500/30 text-red-500/70 hover:text-red-500 hover:border-red-500/60 transition-colors duration-200"
                                        aria-label="Delete {{ $boss->name }}">
                                    Banish
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif

    </main>
</div>
