<?php

namespace Tests\Feature;

use App\Events\ContentPublished;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\User;
use App\Notifications\ContentUpdateNotification;
use App\Notifications\NewFollowerNotification;
use App\Notifications\NewUserRegistrationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin registration notification.
     */
    public function test_admin_is_notified_of_new_user_registration(): void
    {
        Notification::fake();

        $admin = User::factory()->create([
            'role' => 'admin',
            'notify_new_users' => true,
        ]);

        $newUser = User::factory()->create();
        event(new Registered($newUser));

        Notification::assertSentTo(
            $admin,
            NewUserRegistrationNotification::class,
            function ($notification) use ($newUser) {
                return $notification->user->id === $newUser->id;
            }
        );
    }

    /**
     * Test admin registration notification is skipped if disabled.
     */
    public function test_admin_is_not_notified_of_new_user_registration_if_disabled(): void
    {
        Notification::fake();

        $admin = User::factory()->create([
            'role' => 'admin',
            'notify_new_users' => false,
        ]);

        $newUser = User::factory()->create();
        event(new Registered($newUser));

        Notification::assertNotSentTo($admin, NewUserRegistrationNotification::class);
    }

    /**
     * Test author follower notification.
     */
    public function test_author_is_notified_of_new_follower(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author', 'notify_new_users' => true]);
        $follower = User::factory()->create();

        $this->actingAs($follower);

        Livewire::test(\App\Livewire\Portal\UserProfile::class, ['id' => $author->id])
            ->call('toggleFollow');

        Notification::assertSentTo(
            $author,
            NewFollowerNotification::class,
            function ($notification) use ($follower) {
                return $notification->follower->id === $follower->id;
            }
        );
    }

    /**
     * Test author follower notification is skipped if disabled.
     */
    public function test_author_is_not_notified_of_new_follower_if_disabled(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author', 'notify_new_users' => false]);
        $follower = User::factory()->create();

        $this->actingAs($follower);

        Livewire::test(\App\Livewire\Portal\UserProfile::class, ['id' => $author->id])
            ->call('toggleFollow');

        Notification::assertNotSentTo($author, NewFollowerNotification::class);
    }

    /**
     * Test follower is notified of new book from followed author.
     */
    public function test_follower_is_notified_of_new_book(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author']);
        $follower = User::factory()->create(['notify_author_actions' => true]);
        $follower->following()->attach($author->id);

        $book = Book::factory()->create([
            'user_id' => $author->id,
            'status' => Book::STATUS_PUBLISHED,
        ]);

        event(new ContentPublished($book));

        Notification::assertSentTo(
            $follower,
            ContentUpdateNotification::class,
            function ($notification) use ($book) {
                return $notification->content->id === $book->id;
            }
        );
    }

    /**
     * Test follower is notified of new blog from followed author.
     */
    public function test_follower_is_notified_of_new_blog(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author']);
        $follower = User::factory()->create(['notify_author_actions' => true]);
        $follower->following()->attach($author->id);

        $blog = Blog::factory()->create([
            'user_id' => $author->id,
            'status' => Blog::STATUS_PUBLISHED,
        ]);

        event(new ContentPublished($blog));

        Notification::assertSentTo(
            $follower,
            ContentUpdateNotification::class,
            function ($notification) use ($blog) {
                return $notification->content->id === $blog->id;
            }
        );
    }

    /**
     * Test follower and bookmarker are notified of new chapter.
     */
    public function test_follower_and_bookmarker_are_notified_of_new_chapter(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author']);
        $book = Book::factory()->create(['user_id' => $author->id]);

        $follower = User::factory()->create(['notify_book_updates' => true]);
        $follower->following()->attach($author->id);

        $bookmarker = User::factory()->create(['notify_book_updates' => true]);
        $bookmarker->bookmarks()->create([
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);

        $chapter = Chapter::factory()->create([
            'book_id' => $book->id,
            'status' => Chapter::STATUS_PUBLISHED,
        ]);

        event(new ContentPublished($chapter));

        Notification::assertSentTo($follower, ContentUpdateNotification::class);
        Notification::assertSentTo($bookmarker, ContentUpdateNotification::class);
    }

    /**
     * Test ChronicleManager fires event on immediate publication.
     */
    public function test_chronicle_manager_fires_event_on_immediate_publication(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author']);
        $follower = User::factory()->create(['notify_author_actions' => true]);
        $follower->following()->attach($author->id);

        $this->actingAs($author);

        Livewire::test(\App\Livewire\General\Pages\ChronicleManager::class, ['id' => 'create'])
            ->set('title', 'New Chronicle')
            ->set('slug', 'new_chronicle')
            ->set('status', Blog::STATUS_PUBLISHED)
            ->call('saveDetails');

        $blog = Blog::where('title', 'New Chronicle')->first();
        $this->assertNotNull($blog);
        $this->assertEquals(Blog::STATUS_PUBLISHED, $blog->status);

        Notification::assertSentTo($follower, ContentUpdateNotification::class);
    }

    /**
     * Test ChapterManager fires event on immediate publication.
     */
    public function test_chapter_manager_fires_event_on_immediate_publication(): void
    {
        Notification::fake();

        $author = User::factory()->create(['role' => 'author']);
        $book = Book::factory()->create(['user_id' => $author->id]);

        $follower = User::factory()->create(['notify_book_updates' => true]);
        $follower->following()->attach($author->id);

        $this->actingAs($author);

        Livewire::test(\App\Livewire\General\Pages\ChapterManager::class, ['id' => $book->id, 'chapterNumber' => null])
            ->set('title', 'Chapter One')
            ->set('chapterNumber', 1)
            ->set('status', Chapter::STATUS_PUBLISHED)
            ->call('saveDetails');

        $chapter = Chapter::where('title', 'Chapter One')->first();
        $this->assertNotNull($chapter);
        $this->assertEquals(Chapter::STATUS_PUBLISHED, $chapter->status);

        Notification::assertSentTo($follower, ContentUpdateNotification::class);
    }
}
