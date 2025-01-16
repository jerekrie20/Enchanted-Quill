<?php

namespace App\Livewire\General;

use App\Models\Blog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Livewire\Component;

class CKEditor extends Component
{
    public $blog;
    public $content;

    protected $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }

    public function mount($blogId)
    {
        // Load the existing content for the blog
        $blog = Blog::findOrFail($blogId);
        $this->blog = $blog ;
        $this->content = $blog->content;
    }

    public function saveContent()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $this->blog->update([
            'content' => $this->content,
        ]);

        session()->flash('success', 'Blog Content updated successfully!');

    }

    public function store(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'upload' => 'required|image|max:40960',
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


    public function render()
    {
        return view('livewire.general.c-k-editor');
    }
}
