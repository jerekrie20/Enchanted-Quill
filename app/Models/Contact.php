<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'user_id',
        'parent_id',
        'is_from_admin',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'is_from_admin' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Contact::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Contact::class, 'parent_id');
    }

    /**
     * Status constants
     */
    public const STATUS_UNREAD = 0;

    public const STATUS_READ = 1;

    public const STATUS_REPLIED = 2;

    public const STATUS_ARCHIVED = 3;

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_UNREAD => 'Unread',
            self::STATUS_READ => 'Read',
            self::STATUS_REPLIED => 'Replied',
            self::STATUS_ARCHIVED => 'Archived',
            default => 'Unknown',
        };
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', self::STATUS_UNREAD);
    }
}
