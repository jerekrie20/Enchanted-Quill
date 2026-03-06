<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use App\Models\Book;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserProfile extends Component
{
    #[Layout('components.Layouts.portal')]
    public $userId;

    public function mount($id): void
    {
        $this->userId = $id;
    }

    public function getUserProperty()
    {
        return User::findOrFail($this->userId);
    }

    public function getPublishedBooksProperty()
    {
        return Book::where('user_id', $this->userId)
            ->where('status', Book::STATUS_PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->withCount(['chapters', 'reviews'])
            ->latest('published_at')
            ->get();
    }

    public function getPublishedChroniclesProperty()
    {
        return Blog::where('user_id', $this->userId)
            ->where('status', Blog::STATUS_PUBLISHED)
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', now())
            ->latest('publish_at')
            ->limit(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.portal.user-profile')
            ->title($this->user->name.' - Enchanted Quill');
    }
}
