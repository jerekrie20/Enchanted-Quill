<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
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
    public function toMail(object $notifiable): MailMessage
    {
        $type = class_basename($this->content);
        $title = $this->content->title;

        $url = url('/');
        if ($type === 'Book') {
            $url = route('public.book.show', ['id' => $this->content->id]);
        } elseif ($type === 'Blog') {
            $url = route('public.blog.show', ['id' => $this->content->id]);
        }

        return (new MailMessage)
            ->subject("Your {$type} has been published!")
            ->line("Good news! Your {$type} \"{$title}\" has reached its scheduled publication time and is now live.")
            ->action('View Content', $url)
            ->line('Thank you for sharing your work on our platform!');
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
