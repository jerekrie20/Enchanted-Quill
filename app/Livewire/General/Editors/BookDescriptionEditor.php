<?php

namespace App\Livewire\General\Editors;

use App\Models\Book;
use Livewire\Component;

class BookDescriptionEditor extends Component
{
    public $book;

    public $content;

    public function mount($bookId): void
    {
        $book = Book::findOrFail($bookId);
        $this->book = $book;
        $this->content = $book->content;
    }

    public function saveContent(): void
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $this->book->update([
            'content' => $this->content,
        ]);

        session()->flash('success', 'Book description updated successfully!');
    }

    public function render()
    {
        return view('livewire.general.editors.book-description-editor');
    }
}
