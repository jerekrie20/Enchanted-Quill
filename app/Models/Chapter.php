<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'chapter_number',
        'content',
    ];

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
