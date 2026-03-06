<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChronicleDetail extends Component
{
    #[Layout('components.Layouts.portal')]
    public $chronicleId;

    public function mount($id): void
    {
        $this->chronicleId = $id;
    }

    public function getChronicleProperty()
    {
        return Blog::with(['user', 'categories'])
            ->findOrFail($this->chronicleId);
    }

    public function render()
    {
        return view('livewire.portal.chronicle-detail')
            ->title($this->chronicle->title.' - Enchanted Quill');
    }
}
