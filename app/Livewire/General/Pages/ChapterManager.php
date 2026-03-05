<?php

namespace App\Livewire\General\Pages;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

class ChapterManager extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Manage Chapters')]

    // Form fields
    public $title;

    public $chapterNumber;

    public $bookName;

    #[Locked]
    public $bookId;

    #[Locked]
    public ?int $chapterId = null;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'chapterNumber' => [
                'required',
                'integer',
                'min:1',
                \Illuminate\Validation\Rule::unique('chapters', 'chapter_number')
                    ->where('book_id', $this->bookId)
                    ->ignore($this->chapterId),
            ],
        ];
    }

    protected function messages()
    {
        return [
            'chapterNumber.unique' => 'This chapter number already exists for this book.',
            'chapterNumber.required' => 'The chapter number is required.',
            'chapterNumber.integer' => 'The chapter number must be a number.',
            'chapterNumber.min' => 'The chapter number must be at least 1.',
        ];
    }

    public function saveDetails()
    {
        $this->validate();

        $chapter = $this->chapterId
            ? \App\Models\Chapter::findOrFail($this->chapterId)
            : new \App\Models\Chapter;

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

    public function mount(int $id, ?string $chapterNumber = null)
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
        return view('livewire.general.pages.chapter-manager');
    }
}
