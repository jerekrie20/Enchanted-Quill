<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vocation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'bonus_description',
        'bonus_type',
        'bonus_value',
        'required_achievement_id',
    ];

    /**
     * The achievement that unlocks this vocation.
     */
    public function requiredAchievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class, 'required_achievement_id');
    }

    /**
     * Users who have discovered this vocation.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'vocation_id');
    }
}
