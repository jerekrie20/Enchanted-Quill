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

    }

    public function view(User $user, Category $categories): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Category $categories): bool
    {
    }

    public function delete(User $user, Category $categories): bool
    {
    }

    public function restore(User $user, Category $categories): bool
    {
    }

    public function forceDelete(User $user, Category $categories): bool
    {
    }
}
