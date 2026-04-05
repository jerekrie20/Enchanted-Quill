<?php

namespace App\Listeners;

use App\Events\ContentPublished;
use App\Notifications\ContentPublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendContentPublishedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContentPublished $event): void
    {
        $content = $event->content;
        $author = null;

        if (class_basename($content) === 'Book') {
            $author = $content->author;
        } elseif (class_basename($content) === 'Blog') {
            $author = $content->user;
        } elseif (class_basename($content) === 'Chapter') {
            $author = $content->book?->author;
        }

        if ($author) {
            $author->notify(new ContentPublishedNotification($content));
        }
    }
}
