<?php

namespace Tests\Feature\Livewire\Portal;

use App\Livewire\Portal\BookDetail;
use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BookDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_detail_page_renders_successfully(): void
    {
        $book = Book::factory()->create();

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->assertStatus(200)
            ->assertSee($book->title);
    }

    public function test_authenticated_user_can_bookmark_book(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->call('toggleBookmark')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);
    }

    public function test_authenticated_user_can_remove_bookmark(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        Bookmark::create([
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->call('toggleBookmark')
            ->assertDispatched('notify');

        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->id,
            'bookmarkable_id' => $book->id,
            'bookmarkable_type' => Book::class,
        ]);
    }

    public function test_authenticated_user_can_submit_review(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->set('reviewRating', 5)
            ->set('reviewContent', 'This is an amazing book! Highly recommended.')
            ->call('submitReview')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'stars' => 5,
            'content' => 'This is an amazing book! Highly recommended.',
        ]);
    }

    public function test_authenticated_user_can_update_existing_review(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $review = Review::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'stars' => 3,
            'content' => 'It was okay.',
        ]);

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->set('reviewRating', 5)
            ->set('reviewContent', 'Changed my mind, this book is excellent!')
            ->call('submitReview')
            ->assertDispatched('notify');

        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'user_id' => $user->id,
            'book_id' => $book->id,
            'stars' => 5,
            'content' => 'Changed my mind, this book is excellent!',
        ]);
    }

    public function test_review_requires_minimum_content_length(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->set('reviewRating', 5)
            ->set('reviewContent', 'Short')
            ->call('submitReview')
            ->assertHasErrors(['reviewContent']);
    }

    public function test_chapters_are_paginated(): void
    {
        $book = Book::factory()->create();

        // Create 25 chapters
        for ($i = 1; $i <= 25; $i++) {
            $book->chapters()->create([
                'chapter_number' => $i,
                'title' => "Chapter {$i}",
                'content' => 'Chapter content',
            ]);
        }

        $component = Livewire::test(BookDetail::class, ['id' => $book->id])
            ->assertStatus(200);

        // Should show 20 chapters on first page
        $chapters = $component->get('chapters');
        $this->assertEquals(20, $chapters->count());
        $this->assertTrue($chapters->hasPages());
    }

    public function test_reviews_are_paginated(): void
    {
        $book = Book::factory()->create();
        $users = User::factory()->count(10)->create();

        // Create 10 reviews
        foreach ($users as $user) {
            Review::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'stars' => 5,
                'content' => 'Great book from user '.$user->id,
            ]);
        }

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->assertStatus(200)
            ->assertSee('Great book from user');
    }

    public function test_modal_opens_when_opening_review(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->call('openReviewModal')
            ->assertSet('showReviewModal', true);
    }

    public function test_modal_closes_when_closing_review(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        Livewire::test(BookDetail::class, ['id' => $book->id])
            ->set('showReviewModal', true)
            ->call('closeReviewModal')
            ->assertSet('showReviewModal', false);
    }
}
