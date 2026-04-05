<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicBlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_render_the_blog_page(): void
    {
        // Create a user and some published blogs
        $user = User::factory()->create();
        Blog::factory()->count(5)->create([
            'user_id' => $user->id,
            'status' => 1, // Published
            'publish_at' => now()->subDay(),
        ]);

        // Visit the blog page
        $response = $this->get(route('blog'));

        $response->assertStatus(200);
        $response->assertSeeLivewire('public.blog');
    }

    public function test_it_can_render_members_only_blogs(): void
    {
        // Create a user and some members only blogs
        $user = User::factory()->create();
        Blog::factory()->count(3)->create([
            'user_id' => $user->id,
            'status' => 2, // Private/Members Only
            'publish_at' => now()->subDay(),
        ]);

        // Visit the blog page
        $response = $this->get(route('blog'));

        $response->assertStatus(200);
        $response->assertSee('Members Only');
        $response->assertSee('Login to Read');
    }
}
