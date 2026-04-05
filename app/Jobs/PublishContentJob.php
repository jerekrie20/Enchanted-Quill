<?php

namespace App\Jobs;

use App\Events\ContentPublished;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Model $content;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get the fresh model from DB in case it was updated
        $model = $this->content->fresh();

        if (! $model) {
            return;
        }

        if (class_basename($model) === 'Book') {
            if ($model->status != Book::STATUS_SCHEDULED || $model->published_at > now()) {
                return;
            }
            $model->update(['status' => Book::STATUS_PUBLISHED]);
        } elseif (class_basename($model) === 'Blog') {
            if ($model->status != Blog::STATUS_SCHEDULED || $model->publish_at > now()) {
                return;
            }
            $model->update(['status' => Blog::STATUS_PUBLISHED]);
        } elseif (class_basename($model) === 'Chapter') {
            if ($model->status != Chapter::STATUS_SCHEDULED || $model->published_at > now()) {
                return;
            }
            $model->update(['status' => Chapter::STATUS_PUBLISHED]);
        } else {
            return;
        }

        event(new ContentPublished($model));
    }
}
