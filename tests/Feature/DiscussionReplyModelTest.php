<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('DiscussionReply Model Relationships', function () {
    it('belongs to discussion', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        expect($reply->discussion)->toBeInstanceOf(Discussion::class);
        expect($reply->discussion->id)->toBe($discussion->id);
    });

    it('belongs to user', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        expect($reply->user)->toBeInstanceOf(User::class);
        expect($reply->user->id)->toBe($user->id);
    });
});

describe('DiscussionReply Best Answer Logic', function () {
    it('can be marked as best answer', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_resolved' => false,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => false,
        ]);

        $reply->markAsBestAnswer();

        expect($reply->fresh()->is_best_answer)->toBeTrue();
        expect($discussion->fresh()->is_resolved)->toBeTrue();
    });

    it('unmarks other replies as best answer when marking new one', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $firstReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => true,
        ]);

        $secondReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => false,
        ]);

        $secondReply->markAsBestAnswer();

        expect($firstReply->fresh()->is_best_answer)->toBeFalse();
        expect($secondReply->fresh()->is_best_answer)->toBeTrue();
    });

    it('can remove best answer status', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

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

        $reply->removeBestAnswer();

        expect($reply->fresh()->is_best_answer)->toBeFalse();
        expect($discussion->fresh()->is_resolved)->toBeFalse();
    });

    it('keeps discussion resolved if other best answers exist', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_resolved' => true,
        ]);

        $firstReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => true,
        ]);

        $secondReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => true,
        ]);

        $firstReply->removeBestAnswer();

        expect($firstReply->fresh()->is_best_answer)->toBeFalse();
        expect($secondReply->fresh()->is_best_answer)->toBeTrue();
        expect($discussion->fresh()->is_resolved)->toBeTrue(); // Should stay resolved
    });

    it('marks discussion as unresolved when removing last best answer', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

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

        // Create non-best answer reply
        DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'is_best_answer' => false,
        ]);

        $reply->removeBestAnswer();

        expect($reply->fresh()->is_best_answer)->toBeFalse();
        expect($discussion->fresh()->is_resolved)->toBeFalse();
    });

    it('ensures only one best answer per discussion', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $firstReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        $secondReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        $thirdReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        $firstReply->markAsBestAnswer();
        $secondReply->markAsBestAnswer();

        // Only second reply should be best answer
        expect($firstReply->fresh()->is_best_answer)->toBeFalse();
        expect($secondReply->fresh()->is_best_answer)->toBeTrue();
        expect($thirdReply->fresh()->is_best_answer)->toBeFalse();

        // Should only have one best answer
        $bestAnswerCount = $discussion->replies()->where('is_best_answer', true)->count();
        expect($bestAnswerCount)->toBe(1);
    });
});

describe('DiscussionReply Model Attributes', function () {
    it('has correct fillable attributes', function () {
        $reply = new DiscussionReply;

        expect($reply->getFillable())->toBe([
            'discussion_id',
            'user_id',
            'content',
            'is_best_answer',
        ]);
    });

    it('casts attributes correctly', function () {
        $reply = new DiscussionReply;

        expect($reply->getCasts())->toMatchArray([
            'is_best_answer' => 'boolean',
        ]);
    });
});

describe('DiscussionReply Model Factory', function () {
    it('creates valid reply with factory', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        expect($reply->content)->toBeString();
        expect($reply->is_best_answer)->toBeBool();
        expect($reply->discussion_id)->toBe($discussion->id);
        expect($reply->user_id)->toBe($user->id);
        expect($reply->created_at)->toBeInstanceOf(\Carbon\Carbon::class);
    });

    it('creates reply with default best answer false', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'category_id' => $category->id,
        ]);

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);

        expect($reply->is_best_answer)->toBeFalse();
    });
});
