<?php

namespace App\Livewire\General;

use App\Jobs\ProcessBlog;
use App\Models\Blog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogEditor extends Component
{
    use WithFileUploads;

    #[Layout('components.Layouts.admin')]
    #[Title('Edit Blog')]

    //Form Fields
    public $title;
    public $slug;

    public $status;
    public $publish_at;
    public $image;
    public $currentImage;

    #[Locked]
    public $blog;

    public $statusData = [
        '0' => 'Draft',
        '1' => 'Published',
        '2' => 'Private',
        '3' => 'Publish Later'
    ];



    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', Rule::unique('blogs')->ignore($this->blog->id), 'string'],
            'status' => ['required', 'numeric', 'integer', 'min:0', 'max:3'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg','max:2040'],
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

        $imageService = new ImageService();


       // dd($data, $this->image);
        if($this->image){
            $this->image =  $imageService->saveImage($this->image,$this->currentImage,'blogs', 'blog_image');
        }else{
            $this->image = $this->currentImage;
        }

        $data['image'] = $this->image;

        // Convert publish_at if it's set
        if (!empty($data['publish_at'])) {
            $data['publish_at'] = Carbon::parse($data['publish_at']);
        }

        $this->blog->update($data);

        // Schedule the job if status is "Publish Later"
        if ($this->status == 3 && !empty($data['publish_at'])) {
            ProcessBlog::dispatch($this->blog->id)->delay($data['publish_at']);
        }

        session()->flash('success', 'Blog updated successfully!');
    }




    public function mount($id)
    {
        $blog = Blog::find($id);
        $this->blog = $blog;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->status = $blog->status;
        $this->currentImage = $blog->image;
        $this->publish_at = $blog->publish_at;
    }

    public function render()
    {
        return view('livewire.general.blog-editor');
    }
}
