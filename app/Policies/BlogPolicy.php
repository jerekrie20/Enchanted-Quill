<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Blog $blog): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Blog $blog): bool
    {
    }

    public function delete(User $user, Blog $blog): bool
    {
    }

    public function restore(User $user, Blog $blog): bool
    {
    }

    public function forceDelete(User $user, Blog $blog): bool
    {
    }
}
