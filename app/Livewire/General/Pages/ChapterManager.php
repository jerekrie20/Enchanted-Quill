<?php

namespace App\Livewire\General\Pages;

use App\Events\ContentPublished;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
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
            ? 'components.layouts.admin'
            : 'components.layouts.portal';
    }

    // Form fields
    public $title;

    public $chapterNumber;

    public $bookName;

    public $status = 0;

    public $published_at;

    #[Computed]
    public function statusData(): array
    {
        return [
            Chapter::STATUS_DRAFT => 'Draft',
            Chapter::STATUS_PUBLISHED => 'Published',
            Chapter::STATUS_PRIVATE => 'Private',
            Chapter::STATUS_SCHEDULED => 'Publish Later',
            Chapter::STATUS_ARCHIVED => 'Archived',
        ];
    }

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
            'status' => ['required', 'integer', Rule::in([
                Chapter::STATUS_DRAFT,
                Chapter::STATUS_PUBLISHED,
                Chapter::STATUS_PRIVATE,
                Chapter::STATUS_SCHEDULED,
                Chapter::STATUS_ARCHIVED,
            ])],
            'published_at' => ['nullable', 'date', 'after_or_equal:today'],
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
        $data = $this->validate();

        $chapter = $this->chapterId
            ? Chapter::findOrFail($this->chapterId)
            : new Chapter;

        $oldStatus = $chapter->status;

        $chapter->fill([
            'book_id' => $this->bookId,
            'title' => $this->title,
            'chapter_number' => $this->chapterNumber,
            'status' => $this->status,
            'published_at' => ! empty($this->published_at) ? \Illuminate\Support\Carbon::parse($this->published_at) : null,
            'content' => $chapter->content ?? '',
        ]);

        $chapter->save();

        // Fire the event if status changed to published (or new chapter is published)
        if (($oldStatus != Chapter::STATUS_PUBLISHED || ! $this->chapterId) && $chapter->status == Chapter::STATUS_PUBLISHED) {
            event(new ContentPublished($chapter));
        }

        if ($chapter->status == Chapter::STATUS_SCHEDULED && $chapter->published_at) {
            \App\Jobs\PublishContentJob::dispatch($chapter)->delay($chapter->published_at);
        }

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
            $this->status = in_array($chapter->status, [
                Chapter::STATUS_DRAFT,
                Chapter::STATUS_PUBLISHED,
                Chapter::STATUS_PRIVATE,
                Chapter::STATUS_SCHEDULED,
                Chapter::STATUS_ARCHIVED,
            ]) ? $chapter->status : Chapter::STATUS_DRAFT;
            $this->published_at = $chapter->published_at;
        } else {
            $this->status = Chapter::STATUS_DRAFT;
            $this->published_at = null;
        }

    }

    public function render()
    {
        $breadcrumbs = [
            ['label' => 'Volumes', 'url' => route('admin.books'), 'wire:navigate' => true],
            ['label' => 'book', 'url' => route('book.manage', ['id' => $this->bookId]), 'wire:navigate' => true],
            ['label' => 'Chapters', 'url' => route('chapters.list', ['id' => $this->bookId]), 'wire:navigate' => true],
            ['label' => $this->chapterNumber ?: 'New Chapter', 'url' => ''],
        ];

        return view('livewire.general.pages.chapter-manager', [
            'breadcrumbs' => $breadcrumbs,
            'statusData' => $this->statusData,
        ])->layout($this->getLayoutProperty());
    }
}
