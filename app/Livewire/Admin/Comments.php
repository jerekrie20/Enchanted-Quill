<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    #[Layout('components.layouts.admin')]
    #[Title('Comments Management')]

    #[Url]
    public $search = '';

    public $filterBlog;

    public $filterUser;

    public $sort = 'desc';

    public $perPage = 15;

    public function delete($commentId): void
    {
        $comment = Comment::findOrFail($commentId);

        // Only admins can delete comments (you can add policy check here)
        $comment->delete();

        session()->flash('success', 'Comment deleted successfully!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $comments = Comment::query()
            ->with(['user', 'blog'])
            ->when($this->search, function ($query) {
                $query->where('content', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                    ->orWhereHas('blog', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'));
            })
            ->when($this->filterBlog, fn ($query) => $query->where('blog_id', $this->filterBlog))
            ->when($this->filterUser, fn ($query) => $query->where('user_id', $this->filterUser))
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        return view('livewire.admin.comments', [
            'comments' => $comments,
        ]);
    }
}
