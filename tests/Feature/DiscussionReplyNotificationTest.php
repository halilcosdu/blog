<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Livewire\Livewire;

it('shows notification and clears editor after successful reply submission', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $this->actingAs($user);

    $component = Livewire::test('discussion.discussion-show', [
        'slug' => $discussion->slug,
    ]);

    // Set some content in the reply form
    $component->set('replyContent', 'This is a test reply with some content.');

    // Submit the reply
    $component->call('addReply')
        ->assertHasNoErrors()
        ->assertDispatched('show-notification')
        ->assertDispatched('clear-editor-content');

    // Verify reply was created
    expect($discussion->fresh()->replies)->toHaveCount(1);
    expect($discussion->fresh()->replies->first()->content)
        ->toBe('This is a test reply with some content.');

    // Verify form was reset
    $component->assertSet('replyContent', '');
});

it('shows notification when reply is updated', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $reply = $discussion->replies()->create([
        'user_id' => $user->id,
        'content' => 'Original reply content',
    ]);

    $this->actingAs($user);

    $component = Livewire::test('discussion.discussion-show', [
        'slug' => $discussion->slug,
    ]);

    // Start editing the reply
    $component->call('startEditingReply', $reply->id);

    // Update the reply content
    $component->set('editReplyContent', 'Updated reply content')
        ->call('updateReply')
        ->assertHasNoErrors()
        ->assertDispatched('show-notification');

    // Verify reply was updated
    expect($reply->fresh()->content)->toBe('Updated reply content');
});

it('shows notification when reply is deleted', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $reply = $discussion->replies()->create([
        'user_id' => $user->id,
        'content' => 'Reply to be deleted',
    ]);

    $this->actingAs($user);

    $component = Livewire::test('discussion.discussion-show', [
        'slug' => $discussion->slug,
    ]);

    // Delete the reply
    $component->call('deleteReply', $reply->id)
        ->assertHasNoErrors()
        ->assertDispatched('show-notification');

    // Verify reply was deleted
    expect($discussion->fresh()->replies)->toHaveCount(0);
});
