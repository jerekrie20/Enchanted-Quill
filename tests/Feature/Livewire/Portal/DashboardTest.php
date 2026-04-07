<?php

namespace Tests\Feature\Livewire\Portal;

use App\Livewire\Portal\Dashboard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the dashboard renders correctly without blogs.
     */
    public function test_dashboard_renders_without_blogs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Dashboard::class)
            ->assertStatus(200)
            ->assertSee('Silence in the Chronicles')
            ->assertSee('Browse Chronicles');
    }

    /**
     * Test the dashboard renders with blogs.
     */
    public function test_dashboard_renders_with_blogs(): void
    {
        $user = User::factory()->create();
        \App\Models\Blog::factory()->count(3)->create(['status' => \App\Models\Blog::STATUS_PUBLISHED]);

        $this->actingAs($user);

        Livewire::test(Dashboard::class)
            ->assertStatus(200)
            ->assertDontSee('Silence in the Chronicles');
    }
}
