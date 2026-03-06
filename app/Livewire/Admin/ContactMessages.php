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

    public function viewMessage($messageId): void
    {
        $message = Contact::findOrFail($messageId);

        $this->authorize('view', $message);

        // Mark as read if unread
        if ($message->status === Contact::STATUS_UNREAD) {
            $message->update(['status' => Contact::STATUS_READ]);
        }

        $this->selectedMessage = $message;
        $this->showMessageModal = true;
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
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('message', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatus !== null && $this->filterStatus !== '', function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        $unreadCount = Contact::unread()->count();

        return view('livewire.admin.contact-messages', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }
}
