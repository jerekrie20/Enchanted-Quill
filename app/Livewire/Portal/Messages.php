<?php

namespace App\Livewire\Portal;

use App\Mail\AdminContactNotification;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    #[Layout('components.layouts.portal')]
    #[Title('My Messages')]
    public $selectedMessage = null;

    public $replyMessage = '';

    public function viewMessage($messageId)
    {
        $message = Contact::with('replies')
            ->where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->findOrFail($messageId);

        $this->selectedMessage = $message;
        $this->replyMessage = '';
    }

    public function sendReply()
    {
        $this->validate([
            'replyMessage' => 'required|string|min:2|blasp_check',
        ]);

        $reply = Contact::create([
            'parent_id' => $this->selectedMessage->id,
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'message' => $this->replyMessage,
            'status' => Contact::STATUS_UNREAD,
            'is_from_admin' => false,
        ]);

        // Set the main ticket back to unread so admins know there is a new reply
        $this->selectedMessage->update(['status' => Contact::STATUS_UNREAD]);

        // Notify admin of new reply
        $admin = User::where('role', 'admin')->first();
        $adminEmail = $admin ? $admin->email : config('mail.from.address');

        Mail::to($adminEmail)->send(new AdminContactNotification($reply));

        $this->selectedMessage = $this->selectedMessage->fresh('replies');
        $this->replyMessage = '';

        session()->flash('success', 'Reply sent successfully!');
    }

    public function closeMessageModal()
    {
        $this->selectedMessage = null;
    }

    public function render()
    {
        $messages = Contact::where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->withCount('replies')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('livewire.portal.messages', [
            'messages' => $messages,
        ]);
    }
}
