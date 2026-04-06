<div>
@if($this->activeBoss)
    <div class="bg-navbg border-b-2 border-purple-500/30 relative overflow-hidden" role="banner" aria-label="Active Boss Encounter">
        {{-- Subtle animated shimmer --}}
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/0 via-purple-500/5 to-purple-900/0 animate-pulse" aria-hidden="true"></div>

        <div class="max-w-(--breakpoint-xl) mx-auto px-4 py-2.5">
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                {{-- Boss Icon & Name --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    {{-- Placeholder for boss artwork --}}
                    <div class="w-8 h-8 rounded-full bg-purple-500/20 border border-purple-500/40 flex items-center justify-center" aria-hidden="true">
                        <i class="fa-solid fa-dragon text-purple-400 text-sm"></i>
                    </div>
                    <div>
                        <p class="text-xs text-purple-300/70 font-serif leading-none">Great Encounter</p>
                        <p class="text-sm font-heading text-white leading-tight">{{ $this->activeBoss->name }}</p>
                    </div>
                </div>

                {{-- HP Bar --}}
                <div class="flex-1 min-w-0" role="meter"
                     aria-label="{{ $this->activeBoss->name }} Health"
                     aria-valuenow="{{ $this->activeBoss->current_hp }}"
                     aria-valuemax="{{ $this->activeBoss->max_hp }}">
                    <div class="flex justify-between text-xs font-serif text-white/40 mb-1">
                        <span>Boss HP</span>
                        <span>{{ number_format($this->activeBoss->current_hp) }} / {{ number_format($this->activeBoss->max_hp) }}</span>
                    </div>
                    <div class="h-2 bg-purple-900/50 rounded-full overflow-hidden border border-purple-500/20">
                        <div class="h-full rounded-full transition-all duration-700
                            {{ $this->activeBoss->hpPercentage() > 50
                                ? 'bg-gradient-to-r from-purple-500 to-violet-400'
                                : ($this->activeBoss->hpPercentage() > 20
                                    ? 'bg-gradient-to-r from-amber-500 to-orange-400'
                                    : 'bg-gradient-to-r from-red-600 to-rose-500') }}"
                             style="width: {{ $this->activeBoss->hpPercentage() }}%"></div>
                    </div>
                </div>

                {{-- Lore tip --}}
                <p class="text-xs font-serif text-white/30 flex-shrink-0 hidden md:block italic">
                    Write, review &amp; bookmark to deal damage.
                </p>

                @if($this->activeBoss->reward_code)
                    <div class="flex-shrink-0">
                        <span class="text-xs font-serif text-purple-300/60 border border-purple-500/20 px-2 py-1 rounded-sm">
                            <i class="fa-solid fa-gift mr-1" aria-hidden="true"></i>Reward awaits
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
</div>
