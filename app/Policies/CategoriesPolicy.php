<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Only admins can manage categories
        return $user->role === 'admin';
    }

    public function view(User $user, Category $category): bool
    {
        // Only admins can view category details
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        // Only admins can create categories
        return $user->role === 'admin';
    }

    public function update(User $user, Category $category): bool
    {
        // Only admins can update categories
        return $user->role === 'admin';
    }

    public function delete(User $user, Category $category): bool
    {
        // Only admins can delete categories
        return $user->role === 'admin';
    }

    public function restore(User $user, Category $category): bool
    {
        // Only admins can restore categories
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Category $category): bool
    {
        // Only admins can permanently delete categories
        return $user->role === 'admin';
    }
}
