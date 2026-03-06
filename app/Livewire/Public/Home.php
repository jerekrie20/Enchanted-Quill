<?php

namespace App\Livewire\Public;

use App\Models\Blog;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Layout('components.Layouts.public')]
    #[Title('Welcome to Enchanted Quill - Where Words Weave Magic')]
    public function render()
    {
        // Get featured books (recently published)
        $featuredBooks = Book::with(['author', 'categories'])
            ->where('status', Book::STATUS_PUBLISHED)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit(6)
            ->get();

        // Get recent blog posts
        $recentBlogs = Blog::with(['user', 'categories'])
            ->where('status', Blog::STATUS_PUBLISHED)
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', now())
            ->latest('publish_at')
            ->limit(3)
            ->get();

        return view('livewire.public.home', [
            'featuredBooks' => $featuredBooks,
            'recentBlogs' => $recentBlogs,
        ]);
    }
}
