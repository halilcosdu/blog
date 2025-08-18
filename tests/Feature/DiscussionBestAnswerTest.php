<?php

use App\Livewire\Discussion\DiscussionShow;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('allows discussion author to mark a reply as best answer', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => false,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);

    actingAs($author);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('markAsBestAnswer', $reply->id)
        ->assertHasNoErrors();

    expect($reply->fresh()->is_best_answer)->toBeTrue();
    expect($discussion->fresh()->is_resolved)->toBeTrue();
});

it('prevents non-author from marking best answer', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $otherUser = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => false,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);

    actingAs($otherUser);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('markAsBestAnswer', $reply->id)
        ->assertStatus(403);

    expect($reply->fresh()->is_best_answer)->toBeFalse();
    expect($discussion->fresh()->is_resolved)->toBeFalse();
});

it('allows discussion author to remove best answer', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => true,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'is_best_answer' => true,
    ]);

    actingAs($author);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('removeBestAnswer', $reply->id)
        ->assertHasNoErrors();

    expect($reply->fresh()->is_best_answer)->toBeFalse();
    expect($discussion->fresh()->is_resolved)->toBeFalse();
});

it('only allows one best answer per discussion', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => false,
    ]);
    $reply1 = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);
    $reply2 = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);

    actingAs($author);

    // Mark first reply as best answer
    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('markAsBestAnswer', $reply1->id)
        ->assertHasNoErrors();

    expect($reply1->fresh()->is_best_answer)->toBeTrue();

    // Mark second reply as best answer - should remove first
    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('markAsBestAnswer', $reply2->id)
        ->assertHasNoErrors();

    expect($reply1->fresh()->is_best_answer)->toBeFalse();
    expect($reply2->fresh()->is_best_answer)->toBeTrue();
});

it('displays best answer badge in the UI', function () {
    $category = \App\Models\Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'is_best_answer' => true,
    ]);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->assertSee('Best Answer');
});

it('shows mark as best answer button only to discussion author', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => false,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);

    actingAs($author);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->assertSee('Mark as Best Answer');
});

it('does not show mark as best answer button to non-authors', function () {
    $category = \App\Models\Category::factory()->create();
    $author = User::factory()->create();
    $otherUser = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
        'is_resolved' => false,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
    ]);

    actingAs($otherUser);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->assertDontSee('Mark as Best Answer');
});

