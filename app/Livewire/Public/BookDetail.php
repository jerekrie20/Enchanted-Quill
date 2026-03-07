<?php

namespace App\Livewire\Public;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BookDetail extends Component
{
    use WithPagination;

    #[Layout('components.Layouts.public')]
    public $bookId;

    public $isPublic = false;

    public function mount($id): void
    {
        $this->bookId = $id;

        $book = Book::findOrFail($id);

        // Check if the book is public
        if ($book->is_public == 1) {
            $this->isPublic = true;
        }

        // Check if user can view this book (guests can view public published books)
        $this->authorize('view', $book);
    }

    public function getBookProperty()
    {
        return Book::with(['author', 'categories'])
            ->withCount(['reviews', 'chapters'])
            ->findOrFail($this->bookId);
    }

    public function getChaptersProperty()
    {
        return $this->book->chapters()
            ->orderBy('chapter_number', 'asc')
            ->paginate(20);
    }

    public function getAverageRatingProperty()
    {
        if ($this->book->reviews_count === 0) {
            return 0;
        }

        return round($this->book->reviews()->avg('stars'), 1);
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
            ->title($this->book->title.' - Enchanted Quill');
    }
}
