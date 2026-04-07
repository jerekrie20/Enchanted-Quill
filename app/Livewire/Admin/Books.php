<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;

    #[Layout('components.layouts.admin')]
    #[Title('Books Management')]
    public $search = '';

    public $category = [];

    public $status;

    public $sort;

    public $perPage = 10;

    public $authorFilter;

    public $dateFrom;

    public $dateTo;

    public $selectedBooks = [];

    public $selectAll = false;

    public $bulkStatus;

    public function updatedSelectAll($value): void
    {
        if ($value) {
            $this->selectedBooks = Book::query()
                ->where(function ($query) {
                    $query->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                })
                ->when($this->category, fn ($query) => $query->whereHas('categories', fn ($q) => $q->whereIn('categories.id', $this->category)))
                ->when($this->status !== null && $this->status !== '', fn ($query) => $query->where('status', $this->status))
                ->when($this->authorFilter, fn ($query) => $query->where('user_id', $this->authorFilter))
                ->when($this->dateFrom, fn ($query) => $query->whereDate('created_at', '>=', $this->dateFrom))
                ->when($this->dateTo, fn ($query) => $query->whereDate('created_at', '<=', $this->dateTo))
                ->when(auth()->user()->role != 'admin', fn ($query) => $query->where('user_id', auth()->id()))
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedBooks = [];
        }
    }

    public function bulkDelete(): void
    {
        if (empty($this->selectedBooks)) {
            session()->flash('error', 'No books selected for deletion.');

            return;
        }

        $books = Book::whereIn('id', $this->selectedBooks)->get();

        foreach ($books as $book) {
            $this->authorize('delete', $book);
        }

        Book::whereIn('id', $this->selectedBooks)->delete();

        $count = count($this->selectedBooks);
        $this->selectedBooks = [];
        $this->selectAll = false;

        session()->flash('success', "{$count} book(s) deleted successfully!");
    }

    public function bulkUpdateStatus(): void
    {
        if (empty($this->selectedBooks)) {
            session()->flash('error', 'No books selected for status update.');

            return;
        }

        if ($this->bulkStatus === null || $this->bulkStatus === '') {
            session()->flash('error', 'Please select a status to apply.');

            return;
        }

        $books = Book::whereIn('id', $this->selectedBooks)->get();

        foreach ($books as $book) {
            $this->authorize('update', $book);
        }

        Book::whereIn('id', $this->selectedBooks)->update(['status' => $this->bulkStatus]);

        $count = count($this->selectedBooks);
        $this->selectedBooks = [];
        $this->selectAll = false;
        $this->bulkStatus = null;

        session()->flash('success', "{$count} book(s) status updated successfully!");
    }

    public function updateStatus($bookId, $status)
    {
        $book = Book::find($bookId);

        $this->authorize('update', $book);

        $book->update([
            'status' => $status,
        ]);

        $this->dispatch('status-updated', bookId: $bookId);
    }

    public function delete($bookId): void
    {
        $book = Book::findOrFail($bookId);

        $this->authorize('delete', $book);

        $book->delete();
        session()->flash('success', 'Book deleted successfully!');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingAuthorFilter(): void
    {
        $this->resetPage();
    }

    public function updatingDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingDateTo(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::with(['categories', 'author'])
            ->where(function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->category, fn ($query) => $query->whereHas('categories', fn ($q) => $q->whereIn('categories.id', $this->category)))
            ->when($this->status !== null && $this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->authorFilter, function ($query) {
                $query->where('user_id', $this->authorFilter);
            })
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('created_at', '<=', $this->dateTo);
            })
            ->when(auth()->user()->role != 'admin', function ($query) {
                // Restrict to books that belong to the current user(author) if the user is not an admin
                return $query->where('user_id', auth()->id());
            })
            ->orderBy('created_at', $this->sort ?: 'desc')
            ->paginate($this->perPage);

        $categories = Category::all();

        // Get all authors (users who have written books)
        $authors = User::whereHas('books')->get();

        return view('livewire.admin.books', [
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors,
        ]);
    }
}
