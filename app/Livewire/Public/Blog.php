<?php

namespace App\Livewire\Public;

use App\Models\Blog as BlogModel;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.public')]
    #[Title('Blog - Enchanted Quill')]

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

    public function render()
    {
        $query = BlogModel::with(['user', 'categories'])
            ->published();

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', function ($userQuery) {
                        $userQuery->where('name', 'like', '%'.$this->search.'%');
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
            'oldest' => $query->oldest('publish_at'),
            default => $query->latest('publish_at'),
        };

        $blogs = $query->paginate(9);
        $categories = Category::orderBy('name')->get();

        return view('livewire.public.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }
}
