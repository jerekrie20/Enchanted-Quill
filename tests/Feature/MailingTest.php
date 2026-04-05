<?php

use App\Events\ContentPublished;
use App\Mail\AdminContactNotification;
use App\Mail\NewInternalMessage;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
use App\Notifications\ContentPublishedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class MailingTest extends TestCase
{
    use RefreshDatabase;

    public function test_chapter_publication_sends_notification_to_author(): void
    {
        Notification::fake();

        $author = User::factory()->create();
        $book = Book::factory()->create(['user_id' => $author->id]);
        $chapter = Chapter::factory()->create([
            'book_id' => $book->id,
            'status' => Chapter::STATUS_PUBLISHED,
        ]);

        event(new ContentPublished($chapter));

        Notification::assertSentTo($author, ContentPublishedNotification::class, function ($notification) use ($chapter) {
            return $notification->content->id === $chapter->id;
        });
    }

    public function test_contact_form_sends_email_to_admin(): void
    {
        Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);

        Livewire::test(\App\Livewire\Public\Contact::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('subject', 'Test Subject')
            ->set('message', 'This is a test message from a guest.')
            ->call('submit');

        Mail::assertQueued(AdminContactNotification::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });
    }

    public function test_admin_sending_message_sends_email_to_user(): void
    {
        Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        $this->actingAs($admin);

        Livewire::test(\App\Livewire\Admin\ContactMessages::class)
            ->set('composeUserId', $user->id)
            ->set('composeSubject', 'Hello')
            ->set('composeMessage', 'Welcome to our platform!')
            ->call('sendMessage');

        Mail::assertQueued(NewInternalMessage::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_user_reply_sends_email_to_admin(): void
    {
        Mail::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        $contact = \App\Models\Contact::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'message' => 'Original message',
            'status' => \App\Models\Contact::STATUS_UNREAD,
        ]);

        $this->actingAs($user);

        Livewire::test(\App\Livewire\Portal\Messages::class)
            ->call('viewMessage', $contact->id)
            ->set('replyMessage', 'This is my reply to admin.')
            ->call('sendReply');

        Mail::assertQueued(AdminContactNotification::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });
    }
}
