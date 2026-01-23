<?php

namespace App\Livewire\General;

use App\Models\Book;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

class Chapters extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Manage Chapters')]

    //Form fields
    public string $title;
    public string $slug;
    public string $bookName;

    #[Locked]
    public int $bookId;

    public function mount(int $id, ?string $slug = null)
    {
        $this->bookName = Book::findOrFail($id)->title;
        $this->bookId = $id;
        $this->slug = $slug;
    }
    public function render()
    {
        return view('livewire.general.chapters');
    }
}
