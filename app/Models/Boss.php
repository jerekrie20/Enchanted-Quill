<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boss extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'target_id',
        'max_hp',
        'current_hp',
        'reward_code',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'max_hp' => 'integer',
            'current_hp' => 'integer',
        ];
    }

    /**
     * The author or book this boss is tied to (polymorphic-ish via type+target_id).
     */
    public function targetAuthor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function targetBook(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'target_id');
    }

    /**
     * Percentage of HP remaining (0–100).
     */
    public function hpPercentage(): int
    {
        if ($this->max_hp === 0) {
            return 0;
        }

        return (int) round(($this->current_hp / $this->max_hp) * 100);
    }

    /**
     * Whether the boss has been defeated.
     */
    public function isDefeated(): bool
    {
        return $this->current_hp <= 0;
    }

    /**
     * Scope: only active bosses that haven't expired yet.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
            });
    }

    /**
     * Scope: site-wide bosses.
     */
    public function scopeSiteWide(Builder $query): Builder
    {
        return $query->where('type', 'site');
    }

    /**
     * Scope: bosses scoped to a specific author.
     */
    public function scopeForAuthor(Builder $query, int $authorId): Builder
    {
        return $query->where('type', 'author')->where('target_id', $authorId);
    }

    /**
     * Scope: bosses scoped to a specific book.
     */
    public function scopeForBook(Builder $query, int $bookId): Builder
    {
        return $query->where('type', 'book')->where('target_id', $bookId);
    }
}
