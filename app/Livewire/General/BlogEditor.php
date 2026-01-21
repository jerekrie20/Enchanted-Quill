<?php

namespace App\Livewire\General;

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

class BlogEditor extends Component
{
    use WithFileUploads;

    #[Layout('components.Layouts.admin')]
    #[Title('Manage Blog')]
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
    public $blog;

    public $statusData = [
        '0' => 'Draft',
        '1' => 'Published',
        '2' => 'Private',
        '3' => 'Publish Later',
    ];

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('blogs')->ignore($this->blog->id ?? null), 'string'],
            'status' => ['required', 'numeric', 'integer', 'min:0', 'max:3'],
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
        // Ensure the user is authorized to update
        if ($this->blog) {
            $this->authorize('update', $this->blog);
        }

        $data = $this->validate();

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

        if (! $this->blog) {
            // Create new blog
            $data['user_id'] = auth()->id();
            $this->blog = Blog::create($data);

            // Schedule the job if status is "Publish Later"
            if ($this->status == 3 && ! empty($data['publish_at'])) {
                ProcessBlog::dispatch($this->blog->id)->delay($data['publish_at']);
            }

            $this->blog->categories()->attach($this->category);
            session()->flash('success', 'Blog created successfully!');

            return;
        }

        // Update existing blog
        $this->blog->update($data);
        $this->blog->categories()->sync($this->category);

        // Schedule the job if status is "Publish Later"
        if ($this->status == 3 && ! empty($data['publish_at'])) {
            ProcessBlog::dispatch($this->blog->id)->delay($data['publish_at']);
        }

        session()->flash('success', 'Blog updated successfully!');
    }

    public function mount($id)
    {
        $this->categories = Category::all();

        if ($id && $id !== 'create') {
            $blog = Blog::findOrFail($id);
            $this->blog = $blog;
            $this->title = $blog->title;
            $this->slug = $blog->slug;
            $this->category = $blog->categories->pluck('id')->toArray();
            $this->status = $blog->status;
            $this->currentImage = $blog->image;
            $this->publish_at = $blog->publish_at;
        } else {
            $this->blog = false;
            $this->title = '';
            $this->slug = '';
            $this->status = 0; // default to draft
            $this->currentImage = null;
            $this->publish_at = null;
        }
    }

    public function render()
    {
        return view('livewire.general.blog-editor');
    }
}
