<?php

namespace Tests\Feature\Livewire\General;

use App\Livewire\General\Pages\ChronicleManager;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ChronicleManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_blog_and_see_content_editor(): void
    {
        $user = User::factory()->create(['role' => 'author']);
        $category = Category::factory()->create();

        $this->actingAs($user);

        $component = Livewire::test(ChronicleManager::class)
            ->set('title', 'Test Blog')
            ->set('slug', 'test-blog')
            ->set('category', [$category->id])
            ->set('status', Blog::STATUS_DRAFT)
            ->call('saveDetails');

        $component->assertHasNoErrors();
        $this->assertDatabaseHas('blogs', ['title' => 'Test Blog']);

        $blog = Blog::first();
        $component->assertSet('blogId', $blog->id);

        // Verify that the view shows the ChronicleContentEditor (by checking for the livewire component tag or just seeing if it's rendered)
        // In Livewire 3, we can check if the child component is present
        $component->assertSeeLivewire('general.editors.chronicle-content-editor');
    }

    public function test_can_save_blog_content(): void
    {
        $user = User::factory()->create(['role' => 'author']);
        $blog = Blog::factory()->create(['user_id' => $user->id, 'content' => 'Old content']);

        $this->actingAs($user);

        Livewire::test(\App\Livewire\General\Editors\ChronicleContentEditor::class, ['blogId' => $blog->id])
            ->set('content', 'New updated content')
            ->call('saveContent')
            ->assertHasNoErrors();

        $this->assertEquals('New updated content', $blog->refresh()->content);
    }
}
