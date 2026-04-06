<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Achievement extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'icon_path',
        'requirement_type',
        'requirement_value',
        'is_hidden',
    ];

    protected function casts(): array
    {
        return [
            'is_hidden' => 'boolean',
            'requirement_value' => 'integer',
        ];
    }

    /**
     * Users who have earned this achievement.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    /**
     * The vocation this achievement unlocks, if any.
     */
    public function vocation(): HasOne
    {
        return $this->hasOne(Vocation::class, 'required_achievement_id');
    }
}
