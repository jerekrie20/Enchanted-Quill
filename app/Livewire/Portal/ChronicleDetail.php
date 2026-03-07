<?php

namespace App\Livewire\Portal;

use App\Models\Blog;
use App\Rules\NoProfanity;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChronicleDetail extends Component
{
    public $chronicleId;

    public $reviewContent;


    public function getChronicleProperty()
    {
        return Blog::with(['user', 'categories'])
            ->findOrFail($this->chronicleId);
    }

    public function getCommentsProperty()
    {
        return $this->chronicle->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(5, pageName: 'reviews');
    }

    //Leave a comment

    public function leaveComment()
    {
        $this->validate([
            'reviewContent' => [
                'required',
                'string',
                'min:10',
                'max:1000',
                'blasp_check',
                new NoProfanity()
            ],
        ]);

        $this->chronicle->comments()->updateOrCreate([
            'user_id' => auth()->id(),
            'blog_id' => $this->chronicle->id,
        ], [
            'content' => $this->reviewContent,
        ]);

        $this->reviewContent = '';

        session()->flash('success', 'Comment added successfully!');
    }

    public function mount($id): void
    {
        $this->chronicleId = $id;

        $blog = Blog::findOrFail($id);

        // Check if user can view this blog
        $this->authorize('view', $blog);
    }


    public function render()
    {
        // Use public layout for guests, portal layout for authenticated users
        $layout = auth()->check() ? 'components.Layouts.portal' : 'components.Layouts.public';

        return view('livewire.portal.chronicle-detail', [
            'chronicle' => $this->chronicle,
            'comments' => $this->comments,
        ])
            ->layout($layout)
            ->title($this->chronicle->title . ' - Enchanted Quill');
    }
}
