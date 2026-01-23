<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;


    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_PRIVATE = 2;

    const STATUS_Publish_later = 3;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'user_id',
        'status',
        'image',
        'publish_at'
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
            self::STATUS_Publish_later => 'Publish Later',
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

}
