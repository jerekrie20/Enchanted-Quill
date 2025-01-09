<?php

namespace App\Livewire\General;

use App\Models\Blog as BlogModel;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.admin')]
    #[Title('Blogs')]

    public $search = '';
    public $category = [];
    public $status;
    public $sort;
    public $perPage = 10;


    public function updateStatus($blogId, $status)
    {
        $blog = BlogModel::find($blogId);

        // Ensure the user is authorized to update
        $this->authorize('update', $blog);

        // Update the status
        $blog->update([
            'status' => $status,
        ]);

        $this->dispatch('status-updated', blogId: $blogId);

    }

    public function delete(BlogModel $blog)
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        session()->flash('success', "$blog->title was deleted");
    }

    public function render()
    {
        $blog = BlogModel::with('categories')
            ->where(function ($query){
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, fn($query) => $query->whereHas('categories', fn($q) => $q->whereIn('categories.id', $this->category)))
            ->when($this->status, function ($query){
                $query->where('status', $this->status);
            })
            ->orderBy('created_at', $this->sort ?: 'desc')
            ->cursorPaginate($this->perPage);

        $categories = Category::all();

        return view('livewire.admin.blog',[
            'blogs' => $blog,
            'categories' => $categories
        ]);
    }
}
