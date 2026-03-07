<?php

namespace App\Livewire\General\Pages;

use App\Jobs\ProcessBlog;
use App\Models\Blog;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChronicleManager extends Component
{
    use WithFileUploads;

    #[Title('Manage Blog')]
    public function getLayoutProperty(): string
    {
        // Use portal layout for authors, admin layout for admins
        return auth()->user()->role === 'admin'
            ? 'components.Layouts.admin'
            : 'components.Layouts.portal';
    }

    // Form Fields
    public $title;

    public $slug;

    public $status;

    public $publish_at;

    public $image;

    public $currentImage;

    public $category = [];

    public $categories;

    #[Locked]
    public $blogId;

    public $statusData = [
        0 => 'Draft',
        1 => 'Published',
        2 => 'Private',
        3 => 'Publish Later',
    ];

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('blogs')->ignore($this->blogId), 'string'],
            'status' => ['required', 'integer', Rule::in([0, 1, 2, 3])],
            'category.*' => Rule::exists('categories', 'id'),
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2040'],
            'publish_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function updatedTitle()
    {
        $this->slug = str_replace(' ', '_', strtolower($this->title));
    }

    public function saveDetails()
    {
        $data = $this->validate();

        // Ensure the user is authorized to update
        if ($this->blogId) {
            $blog = Blog::findOrFail($this->blogId);
            $this->authorize('update', $blog);
        }

        // Remove image from validated data (we'll handle it separately)
        unset($data['image']);

        $imageService = new ImageService;

        // Handle image upload
        if ($this->image) {
            $uploadedImage = $imageService->saveImage($this->image, $this->currentImage, 'blogs', 'blog_image');
            $data['image'] = $uploadedImage;
        } elseif ($this->currentImage) {
            $data['image'] = $this->currentImage;
        }

        // Convert publish_at if it's set
        if (! empty($data['publish_at'])) {
            $data['publish_at'] = Carbon::parse($data['publish_at']);
        }

        if (! $this->blogId) {
            // Create new blog
            $data['user_id'] = auth()->id();
            $blog = Blog::create($data);

            // Schedule the job if status is "Publish Later"
            if ($this->status == 3 && ! empty($data['publish_at'])) {
                ProcessBlog::dispatch($blog->id)->delay($data['publish_at']);
            }

            $blog->categories()->attach($this->category);
            session()->flash('success', 'Blog created successfully!');

            return;
        }

        // Update existing blog
        $blog = Blog::findOrFail($this->blogId);
        $blog->update($data);
        $blog->categories()->sync($this->category);

        // Schedule the job if status is "Publish Later"
        if ($this->status == 3 && ! empty($data['publish_at'])) {
            ProcessBlog::dispatch($blog->id)->delay($data['publish_at']);
        }

        session()->flash('success', 'Blog updated successfully!');
    }

    public function mount($id)
    {
        $this->categories = Category::all();

        if ($id && $id !== 'create') {
            $blog = Blog::findOrFail($id);
            $this->blogId = $blog->id;
            $this->title = $blog->title;
            $this->slug = $blog->slug;
            $this->category = $blog->categories->pluck('id')->toArray();
            // Ensure status is valid (0-3), default to 0 if invalid
            $this->status = in_array($blog->status, [0, 1, 2, 3]) ? $blog->status : 0;
            $this->currentImage = $blog->image;
            $this->publish_at = $blog->publish_at;
        } else {
            $this->blogId = null;
            $this->title = '';
            $this->slug = '';
            $this->status = 0; // default to draft
            $this->currentImage = null;
            $this->publish_at = null;
        }
    }

    public function render()
    {
        $breadcrumbs = [
            ['label' => 'Chronicles', 'url' => route('blogs'), 'wire:navigate' => true],
            ['label' => $this->blogId ? $this->title : 'New Chronicle', 'url' => ''],
        ];

        return view('livewire.general.pages.chronicle-manager', [
            'breadcrumbs' => $breadcrumbs,
        ])->layout($this->getLayoutProperty());
    }
}
