<?php

namespace App\Listeners;

use App\Events\ContentPublished;
use App\Notifications\ContentPublishedNotification;
use App\Notifications\ContentUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

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
        $type = class_basename($content);

        if ($type === 'Book') {
            $author = $content->author;
        } elseif ($type === 'Blog') {
            $author = $content->user;
        } elseif ($type === 'Chapter') {
            $author = $content->book?->author;
        }

        // 1. Notify the author about their own publication (if they want to)
        if ($author && $author->notify_publication) {
            $author->notify(new ContentPublishedNotification($content));
        }

        // 2. Notify followers/bookmarkers
        if (! $author) {
            return;
        }

        $notifiables = collect();

        if ($type === 'Book' || $type === 'Blog') {
            // New book/blog: Notify followers who want author action notifications
            $followers = $author->followers()->where('notify_author_actions', true)->get();
            $notifiables = $notifiables->concat($followers);
        } elseif ($type === 'Chapter') {
            // New chapter: Notify followers and bookmarkers who want book updates
            $followers = $author->followers()->where('notify_book_updates', true)->get();
            $bookmarkers = $content->book->bookmarks()->with('user')->get()->pluck('user')->filter(function ($user) {
                return $user && $user->notify_book_updates;
            });

            $notifiables = $notifiables->concat($followers)->concat($bookmarkers);
        }

        // Remove duplicates (e.g., someone following AND bookmarking) and the author themselves
        $notifiables = $notifiables->unique('id')->reject(function ($user) use ($author) {
            return $user->id === $author->id;
        });

        if ($notifiables->isNotEmpty()) {
            Notification::send($notifiables, new ContentUpdateNotification($content));
        }
    }
}
