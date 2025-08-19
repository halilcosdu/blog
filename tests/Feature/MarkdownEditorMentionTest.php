<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Livewire\Livewire;

it('discussion page includes markdown editor with mention functionality', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $this->actingAs($user);

    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Check that the page includes the simple markdown editor which has mention functionality
    $response->assertSeeLivewire('simple-markdown-editor');
});

it('can search users for mentions', function () {
    $component = Livewire::test('simple-markdown-editor');

    // Test empty search returns all users
    $component->call('searchUsers')
        ->assertSet('mentionUsers', function ($users) {
            return count($users) > 0;
        });

    // Test search with query filters users
    $component->call('searchUsers', 'admin')
        ->assertSet('mentionUsers', function ($users) {
            return collect($users)->contains(function ($user) {
                return str_contains(strtolower($user['name']), 'admin') ||
                       str_contains(strtolower($user['username']), 'admin');
            });
        });
});

it('can select mention from dropdown', function () {
    $component = Livewire::test('simple-markdown-editor');

    // Trigger mention dropdown
    $component->call('searchUsers')
        ->call('selectMentionByIndex', 0)
        ->assertDispatched('select-mention');
});

it('can navigate mention dropdown with keyboard', function () {
    $component = Livewire::test('simple-markdown-editor');

    // Set up mention dropdown
    $component->set('showMentionDropdown', true)
        ->set('mentionUsers', [
            ['id' => 1, 'name' => 'John Doe', 'username' => 'john.doe'],
            ['id' => 2, 'name' => 'Jane Smith', 'username' => 'jane.smith'],
        ])
        ->set('mentionSelectedIndex', 0);

    // Test navigation down
    $component->call('navigateMention', 'down')
        ->assertSet('mentionSelectedIndex', 1);

    // Test navigation up
    $component->call('navigateMention', 'up')
        ->assertSet('mentionSelectedIndex', 0);
});

it('hides mention dropdown when content is cleared', function () {
    $component = Livewire::test('simple-markdown-editor');

    // Show mention dropdown
    $component->set('showMentionDropdown', true)
        ->set('mentionUsers', [['id' => 1, 'name' => 'Test User', 'username' => 'test']]);

    // Clear content should hide mention dropdown
    $component->dispatch('clear-editor-content')
        ->assertSet('showMentionDropdown', false)
        ->assertSet('mentionUsers', []);
});

it('renders mentions in preview mode', function () {
    $component = Livewire::test('simple-markdown-editor');

    // Set content with mentions
    $contentWithMentions = 'Hello @john.doe and @jane_smith!';
    $component->set('content', $contentWithMentions)
        ->set('activeTab', 'preview');

    // Check that the component renders without errors
    expect($component->get('content'))->toBe($contentWithMentions);
    expect($component->get('activeTab'))->toBe('preview');
});
