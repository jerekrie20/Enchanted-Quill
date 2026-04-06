<?php

namespace Tests\Feature\Livewire\Portal;

use App\Livewire\Portal\UserProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FollowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_follow_an_author(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $author = User::factory()->create(['role' => 'author']);

        $this->actingAs($user);

        Livewire::test(UserProfile::class, ['id' => $author->id])
            ->call('toggleFollow');

        $this->assertTrue($user->isFollowing($author));
        $this->assertEquals(1, $author->followers()->count());
    }

    public function test_user_can_unfollow_an_author(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $author = User::factory()->create(['role' => 'author']);

        $user->following()->attach($author->id);

        $this->actingAs($user);

        Livewire::test(UserProfile::class, ['id' => $author->id])
            ->call('toggleFollow');

        $this->assertFalse($user->isFollowing($author));
        $this->assertEquals(0, $author->followers()->count());
    }

    public function test_user_cannot_follow_themselves(): void
    {
        $author = User::factory()->create(['role' => 'author']);

        $this->actingAs($author);

        Livewire::test(UserProfile::class, ['id' => $author->id])
            ->call('toggleFollow');

        $this->assertFalse($author->isFollowing($author));
    }
}
