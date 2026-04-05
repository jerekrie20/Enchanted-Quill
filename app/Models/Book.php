<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    // Define status constants
    const STATUS_DRAFT = 0;

    const STATUS_PUBLISHED = 1;

    const STATUS_PRIVATE = 2;

    const STATUS_SCHEDULED = 3;

    const STATUS_ARCHIVED = 4;

    /**
     * Get the human-readable status label for the book.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_PRIVATE => 'Private',
            self::STATUS_SCHEDULED => 'Publish Later',
            self::STATUS_ARCHIVED => 'Archived',
            default => 'Unknown',
        };
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover',
        'user_id',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * A book belongs to many categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_categories')->withTimestamps();
    }

    /**
     * A book belongs to one author (user).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A book has many reviews.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A book has many chapters.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * Check if the book is published.
     */
    public function isPublished(): bool
    {
        return in_array($this->status, [self::STATUS_PUBLISHED, self::STATUS_PRIVATE])
            && ($this->published_at === null || $this->published_at <= now());
    }

    /**
     * Scope a query to only include published books.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereIn('status', [self::STATUS_PUBLISHED, self::STATUS_PRIVATE])
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Get the bookmarks for this book.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class, 'bookmarkable_id')
            ->where('bookmarkable_type', self::class);
    }
}
