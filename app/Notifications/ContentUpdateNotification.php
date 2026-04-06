<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContentUpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Model $content) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $type = class_basename($this->content);
        $authorName = '';
        $url = '';
        $message = '';
        $subject = '';

        if ($type === 'Book') {
            $authorName = $this->content->author->name;
            $url = route('public.book.show', ['id' => $this->content->id]);
            $subject = "New Volume Released: {$this->content->title}";
            $message = "{$authorName} has published a new volume: **{$this->content->title}**.";
        } elseif ($type === 'Blog') {
            $authorName = $this->content->user->name;
            $url = route('public.blog.show', ['id' => $this->content->id]);
            $subject = "New Chronicle Published: {$this->content->title}";
            $message = "{$authorName} has published a new chronicle: **{$this->content->title}**.";
        } elseif ($type === 'Chapter') {
            $authorName = $this->content->book->author->name;
            $bookTitle = $this->content->book->title;
            $url = route('chapter.read', [
                'bookId' => $this->content->book_id,
                'chapterNumber' => $this->content->chapter_number,
            ]);
            $subject = "New Chapter: {$this->content->title} in {$bookTitle}";
            $message = "A new chapter has been added to **{$bookTitle}**: *Chapter {$this->content->chapter_number}: {$this->content->title}*.";
        }

        return (new MailMessage)
            ->subject($subject)
            ->line($message)
            ->action('Read Now', $url)
            ->line('Where words weave magic,')
            ->line('The Enchanted Quill Team');
    }
}
