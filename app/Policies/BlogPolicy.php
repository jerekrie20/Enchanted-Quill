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

    public function view(?User $user, Blog $blog): Response
    {
        // If the blog is published or private, guests can view it in listings/details (interaction is gated)
        if ($blog->isPublished()) {
            return Response::allow();
        }

        // For unpublished blogs, guests are denied
        if (! $user) {
            return Response::deny('You must be logged in to view this blog.');
        }
        // Admins can view all blogs
        if ($user->role == 'admin') {
            return Response::allow();
        }

        // Users can only view their own unpublished or private blogs
        return $user->id == $blog->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to view this blog.');
    }

    public function create(User $user): Response
    {
        return in_array($user->role, ['admin', 'author'])
            ? Response::allow()
            : Response::deny('You are not authorized to create a blog post.');
    }

    public function update(User $user, Blog $blog): Response
    {
        // Admins can update all blogs
        if ($user->role == 'admin') {
            return Response::allow();
        }

        // Users can only update their own blog
        return $user->id == $blog->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this blog.');
    }

    public function delete(User $user, Blog $blog): Response
    {
        // Future: This will be a soft delete

        // Admins can delete all blogs
        if ($user->role == 'admin') {
            return Response::allow();
        }

        // Users can only delete their own blog
        return $user->id == $blog->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this blog.');

    }

    public function restore(User $user, Blog $blog): bool
    {
        // Admins can restore any blogs
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Blog $blog): bool
    {
        // Only admins can hard delete
        return $user->role === 'admin';
    }
}
