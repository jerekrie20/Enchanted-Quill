<?php

namespace App\Livewire\General\Editors;

use App\Models\Book;
use Livewire\Component;

class BookDescriptionEditor extends Component
{
    public $book;

    public $description;

    public function mount($bookId): void
    {
        $book = Book::findOrFail($bookId);
        $this->book = $book;
        $this->description = $book->description;
    }

    public function saveContent(): void
    {
        $this->validate([
            'description' => 'required|string',
        ]);

        $this->book->update([
            'description' => $this->description,
        ]);

        session()->flash('success', 'Book description updated successfully!');
    }

    public function render()
    {
        return view('livewire.general.editors.book-description-editor');
    }
}
