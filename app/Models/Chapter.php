<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;

    const STATUS_PUBLISHED = 1;

    const STATUS_PRIVATE = 2;

    const STATUS_SCHEDULED = 3;

    const STATUS_ARCHIVED = 4;

    protected $fillable = [
        'book_id',
        'chapter_number',
        'title',
        'content',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the human-readable status label for the chapter.
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

    /**
     * A chapter belongs to a book.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Scope to find chapters by book and chapter number.
     */
    public function scopeByBookAndNumber($query, $bookId, $chapterNumber)
    {
        return $query->where('book_id', $bookId)
            ->where('chapter_number', $chapterNumber);
    }
}
