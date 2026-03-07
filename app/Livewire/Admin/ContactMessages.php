<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ContactMessages extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.admin')]
    #[Title('Contact Messages')]

    #[Url]
    public $search = '';

    public $filterStatus;

    public $sort = 'desc';

    public $perPage = 15;

    public $selectedMessage = null;

    public $showMessageModal = false;

    public $showComposeModal = false;

    public $replyMessage = '';

    public $composeUserId = '';

    public $composeSubject = '';

    public $composeMessage = '';

    public function viewMessage($messageId): void
    {
        $message = Contact::with(['replies', 'user'])->findOrFail($messageId);

        $this->authorize('view', $message);

        // Mark as read if unread
        if ($message->status === Contact::STATUS_UNREAD) {
            $message->update(['status' => Contact::STATUS_READ]);
        }

        $this->selectedMessage = $message;
        $this->showMessageModal = true;
        $this->replyMessage = '';
    }

    public function openComposeModal(): void
    {
        $this->showComposeModal = true;
        $this->composeUserId = '';
        $this->composeSubject = '';
        $this->composeMessage = '';
    }

    public function closeComposeModal(): void
    {
        $this->showComposeModal = false;
    }

    public function sendMessage(): void
    {
        $this->validate([
            'composeUserId' => 'required|exists:users,id',
            'composeSubject' => 'required|string|max:255',
            'composeMessage' => 'required|string|min:2',
        ]);

        $user = \App\Models\User::find($this->composeUserId);

        Contact::create([
            'user_id' => $user->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'message' => 'Subject: '.$this->composeSubject."\n\n".$this->composeMessage,
            'status' => Contact::STATUS_UNREAD,
            'is_from_admin' => true,
        ]);

        $this->closeComposeModal();
        session()->flash('success', 'Message sent to user successfully!');
    }

    public function sendReply(): void
    {
        $this->validate([
            'replyMessage' => 'required|string|min:2',
        ]);

        $this->authorize('update', $this->selectedMessage);

        // Create the reply
        Contact::create([
            'parent_id' => $this->selectedMessage->id,
            'user_id' => $this->selectedMessage->user_id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'message' => $this->replyMessage,
            'status' => Contact::STATUS_REPLIED,
            'is_from_admin' => true,
        ]);

        // Update the main message status
        $this->selectedMessage->update(['status' => Contact::STATUS_REPLIED]);

        // If guest, we would ideally send an email here.
        // if (!$this->selectedMessage->user_id) {
        //     Mail::to($this->selectedMessage->email)->send(new ReplyMail(...));
        // }

        $this->selectedMessage = $this->selectedMessage->fresh(['replies', 'user']);
        $this->replyMessage = '';

        session()->flash('success', 'Reply sent successfully!');
    }

    public function closeMessageModal(): void
    {
        $this->showMessageModal = false;
        $this->selectedMessage = null;
    }

    public function updateStatus($messageId, $status): void
    {
        $message = Contact::findOrFail($messageId);

        $this->authorize('update', $message);

        $message->update(['status' => $status]);

        if ($this->selectedMessage && $this->selectedMessage->id === $messageId) {
            $this->selectedMessage = $message->fresh();
        }

        session()->flash('success', 'Message status updated successfully!');
    }

    public function delete($messageId): void
    {
        $message = Contact::findOrFail($messageId);

        $this->authorize('delete', $message);

        $message->delete();

        if ($this->showMessageModal) {
            $this->closeMessageModal();
        }

        session()->flash('success', 'Message deleted successfully!');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $messages = Contact::query()
            ->whereNull('parent_id')
            ->with(['user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('message', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->filterStatus !== null && $this->filterStatus !== '', function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        $unreadCount = Contact::whereNull('parent_id')->unread()->count();
        $users = \App\Models\User::orderBy('name')->get();

        return view('livewire.admin.contact-messages', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
            'users' => $users,
        ]);
    }
}
