<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.admin')]
    #[Title('Reviews Management')]

    #[Url]
    public $search = '';

    public $filterBook;

    public $filterUser;

    public $filterRating;

    public $sort = 'desc';

    public $perPage = 15;

    public function delete($reviewId): void
    {
        $review = Review::findOrFail($reviewId);

        $this->authorize('delete', $review);

        $review->delete();

        session()->flash('success', 'Review deleted successfully!');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterBook(): void
    {
        $this->resetPage();
    }

    public function updatingFilterUser(): void
    {
        $this->resetPage();
    }

    public function updatingFilterRating(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $reviews = Review::query()
            ->with(['user', 'book'])
            ->when($this->search, function ($query) {
                $query->where('content', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                    ->orWhereHas('book', fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'));
            })
            ->when($this->filterBook, fn ($query) => $query->where('book_id', $this->filterBook))
            ->when($this->filterUser, fn ($query) => $query->where('user_id', $this->filterUser))
            ->when($this->filterRating, fn ($query) => $query->where('stars', $this->filterRating))
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        $books = Book::query()
            ->select('id', 'title')
            ->orderBy('title')
            ->get();

        $users = User::query()
            ->select('id', 'name')
            ->whereHas('reviews')
            ->orderBy('name')
            ->get();

        return view('livewire.admin.reviews', [
            'reviews' => $reviews,
            'books' => $books,
            'users' => $users,
        ]);
    }
}
