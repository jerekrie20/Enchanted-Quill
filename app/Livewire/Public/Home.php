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
        // Get featured books (recently published and public)
        $featuredBooks = Book::with(['author', 'categories'])
            ->where('status', Book::STATUS_PUBLISHED)
            ->where('is_public', true)
            ->latest('updated_at')
            ->limit(6)
            ->get();

        // Get recent blog posts (published and public)
        $recentBlogs = Blog::with(['user', 'categories'])
            ->where('status', Blog::STATUS_PUBLISHED)
            ->where('is_public', true)
            ->latest('updated_at')
            ->limit(3)
            ->get();

        return view('livewire.public.home', [
            'featuredBooks' => $featuredBooks,
            'recentBlogs' => $recentBlogs,
        ]);
    }
}
