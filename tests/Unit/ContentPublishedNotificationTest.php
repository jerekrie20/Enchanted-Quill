<?php

namespace Tests\Unit;

use App\Mail\ChapterPublished;
use App\Models\Chapter;
use App\Models\User;
use App\Notifications\ContentPublishedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentPublishedNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_mail_returns_chapter_published_mailable(): void
    {
        $user = User::factory()->create();
        $chapter = Chapter::factory()->create();

        $notification = new ContentPublishedNotification($chapter);
        $mailable = $notification->toMail($user);

        $this->assertInstanceOf(ChapterPublished::class, $mailable);
        $this->assertEquals('Your Chapter "'.$chapter->title.'" Has Been Published!', $mailable->envelope()->subject);
    }
}
