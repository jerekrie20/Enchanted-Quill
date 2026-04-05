<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Chronicles extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.portal')]
    #[Title('Chronicles - Enchanted Quill')]
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

    public function render()
    {
        $query = Blog::with(['user', 'categories'])
            ->published();

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%');
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
                $query->latest('updated_at');
                break;
            case 'oldest':
                $query->oldest('updated_at');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
        }

        $chronicles = $query->paginate($this->perPage);

        $categories = Category::all();

        return view('livewire.portal.chronicles', [
            'chronicles' => $chronicles,
            'categories' => $categories,
        ]);
    }
}
