<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Dashboard')]

    public $totalUsers;
    public $totalBooks;
    public $comments;
    public $totalBlogs;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalBooks = Book::count();
        $this->totalBlogs = Blog::count();
        $this->comments = Comment::count();
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
