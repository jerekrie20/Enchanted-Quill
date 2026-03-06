<?php

namespace App\Livewire\Portal;

use App\Models\Book;
use App\Models\Bookmark;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class BookDetail extends Component
{
    use WithPagination;

    public $bookId;

    public $showReviewModal = false;

    public $reviewRating = 5;

    public $reviewContent = '';

    public function mount($id): void
    {
        $this->bookId = $id;

        $book = Book::findOrFail($id);

        // Check if user can view this book
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

    public function getIsBookmarkedProperty(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return Bookmark::where('user_id', auth()->id())
            ->where('bookmarkable_type', Book::class)
            ->where('bookmarkable_id', $this->bookId)
            ->exists();
    }

    public function getAverageRatingProperty()
    {
        if ($this->book->reviews_count === 0) {
            return 0;
        }

        return round($this->book->reviews()->avg('stars'), 1);
    }

    public function getUserReviewProperty()
    {
        if (! auth()->check()) {
            return null;
        }

        return $this->book->reviews()
            ->where('user_id', auth()->id())
            ->first();
    }

    public function toggleBookmark(): void
    {
        if (! auth()->check()) {
            $this->redirect(route('login'), navigate: true);

            return;
        }

        $bookmark = Bookmark::where('user_id', auth()->id())
            ->where('bookmarkable_type', Book::class)
            ->where('bookmarkable_id', $this->bookId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->dispatch('notify', message: 'Removed from library', type: 'success');
        } else {
            Bookmark::create([
                'user_id' => auth()->id(),
                'bookmarkable_type' => Book::class,
                'bookmarkable_id' => $this->bookId,
            ]);
            $this->dispatch('notify', message: 'Added to library', type: 'success');
        }
    }

    public function openReviewModal(): void
    {
        if (! auth()->check()) {
            $this->redirect(route('login'), navigate: true);

            return;
        }

        if ($this->userReview) {
            $this->reviewRating = $this->userReview->stars->value;
            $this->reviewContent = $this->userReview->content;
        }

        $this->showReviewModal = true;
    }

    public function closeReviewModal(): void
    {
        $this->showReviewModal = false;
        $this->reviewRating = 5;
        $this->reviewContent = '';
        $this->resetValidation();
    }

    public function submitReview(): void
    {
        $this->validate([
            'reviewRating' => 'required|numeric|min:1|max:5',
            'reviewContent' => 'required|string|min:10|max:1000',
        ]);

        $this->book->reviews()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'stars' => $this->reviewRating,
                'content' => $this->reviewContent,
            ]
        );

        $this->closeReviewModal();
        $this->dispatch('notify', message: 'Review submitted successfully', type: 'success');
    }

    #[On('load-more-reviews')]
    public function loadMoreReviews(): void
    {
        $this->dispatch('reviews-loaded');
    }

    public function render()
    {
        $reviews = $this->book->reviews()
            ->with('user')
            ->latest()
            ->paginate(5, pageName: 'reviews');

        // Use public layout for guests, portal layout for authenticated users
        $layout = auth()->check() ? 'components.Layouts.portal' : 'components.Layouts.public';

        return view('livewire.portal.book-detail', [
            'reviews' => $reviews,
        ])
            ->layout($layout)
            ->title($this->book->title.' - Enchanted Quill');
    }
}
