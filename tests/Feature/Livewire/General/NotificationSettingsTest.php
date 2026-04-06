<?php

namespace Tests\Feature\Livewire\General;

use App\Livewire\General\Settings\NotificationSettings;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_notification_settings(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(NotificationSettings::class)
            ->assertSet('notify_messages', $user->notify_messages)
            ->assertSet('notify_book_updates', $user->notify_book_updates);
    }

    public function test_user_can_update_notification_settings(): void
    {
        $user = User::factory()->create([
            'notify_messages' => true,
            'notify_book_updates' => true,
        ]);
        $this->actingAs($user);

        Livewire::test(NotificationSettings::class)
            ->set('notify_messages', false)
            ->set('notify_book_updates', false)
            ->call('updateNotifications')
            ->assertHasNoErrors()
            ->assertSee('Notification preferences updated successfully.');

        $user->refresh();
        $this->assertFalse($user->notify_messages);
        $this->assertFalse($user->notify_book_updates);
    }

    public function test_author_can_see_author_specific_notifications(): void
    {
        $author = User::factory()->create(['role' => 'author']);
        $this->actingAs($author);

        Livewire::test(NotificationSettings::class)
            ->assertSee('Author Notifications')
            ->assertSee('Publication Updates')
            ->assertSee('New Readers/Followers');
    }

    public function test_reader_cannot_see_author_specific_notifications(): void
    {
        $reader = User::factory()->create(['role' => 'reader']);
        $this->actingAs($reader);

        Livewire::test(NotificationSettings::class)
            ->assertDontSee('Author Notifications')
            ->assertDontSee('Publication Updates');
    }
}
