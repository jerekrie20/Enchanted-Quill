<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Books extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Books Management')]

    public $search = '';
    public $category = [];
    public $status;
    public $sort;
    public $perPage = 10;

    public  function updateStatus($bookId, $status)
    {
        $book = Book::find($bookId);

        $this->authorize('update', $book);

        $book->update([
            'status' => $status
        ]);

        $this->dispatch('status-updated', bookId: $bookId);
    }

    public function render()
    {
        $books = Book::with('categories')
            ->where(function ($query){
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, fn($query) => $query->whereHas('categories', fn($q) => $q->whereIn('categories.id', $this->category)))
            ->when($this->status, function ($query){
                $query->where('status', $this->status);
            })
            ->when(auth()->user()->role != 'admin', function ($query) {
                // Restrict to books that belong to the current user(author) if the user is not an admin
                return $query->where('user_id', auth()->id());
            })
            ->orderBy('created_at', $this->sort ?: 'desc')
            ->cursorPaginate($this->perPage);
        $categories = Category::all();

        return view('livewire.admin.books',[
            'books' => $books,
            'categories' => $categories
        ]);
    }
}
