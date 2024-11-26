<?php

namespace App\Models;

use App\Enums\ReviewRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'content',
        'stars',
    ];

    protected $casts = [
        'stars' => ReviewRating::class,
    ];

    /**
     * The user who created the review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The book being reviewed.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeByRating($query, $rating)
    {
        return $query->where('stars', '>=', $rating);
    }
}
