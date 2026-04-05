<?php

namespace App\Livewire\Public;

use App\Models\Book;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.public')]
    #[Title('Browse Books - Enchanted Quill')]

    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    #[Url]
    public $sortBy = 'latest';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Book::with(['author', 'categories'])
            ->published();

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhereHas('author', function ($authorQuery) {
                        $authorQuery->where('name', 'like', '%'.$this->search.'%');
                    });
            });
        }

        // Apply category filter
        if ($this->category) {
            $query->whereHas('categories', function ($categoryQuery) {
                $categoryQuery->where('categories.id', $this->category);
            });
        }

        // Apply sorting
        $query = match ($this->sortBy) {
            'title' => $query->orderBy('title'),
            'oldest' => $query->oldest('published_at'),
            'popular' => $query->withCount('reviews')->orderByDesc('reviews_count'),
            default => $query->latest('published_at'),
        };

        $books = $query->paginate(12);
        $categories = Category::orderBy('name')->get();

        return view('livewire.public.books', [
            'books' => $books,
            'categories' => $categories,
        ])->layoutData([
            'description' => 'Browse our extensive collection of original books and stories. Find your next favorite read from our community of writers.',
        ]);
    }
}
