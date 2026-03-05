<?php

namespace App\Livewire\General\Editors;

use App\Models\Blog;
use Livewire\Component;

class ChronicleContentEditor extends Component
{
    public $blog;

    public $content;

    public function mount($blogId): void
    {
        $blog = Blog::findOrFail($blogId);
        $this->blog = $blog;
        $this->content = $blog->content;
    }

    public function saveContent(): void
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $this->blog->update([
            'content' => $this->content,
        ]);

        session()->flash('success', 'Chronicle content updated successfully!');
    }

    public function render()
    {
        return view('livewire.general.editors.chronicle-content-editor');
    }
}
