<?php

namespace App\Livewire\General\Pages;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

class ChapterManager extends Component
{
    #[Title('Manage Chapters')]
    public function getLayoutProperty(): string
    {
        // Use portal layout for authors, admin layout for admins
        return auth()->user()->role === 'admin'
            ? 'components.Layouts.admin'
            : 'components.Layouts.portal';
    }

    // Form fields
    public $title;

    public $chapterNumber;

    public $bookName;

    #[Locked]
    public $bookId;

    #[Locked]
    public ?int $chapterId = null;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'chapterNumber' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('chapters', 'chapter_number')
                    ->where('book_id', $this->bookId)
                    ->ignore($this->chapterId),
            ],
        ];
    }

    protected function messages(): array
    {
        return [
            'chapterNumber.unique' => 'This chapter number already exists for this book.',
            'chapterNumber.required' => 'The chapter number is required.',
            'chapterNumber.integer' => 'The chapter number must be a number.',
            'chapterNumber.min' => 'The chapter number must be at least 1.',
        ];
    }

    public function saveDetails(): null
    {
        $this->validate();

        $chapter = $this->chapterId
            ? Chapter::findOrFail($this->chapterId)
            : new Chapter;

        $chapter->fill([
            'book_id' => $this->bookId,
            'title' => $this->title,
            'chapter_number' => $this->chapterNumber,
            'content' => $chapter->content ?? '',
        ]);

        $chapter->save();

        $isNewChapter = ! $this->chapterId;

        // Update the chapterId if it's a new chapter
        if ($isNewChapter) {
            $this->chapterId = $chapter->id;
        }

        session()->flash('success', $isNewChapter ? 'Chapter created successfully!' : 'Chapter updated successfully!');

        // Redirect to the chapter edit page with chapter number
        return $this->redirect(route('chapter.manage', ['id' => $this->bookId, 'chapterNumber' => $this->chapterNumber]), navigate: true);
    }

    public function mount(int $id, ?string $chapterNumber = null): void
    {
        $book = Book::findOrFail($id);
        $this->bookId = $id;
        $this->bookName = $book->title;

        if ($chapterNumber) {
            $chapter = $book->chapters()->where('chapter_number', $chapterNumber)->firstOrFail();
            $this->chapterId = $chapter->id;
            $this->title = $chapter->title;
            $this->chapterNumber = (string) $chapter->chapter_number;
        }

    }

    public function render()
    {
        $breadcrumbs = [
            ['label' => 'Volumes', 'url' => route('admin.books'), 'wire:navigate' => true],
            ['label' => $this->bookName, 'url' => route('book.manage', ['id' => $this->bookId]), 'wire:navigate' => true],
            ['label' => 'Chapters', 'url' => route('chapters.list', ['id' => $this->bookId]), 'wire:navigate' => true],
            ['label' => $this->title ?: 'New Chapter', 'url' => ''],
        ];

        return view('livewire.general.pages.chapter-manager', [
            'breadcrumbs' => $breadcrumbs,
        ])->layout($this->getLayoutProperty());
    }
}
