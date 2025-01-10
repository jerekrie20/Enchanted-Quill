<?php

namespace App\Livewire\General;

use App\Models\Blog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class BlogEditor extends Component
{
    #[Layout('components.Layouts.admin')]
    #[Title('Edit Blog')]

    //Form Fields
    public $title;

    public $content;
    public $blogId;

    public $status;
    public $publish_at;

    public $statusData = [
        '0' => 'Draft',
        '1' => 'Published',
        '2' => 'Private',
        '3' => 'Publish Later'
    ];
    protected $imageService;

    public function __construct()
    {
        $this->imageService = app(ImageService::class);
    }

    public function saveDetails()
    {

    }

    public function saveEditor()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $blog = Blog::find($this->blogId);
        $blog->update([
            'content' => $this->content,
        ]);

        session()->flash('success', 'Blog updated successfully!');

    }

    public function store(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'upload' => 'required|image|max:2048',
        ]);

        // Use the ImageService to save the image
        $imagePath = $this->imageService->saveImage(
            $request->file('upload'),
            null, // No current image to replace
            'blogs', // Folder where images are stored
            'blog_image' // Base name for the image
        );


        // Return the image URL to CKEditor
        return response()->json([
            'url' => asset('storage/blogs/' . $imagePath),
        ]);
    }

    public function deleteImages(Request $request)
    {
      //  Log::info('deleteImages route was hit');

        $filePath = $request->input('imagePath'); // File path relative to /storage

       // Log::info("Delete File Details: $filePath ");

        $this->imageService->deleteImage($filePath);
    }


    public function mount($id)
    {
        $blog = Blog::find($id);
        $this->blogId = $id;
        $this->content = $blog->content; // Load existing content
        $this->title = $blog->title;
        $this->status = $blog->status;
    }

    public function render()
    {
        return view('livewire.general.blog-editor');
    }
}
