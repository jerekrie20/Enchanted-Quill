<?php

namespace Tests\Feature\Portal;

use App\Models\User;
use App\Livewire\Portal\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_component_can_render(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('portal.settings'))
            ->assertStatus(200)
            ->assertSeeLivewire(Settings::class);
    }

    public function test_initial_tab_is_personal(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Settings::class)
            ->assertSet('activeTab', 'personal')
            ->assertSee('Personal Scrolls');
    }

    public function test_can_switch_tabs(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Settings::class)
            ->set('activeTab', 'protective')
            ->assertSet('activeTab', 'protective')
            ->assertSee('Update Password');
    }

    public function test_can_initialize_from_url(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->withQueryParams(['tab' => 'protective'])
            ->test(Settings::class)
            ->assertSet('activeTab', 'protective');
    }
}
