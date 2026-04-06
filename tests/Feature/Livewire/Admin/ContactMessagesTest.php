<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ContactMessages;
use App\Mail\NewInternalMessage;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactMessagesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $user;

    protected Contact $contact;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->user = User::factory()->create();
        $this->contact = Contact::create([
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'message' => 'Hello Admin',
            'status' => Contact::STATUS_UNREAD,
        ]);
    }

    public function test_admin_can_send_reply_with_email_by_default(): void
    {
        Mail::fake();
        $this->actingAs($this->admin);

        Livewire::test(ContactMessages::class)
            ->call('viewMessage', $this->contact->id)
            ->set('replyMessage', 'This is a default reply')
            ->call('sendReply')
            ->assertHasNoErrors()
            ->assertSee('Reply sent and email notification delivered!');

        Mail::assertQueued(NewInternalMessage::class);
    }

    public function test_admin_can_send_reply_without_email(): void
    {
        Mail::fake();
        $this->actingAs($this->admin);

        Livewire::test(ContactMessages::class)
            ->call('viewMessage', $this->contact->id)
            ->set('replyMessage', 'This is a system-only reply')
            ->call('sendReply', false)
            ->assertHasNoErrors()
            ->assertSee('Reply sent successfully!');

        $this->assertDatabaseHas('contacts', [
            'parent_id' => $this->contact->id,
            'message' => 'This is a system-only reply',
            'is_from_admin' => true,
        ]);

        Mail::assertNothingQueued();
    }

    public function test_admin_can_send_reply_with_email(): void
    {
        Mail::fake();
        $this->actingAs($this->admin);

        Livewire::test(ContactMessages::class)
            ->call('viewMessage', $this->contact->id)
            ->set('replyMessage', 'This is a reply with email')
            ->call('sendReply', true)
            ->assertHasNoErrors()
            ->assertSee('Reply sent and email notification delivered!');

        $this->assertDatabaseHas('contacts', [
            'parent_id' => $this->contact->id,
            'message' => 'This is a reply with email',
            'is_from_admin' => true,
        ]);

        Mail::assertQueued(NewInternalMessage::class, function ($mail) {
            return $mail->hasTo($this->user->email);
        });
    }

    public function test_admin_can_send_reply_to_guest_with_email(): void
    {
        Mail::fake();
        $this->actingAs($this->admin);

        $guestContact = Contact::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'message' => 'Guest Message',
            'status' => Contact::STATUS_UNREAD,
        ]);

        Livewire::test(ContactMessages::class)
            ->call('viewMessage', $guestContact->id)
            ->set('replyMessage', 'Reply to guest')
            ->call('sendReply', true)
            ->assertHasNoErrors();

        Mail::assertQueued(NewInternalMessage::class, function ($mail) {
            return $mail->hasTo('guest@example.com');
        });
    }
}
