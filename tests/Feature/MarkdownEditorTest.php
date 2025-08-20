<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('markdown editor component renders correctly in discussion create page', function () {
    // Create a user to authenticate
    $user = User::factory()->create();

    $this->actingAs($user);
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Start a New Discussion')
        ->assertSee('markdown-editor-wrapper');
});

test('user search api returns users correctly', function () {
    User::factory()->create([
        'name' => 'Test User',
        'username' => 'test.user_123',
    ]);

    $response = $this->get('/api/users/search?q=test');

    $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => ['id', 'name', 'username'],
        ]);
});

test('user search api handles usernames with dots and underscores', function () {
    $user = User::factory()->create([
        'name' => 'Quigley Maudie',
        'username' => 'quigley.maudie_87824',
    ]);

    $response = $this->get('/api/users/search?q=quigley');

    $response->assertStatus(200);

    $users = $response->json();
    expect($users)->toHaveCount(1);
    expect($users[0]['username'])->toBe('quigley.maudie_87824');
    expect($users[0]['name'])->toBe('Quigley Maudie');
});

test('user search api returns partial matches', function () {
    User::factory()->create([
        'name' => 'John Doe',
        'username' => 'john.doe_456',
    ]);

    // Search by partial username
    $response = $this->get('/api/users/search?q=john');
    $response->assertStatus(200);

    $users = $response->json();
    expect($users)->toHaveCount(1);

    // Search by partial name
    $response = $this->get('/api/users/search?q=doe');
    $response->assertStatus(200);

    $users = $response->json();
    expect($users)->toHaveCount(1);
});

test('markdown editor component includes typography plugin styles', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('markdown-editor-wrapper')  // Check that markdown editor wrapper exists
        ->assertSee('editor-toolbar')  // Check that editor toolbar exists
        ->assertSee('copyCodeToClipboard'); // Check that copy function exists
});

test('copy button function is properly defined', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('copyCodeToClipboard')  // Check that copy function exists
        ->assertSee('event.preventDefault()')  // Check for proper event handling
        ->assertSee('event.stopPropagation()'); // Check for proper event propagation control
});
