<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('discussion creates unique slug automatically', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $discussion = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Discussion',
        'content' => 'This is a test discussion',
    ]);

    expect($discussion->slug)->toBe('test-discussion');
});

test('discussion creates unique slug when duplicate title exists', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    // Create first discussion
    $discussion1 = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Discussion',
        'content' => 'This is the first test discussion',
    ]);

    // Create second discussion with same title
    $discussion2 = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Discussion',
        'content' => 'This is the second test discussion',
    ]);

    expect($discussion1->slug)->toBe('test-discussion');
    expect($discussion2->slug)->toBe('test-discussion-1');
});

test('discussion creates sequential unique slugs for multiple duplicates', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $discussions = [];

    // Create 5 discussions with same title
    for ($i = 0; $i < 5; $i++) {
        $discussions[] = Discussion::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Test Discussion',
            'content' => "This is test discussion number {$i}",
        ]);
    }

    expect($discussions[0]->slug)->toBe('test-discussion');
    expect($discussions[1]->slug)->toBe('test-discussion-1');
    expect($discussions[2]->slug)->toBe('test-discussion-2');
    expect($discussions[3]->slug)->toBe('test-discussion-3');
    expect($discussions[4]->slug)->toBe('test-discussion-4');
});

test('discussion slug updates when title changes', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $discussion = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Original Title',
        'content' => 'This is a test discussion',
    ]);

    expect($discussion->slug)->toBe('original-title');

    // Update title
    $discussion->update(['title' => 'Updated Title']);

    expect($discussion->fresh()->slug)->toBe('updated-title');
});

test('discussion slug excludes current record when updating', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    // Create first discussion
    $discussion1 = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Discussion',
        'content' => 'First discussion',
    ]);

    // Create second discussion
    $discussion2 = Discussion::create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Another Discussion',
        'content' => 'Second discussion',
    ]);

    expect($discussion1->slug)->toBe('test-discussion');
    expect($discussion2->slug)->toBe('another-discussion');

    // Update second discussion to have same title as first
    // Should not conflict with itself
    $discussion1->update(['title' => 'Test Discussion']);

    expect($discussion1->fresh()->slug)->toBe('test-discussion');
});
