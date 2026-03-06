<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        // Only admins can view contact messages
        return $user->role === 'admin';
    }

    public function view(User $user, Contact $contact): bool
    {
        // Only admins can view contact messages
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        // Anyone can create contact messages (public form)
        return true;
    }

    public function update(User $user, Contact $contact): bool
    {
        // Only admins can update contact messages (mark as read, etc.)
        return $user->role === 'admin';
    }

    public function delete(User $user, Contact $contact): bool
    {
        // Only admins can delete contact messages
        return $user->role === 'admin';
    }

    public function restore(User $user, Contact $contact): bool
    {
        // Only admins can restore contact messages
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, Contact $contact): bool
    {
        // Only admins can permanently delete contact messages
        return $user->role === 'admin';
    }
}
