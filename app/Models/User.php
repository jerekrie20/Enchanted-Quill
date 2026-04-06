<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'avatar',
        'password',
        'last_active',
        'first_name',
        'last_name',
        'bio',
        'profile_image',
        'notify_messages',
        'notify_book_updates',
        'notify_publication',
        'notify_author_actions',
        'notify_new_users',
        'notify_payments',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_active' => 'datetime',
            'notify_messages' => 'boolean',
            'notify_book_updates' => 'boolean',
            'notify_publication' => 'boolean',
            'notify_author_actions' => 'boolean',
            'notify_new_users' => 'boolean',
            'notify_payments' => 'boolean',
        ];
    }

    /**
     * Get the blogs created by the user.
     */
    public function blogs(): hasMany
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get the reviews created by the user.
     */
    public function reviews(): hasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the comments created by the user.
     */
    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the books authored by the user.
     */
    public function books(): hasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * Get the bookmarks created by the user.
     */
    public function bookmarks(): hasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
