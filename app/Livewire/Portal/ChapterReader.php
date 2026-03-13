<?php

namespace App\Livewire\Portal;

use App\Models\Book;
use App\Models\Chapter;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChapterReader extends Component
{
    public $link;

    public $bookLink;

    public function getLayoutProperty(): string
    {
        // Use portal layout for authors, admin, readers, and public layout for others
        return auth()->user()
            ? 'components.Layouts.portal'
            : 'components.Layouts.public';
    }

    public $bookId;

    public $chapterNumber;

    public function mount($bookId, $chapterNumber): void
    {
        $this->bookId = $bookId;
        $this->chapterNumber = $chapterNumber;

        // Check if the user is authorized to view the book (this will also check if the book is public)
        $this->authorize('view', $this->book);

        if ($this->book->status == 2 && ! auth()->check()) {
            abort(403, 'You must be logged in to read this book.');
        }

        if (auth()->user()) {
            $this->link = 'portal.chapter.read';
            $this->bookLink = 'portal.book.show';
        } else {
            $this->link = 'chapter.read';
            $this->bookLink = 'public.book.show';
        }
    }

    public function getBookProperty()
    {
        return Book::with(['author'])->findOrFail($this->bookId);
    }

    public function getChapterProperty()
    {
        return Chapter::where('book_id', $this->bookId)
            ->where('chapter_number', $this->chapterNumber)
            ->firstOrFail();
    }

    public function getPreviousChapterProperty()
    {
        return Chapter::where('book_id', $this->bookId)
            ->where('chapter_number', '<', $this->chapterNumber)
            ->orderBy('chapter_number', 'desc')
            ->first();
    }

    public function getNextChapterProperty()
    {
        return Chapter::where('book_id', $this->bookId)
            ->where('chapter_number', '>', $this->chapterNumber)
            ->orderBy('chapter_number', 'asc')
            ->first();
    }

    public function render()
    {
        return view('livewire.portal.chapter-reader')
            ->title($this->chapter->title.' - '.$this->book->title.' - Enchanted Quill')
            ->layout($this->getLayoutProperty());
    }
}
