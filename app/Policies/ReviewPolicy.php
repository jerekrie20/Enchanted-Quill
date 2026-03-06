<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Only admins can view all reviews in the admin panel
        return $user->role === 'admin';
    }

    public function view(User $user, Review $review): bool
    {
        // Admins can view all reviews, users can view their own
        return $user->role === 'admin' || $user->id === $review->user_id;
    }

    public function create(User $user): bool
    {
        // All authenticated users can create reviews
        return true;
    }

    public function update(User $user, Review $review): Response
    {
        // Admins can update any review
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can update their own reviews
        return $user->id === $review->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this review.');
    }

    public function delete(User $user, Review $review): Response
    {
        // Admins can delete any review
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can delete their own reviews
        return $user->id === $review->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this review.');
    }

    public function restore(User $user, Review $review): bool
    {
        // Only admins can restore deleted reviews
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Review $review): bool
    {
        // Only admins can permanently delete reviews
        return $user->role === 'admin';
    }
}
