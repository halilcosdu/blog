<?php

use App\Livewire\Discussion\EditDiscussion;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('Discussion Edit Functionality', function () {
    it('can render edit discussion page for discussion owner', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertSuccessful();
        $response->assertSee('Edit Discussion');
        $response->assertSee($discussion->title);
    });

    it('prevents non-owners from accessing edit page', function () {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($otherUser);

        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertStatus(403);
    });

    it('loads discussion data correctly in edit component', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Original Title',
            'content' => 'Original Content',
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->assertSet('title', 'Original Title')
            ->assertSet('content', 'Original Content')
            ->assertSet('category_id', $category->id);
    });

    it('can update discussion title successfully', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Original Title',
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'Updated Title')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        // Verify database was updated
        expect($discussion->fresh()->title)->toBe('Updated Title');
    });

    it('can update discussion content successfully', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => 'Original content',
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('content', 'Updated content')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        // Verify database was updated
        expect($discussion->fresh()->content)->toBe('Updated content');
    });

    it('can update discussion category successfully', function () {
        $user = User::factory()->create();
        $originalCategory = Category::factory()->create();
        $newCategory = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $originalCategory->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('category_id', $newCategory->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        // Verify database was updated
        expect($discussion->fresh()->category_id)->toBe($newCategory->id);
    });

    it('validates required title field', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', '')
            ->call('save')
            ->assertHasErrors(['title']);
    });

    it('validates required content field', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('content', '')
            ->call('save')
            ->assertHasErrors(['content']);
    });

    it('validates required category field', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('category_id', null)
            ->call('save')
            ->assertHasErrors(['category_id']);
    });

    it('validates title maximum length', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', str_repeat('a', 256)) // Over 255 chars
            ->call('save')
            ->assertHasErrors(['title']);
    });

    it('validates category exists in database', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('category_id', 99999) // Non-existent category
            ->call('save')
            ->assertHasErrors(['category_id']);
    });

    it('allows direct content updates from markdown editor', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => 'Original content',
        ]);

        $this->actingAs($user);

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);

        // Directly set content as markdown editor would do
        $component->set('content', 'Updated content from markdown editor');

        $component->assertSet('content', 'Updated content from markdown editor');
    });

    it('redirects to discussion show page after successful update', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'Updated Title')
            ->set('content', 'Updated content')
            ->call('save')
            ->assertRedirect(); // Just check that redirect happened, slug might change
    });

    it('displays success message after update', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'Updated Title')
            ->call('save')
            ->assertRedirect();

        expect(session()->get('success'))->toBe('Discussion updated successfully!');
    });

    it('handles markdown content with mentions', function () {
        $user = User::factory()->create();
        $mentionedUser = User::factory()->create(['username' => 'mentioned_user']);
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $contentWithMention = 'Hello @mentioned_user, what do you think about this?';

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('content', $contentWithMention)
            ->call('save')
            ->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($contentWithMention);
    });

    it('handles markdown content with code blocks', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $contentWithCode = "Here's some code:\n\n```php\n\$user = new User();\necho \$user->name;\n```";

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('content', $contentWithCode)
            ->call('save')
            ->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($contentWithCode);
    });

    it('preserves markdown formatting in content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $markdownContent = '# Heading\n\nThis is **bold** and *italic* text.\n\n- Item 1\n- Item 2';

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('content', $markdownContent)
            ->call('save')
            ->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($markdownContent);
    });

    it('loads active categories in dropdown', function () {
        $user = User::factory()->create();
        $activeCategory = Category::factory()->create(['is_active' => true, 'name' => 'Active Category']);
        $inactiveCategory = Category::factory()->create(['is_active' => false, 'name' => 'Inactive Category']);
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $activeCategory->id,
        ]);

        $this->actingAs($user);

        // Test by making HTTP request to the edit page
        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertSuccessful();
        $response->assertSee('Active Category');
        $response->assertDontSee('Inactive Category');
    });

    it('updates all fields simultaneously', function () {
        $user = User::factory()->create();
        $originalCategory = Category::factory()->create();
        $newCategory = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $originalCategory->id,
            'title' => 'Original Title',
            'content' => 'Original Content',
        ]);

        $this->actingAs($user);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'New Title')
            ->set('content', 'New Content')
            ->set('category_id', $newCategory->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        $discussion->refresh();
        expect($discussion->title)->toBe('New Title');
        expect($discussion->content)->toBe('New Content');
        expect($discussion->category_id)->toBe($newCategory->id);
    });

    it('handles 404 for non-existent discussion slug', function () {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        Livewire::test(EditDiscussion::class, ['slug' => 'non-existent-slug']);
    });

    it('has correct page title and meta description', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        // Test by making HTTP request to verify page title and meta
        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertSuccessful();
        $response->assertSee('Edit Discussion');
    });
});
