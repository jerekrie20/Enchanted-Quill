<?php

namespace Tests\Feature\Livewire\Portal;

use App\Livewire\Portal\BookDetail;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BookmarkTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_bookmark_a_book(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $book = Book::factory()->create(['status' => Book::STATUS_PUBLISHED]);

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->call('toggleBookmark')
            ->assertSet('isBookmarked', true);

        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);
    }

    public function test_user_can_remove_bookmark(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $book = Book::factory()->create(['status' => Book::STATUS_PUBLISHED]);

        \App\Models\Bookmark::create([
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->call('toggleBookmark')
            ->assertSet('isBookmarked', false);

        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
        ]);
    }

    public function test_bookmark_button_is_visible_without_chapters(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $book = Book::factory()->create(['status' => Book::STATUS_PUBLISHED]);

        $this->actingAs($user);

        // Should see the "Add to Library" button even if there are 0 chapters
        $this->assertEquals(0, $book->chapters()->count());

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->assertSee('Add to Library');
    }
}
