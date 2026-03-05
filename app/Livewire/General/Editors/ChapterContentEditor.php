<?php

namespace App\Livewire\General\Editors;

use App\Models\Chapter;
use Livewire\Component;

class ChapterContentEditor extends Component
{
    public $chapter;

    public $content;

    public function mount($chapterId): void
    {
        $chapter = Chapter::findOrFail($chapterId);
        $this->chapter = $chapter;
        $this->content = $chapter->content;
    }

    public function saveContent(): void
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $this->chapter->update([
            'content' => $this->content,
        ]);

        session()->flash('success', 'Chapter content updated successfully!');

        $this->dispatch('content-saved');
    }

    public function render()
    {
        return view('livewire.general.editors.chapter-content-editor');
    }
}
