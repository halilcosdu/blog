<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Discussion Model Relationships', function () {
    it('belongs to user', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($discussion->user)->toBeInstanceOf(User::class);
        expect($discussion->user->id)->toBe($user->id);
    });

    it('belongs to category', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($discussion->category)->toBeInstanceOf(Category::class);
        expect($discussion->category->id)->toBe($category->id);
    });

    it('has many replies ordered by creation date desc', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        // Create replies with different timestamps
        $firstReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'created_at' => now()->subHours(2),
        ]);

        $secondReply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'created_at' => now()->subHour(),
        ]);

        $replies = $discussion->replies;

        expect($replies)->toHaveCount(2);
        expect($replies->first()->id)->toBe($secondReply->id); // Most recent first
        expect($replies->last()->id)->toBe($firstReply->id);
    });
});

describe('Discussion Model Business Logic', function () {
    it('generates unique slug on creation', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Test Discussion Title',
            'slug' => null, // Let it be generated
        ]);

        expect($discussion->slug)->toBe('test-discussion-title');
    });

    it('generates unique slug when title has duplicate', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Create first discussion
        $firstDiscussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Duplicate Title',
            'slug' => null,
        ]);

        // Create second discussion with same title
        $secondDiscussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Duplicate Title',
            'slug' => null,
        ]);

        expect($firstDiscussion->slug)->toBe('duplicate-title');
        expect($secondDiscussion->slug)->toBe('duplicate-title-1');
    });

    it('updates slug when title changes', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Original Title',
            'slug' => null,
        ]);

        expect($discussion->slug)->toBe('original-title');

        $discussion->update(['title' => 'Updated Title', 'slug' => null]);

        expect($discussion->fresh()->slug)->toBe('updated-title');
    });

    it('excludes current record when updating slug', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Test Title',
            'slug' => null,
        ]);

        // Update to same title should not change slug
        $discussion->update(['title' => 'Test Title']);

        expect($discussion->fresh()->slug)->toBe('test-title');
    });

    it('increments view count', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'views_count' => 5,
        ]);

        $discussion->incrementViewCount();

        expect($discussion->fresh()->views_count)->toBe(6);
    });

    it('can be marked as resolved', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_resolved' => false,
        ]);

        $discussion->markAsResolved();

        expect($discussion->fresh()->is_resolved)->toBeTrue();
    });

    it('can be marked as unresolved', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_resolved' => true,
        ]);

        $discussion->markAsUnresolved();

        expect($discussion->fresh()->is_resolved)->toBeFalse();
    });
});

describe('Discussion Model Attributes', function () {
    it('has correct fillable attributes', function () {
        $discussion = new Discussion;

        expect($discussion->getFillable())->toBe([
            'user_id',
            'category_id',
            'title',
            'slug',
            'content',
            'is_resolved',
            'views_count',
        ]);
    });

    it('casts attributes correctly', function () {
        $discussion = new Discussion;

        expect($discussion->getCasts())->toMatchArray([
            'is_resolved' => 'boolean',
            'views_count' => 'integer',
        ]);
    });
});

describe('Discussion Model Factory', function () {
    it('creates valid discussion with factory', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($discussion->title)->toBeString();
        expect($discussion->slug)->toBeString();
        expect($discussion->content)->toBeString();
        expect($discussion->is_resolved)->toBeBool();
        expect($discussion->views_count)->toBeInt();
        expect($discussion->user_id)->toBe($user->id);
        expect($discussion->category_id)->toBe($category->id);
    });

    it('generates different slugs for different discussions', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussions = Discussion::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $slugs = $discussions->pluck('slug')->toArray();
        expect($slugs)->toBe(array_unique($slugs)); // All slugs should be unique
    });
});
