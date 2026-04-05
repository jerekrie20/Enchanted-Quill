<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AuthorDashboard extends Component
{
    #[Layout('components.Layouts.portal')]
    #[Title('My Content - Enchanted Quill')]
    public function render()
    {
        $userId = auth()->id();

        // Get author's books stats
        $booksCount = Book::where('user_id', $userId)->count();
        $publishedBooks = Book::where('user_id', $userId)
            ->published()
            ->count();
        $draftBooks = Book::where('user_id', $userId)
            ->where('status', Book::STATUS_DRAFT)
            ->count();

        // Get author's recent books
        $recentBooks = Book::where('user_id', $userId)
            ->withCount(['chapters', 'reviews'])
            ->latest('updated_at')
            ->limit(5)
            ->get();

        // Get author's blogs stats
        $blogsCount = Blog::where('user_id', $userId)->count();
        $publishedBlogs = Blog::where('user_id', $userId)
            ->published()
            ->count();
        $draftBlogs = Blog::where('user_id', $userId)
            ->where('status', Blog::STATUS_DRAFT)
            ->count();

        // Get author's recent blogs
        $recentBlogs = Blog::where('user_id', $userId)
            ->latest('updated_at')
            ->limit(5)
            ->get();

        return view('livewire.portal.author-dashboard', [
            'booksCount' => $booksCount,
            'publishedBooks' => $publishedBooks,
            'draftBooks' => $draftBooks,
            'recentBooks' => $recentBooks,
            'blogsCount' => $blogsCount,
            'publishedBlogs' => $publishedBlogs,
            'draftBlogs' => $draftBlogs,
            'recentBlogs' => $recentBlogs,
        ]);
    }
}
