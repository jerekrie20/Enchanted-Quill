<?php

namespace App\Livewire\General;

use App\Models\Book;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class BookEditor extends Component
{
    use WithFileUploads;

    #[Layout('components.Layouts.admin')]
    #[Title('Manage Book')]

    // Form Fields
    public $title;

    public $slug;

    public $status;

    public $publish_at;

    public $cover;

    public $currentCover;

    public $category = [];

    public $categories;

    #[Locked]
    public $book;

    public $statusData = [
        '0' => 'Draft',
        '1' => 'Published',
        '2' => 'Publish Later',
        '3' => 'Archived',
    ];

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('books')->ignore($this->book->id ?? null), 'string'],
            'status' => ['required', 'numeric', 'integer', 'min:0', 'max:3'],
            'category.*' => Rule::exists('categories', 'id'),
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2040'],
            'publish_at' => ['nullable', 'date', 'after_or_equal:today'],
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

        // Convert publish_at if it's set
        if (! empty($data['publish_at'])) {
            $data['publish_at'] = Carbon::parse($data['publish_at']);
        }

        if (!$this->book) {
            // Create new book
            $data['author_id'] = auth()->id();
            $this->book = Book::create($data);
            $this->book->categories()->attach($this->category);
            session()->flash('success', 'Book created successfully!');

            return;
        }

        // Update existing book

        $this->book->update($data);
        $this->book->categories()->sync($this->category);

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
            $this->publish_at = $book->publish_at;
        } else {
            $this->book = false;
            $this->title = '';
            $this->slug = '';
            $this->status = 0; // default to draft
            $this->currentCover = null;
            $this->publish_at = null;
        }
    }

    public function render()
    {
        return view('livewire.general.book-editor');
    }
}
