<?php

use App\Livewire\Discussion\CreateDiscussion;
use App\Models\Category;
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

test('notification component renders in layout', function () {
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('notifications-container');
});

test('success notification appears after creating discussion', function () {
    Livewire::test(CreateDiscussion::class)
        ->set('title', 'Test Discussion')
        ->set('content', 'This is test content that is long enough')
        ->set('category_id', $this->category->id)
        ->call('save');

    expect(session('success'))->toBe('Discussion created successfully!');
});

test('notification component handles success messages', function () {
    session()->flash('success', 'Test success message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Test success message');
});

test('notification component handles error messages', function () {
    session()->flash('error', 'Test error message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Test error message');
});

test('notification component handles warning messages', function () {
    session()->flash('warning', 'Test warning message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Test warning message');
});

test('notification component handles info messages', function () {
    session()->flash('info', 'Test info message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Test info message');
});

test('multiple notifications can be displayed', function () {
    session()->flash('success', 'Success message');
    session()->flash('warning', 'Warning message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('Success message')
        ->assertSee('Warning message');
});

test('notification component includes proper classes for different types', function () {
    session()->flash('success', 'Success message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('bg-green-50/95 dark:bg-green-900/90')
        ->assertSee('text-green-800 dark:text-green-200');
});

test('notification component includes close button functionality', function () {
    session()->flash('success', 'Test message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('removeNotification', false);
});

test('notification component includes auto-removal functionality', function () {
    session()->flash('success', 'Test message');

    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('auto-remove-notification', false)
        ->assertSee('setTimeout', false);
});

test('global notification function is available', function () {
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee('window.showNotification', false)
        ->assertSee('Livewire.dispatch(\'show-notification\'', false);
});

test('livewire notification listener is available', function () {
    $response = $this->get('/discussions/create');

    $response->assertStatus(200)
        ->assertSee("window.addEventListener('notification'", false);
});

test('auto removal event is dispatched when notification is added', function () {
    $component = Livewire::test(\App\Livewire\NotificationManager::class);

    $component->call('addNotification', 'success', 'Test message');

    $component->assertDispatched('auto-remove-notification');
});
