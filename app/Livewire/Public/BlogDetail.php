<?php

namespace App\Livewire\Public;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BlogDetail extends Component
{
    #[Layout('components.layouts.public')]
    public $blogId;

    public function getBlogProperty()
    {
        return Blog::with(['user', 'categories'])
            ->findOrFail($this->blogId);
    }

    public function getCommentsProperty()
    {
        return $this->blog->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5, pageName: 'reviews');
    }

    public function mount($id): void
    {
        $this->blogId = $id;

        $blog = Blog::findOrFail($id);

        // Check if user can view this blog (guests can view public published blogs)
        $this->authorize('view', $blog);
    }

    public function render()
    {
        return view('livewire.public.blog-detail', [
            'blog' => $this->blog,
            'comments' => $this->comments,
        ])
            ->title($this->blog->title.' - Enchanted Quill')
            ->layoutData([
                'description' => substr(strip_tags($this->blog->content), 0, 160),
                'image' => $this->blog->image ? asset('storage/'.$this->blog->image) : asset('graphic/quill.webp'),
            ]);
    }
}
