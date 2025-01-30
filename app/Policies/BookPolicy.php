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

    }

    public function view(User $user, Book $book): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Book $book): Response
    {
        //Admins can update all blogs
        if ($user->role == 'admin'){
            return Response::allow();
        }

        // Ensure the user can update their own book
        return $user->id == $book->author->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to edit this blog.');
    }

    public function delete(User $user, Book $book): bool
    {
    }

    public function restore(User $user, Book $book): bool
    {
    }

    public function forceDelete(User $user, Book $book): bool
    {
    }
}
