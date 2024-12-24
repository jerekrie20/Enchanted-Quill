<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admins can view all users.
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        // Admins can view all users.
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can only view their own data.
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You are not authorized to view this user.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only admins can create users.
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        // Admins can update any user.
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can only update their own data.
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You are not authorized to update this user.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        // Admins can delete any user.
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Users can only delete their own account.
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You are not authorized to view this user.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Only admins can restore users.
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Only admins can permanently delete users.
        return $user->role === 'admin';
    }
}
