<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserRegistrationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdminsOfNewRegistration implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        // Notify admins who want to be notified of new users
        $admins = User::where('role', 'admin')
            ->where('notify_new_users', true)
            ->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewUserRegistrationNotification($user));
        }
    }
}
