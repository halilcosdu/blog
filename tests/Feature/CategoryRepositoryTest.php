<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Category Repository CRUD Operations', function () {
    it('extends base repository', function () {
        $category = Category::factory()->create();
        $repository = new CategoryRepository($category);

        expect($repository)->toBeInstanceOf(\App\Repositories\BaseRepository::class);
    });

    it('can create category through repository', function () {
        $category = new Category;
        $repository = new CategoryRepository($category);

        $data = [
            'name' => 'Test Category',
            'description' => 'Test description',
            'is_active' => true,
        ];

        $result = $repository->create($data);

        expect($result)->toBeInstanceOf(Category::class);
        expect($result->name)->toBe('Test Category');
        expect($result->is_active)->toBeTrue();
    });
});

describe('Category Repository Active Categories', function () {
    it('gets only active categories', function () {
        $activeCategories = Category::factory(3)->create(['is_active' => true]);
        $inactiveCategories = Category::factory(2)->create(['is_active' => false]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getActive();

        expect($result)->toHaveCount(3);
        $result->each(function ($category) {
            expect($category->is_active)->toBeTrue();
        });
    });

    it('includes post counts for active categories', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);

        Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $categoryModel = new Category;
        $repository = new CategoryRepository($categoryModel);

        $result = $repository->getActive();

        expect($result->first()->posts_count)->toBe(3); // Only published posts
    });

    it('orders active categories by sort order', function () {
        $category1 = Category::factory()->create(['is_active' => true, 'sort_order' => 3]);
        $category2 = Category::factory()->create(['is_active' => true, 'sort_order' => 1]);
        $category3 = Category::factory()->create(['is_active' => true, 'sort_order' => 2]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getActive();

        expect($result->pluck('id')->toArray())->toBe([
            $category2->id, // sort_order 1
            $category3->id, // sort_order 2
            $category1->id, // sort_order 3
        ]);
    });

    it('respects limit parameter for active categories', function () {
        Category::factory(5)->create(['is_active' => true]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getActive(2);

        expect($result)->toHaveCount(2);
    });

    it('returns empty collection when no active categories', function () {
        Category::factory(3)->create(['is_active' => false]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getActive();

        expect($result)->toHaveCount(0);
    });
});

describe('Category Repository Slug Lookup', function () {
    it('finds category by slug', function () {
        $category = Category::factory()->create(['slug' => 'test-category']);
        $otherCategory = Category::factory()->create(['slug' => 'other-category']);

        $categoryModel = new Category;
        $repository = new CategoryRepository($categoryModel);

        $result = $repository->findBySlug('test-category');

        expect($result)->toBeInstanceOf(Category::class);
        expect($result->id)->toBe($category->id);
        expect($result->slug)->toBe('test-category');
    });

    it('returns null when category slug not found', function () {
        Category::factory()->create(['slug' => 'existing-category']);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->findBySlug('non-existent-category');

        expect($result)->toBeNull();
    });

    it('finds category by slug case sensitively', function () {
        $category = Category::factory()->create(['slug' => 'test-category']);

        $categoryModel = new Category;
        $repository = new CategoryRepository($categoryModel);

        $result = $repository->findBySlug('TEST-CATEGORY');

        expect($result)->toBeNull(); // Should be case sensitive
    });
});

describe('Category Repository Categories With Posts', function () {
    it('gets categories that have published posts', function () {
        $user = User::factory()->create();

        $categoryWithPosts = Category::factory()->create(['is_active' => true]);
        $categoryWithoutPosts = Category::factory()->create(['is_active' => true]);
        $categoryWithUnpublishedPosts = Category::factory()->create(['is_active' => true]);

        // Category with published posts
        Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $categoryWithPosts->id,
            'is_published' => true,
        ]);

        // Category with only unpublished posts
        Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $categoryWithUnpublishedPosts->id,
            'is_published' => false,
        ]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getWithPosts();

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($categoryWithPosts->id);
    });

    it('includes post counts for categories with posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);

        Post::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $categoryModel = new Category;
        $repository = new CategoryRepository($categoryModel);

        $result = $repository->getWithPosts();

        expect($result->first()->posts_count)->toBe(5); // Only published posts
    });

    it('only includes active categories with posts', function () {
        $user = User::factory()->create();

        $activeCategory = Category::factory()->create(['is_active' => true]);
        $inactiveCategory = Category::factory()->create(['is_active' => false]);

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $activeCategory->id,
            'is_published' => true,
        ]);

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $inactiveCategory->id,
            'is_published' => true,
        ]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getWithPosts();

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($activeCategory->id);
    });

    it('orders categories with posts by sort order', function () {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['is_active' => true, 'sort_order' => 3]);
        $category2 = Category::factory()->create(['is_active' => true, 'sort_order' => 1]);

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'is_published' => true,
        ]);

        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'is_published' => true,
        ]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getWithPosts();

        expect($result->first()->id)->toBe($category2->id); // Lower sort order first
        expect($result->last()->id)->toBe($category1->id);
    });
});

describe('Category Repository Popular Categories', function () {
    it('gets popular categories by post count', function () {
        $user = User::factory()->create();

        $popularCategory = Category::factory()->create(['is_active' => true]);
        $lessPopularCategory = Category::factory()->create(['is_active' => true]);
        $unpopularCategory = Category::factory()->create(['is_active' => true]);

        // Popular category with 5 posts
        Post::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $popularCategory->id,
            'is_published' => true,
        ]);

        // Less popular with 2 posts
        Post::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => $lessPopularCategory->id,
            'is_published' => true,
        ]);

        // Unpopular with 0 posts (will be included but with 0 count)

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getPopular(3);

        expect($result)->toHaveCount(3);
        expect($result->first()->id)->toBe($popularCategory->id);
        expect($result->first()->posts_count)->toBe(5);
        expect($result->get(1)->id)->toBe($lessPopularCategory->id);
        expect($result->get(1)->posts_count)->toBe(2);
        expect($result->last()->id)->toBe($unpopularCategory->id);
        expect($result->last()->posts_count)->toBe(0);
    });

    it('respects limit parameter for popular categories', function () {
        $user = User::factory()->create();

        $categories = Category::factory(5)->create(['is_active' => true]);

        foreach ($categories as $index => $category) {
            Post::factory($index + 1)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'is_published' => true,
            ]);
        }

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getPopular(2);

        expect($result)->toHaveCount(2);
    });

    it('only includes active categories in popular list', function () {
        $user = User::factory()->create();

        $activeCategory = Category::factory()->create(['is_active' => true]);
        $inactiveCategory = Category::factory()->create(['is_active' => false]);

        Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $inactiveCategory->id,
            'is_published' => true,
        ]);

        Post::factory(1)->create([
            'user_id' => $user->id,
            'category_id' => $activeCategory->id,
            'is_published' => true,
        ]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getPopular(5);

        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($activeCategory->id);
    });

    it('orders popular categories by post count descending', function () {
        $user = User::factory()->create();

        $category1 = Category::factory()->create(['is_active' => true]);
        $category2 = Category::factory()->create(['is_active' => true]);
        $category3 = Category::factory()->create(['is_active' => true]);

        Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category1->id,
            'is_published' => true,
        ]);

        Post::factory(7)->create([
            'user_id' => $user->id,
            'category_id' => $category2->id,
            'is_published' => true,
        ]);

        Post::factory(1)->create([
            'user_id' => $user->id,
            'category_id' => $category3->id,
            'is_published' => true,
        ]);

        $category = new Category;
        $repository = new CategoryRepository($category);

        $result = $repository->getPopular(3);

        expect($result->get(0)->id)->toBe($category2->id); // 7 posts
        expect($result->get(1)->id)->toBe($category1->id); // 3 posts
        expect($result->get(2)->id)->toBe($category3->id); // 1 post
    });

    it('counts only published posts for popularity', function () {
        $user = User::factory()->create();

        $category = Category::factory()->create(['is_active' => true]);

        Post::factory(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);

        $categoryModel = new Category;
        $repository = new CategoryRepository($categoryModel);

        $result = $repository->getPopular(1);

        expect($result->first()->posts_count)->toBe(3); // Only published posts
    });
});
