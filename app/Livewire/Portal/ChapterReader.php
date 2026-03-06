<?php

namespace App\Livewire\Portal;

use App\Models\Book;
use App\Models\Chapter;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChapterReader extends Component
{
    #[Layout('components.Layouts.portal')]
    public $bookId;

    public $chapterNumber;

    public function mount($bookId, $chapterNumber): void
    {
        $this->bookId = $bookId;
        $this->chapterNumber = $chapterNumber;
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
            ->title($this->chapter->title.' - '.$this->book->title.' - Enchanted Quill');
    }
}
