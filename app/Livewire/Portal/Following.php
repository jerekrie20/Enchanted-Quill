<?php

namespace App\Livewire\Portal;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Following extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function followedAuthors()
    {
        return auth()->user()->following()
            ->withCount(['books', 'blogs'])
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->latest('follows.created_at')
            ->paginate(12);
    }

    public function unfollow(int $authorId): void
    {
        auth()->user()->following()->detach($authorId);
        session()->flash('success', 'You have unbound the pact with this author.');
    }

    #[Layout('components.Layouts.portal')]
    #[Title('Following - Enchanted Quill')]
    public function render()
    {
        return view('livewire.portal.following');
    }
}
