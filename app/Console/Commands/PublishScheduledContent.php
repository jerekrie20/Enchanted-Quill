<?php

namespace App\Console\Commands;

use App\Jobs\PublishContentJob;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Console\Command;

class PublishScheduledContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all scheduled content that is due.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Starting scheduled content publication check...');

        // Publish due Books
        $books = Book::where('status', Book::STATUS_SCHEDULED)
            ->where('published_at', '<=', now())
            ->get();

        foreach ($books as $book) {
            $this->info("Found Book: '{$book->title}' due for publication.");
            PublishContentJob::dispatch($book);
        }

        // Publish due Blogs
        $blogs = Blog::where('status', Blog::STATUS_SCHEDULED)
            ->where('publish_at', '<=', now())
            ->get();

        foreach ($blogs as $blog) {
            $this->info("Found Blog: '{$blog->title}' due for publication.");
            PublishContentJob::dispatch($blog);
        }

        // Publish due Chapters
        $chapters = Chapter::where('status', Chapter::STATUS_SCHEDULED)
            ->where('published_at', '<=', now())
            ->get();

        foreach ($chapters as $chapter) {
            $this->info("Found Chapter: '{$chapter->title}' due for publication.");
            PublishContentJob::dispatch($chapter);
        }

        $this->info('Publication check completed.');
    }
}
