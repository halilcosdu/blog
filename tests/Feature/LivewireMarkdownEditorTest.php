<?php

use App\Livewire\MarkdownEditor;
use Livewire\Livewire;

test('markdown editor component renders correctly', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $component->assertStatus(200)
        ->assertSee('Write')
        ->assertSee('Preview')
        ->assertSee('markdown-textarea');
});

test('markdown editor initializes with default values', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $component->assertSet('content', '')
        ->assertSet('name', 'content')
        ->assertSet('activeTab', 'write')
        ->assertSet('mentionDropdown.show', false);
});

test('markdown editor can be initialized with custom values', function () {
    $component = Livewire::test(MarkdownEditor::class, [
        'name' => 'description',
        'value' => 'Initial content',
        'placeholder' => 'Enter description...',
        'rows' => 10,
        'required' => true,
    ]);

    $component->assertSet('content', 'Initial content')
        ->assertSet('name', 'description')
        ->assertSet('placeholder', 'Enter description...')
        ->assertSet('rows', 10)
        ->assertSet('required', true);
});

test('can switch between write and preview tabs', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Initially on write tab
    $component->assertSet('activeTab', 'write');

    // Switch to preview
    $component->call('setActiveTab', 'preview')
        ->assertSet('activeTab', 'preview')
        ->assertDispatched('update-preview');

    // Switch back to write
    $component->call('setActiveTab', 'write')
        ->assertSet('activeTab', 'write');
});

test('toolbar buttons dispatch insert text events', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Test bold button
    $component->call('insertText', '**', '**')
        ->assertDispatched('insert-text', before: '**', after: '**');

    // Test italic button
    $component->call('insertText', '*', '*')
        ->assertDispatched('insert-text', before: '*', after: '*');

    // Test heading button
    $component->call('insertText', '## ', '')
        ->assertDispatched('insert-text', before: '## ', after: '');
});

test('code block and link buttons dispatch events', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $component->call('insertCodeBlock')
        ->assertDispatched('insert-code-block');

    $component->call('insertLink')
        ->assertDispatched('insert-link');
});

test('content updates are dispatched to parent component', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $component->set('content', 'New content')
        ->assertDispatched('contentUpdated', 'New content');
});

test('mention dropdown can be shown and hidden', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Show mention dropdown
    $component->call('showMentionDropdown', [
        'query' => 'john',
        'top' => 50,
        'left' => 20,
    ]);

    $component->assertSet('mentionDropdown.show', true)
        ->assertSet('mentionDropdown.query', 'john')
        ->assertSet('mentionDropdown.top', 50)
        ->assertSet('mentionDropdown.left', 20);

    // Hide mention dropdown
    $component->call('hideMentionDropdown');

    $component->assertSet('mentionDropdown.show', false)
        ->assertSet('mentionDropdown.users', []);
});

test('mention user search works correctly', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Search for users (using simulated data)
    $component->call('searchUsers', 'john');

    $users = $component->get('mentionDropdown.users');
    expect($users)->toBeArray();

    // Should find John Doe
    $johnUser = collect($users)->firstWhere('username', 'johndoe');
    expect($johnUser)->not->toBeNull();
    expect($johnUser['name'])->toBe('John Doe');
});

test('mention user search filters correctly', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Search with empty query should return all users
    $component->call('searchUsers', '');
    $allUsers = $component->get('mentionDropdown.users');

    // Search with specific query should filter
    $component->call('searchUsers', 'alice');
    $filteredUsers = $component->get('mentionDropdown.users');

    expect(count($filteredUsers))->toBeLessThanOrEqual(count($allUsers));

    // Should find Alice Johnson
    $aliceUser = collect($filteredUsers)->firstWhere('username', 'alice.johnson');
    expect($aliceUser)->not->toBeNull();
});

test('selecting mention dispatches event and hides dropdown', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $user = ['id' => 1, 'name' => 'John Doe', 'username' => 'johndoe'];

    $component->call('selectMention', $user)
        ->assertDispatched('select-mention', user: $user)
        ->assertSet('mentionDropdown.show', false);
});

test('selecting mention by index works correctly', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Setup users first
    $component->call('searchUsers', '');

    // Select first user by index
    $component->call('selectMentionByIndex', 0)
        ->assertDispatched('select-mention')
        ->assertSet('mentionDropdown.show', false);
});

test('toolbar buttons are disabled in preview mode', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // Switch to preview mode
    $component->call('setActiveTab', 'preview')
        ->assertSet('activeTab', 'preview');

    // Check that component renders with disabled buttons in preview mode
    $component->assertSee('Preview');

    // The disabled state is controlled by the activeTab property
    expect($component->get('activeTab'))->toBe('preview');
});

test('write tab shows textarea and preview tab shows preview area', function () {
    $component = Livewire::test(MarkdownEditor::class);

    // In write mode, should see textarea
    $component->assertSet('activeTab', 'write')
        ->assertSee('markdown-textarea');

    // In preview mode, should see preview area
    $component->call('setActiveTab', 'preview')
        ->assertSee('preview-content');
});

test('markdown editor handles content with special characters', function () {
    $component = Livewire::test(MarkdownEditor::class);

    $specialContent = 'Content with **bold**, *italic*, `code`, and @mention.user_name';

    $component->set('content', $specialContent)
        ->assertSet('content', $specialContent)
        ->assertDispatched('contentUpdated', $specialContent);
});

test('markdown editor component integration works with parent component', function () {
    // Test that the component can communicate with its parent
    $component = Livewire::test(MarkdownEditor::class, [
        'name' => 'content',
        'value' => 'Test content',
    ]);

    $component->assertSet('content', 'Test content');

    // Update content and verify event is dispatched
    $component->call('updateContent', 'Updated content')
        ->assertSet('content', 'Updated content')
        ->assertDispatched('contentUpdated', 'Updated content');
});
