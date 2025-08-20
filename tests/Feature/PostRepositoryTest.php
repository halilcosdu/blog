<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Post Repository CRUD Operations', function () {
    it('extends base repository', function () {
        $post = Post::factory()->create();
        $repository = new PostRepository($post);

        expect($repository)->toBeInstanceOf(\App\Repositories\BaseRepository::class);
    });

    it('can create post through repository', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $post = new Post;
        $repository = new PostRepository($post);

        $data = [
            'title' => 'Test Post',
            'content' => 'Test content',
            'excerpt' => 'Test excerpt',
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ];

        $result = $repository->create($data);

        expect($result)->toBeInstanceOf(Post::class);
        expect($result->title)->toBe('Test Post');
        expect($result->is_published)->toBeTrue();
    });
});

describe('Post Repository Published Posts', function () {
    it('gets only published posts', function () {
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

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getPublished();

        expect($result)->toHaveCount(3);
        $result->each(function ($post) {
            expect($post->is_published)->toBeTrue();
        });
    });

    it('returns empty collection when no published posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getPublished();

        expect($result)->toHaveCount(0);
    });
});

describe('Post Repository Featured Posts', function () {
    it('gets featured post with relationships', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $featuredPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'is_featured' => true,
            'published_at' => now()->subDay(),
        ]);

        $regularPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'is_featured' => false,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getFeatured();

        expect($result)->toBeInstanceOf(Post::class);
        expect($result->id)->toBe($featuredPost->id);
        expect($result->is_featured)->toBeTrue();
        expect($result->user)->toBeInstanceOf(User::class);
        expect($result->category)->toBeInstanceOf(Category::class);
    });

    it('returns most recent featured post when multiple exist', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $olderFeatured = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'is_featured' => true,
            'published_at' => now()->subDays(2),
        ]);

        $newerFeatured = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'is_featured' => true,
            'published_at' => now()->subDay(),
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getFeatured();

        expect($result->id)->toBe($newerFeatured->id);
    });

    it('returns null when no featured posts exist', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'is_featured' => false,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getFeatured();

        expect($result)->toBeNull();
    });
});

describe('Post Repository Latest Posts', function () {
    it('gets latest posts with default limit', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'published_at' => fn () => fake()->dateTimeBetween('-1 month', 'now'),
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getLatest();

        expect($result)->toHaveCount(6); // Default limit

        // Verify they're ordered by published_at desc
        $publishedDates = $result->pluck('published_at')->toArray();
        $sortedDates = collect($publishedDates)->sortDesc()->values()->toArray();
        expect($publishedDates)->toBe($sortedDates);
    });

    it('respects custom limit parameter', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getLatest(3);

        expect($result)->toHaveCount(3);
    });

    it('includes user and category relationships', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getLatest(1);

        expect($result->first()->user)->toBeInstanceOf(User::class);
        expect($result->first()->category)->toBeInstanceOf(Category::class);
    });
});

describe('Post Repository Popular Posts', function () {
    it('gets top posts by views count', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $lowViews = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 100,
            'featured_image' => 'image.jpg',
        ]);

        $highViews = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 1000,
            'featured_image' => 'image.jpg',
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getTopByViews(2);

        expect($result)->toHaveCount(2);
        expect($result->first()->id)->toBe($highViews->id);
        expect($result->first()->views_count)->toBeGreaterThan($result->last()->views_count);
    });

    it('only includes posts with featured images for top posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $withImage = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 1000,
            'featured_image' => 'image.jpg',
        ]);

        $withoutImage = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 2000,
            'featured_image' => null,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getTopByViews(5);

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($withImage->id);
    });

    it('gets popular posts without featured image requirement', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $highViews = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 1000,
        ]);

        $lowViews = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'views_count' => 100,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getPopular(2);

        expect($result)->toHaveCount(2);
        expect($result->first()->id)->toBe($highViews->id);
    });
});

describe('Post Repository Category Filtering', function () {
    it('gets posts by category', function () {
        $user = User::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $postsCategory1 = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'is_published' => true,
        ]);

        $postsCategory2 = Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getByCategory($category1->id);

        expect($result)->toHaveCount(3);
        $result->each(function ($post) use ($category1) {
            expect($post->category_id)->toBe($category1->id);
        });
    });

    it('respects limit parameter for category posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getByCategory($category->id, 2);

        expect($result)->toHaveCount(2);
    });

    it('returns empty collection for category with no posts', function () {
        $category = Category::factory()->create();
        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getByCategory($category->id);

        expect($result)->toHaveCount(0);
    });
});

describe('Post Repository Search', function () {
    it('searches posts by title', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $matchingPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Laravel Tutorial',
            'is_published' => true,
        ]);

        $nonMatchingPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Vue.js Guide',
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->search('Laravel');

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($matchingPost->id);
    });

    it('searches posts by content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $matchingPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Random Title',
            'content' => 'This post contains Laravel framework information',
            'is_published' => true,
        ]);

        $nonMatchingPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Another Title',
            'content' => 'This post is about Vue.js',
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->search('Laravel');

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($matchingPost->id);
    });

    it('searches posts by excerpt', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $matchingPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Random Title',
            'content' => 'Random content',
            'excerpt' => 'Learn about Laravel framework basics',
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->search('Laravel');

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($matchingPost->id);
    });

    it('respects limit parameter in search', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Post::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Laravel Tutorial Part',
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->search('Laravel', 2);

        expect($result)->toHaveCount(2);
    });
});

describe('Post Repository Tags Analysis', function () {
    it('gets recent posts with tags', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $postsWithTags = Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        // Attach tags using polymorphic relationship
        $postsWithTags->each(function ($post) {
            $post->syncTags(['laravel', 'php']);
        });

        $postsWithoutTags = Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $postsWithEmptyTags = Post::factory(1)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getRecentWithTags(10);

        expect($result)->toHaveCount(3);
        $result->each(function ($post) {
            expect($post->tags)->not->toBeNull();
            expect($post->tags)->not->toBeEmpty();
        });
    });

    it('respects limit for recent posts with tags', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $posts = Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        // Attach tags using polymorphic relationship
        $posts->each(function ($post) {
            $post->syncTags(['laravel', 'php']);
        });

        $post = new Post;
        $repository = new PostRepository($post);

        $result = $repository->getRecentWithTags(5);

        expect($result)->toHaveCount(5);
    });

    it('returns only specific columns for performance', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        // Attach tags using polymorphic relationship
        $post->syncTags(['laravel', 'php']);

        $postModel = new Post;
        $repository = new PostRepository($postModel);

        $result = $repository->getRecentWithTags(1);

        expect($result->first()->tags)->not->toBeNull();
        // These should be included because they are in the select
        expect($result->first()->title)->toBe('Test Title');
        expect($result->first()->slug)->not->toBeNull();
        expect($result->first()->published_at)->not->toBeNull();
        // Content should be null because it's not selected
        expect($result->first()->content)->toBeNull();
    });
});
