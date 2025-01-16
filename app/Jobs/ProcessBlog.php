<?php

namespace App\Jobs;

use App\Models\Blog;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBlog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, \Illuminate\Bus\Queueable, SerializesModels;

    protected $blogId;

    /**
     * Create a new job instance.
     */
    public function __construct($blogID)
    {
       $this->blogId = $blogID;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $blog = Blog::find($this->blogId);

        try {
            if($blog && $blog->status == 3 && $blog->publish_at <= now()) {
                $blog->update(['status' => 1]); // Set status to Published
                Log::info('Blog published!', ['id' => $this->blogId, 'title' => $blog->title]);
            }
        } catch (\Exception $e) {
            Log::error('Error publishing blog:', [
                'id' => $this->blogId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
