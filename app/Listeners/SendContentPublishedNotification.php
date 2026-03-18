<?php

namespace App\Listeners;

use App\Events\ContentPublished;
use App\Mail\BlogPublished;
use App\Mail\BookPublished;
use App\Notifications\ContentPublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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

            if ($author) {
                Mail::to($author)->send(new BookPublished($content));
            }

            return;
        } elseif (class_basename($content) === 'Blog') {
            $author = $content->user;

            if ($author) {
                Mail::to($author)->send(new BlogPublished($content));
            }

            return;
        }

        if ($author) {
            $author->notify(new ContentPublishedNotification($content));
        }
    }
}
