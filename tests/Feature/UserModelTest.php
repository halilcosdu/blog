<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User Model Relationships', function () {
    it('has many posts relationship', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $posts = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($user->posts)->toHaveCount(3);
        expect($user->posts->first())->toBeInstanceOf(Post::class);
        expect($user->posts->first()->user_id)->toBe($user->id);
    });

    it('has many discussions relationship', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussions = Discussion::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($user->discussions)->toHaveCount(2);
        expect($user->discussions->first())->toBeInstanceOf(Discussion::class);
        expect($user->discussions->first()->user_id)->toBe($user->id);
    });

    it('has many discussion replies relationship', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'category_id' => $category->id,
        ]);

        $replies = DiscussionReply::factory(3)->create([
            'user_id' => $user->id,
            'discussion_id' => $discussion->id,
        ]);

        expect($user->discussionReplies)->toHaveCount(3);
        expect($user->discussionReplies->first())->toBeInstanceOf(DiscussionReply::class);
        expect($user->discussionReplies->first()->user_id)->toBe($user->id);
    });

    it('can access filament panel by default', function () {
        $user = User::factory()->create();
        $panel = mock(\Filament\Panel::class);

        expect($user->canAccessPanel($panel))->toBeTrue();
    });

    it('has correct fillable attributes', function () {
        $user = new User;

        expect($user->getFillable())->toBe([
            'name',
            'username',
            'email',
            'password',
        ]);
    });

    it('has correct hidden attributes', function () {
        $user = new User;

        expect($user->getHidden())->toBe([
            'password',
            'remember_token',
        ]);
    });

    it('has correct cast attributes', function () {
        $user = new User;

        expect($user->getCasts())->toMatchArray([
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ]);
    });

    it('implements filament user interface', function () {
        $user = new User;

        expect($user)->toBeInstanceOf(\Filament\Models\Contracts\FilamentUser::class);
    });
});

describe('User Model Factory', function () {
    it('creates valid user with factory', function () {
        $user = User::factory()->create();

        expect($user->name)->toBeString();
        expect($user->username)->toBeString();
        expect($user->email)->toBeString();
        expect($user->password)->toBeString();
        expect($user->created_at)->toBeInstanceOf(\Carbon\Carbon::class);
    });

    it('creates user with custom attributes', function () {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
        ]);

        expect($user->name)->toBe('John Doe');
        expect($user->username)->toBe('johndoe');
        expect($user->email)->toBe('john@example.com');
    });

    it('creates multiple users with unique usernames', function () {
        $users = User::factory(3)->create();

        expect($users)->toHaveCount(3);

        $usernames = $users->pluck('username')->toArray();
        expect($usernames)->toBe(array_unique($usernames)); // All usernames should be unique
    });
});
