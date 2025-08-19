<?php

use App\Livewire\Discussion\DiscussionShow;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

it('allows users to edit their own replies', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
        'content' => '<p>Original content</p>',
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('startEditingReply', $reply->id)
        ->assertSet('editingReplyId', $reply->id)
        ->assertSet('editReplyContent', '<p>Original content</p>')
        ->set('editReplyContent', '<p>Updated content with <strong>bold text</strong></p>')
        ->call('updateReply')
        ->assertHasNoErrors()
        ->assertSet('editingReplyId', null);

    expect($reply->fresh()->content)->toBe('<p>Updated content with <strong>bold text</strong></p>');
});

it('prevents users from editing other users replies', function () {
    $category = Category::factory()->create();
    $replyAuthor = User::factory()->create();
    $otherUser = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $replyAuthor->id,
    ]);

    actingAs($otherUser);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('startEditingReply', $reply->id)
        ->assertStatus(403);
});

it('allows users to cancel editing', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
        'content' => '<p>Original content</p>',
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('startEditingReply', $reply->id)
        ->assertSet('editingReplyId', $reply->id)
        ->set('editReplyContent', '<p>Changed content</p>')
        ->call('cancelEditingReply')
        ->assertSet('editingReplyId', null)
        ->assertSet('editReplyContent', '');

    expect($reply->fresh()->content)->toBe('<p>Original content</p>');
});

it('allows users to delete their own replies', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('deleteReply', $reply->id)
        ->assertHasNoErrors();

    expect(DiscussionReply::find($reply->id))->toBeNull();
});

it('prevents users from deleting other users replies', function () {
    $category = Category::factory()->create();
    $replyAuthor = User::factory()->create();
    $otherUser = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $replyAuthor->id,
    ]);

    actingAs($otherUser);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('deleteReply', $reply->id)
        ->assertStatus(403);

    expect(DiscussionReply::find($reply->id))->not->toBeNull();
});

it('removes best answer status when deleting a best answer reply', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'is_resolved' => true,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
        'is_best_answer' => true,
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('deleteReply', $reply->id)
        ->assertHasNoErrors();

    expect(DiscussionReply::find($reply->id))->toBeNull();
    expect($discussion->fresh()->is_resolved)->toBeFalse();
});

it('validates minimum content length when editing', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->call('startEditingReply', $reply->id)
        ->set('editReplyContent', 'Short')
        ->call('updateReply')
        ->assertHasErrors(['editReplyContent' => 'min']);
});

it('shows edit and delete buttons only for reply author', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
    ]);

    actingAs($user);

    Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
        ->assertSee('Edit')
        ->assertSee('Delete');
});

it('does not show edit and delete buttons for non-authors', function () {
    $category = Category::factory()->create();
    $replyAuthor = User::factory()->create();
    $otherUser = User::factory()->create();
    $discussion = Discussion::factory()->create([
        'category_id' => $category->id,
        'user_id' => $replyAuthor->id, // Make sure discussion author is the reply author
    ]);
    $reply = DiscussionReply::factory()->create([
        'discussion_id' => $discussion->id,
        'user_id' => $replyAuthor->id,
    ]);

    actingAs($otherUser);

    // Since the other user is neither the discussion author nor the reply author,
    // they shouldn't see edit/delete buttons for the reply
    $response = Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug]);

    // Check that the wire:click for editing this specific reply is not present
    expect($response->html())->not->toContain('wire:click="startEditingReply('.$reply->id.')');
    expect($response->html())->not->toContain('wire:click="deleteReply('.$reply->id.')');
});
