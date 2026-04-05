<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Authors and admins can view the books list
        return in_array($user->role, ['admin', 'author']);
    }

    public function view(?User $user, Book $book): Response
    {
        // If the book is published, anyone can view its detail page
        if ($book->isPublished()) {
            return Response::allow();
        }

        // For unpublished books, guests are denied
        if (! $user) {
            return Response::deny('You must be logged in to view this book.');
        }

        // Admins can view all books
        if ($user->role === 'admin') {
            return Response::allow();
        }

        // Authors can view their own books
        return $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to view this book.');
    }

    public function create(User $user): bool
    {
        // Authors and admins can create books
        return in_array($user->role, ['admin', 'author']);
    }

    public function update(User $user, Book $book): Response
    {
        // Admins can update all blogs
        if ($user->role == 'admin') {
            return Response::allow();
        }

        // Ensure the user can update their own book
        return $user->id == $book->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this Book.');
    }

    public function delete(User $user, Book $book): Response
    {
        // Admins can delete all blogs
        if ($user->role == 'admin') {
            return Response::allow();
        }

        // Ensure the user can only delete their own books
        return $user->id == $book->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to delete this Book.');
    }

    public function restore(User $user, Book $book): bool
    {
        // Only admins can restore deleted books
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Book $book): bool
    {
        // Only admins can permanently delete books
        return $user->role === 'admin';
    }
}
