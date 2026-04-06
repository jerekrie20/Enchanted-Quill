<?php

namespace App\Listeners;

use App\Events\BookmarkCreated;
use App\Events\ContentPublished;
use App\Events\ReviewCreated;
use App\Models\Achievement;
use App\Models\Boss;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

/**
 * The Background Reaper — listens for site activity and drives the gamification engine.
 *
 * Responsibilities per event:
 *   1. Award Ink (XP) to the acting user
 *   2. Decrement HP on any active Boss matching the event scope
 *   3. Check whether the user has unlocked new Achievements
 *   4. Check whether a newly-earned Achievement reveals a hidden Vocation
 */
class GamificationListener implements ShouldQueue
{
    use InteractsWithQueue;

    /** @var array<string, int> Ink (XP) awarded per action type */
    private const INK_REWARDS = [
        'chapter_published' => 100,
        'book_published' => 500,
        'blog_published' => 75,
        'review_created' => 25,
        'bookmark_created' => 10,
    ];

    /** @var array<string, int> Boss HP damage per action type */
    private const BOSS_DAMAGE = [
        'chapter_published' => 500,
        'book_published' => 1000,
        'blog_published' => 300,
        'review_created' => 100,
        'bookmark_created' => 50,
    ];

    public function handle(object $event): void
    {
        [$user, $actionType, $bookId, $authorId] = $this->resolveEventContext($event);

        if (! $user) {
            return;
        }

        $inkMultiplier = $this->resolveInkMultiplier($user);

        $this->awardInk($user, $actionType, $inkMultiplier);
        $this->damageBosses($actionType, $bookId, $authorId);
        $this->checkAchievements($user);
        $this->checkVocationDiscovery($user);
    }

    /**
     * Resolve which user, action type, and scope identifiers apply to this event.
     *
     * @return array{0: ?User, 1: string, 2: ?int, 3: ?int}
     */
    private function resolveEventContext(object $event): array
    {
        if ($event instanceof ContentPublished) {
            $content = $event->content;
            $type = class_basename($content);

            if ($type === 'Chapter') {
                $author = $content->book?->author;

                return [$author, 'chapter_published', $content->book_id, $author?->id];
            }

            if ($type === 'Book') {
                return [$content->author, 'book_published', $content->id, $content->author?->id];
            }

            if ($type === 'Blog') {
                return [$content->user, 'blog_published', null, $content->user?->id];
            }
        }

        if ($event instanceof ReviewCreated) {
            return [$event->user, 'review_created', $event->review->book_id, null];
        }

        if ($event instanceof BookmarkCreated) {
            $bookId = $event->bookmark->bookmarkable_type === \App\Models\Book::class
                ? $event->bookmark->bookmarkable_id
                : null;

            return [$event->user, 'bookmark_created', $bookId, null];
        }

        return [null, '', null, null];
    }

    /**
     * Award Ink to the user, applying any vocation multiplier.
     */
    private function awardInk(User $user, string $actionType, float $multiplier): void
    {
        $base = self::INK_REWARDS[$actionType] ?? 0;
        $amount = (int) round($base * $multiplier);

        if ($amount > 0) {
            $user->increment('ink_total', $amount);
        }
    }

    /**
     * Decrement HP on all active bosses relevant to this action.
     *
     * Site bosses: always hit.
     * Author bosses: hit when the acting author matches the boss target.
     * Book bosses: hit when the book matches the boss target.
     */
    private function damageBosses(string $actionType, ?int $bookId, ?int $authorId): void
    {
        $damage = self::BOSS_DAMAGE[$actionType] ?? 0;

        if ($damage === 0) {
            return;
        }

        $activeBosses = Boss::active()->get();

        foreach ($activeBosses as $boss) {
            $isRelevant = match ($boss->type) {
                'site' => true,
                'author' => $authorId !== null && $boss->target_id === $authorId,
                'book' => $bookId !== null && $boss->target_id === $bookId,
                default => false,
            };

            if (! $isRelevant) {
                continue;
            }

            // Use atomic DB decrement clamped to zero to avoid going negative
            DB::table('bosses')
                ->where('id', $boss->id)
                ->where('current_hp', '>', 0)
                ->update([
                    'current_hp' => DB::raw("GREATEST(0, current_hp - {$damage})"),
                ]);

            // Deactivate the boss if it is now defeated
            $boss->refresh();
            if ($boss->isDefeated()) {
                $boss->update(['is_active' => false]);
            }
        }
    }

    /**
     * Check all achievement definitions and award any newly-earned ones.
     */
    private function checkAchievements(User $user): void
    {
        $earnedSlugs = $user->achievements()->pluck('slug')->all();

        $candidates = Achievement::whereNotIn('slug', $earnedSlugs)->get();

        foreach ($candidates as $achievement) {
            if ($this->userMeetsRequirement($user, $achievement->requirement_type, $achievement->requirement_value)) {
                $user->achievements()->attach($achievement->id, ['earned_at' => now()]);
            }
        }
    }

    /**
     * Evaluate a single achievement requirement against live user data.
     */
    private function userMeetsRequirement(User $user, string $requirementType, int $requirementValue): bool
    {
        return match ($requirementType) {
            'chapters_published' => $user->books()
                ->withCount(['chapters as published_chapters_count' => fn ($q) => $q->where('status', 1)])
                ->get()
                ->sum('published_chapters_count') >= $requirementValue,

            'books_bookmarked' => $user->bookmarks()
                ->where('bookmarkable_type', \App\Models\Book::class)
                ->count() >= $requirementValue,

            'reviews_given' => $user->reviews()->count() >= $requirementValue,

            'reviews_starred' => $user->reviews()
                ->where('stars', '>=', 4)
                ->count() >= $requirementValue,

            'ink_total' => $user->ink_total >= $requirementValue,

            default => false,
        };
    }

    /**
     * If the user has earned an achievement that unlocks a hidden vocation, assign it.
     */
    private function checkVocationDiscovery(User $user): void
    {
        if ($user->vocation_id !== null) {
            return;
        }

        $user->loadMissing('achievements');

        $earnedIds = $user->achievements->pluck('id');

        $vocation = \App\Models\Vocation::whereIn('required_achievement_id', $earnedIds)->first();

        if ($vocation) {
            $user->update(['vocation_id' => $vocation->id]);
        }
    }

    /**
     * Resolve the Ink multiplier for the user's current vocation (if any).
     */
    private function resolveInkMultiplier(User $user): float
    {
        if ($user->vocation_id === null) {
            return 1.0;
        }

        $user->loadMissing('vocation');

        if ($user->vocation?->bonus_type === 'ink_multiplier') {
            return (float) $user->vocation->bonus_value;
        }

        return 1.0;
    }
}
