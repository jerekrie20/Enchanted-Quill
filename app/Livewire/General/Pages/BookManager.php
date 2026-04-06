<?php

namespace App\Livewire\General\Pages;

use App\Events\ContentPublished;
use App\Models\Book;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class BookManager extends Component
{
    use WithFileUploads;

    #[Title('Manage Book')]
    public function getLayoutProperty(): string
    {
        // Use portal layout for authors, admin layout for admins
        return auth()->user()->role === 'admin'
            ? 'components.Layouts.admin'
            : 'components.Layouts.portal';
    }

    // Form Fields
    public $title;

    public $slug;

    public $status;

    public $published_at;

    public $cover;

    public $currentCover;

    public $category = [];

    public $categories;

    #[Locked]
    public $book;

    #[Computed]
    public function statusData(): array
    {
        return [
            Book::STATUS_DRAFT => 'Draft',
            Book::STATUS_PUBLISHED => 'Published',
            Book::STATUS_PRIVATE => 'Private',
            Book::STATUS_SCHEDULED => 'Publish Later',
            Book::STATUS_ARCHIVED => 'Archived',
        ];
    }

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('books')->ignore($this->book->id ?? null), 'string'],
            'status' => ['required', 'integer', Rule::in([
                Book::STATUS_DRAFT,
                Book::STATUS_PUBLISHED,
                Book::STATUS_PRIVATE,
                Book::STATUS_SCHEDULED,
                Book::STATUS_ARCHIVED,
            ])],
            'category.*' => Rule::exists('categories', 'id'),
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2040'],
            'published_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function updatedTitle()
    {
        $this->slug = str_replace(' ', '_', strtolower($this->title));
    }

    public function saveDetails()
    {
        // Ensure the user is authorized to update
        if ($this->book) {
            $this->authorize('update', $this->book);
        }

        $data = $this->validate();

        $imageService = new ImageService;

        // Handle cover image upload
        if ($this->cover) {
            $uploadedImage = $imageService->saveImage($this->cover, $this->currentCover, 'books', 'book_cover');
            $data['cover'] = $uploadedImage;
        } elseif ($this->currentCover) {
            $data['cover'] = $this->currentCover;
        }

        // Convert published_at if it's set
        if (! empty($data['published_at'])) {
            $data['published_at'] = Carbon::parse($data['published_at']);
        } else {
            $data['published_at'] = null;
        }

        if (! $this->book) {
            // Create new book
            $data['user_id'] = auth()->id();
            $this->book = Book::create($data);
            $this->book->categories()->attach($this->category);

            // Fire the event if published immediately
            if ($this->status == Book::STATUS_PUBLISHED) {
                event(new ContentPublished($this->book));
            }

            // Schedule the job if status is "Publish Later"
            if ($this->status == Book::STATUS_SCHEDULED && ! empty($data['published_at'])) {
                \App\Jobs\PublishContentJob::dispatch($this->book)->delay($data['published_at']);
            }

            session()->flash('success', 'Book created successfully!');

            return;
        }

        // Update existing book

        $oldStatus = $this->book->status;
        $this->book->update($data);
        $this->book->categories()->sync($this->category);

        // Fire the event if status changed to published
        if ($oldStatus != Book::STATUS_PUBLISHED && $this->status == Book::STATUS_PUBLISHED) {
            event(new ContentPublished($this->book));
        }

        // Schedule the job if status is "Publish Later"
        if ($this->status == Book::STATUS_SCHEDULED && ! empty($data['published_at'])) {
            \App\Jobs\PublishContentJob::dispatch($this->book)->delay($data['published_at']);
        }

        session()->flash('success', 'Book updated successfully!');
    }

    public function mount($id)
    {
        $this->categories = Category::all();

        if ($id && $id !== 'create') {
            $book = Book::findOrFail($id);
            $this->book = $book;
            $this->title = $book->title;
            $this->slug = $book->slug;
            $this->category = $book->categories->pluck('id')->toArray();
            $this->status = $book->status;
            $this->currentCover = $book->cover;
            $this->published_at = $book->published_at;
        } else {
            $this->book = false;
            $this->title = '';
            $this->slug = '';
            $this->status = Book::STATUS_DRAFT; // default to draft
            $this->currentCover = null;
            $this->published_at = null;
        }

    }

    public function render()
    {
        $breadcrumbs = [
            ['label' => 'Volumes', 'url' => route('admin.books'), 'wire:navigate' => true],
            ['label' => $this->book ? $this->book->title : 'New Volume', 'url' => ''],
        ];

        return view('livewire.general.pages.book-manager', [
            'breadcrumbs' => $breadcrumbs,
            'statusData' => $this->statusData,
        ])->layout($this->getLayoutProperty());
    }
}
