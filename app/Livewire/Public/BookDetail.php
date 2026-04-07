<?php

namespace App\Livewire\Public;

use App\Models\Book;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BookDetail extends Component
{
    use WithPagination;

    #[Layout('components.layouts.public')]
    public $bookId;

    public $canRead = false;

    #[Computed]
    public function book()
    {
        return Book::with(['author', 'categories'])
            ->withCount(['reviews', 'chapters'])
            ->withAvg('reviews', 'stars')
            ->findOrFail($this->bookId);
    }

    #[Computed]
    public function chapters()
    {
        return $this->book->chapters()
            ->orderBy('chapter_number', 'asc')
            ->paginate(20);
    }

    #[Computed]
    public function averageRating()
    {
        if ($this->book->reviews_count === 0) {
            return 0;
        }

        return round($this->book->reviews_avg_stars ?? 0, 1);
    }

    public function mount($id): void
    {
        $this->bookId = $id;

        // Use the computed property to avoid querying the book twice
        $book = $this->book;

        // Check if the user can read the content
        if ($book->status == 1 || auth()->check()) {
            $this->canRead = true;
        }

        // Check if user can view this book (guests can view public published books)
        $this->authorize('view', $book);
    }

    public function render()
    {
        $reviews = $this->book->reviews()
            ->with('user')
            ->latest()
            ->paginate(5, pageName: 'reviews');

        return view('livewire.public.book-detail', [
            'book' => $this->book,
            'chapters' => $this->chapters,
            'reviews' => $reviews,
            'averageRating' => $this->averageRating,
        ])
            ->title($this->book->title.' - Enchanted Quill')
            ->layoutData([
                'description' => substr(strip_tags($this->book->description), 0, 160),
                'image' => $this->book->image ? asset('storage/'.$this->book->image) : asset('graphic/quill.webp'),
            ]);
    }
}
