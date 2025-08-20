<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Post Model Relationships', function () {
    it('belongs to user', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($post->user)->toBeInstanceOf(User::class);
        expect($post->user->id)->toBe($user->id);
    });

    it('belongs to category', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($post->category)->toBeInstanceOf(Category::class);
        expect($post->category->id)->toBe($category->id);
    });

    it('has polymorphic relationship with tags', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        // Test morphToMany relationship
        expect($post->tags())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class);

        // Test tag attachment
        $post->attachTag('laravel');
        $post->attachTag('php');

        expect($post->tags)->toHaveCount(2);
        expect($post->hasTag('laravel'))->toBeTrue();
        expect($post->hasTag('php'))->toBeTrue();
    });
});

describe('Post Model SEO Features', function () {
    it('generates slug from title on creation', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->make([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'How to Build Amazing Laravel Apps',
            'slug' => null,
        ]);

        $post->save(); // This will trigger the creating event

        expect($post->slug)->toBe('how-to-build-amazing-laravel-apps');
    });

    it('uses provided slug if given', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Laravel Tutorial',
            'slug' => 'custom-laravel-tutorial',
        ]);

        expect($post->slug)->toBe('custom-laravel-tutorial');
    });

    it('calculates read time based on content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $content = str_repeat('word ', 400); // 400 words

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $content,
        ]);

        // 400 words / 200 words per minute = 2 minutes
        expect($post->read_time)->toBe(2);
    });

    it('calculates minimum 1 minute read time', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $content = 'Short content'; // Very short content

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $content,
        ]);

        expect($post->read_time)->toBe(1);
    });

    it('formats reading time correctly', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $shortPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'read_time' => 1,
        ]);

        $longPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'read_time' => 5,
        ]);

        expect($shortPost->reading_time)->toBe('1 min');
        expect($longPost->reading_time)->toBe('5 mins');
    });

    it('has meta fields for SEO', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'meta_title' => 'SEO Title for Post',
            'meta_description' => 'This is a meta description for SEO purposes.',
        ]);

        expect($post->meta_title)->toBe('SEO Title for Post');
        expect($post->meta_description)->toBe('This is a meta description for SEO purposes.');
    });

    it('uses slug as route key', function () {
        $post = new Post;

        expect($post->getRouteKeyName())->toBe('slug');
    });
});

describe('Post Model Business Logic', function () {
    it('sets published_at when is_published is true on creation', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => null,
        ]);

        expect($post->published_at)->not->toBeNull();
        expect($post->published_at)->toBeInstanceOf(Carbon::class);
    });

    it('does not set published_at when is_published is false', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
            'published_at' => null,
        ]);

        expect($post->published_at)->toBeNull();
    });

    it('sets published_at when changing from unpublished to published', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $post->update(['is_published' => true]);

        expect($post->fresh()->published_at)->not->toBeNull();
    });

    it('recalculates read time when content changes', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => str_repeat('word ', 200), // 200 words = 1 minute
        ]);

        expect($post->read_time)->toBe(1);

        $post->update(['content' => str_repeat('word ', 600)]); // 600 words = 3 minutes

        expect($post->fresh()->read_time)->toBe(3);
    });

    it('formats published date correctly', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'published_at' => now()->subDays(2),
        ]);

        expect($post->formatted_published_date)->toContain('days ago');
    });

    it('returns empty string for formatted date when not published', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->make([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
            'published_at' => null,
        ]);
        $post->save();

        // Manually set published_at to null after creation to test the attribute
        $post->update(['published_at' => null]);

        expect($post->fresh()->formatted_published_date)->toBe('');
    });
});

describe('Post Model Scopes', function () {
    it('filters published posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $publishedPosts = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $unpublishedPosts = Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $results = Post::published()->get();

        expect($results)->toHaveCount(3);
        $results->each(function ($post) {
            expect($post->is_published)->toBeTrue();
        });
    });

    it('filters featured posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $featuredPosts = Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_featured' => true,
        ]);

        $regularPosts = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_featured' => false,
        ]);

        $results = Post::featured()->get();

        expect($results)->toHaveCount(2);
        $results->each(function ($post) {
            expect($post->is_featured)->toBeTrue();
        });
    });

    it('orders posts by published date descending with recent scope', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $posts = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'published_at' => fn () => fake()->dateTimeBetween('-1 month', 'now'),
        ]);

        $results = Post::recent()->get();

        expect($results)->toHaveCount(3);

        // Verify they're ordered by published_at desc
        $publishedDates = $results->pluck('published_at')->toArray();
        $sortedDates = collect($publishedDates)->sortDesc()->values()->toArray();
        expect($publishedDates)->toBe($sortedDates);
    });
});

describe('Post Model Attributes', function () {
    it('has correct fillable attributes', function () {
        $post = new Post;

        expect($post->getFillable())->toBe([
            'title',
            'slug',
            'excerpt',
            'content',
            'featured_image',
            'meta_title',
            'meta_description',
            'user_id',
            'category_id',
            'is_published',
            'is_featured',
            'published_at',
            'views_count',
            'read_time',
        ]);
    });

    it('casts attributes correctly', function () {
        $post = new Post;

        expect($post->getCasts())->toMatchArray([
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ]);
    });

    it('handles tags through polymorphic relationship', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        // Attach tags using the polymorphic relationship
        $post->syncTags(['laravel', 'php', 'tutorial']);

        expect($post->tags)->toHaveCount(3);
        expect($post->getTagNames())->toBe(['laravel', 'php', 'tutorial']);
        expect($post->hasTag('laravel'))->toBeTrue();
        expect($post->hasTag('nonexistent'))->toBeFalse();
    });
});

describe('Post Model Factory', function () {
    it('creates valid post with factory', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        expect($post->title)->toBeString();
        expect($post->slug)->toBeString();
        expect($post->excerpt)->toBeString();
        expect($post->content)->toBeString();
        expect($post->is_published)->toBeBool();
        expect($post->is_featured)->toBeBool();
        expect($post->views_count)->toBeInt();
        expect($post->read_time)->toBeInt();
        expect($post->user_id)->toBe($user->id);
        expect($post->category_id)->toBe($category->id);
    });
});
