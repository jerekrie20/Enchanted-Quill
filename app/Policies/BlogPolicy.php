<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Admins can view all blogs.
        return $user->role === 'admin';
    }

    public function view(User $user, Blog $blog): Response
    {
        //Admins can view all blogs
        if ($user->role == 'admin'){
            return Response::allow();
        }

        //Users can only view their own blog
        return $user->id == $blog->id
            ? Response::allow()
            : Response::deny('You are not authorized to view this blog.');
    }

    public function create(User $user): Response
    {

    }

    public function update(User $user, Blog $blog): Response
    {
        //Admins can update all blogs
        if ($user->role == 'admin'){
            return Response::allow();
        }

        //Users can only update their own blog
        return $user->id == $blog->id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this blog.');
    }

    public function delete(User $user, Blog $blog): Response
    {
        //Future: This will be a soft delete

        //Admins can delete all blogs
        if ($user->role == 'admin'){
            return Response::allow();
        }

        //Users can only delete their own blog
        return $user->id == $blog->id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this blog.');

    }

    public function restore(User $user, Blog $blog): bool
    {
        //Future: Admins can restore any blogs while users can only restore their blog
    }

    public function forceDelete(User $user, Blog $blog): bool
    {
        //Future: Only admins can forceDelete(Hard delete)
    }
}
