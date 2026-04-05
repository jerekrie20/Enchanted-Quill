<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelPublicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_is_published_logic(): void
    {
        $publishedBook = new Book([
            'status' => Book::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);
        $this->assertTrue($publishedBook->isPublished());

        $privateBook = new Book([
            'status' => Book::STATUS_PRIVATE,
            'published_at' => now()->subDay(),
        ]);
        $this->assertTrue($privateBook->isPublished());

        $draftBook = new Book([
            'status' => Book::STATUS_DRAFT,
            'published_at' => now()->subDay(),
        ]);
        $this->assertFalse($draftBook->isPublished());

        $scheduledBook = new Book([
            'status' => Book::STATUS_SCHEDULED,
            'published_at' => now()->addDay(),
        ]);
        $this->assertFalse($scheduledBook->isPublished());

        $immediatePublishedBook = new Book([
            'status' => Book::STATUS_PUBLISHED,
            'published_at' => null,
        ]);
        $this->assertTrue($immediatePublishedBook->isPublished());
    }

    public function test_book_published_scope(): void
    {
        // Published
        Book::factory()->create([
            'status' => Book::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);

        // Private (Accessible but unlisted usually)
        Book::factory()->create([
            'status' => Book::STATUS_PRIVATE,
            'published_at' => now()->subDay(),
        ]);

        // Draft
        Book::factory()->create([
            'status' => Book::STATUS_DRAFT,
            'published_at' => now()->subDay(),
        ]);

        // Scheduled
        Book::factory()->create([
            'status' => Book::STATUS_SCHEDULED,
            'published_at' => now()->addDay(),
        ]);

        $this->assertEquals(2, Book::published()->count());
    }

    public function test_blog_is_published_logic(): void
    {
        $publishedBlog = new Blog([
            'status' => Blog::STATUS_PUBLISHED,
            'publish_at' => now()->subDay(),
        ]);
        $this->assertTrue($publishedBlog->isPublished());

        $draftBlog = new Blog([
            'status' => Blog::STATUS_DRAFT,
            'publish_at' => now()->subDay(),
        ]);
        $this->assertFalse($draftBlog->isPublished());
    }

    public function test_blog_published_scope(): void
    {
        Blog::factory()->create([
            'status' => Blog::STATUS_PUBLISHED,
            'publish_at' => now()->subDay(),
        ]);

        Blog::factory()->create([
            'status' => Blog::STATUS_DRAFT,
            'publish_at' => now()->subDay(),
        ]);

        Blog::factory()->create([
            'status' => Blog::STATUS_SCHEDULED,
            'publish_at' => now()->addDay(),
        ]);

        $this->assertEquals(1, Blog::published()->count());
    }
}
