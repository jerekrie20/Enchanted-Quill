<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Categories;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Livewire::actingAs($admin)
            ->test(Categories::class)
            ->call('openCreateModal')
            ->set('name', 'Test Category')
            ->call('save')
            ->assertStatus(200)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    public function test_non_admin_cannot_create_category(): void
    {
        $user = User::factory()->create(['role' => 'reader']);

        Livewire::actingAs($user)
            ->test(Categories::class)
            ->call('openCreateModal')
            ->set('name', 'Test Category')
            ->call('save')
            ->assertForbidden();

        $this->assertDatabaseMissing('categories', [
            'name' => 'Test Category',
        ]);
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create(['name' => 'Old Name']);

        Livewire::actingAs($admin)
            ->test(Categories::class)
            ->call('openEditModal', $category->id)
            ->set('name', 'New Name')
            ->call('save')
            ->assertStatus(200)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'New Name',
        ]);
    }

    public function test_non_admin_cannot_update_category(): void
    {
        $user = User::factory()->create(['role' => 'reader']);
        $category = Category::factory()->create(['name' => 'Old Name']);

        Livewire::actingAs($user)
            ->test(Categories::class)
            ->call('openEditModal', $category->id)
            ->assertForbidden();
    }
}
