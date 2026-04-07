<?php

namespace App\Livewire\Portal;

use App\Models\Book;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Library extends Component
{
    use WithPagination;

    #[Layout('components.layouts.portal')]
    #[Title('Library - Enchanted Quill')]
    public $search = '';

    public $selectedCategories = [];

    public $sortBy = 'latest';

    public $perPage = 12;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedCategories(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'selectedCategories']);
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
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }

        // Apply category filter
        if (! empty($this->selectedCategories)) {
            $query->whereHas('categories', function ($q) {
                $q->whereIn('categories.id', $this->selectedCategories);
            });
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'latest':
                $query->latest('published_at');
                break;
            case 'oldest':
                $query->oldest('published_at');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'popular':
                $query->withCount('reviews')->orderByDesc('reviews_count');
                break;
        }

        $books = $query->paginate($this->perPage);

        $categories = Category::all();

        return view('livewire.portal.library', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}
