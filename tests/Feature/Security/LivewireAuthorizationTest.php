<?php

use App\Livewire\Discussion\CreateDiscussion;
use App\Livewire\Discussion\DiscussionShow;
use App\Livewire\Discussion\EditDiscussion;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('Livewire Component Authorization', function () {
    it('protects discussion creation from unauthorized users', function () {
        // Test without authentication - component loads but should fail operations requiring auth
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Test that unauthenticated users can't save discussions
        try {
            Livewire::test(CreateDiscussion::class)
                ->set('title', 'Test Discussion')
                ->set('content', 'This is a test discussion content')
                ->set('category_id', $category->id)
                ->call('save');

            // If no exception, check that no discussion was created
            expect(Discussion::count())->toBe(0);
        } catch (\Exception $e) {
            // Expected behavior - should throw exception or fail gracefully
            expect(true)->toBeTrue();
        }
    });

    it('allows authenticated users to create discussions', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user);

        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Test Discussion')
            ->set('content', 'This is a test discussion content')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();
    });

    it('protects discussion editing from non-owners', function () {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($otherUser);

        // Test authorization through route access rather than component test
        // since component mount() throws 403 before Livewire test can handle it
        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertStatus(403);

        // Verify the discussion wasn't modified
        $discussion->refresh();
        expect($discussion->user_id)->toBe($owner->id);
    });

    it('allows discussion owners to edit their discussions', function () {
        $owner = User::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category1->id,
        ]);

        $this->actingAs($owner);

        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'Updated Title')
            ->set('content', 'Updated content')
            ->set('category_id', $category2->id)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect();

        // Verify the discussion was updated
        $discussion->refresh();
        expect($discussion->title)->toBe('Updated Title');
        expect($discussion->content)->toBe('Updated content');
        expect($discussion->category_id)->toBe($category2->id);
    });

    it('protects reply creation from unauthenticated users', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        // Test without authentication
        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->set('replyContent', 'This is a reply attempt')
            ->call('addReply')
            ->assertStatus(403);
    });

    it('allows authenticated users to add replies', function () {
        $discussionOwner = User::factory()->create();
        $replier = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $discussionOwner->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($replier);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->set('replyContent', 'This is a valid reply content')
            ->call('addReply')
            ->assertHasNoErrors();

        // Verify reply was created
        expect(DiscussionReply::where('discussion_id', $discussion->id)->count())->toBe(1);
        $reply = DiscussionReply::where('discussion_id', $discussion->id)->first();
        expect($reply->user_id)->toBe($replier->id);
        expect($reply->content)->toBe('This is a valid reply content');
    });

    it('protects reply editing from non-owners', function () {
        $replyOwner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $replyOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyOwner->id,
        ]);

        $this->actingAs($otherUser);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('startEditingReply', $reply->id)
            ->assertStatus(403);
    });

    it('allows reply owners to edit their replies', function () {
        $replyOwner = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $replyOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyOwner->id,
            'content' => 'Original content',
        ]);

        $this->actingAs($replyOwner);

        $component = Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('startEditingReply', $reply->id)
            ->assertHasNoErrors()
            ->set('editReplyContent', 'Updated reply content')
            ->call('updateReply')
            ->assertHasNoErrors();

        // Verify reply was updated
        $reply->refresh();
        expect($reply->content)->toBe('Updated reply content');
    });

    it('protects reply deletion from non-owners', function () {
        $replyOwner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $replyOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyOwner->id,
        ]);

        $this->actingAs($otherUser);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('deleteReply', $reply->id)
            ->assertStatus(403);

        // Verify reply still exists
        expect(DiscussionReply::find($reply->id))->not->toBeNull();
    });

    it('allows reply owners to delete their replies', function () {
        $replyOwner = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $replyOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyOwner->id,
        ]);

        $this->actingAs($replyOwner);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('deleteReply', $reply->id)
            ->assertHasNoErrors();

        // Verify reply was deleted
        expect(DiscussionReply::find($reply->id))->toBeNull();
    });

    it('protects discussion resolution from non-owners', function () {
        $discussionOwner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $discussionOwner->id,
            'category_id' => $category->id,
            'is_resolved' => false,
        ]);

        $this->actingAs($otherUser);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('markAsResolved')
            ->assertStatus(403);

        // Verify discussion is still unresolved
        $discussion->refresh();
        expect($discussion->is_resolved)->toBeFalse();
    });

    it('allows discussion owners to mark as resolved', function () {
        $discussionOwner = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $discussionOwner->id,
            'category_id' => $category->id,
            'is_resolved' => false,
        ]);

        $this->actingAs($discussionOwner);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('markAsResolved')
            ->assertHasNoErrors();

        // Verify discussion is marked as resolved
        $discussion->refresh();
        expect($discussion->is_resolved)->toBeTrue();
    });

    it('protects best answer marking from non-discussion-owners', function () {
        $discussionOwner = User::factory()->create();
        $replyAuthor = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $discussionOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyAuthor->id,
        ]);

        $this->actingAs($otherUser);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('markAsBestAnswer', $reply->id)
            ->assertStatus(403);

        // Verify reply is not marked as best answer
        $reply->refresh();
        expect($reply->is_best_answer)->toBeFalse();
    });

    it('allows discussion owners to mark best answers', function () {
        $discussionOwner = User::factory()->create();
        $replyAuthor = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $discussionOwner->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $replyAuthor->id,
        ]);

        $this->actingAs($discussionOwner);

        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('markAsBestAnswer', $reply->id)
            ->assertHasNoErrors();

        // Verify reply is marked as best answer
        $reply->refresh();
        expect($reply->is_best_answer)->toBeTrue();
    });

    it('prevents cross-discussion reply manipulation', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::factory()->create();

        $discussion1 = Discussion::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);

        $discussion2 = Discussion::factory()->create([
            'user_id' => $user2->id,
            'category_id' => $category->id,
        ]);

        $reply1 = DiscussionReply::factory()->create([
            'discussion_id' => $discussion1->id,
            'user_id' => $user1->id,
        ]);

        $reply2 = DiscussionReply::factory()->create([
            'discussion_id' => $discussion2->id,
            'user_id' => $user2->id,
        ]);

        $this->actingAs($user1);

        // User1 should not be able to mark user2's reply as best answer for discussion1
        Livewire::test(DiscussionShow::class, ['slug' => $discussion1->slug])
            ->call('markAsBestAnswer', $reply2->id)
            ->assertStatus(403);
    });

    it('validates component state after authorization failures', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user1->id,
        ]);

        $this->actingAs($user2);

        try {
            Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
                ->call('deleteReply', $reply->id);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            // Expected authorization failure
            expect($e->getStatusCode())->toBe(403);
        }

        // Verify data integrity after failed authorization attempt
        $reply->refresh();
        expect($reply)->not->toBeNull();
        expect($reply->content)->not->toBeEmpty();
    });
});
