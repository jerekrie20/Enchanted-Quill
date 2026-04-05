<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;

class ContentPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Model $content;

    /**
     * Create a new notification instance.
     */
    public function __construct(Model $content)
    {
        $this->content = $content;
    }

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
    public function toMail(object $notifiable): \Illuminate\Mail\Mailable
    {
        $type = class_basename($this->content);

        if ($type === 'Book') {
            return (new \App\Mail\BookPublished($this->content))
                ->to($notifiable->email);
        } elseif ($type === 'Blog') {
            return (new \App\Mail\BlogPublished($this->content))
                ->to($notifiable->email);
        } elseif ($type === 'Chapter') {
            return (new \App\Mail\ChapterPublished($this->content))
                ->to($notifiable->email);
        }

        throw new \InvalidArgumentException("Unknown content type: {$type}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'content_id' => $this->content->id,
            'content_type' => get_class($this->content),
            'title' => $this->content->title,
        ];
    }
}
