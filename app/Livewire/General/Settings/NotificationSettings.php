<?php

namespace App\Livewire\General\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationSettings extends Component
{
    public $notify_messages;

    public $notify_book_updates;

    public $notify_publication;

    public $notify_author_actions;

    public $notify_new_users;

    public $notify_payments;

    public function mount(): void
    {
        $user = Auth::user();
        $this->notify_messages = $user->notify_messages;
        $this->notify_book_updates = $user->notify_book_updates;
        $this->notify_publication = $user->notify_publication;
        $this->notify_author_actions = $user->notify_author_actions;
        $this->notify_new_users = $user->notify_new_users;
        $this->notify_payments = $user->notify_payments;
    }

    public function updateNotifications(): void
    {
        $user = Auth::user();
        $user->update([
            'notify_messages' => $this->notify_messages,
            'notify_book_updates' => $this->notify_book_updates,
            'notify_publication' => $this->notify_publication,
            'notify_author_actions' => $this->notify_author_actions,
            'notify_new_users' => $this->notify_new_users,
            'notify_payments' => $this->notify_payments,
        ]);

        session()->flash('notifications-updated', 'Notification preferences updated successfully.');
    }

    public function render()
    {
        return view('livewire.general.settings.notification-settings');
    }
}
