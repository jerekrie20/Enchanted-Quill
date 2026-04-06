<?php

namespace Tests\Feature\Livewire\Portal;

use App\Livewire\Portal\Following;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FollowingTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_followed_authors(): void
    {
        $user = User::factory()->create();
        $author = User::factory()->create(['name' => 'John Doe']);
        $author2 = User::factory()->create(['name' => 'Jane Smith']);

        $user->following()->attach($author->id);

        $this->actingAs($user);

        Livewire::test(Following::class)
            ->assertSee('John Doe')
            ->assertDontSee('Jane Smith');
    }

    public function test_user_can_search_followed_authors(): void
    {
        $user = User::factory()->create();
        $author = User::factory()->create(['name' => 'John Doe']);
        $author2 = User::factory()->create(['name' => 'Jane Smith']);

        $user->following()->attach([$author->id, $author2->id]);

        $this->actingAs($user);

        Livewire::test(Following::class)
            ->assertSee('John Doe')
            ->assertSee('Jane Smith')
            ->set('search', 'John')
            ->assertSee('John Doe')
            ->assertDontSee('Jane Smith');
    }

    public function test_user_can_unfollow_author_from_list(): void
    {
        $user = User::factory()->create();
        $author = User::factory()->create(['name' => 'John Doe']);

        $user->following()->attach($author->id);

        $this->actingAs($user);

        Livewire::test(Following::class)
            ->assertSee('John Doe')
            ->call('unfollow', $author->id)
            ->assertDontSee('John Doe');

        $this->assertFalse($user->isFollowing($author));
    }
}
