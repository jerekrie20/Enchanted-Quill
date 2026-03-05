<?php

namespace App\Livewire\General\Pages;

use App\Models\Book;
use App\Models\Chapter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

class ChaptersList extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Manage Chapters')]

    #[Locked]
    public int $bookId;

    public string $bookName;

    public function mount(int $id)
    {
        $book = Book::findOrFail($id);
        $this->bookId = $id;
        $this->bookName = $book->title;
    }

    public function deleteChapter(int $chapterId)
    {
        $chapter = Chapter::where('book_id', $this->bookId)
            ->where('id', $chapterId)
            ->firstOrFail();

        $chapter->delete();

        session()->flash('success', 'Chapter deleted successfully!');
    }

    public function render()
    {
        $chapters = Chapter::where('book_id', $this->bookId)
            ->orderBy('chapter_number')
            ->get();

        $breadcrumbs = [
            ['label' => 'Volumes', 'url' => route('admin.books'), 'wire:navigate' => true],
            ['label' => $this->bookName, 'url' => route('book.manage', ['id' => $this->bookId]), 'wire:navigate' => true],
            ['label' => 'Chapters', 'url' => ''],
        ];

        return view('livewire.general.pages.chapters-list', [
            'chapters' => $chapters,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
