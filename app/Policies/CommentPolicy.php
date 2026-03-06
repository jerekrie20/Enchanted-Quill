<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Only admins can view all comments
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        // Admins can view all comments, users can view their own
        return $user->role === 'admin' || $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // All authenticated users can create comments
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): Response
    {
        // Admins can update any comment
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can update their own comments
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this comment.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): Response
    {
        // Admins can delete any comment
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can delete their own comments
        return $user->id === $comment->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this comment.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comment $comment): bool
    {
        // Only admins can restore deleted comments
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comment $comment): bool
    {
        // Only admins can permanently delete comments
        return $user->role === 'admin';
    }
}
