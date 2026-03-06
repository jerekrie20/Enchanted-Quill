<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChronicleDetail extends Component
{
    public $chronicleId;

    public function mount($id): void
    {
        $this->chronicleId = $id;

        $blog = Blog::findOrFail($id);

        // Check if user can view this blog
        $this->authorize('view', $blog);
    }

    public function getChronicleProperty()
    {
        return Blog::with(['user', 'categories'])
            ->findOrFail($this->chronicleId);
    }

    public function render()
    {
        // Use public layout for guests, portal layout for authenticated users
        $layout = auth()->check() ? 'components.Layouts.portal' : 'components.Layouts.public';

        return view('livewire.portal.chronicle-detail', [
            'chronicle' => $this->chronicle,
        ])
            ->layout($layout)
            ->title($this->chronicle->title.' - Enchanted Quill');
    }
}
