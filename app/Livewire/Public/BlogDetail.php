<?php

namespace App\Livewire\Public;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BlogDetail extends Component
{
    #[Layout('components.Layouts.public')]
    public $blogId;

    public function mount($id): void
    {
        $this->blogId = $id;

        $blog = Blog::findOrFail($id);

        // Check if user can view this blog (guests can view public published blogs)
        $this->authorize('view', $blog);
    }

    public function getBlogProperty()
    {
        return Blog::with(['user', 'categories'])
            ->findOrFail($this->blogId);
    }

    public function render()
    {
        return view('livewire.public.blog-detail', [
            'blog' => $this->blog,
        ])
            ->title($this->blog->title.' - Enchanted Quill');
    }
}
