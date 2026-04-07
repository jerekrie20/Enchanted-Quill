<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    #[Layout('components.layouts.admin')]
    #[Title('Categories Management')]

    #[Url]
    public $search = '';

    public $sort = 'desc';

    public $perPage = 15;

    public $displayModal = false;

    public $isEditing = false;

    #[Validate('required|string|max:255|unique:categories,name')]
    public $name;

    public $slug;

    #[Locked]
    public $categoryId;

    public function openCreateModal(): void
    {
        $this->reset(['name', 'slug', 'categoryId', 'isEditing']);
        $this->displayModal = true;
    }

    public function openEditModal($id): void
    {
        $category = Category::findOrFail($id);

        $this->authorize('update', $category);

        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->isEditing = true;
        $this->displayModal = true;
    }

    public function closeModal(): void
    {
        $this->reset(['name', 'slug', 'categoryId', 'isEditing']);
        $this->displayModal = false;
        $this->resetValidation();
    }

    public function save(): void
    {
        if ($this->isEditing) {
            $this->update();
        } else {
            $this->create();
        }
    }

    protected function create(): void
    {

        $this->authorize('create', Category::class);

        $this->validate();

        Category::create([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Category created successfully!');

        $this->closeModal();
    }

    protected function update(): void
    {
        $category = Category::findOrFail($this->categoryId);

        $this->authorize('update', $category);

        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$this->categoryId,
        ]);

        $category->update([
            'name' => $this->name,
        ]);

        session()->flash('success', 'Category updated successfully!');

        $this->closeModal();
    }

    public function delete($id): void
    {
        $category = Category::findOrFail($id);

        $this->authorize('delete', $category);

        // Check if category is in use
        $booksCount = $category->books()->count();
        $blogsCount = $category->blogs()->count();

        if ($booksCount > 0 || $blogsCount > 0) {
            session()->flash('error', "Cannot delete '{$category->name}' - it's being used by {$booksCount} book(s) and {$blogsCount} blog(s).");

            return;
        }

        $category->delete();

        session()->flash('success', 'Category deleted successfully!');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::query()
            ->withCount(['books', 'blogs'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('slug', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', $this->sort)
            ->paginate($this->perPage);

        return view('livewire.admin.categories', [
            'categories' => $categories,
        ]);
    }
}
