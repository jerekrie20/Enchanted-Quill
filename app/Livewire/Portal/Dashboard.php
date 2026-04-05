<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.Layouts.portal')]
    #[Title('Home - Enchanted Quill')]
    public function render()
    {
        // Get recently updated books (published only)
        $recentBooks = Book::with(['author', 'categories'])
            ->published()
            ->latest('updated_at')
            ->limit(6)
            ->get();

        // Get popular books (most reviewed)
        $popularBooks = Book::with(['author', 'categories'])
            ->published()
            ->withCount('reviews')
            ->orderByDesc('reviews_count')
            ->limit(6)
            ->get();

        // Get recent blogs/chronicles
        $recentChronicles = Blog::with(['user', 'categories'])
            ->published()
            ->latest('publish_at')
            ->limit(6)
            ->get();

        return view('livewire.portal.dashboard', [
            'recentBooks' => $recentBooks,
            'popularBooks' => $popularBooks,
            'recentChronicles' => $recentChronicles,
        ]);
    }
}
