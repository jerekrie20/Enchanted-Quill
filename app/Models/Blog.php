<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_DRAFT = 0;

    const STATUS_PUBLISHED = 1;

    const STATUS_PRIVATE = 2;

    const STATUS_SCHEDULED = 3;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'user_id',
        'status',
        'publish_at',
    ];

    /**
     * Get the human-readable status label for the blog.
     * Use $blog->status_label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_PRIVATE => 'Private',
            self::STATUS_SCHEDULED => 'Publish Later',
            default => 'Unknown',
        };
    }

    /**
     * A blog belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A blog belongs to many categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blog_categories')->withTimestamps();
    }

    /**
     * A blog has to many comments.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check if the blog is published.
     */
    public function isPublished(): bool
    {
        return in_array($this->status, [self::STATUS_PUBLISHED, self::STATUS_PRIVATE])
            && ($this->publish_at === null || $this->publish_at <= now());
    }

    /**
     * Scope a query to only include published blogs.
     */
    public function scopePublished($query)
    {
        return $query->whereIn('status', [self::STATUS_PUBLISHED, self::STATUS_PRIVATE])
            ->where(function ($q) {
                $q->whereNull('publish_at')
                    ->orWhere('publish_at', '<=', now());
            });
    }

    protected function casts(): array
    {
        return [
            'publish_at' => 'datetime',
        ];
    }
}
