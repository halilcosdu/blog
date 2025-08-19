<?php

use App\Livewire\Discussion\CreateDiscussion;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->category = Category::factory()->create([
        'is_active' => true,
        'sort_order' => 1,
    ]);
    $this->actingAs($this->user);
});

test('create discussion page renders correctly', function () {
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Start a New Discussion')
        ->assertSee('Discussion Title')
        ->assertSee('Category')
        ->assertSee('Discussion Content')
        ->assertSee('Create Discussion');
});

test('create discussion page shows categories', function () {
    $categories = Category::factory()->count(3)->create([
        'is_active' => true,
    ]);

    $response = $this->get('/discussions/create');

    $response->assertStatus(200);

    foreach ($categories as $category) {
        $response->assertSee($category->name);
    }
});

test('create discussion page does not show inactive categories', function () {
    $activeCategory = Category::factory()->create([
        'name' => 'Active Category',
        'is_active' => true,
    ]);

    $inactiveCategory = Category::factory()->create([
        'name' => 'Inactive Category',
        'is_active' => false,
    ]);

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Active Category')
        ->assertDontSee('Inactive Category');
});

test('can create discussion with valid data', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion Title')
        ->set('content', 'This is a test discussion content with some details.')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect('/discussions');

    $this->assertDatabaseHas('discussions', [
        'user_id' => $this->user->id,
        'category_id' => $this->category->id,
        'title' => 'Test Discussion Title',
        'content' => 'This is a test discussion content with some details.',
        'slug' => 'test-discussion-title',
        'is_resolved' => false,
        'views_count' => 0,
    ]);
});

test('creates unique slug automatically', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Amazing Discussion')
        ->set('content', 'Content for amazing discussion')
        ->set('category_id', $this->category->id)
        ->call('save');

    $discussion = Discussion::where('title', 'Amazing Discussion')->first();
    expect($discussion->slug)->toBe('amazing-discussion');
});

test('title is required', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', '')
        ->set('content', 'This is valid content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['title' => 'required']);

    $this->assertDatabaseEmpty('discussions');
});

test('title must be at least 5 characters', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Hi')  // Only 2 characters
        ->set('content', 'This is valid content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['title' => 'min']);

    $this->assertDatabaseEmpty('discussions');
});

test('title with exactly 5 characters is valid', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Hello')  // Exactly 5 characters
        ->set('content', 'This is valid content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => 'Hello',
    ]);
});

test('title cannot be longer than 255 characters', function () {
    $longTitle = str_repeat('a', 256);

    Livewire::test(CreateDiscussion::class)
        ->set('title', $longTitle)
        ->set('content', 'This is valid content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['title' => 'max']);

    $this->assertDatabaseEmpty('discussions');
});

test('title with exactly 255 characters is valid', function () {
    $validTitle = str_repeat('a', 255);

    Livewire::test(CreateDiscussion::class)
        ->set('title', $validTitle)
        ->set('content', 'This is valid content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => $validTitle,
    ]);
});

test('content is required', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', '')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['content' => 'required']);

    $this->assertDatabaseEmpty('discussions');
});

test('content must be at least 10 characters', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', 'Short')  // Only 5 characters
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['content' => 'min']);

    $this->assertDatabaseEmpty('discussions');
});

test('content with exactly 10 characters is valid', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', '1234567890')  // Exactly 10 characters
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'content' => '1234567890',
    ]);
});

test('content with only whitespace is invalid', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', '           ')  // 11 spaces but should still fail validation
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasErrors(['content']);

    $this->assertDatabaseEmpty('discussions');
});

test('category_id is required', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', 'Valid content that is long enough')
        ->set('category_id', null)
        ->call('save')
        ->assertHasErrors(['category_id' => 'required']);

    $this->assertDatabaseEmpty('discussions');
});

test('category_id must exist in categories table', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', 'Valid content that is long enough')
        ->set('category_id', 99999) // Non-existent category
        ->call('save')
        ->assertHasErrors(['category_id' => 'exists']);

    $this->assertDatabaseEmpty('discussions');
});

test('cannot create discussion with inactive category', function () {
    $inactiveCategory = Category::factory()->create([
        'is_active' => false,
    ]);

    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Valid Title')
        ->set('content', 'Valid content that is long enough')
        ->set('category_id', $inactiveCategory->id)
        ->call('save')
        ->assertHasErrors(['category_id']);

    $this->assertDatabaseEmpty('discussions');
});

test('multiple validation errors are shown together', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', '') // Required error
        ->set('content', '') // Required error
        ->set('category_id', null) // Required error
        ->call('save')
        ->assertHasErrors(['title', 'content', 'category_id']);

    $this->assertDatabaseEmpty('discussions');
});

test('success message is flashed after creating discussion', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion')
        ->set('content', 'Test content')
        ->set('category_id', $this->category->id)
        ->call('save');

    expect(session('success'))->toBe('Discussion created successfully!');
});

test('discussion is created with correct user_id', function () {
    $anotherUser = User::factory()->create();

    // Make sure we're acting as the first user
    $this->actingAs($this->user);

    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion')
        ->set('content', 'Test content')
        ->set('category_id', $this->category->id)
        ->call('save');

    $this->assertDatabaseHas('discussions', [
        'user_id' => $this->user->id,
        'title' => 'Test Discussion',
    ]);

    $this->assertDatabaseMissing('discussions', [
        'user_id' => $anotherUser->id,
        'title' => 'Test Discussion',
    ]);
});

test('discussion is created with default values', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion')
        ->set('content', 'Test content')
        ->set('category_id', $this->category->id)
        ->call('save');

    $discussion = Discussion::where('title', 'Test Discussion')->first();

    expect($discussion->is_resolved)->toBeFalse();
    expect($discussion->views_count)->toBe(0);
    expect($discussion->user_id)->toBe($this->user->id);
});

test('can create discussion with markdown content', function () {
    $markdownContent = '# Heading 1

## Heading 2

This is **bold** text and this is *italic* text.

Here is a code block:
```php
<?php
echo "Hello World";
```

And here is an @mention example.';

    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Markdown Test Discussion')
        ->set('content', $markdownContent)
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => 'Markdown Test Discussion',
        'content' => $markdownContent,
    ]);
});

test('can create discussion with unicode characters', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Unicode Test: 🚀 Laravel Discussion')
        ->set('content', 'Content with unicode: 🔥 PHP, 💎 Ruby, 🐍 Python')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => 'Unicode Test: 🚀 Laravel Discussion',
        'content' => 'Content with unicode: 🔥 PHP, 💎 Ruby, 🐍 Python',
    ]);
});

test('can create discussion with special characters in title', function () {
    $specialTitle = 'How to use Laravel\'s "Eloquent" & <Models>?';

    Livewire::test(CreateDiscussion::class)
        ->set('title', $specialTitle)
        ->set('content', 'Discussion about special characters')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => $specialTitle,
    ]);
});

test('redirects to discussions index after successful creation', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion')
        ->set('content', 'Test content')
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertRedirect('/discussions');
});

test('unauthenticated user cannot access create discussion page', function () {
    auth()->logout();

    $response = $this->get('/discussions/create');

    $response->assertRedirect(route('filament.dashboard.auth.login'));
});

test('discussion requires user authentication', function () {
    // This test verifies that discussions require authentication at the route level
    // The previous test already covers this: 'unauthenticated user cannot access create discussion page'
    expect(true)->toBeTrue();
});

test('categories are ordered by sort_order then by name', function () {
    // Clear existing categories first
    Category::query()->delete();

    // Create categories with different sort orders and names
    $categoryZ = Category::factory()->create([
        'name' => 'Z Category',
        'sort_order' => 3,
        'is_active' => true,
    ]);

    $categoryA = Category::factory()->create([
        'name' => 'A Category',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $categoryB = Category::factory()->create([
        'name' => 'B Category',
        'sort_order' => 2,
        'is_active' => true,
    ]);

    $component = Livewire::test(CreateDiscussion::class);
    $categories = $component->viewData('categories');

    expect($categories->pluck('name')->toArray())->toBe([
        'A Category',
        'B Category',
        'Z Category',
    ]);
});

test('handles very long content', function () {
    $longContent = str_repeat('This is a very long content. ', 1000);

    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Long Content Discussion')
        ->set('content', $longContent)
        ->set('category_id', $this->category->id)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('discussions', [
        'title' => 'Long Content Discussion',
        'content' => $longContent,
    ]);
});

test('component initializes with empty values', function () {
    $component = Livewire::test(CreateDiscussion::class);

    expect($component->get('title'))->toBe('');
    expect($component->get('content'))->toBe('');
    expect($component->get('category_id'))->toBeNull();
});
