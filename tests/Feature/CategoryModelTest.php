<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Category Model Relationships', function () {
    it('has many posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $posts = Post::factory(3)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        expect($category->posts)->toHaveCount(3);
        expect($category->posts->first())->toBeInstanceOf(Post::class);
        expect($category->posts->first()->category_id)->toBe($category->id);
    });

    it('has many discussions', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussions = Discussion::factory(2)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);

        expect($category->discussions)->toHaveCount(2);
        expect($category->discussions->first())->toBeInstanceOf(Discussion::class);
        expect($category->discussions->first()->category_id)->toBe($category->id);
    });

    it('has published posts scope', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Create published posts
        $publishedPosts = Post::factory(3)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
            'is_published' => true,
        ]);

        // Create unpublished posts
        $unpublishedPosts = Post::factory(2)->create([
            'category_id' => $category->id,
            'user_id' => $user->id,
            'is_published' => false,
        ]);

        expect($category->publishedPosts)->toHaveCount(3);
        expect($category->posts)->toHaveCount(5); // All posts

        // Verify all returned posts are published
        $category->publishedPosts->each(function ($post) {
            expect($post->is_published)->toBeTrue();
        });
    });
});

describe('Category Model Business Logic', function () {
    it('generates slug from name on creation', function () {
        $category = Category::factory()->create([
            'name' => 'Test Category Name',
            'slug' => null, // Don't set slug, let it be generated
        ]);

        expect($category->slug)->toBe('test-category-name');
    });

    it('uses provided slug if given', function () {
        $category = Category::factory()->create([
            'name' => 'Test Category Name',
            'slug' => 'custom-slug',
        ]);

        expect($category->slug)->toBe('custom-slug');
    });

    it('generates new slug when name changes and slug is empty', function () {
        $category = Category::factory()->create([
            'name' => 'Original Name',
            'slug' => 'original-name',
        ]);

        // Clear slug and update name
        $category->update([
            'name' => 'Updated Name',
            'slug' => null,
        ]);

        expect($category->fresh()->slug)->toBe('updated-name');
    });

    it('keeps existing slug when name changes and slug is not empty', function () {
        $category = Category::factory()->create([
            'name' => 'Original Name',
            'slug' => 'custom-slug',
        ]);

        $category->update(['name' => 'Updated Name']);

        expect($category->fresh()->slug)->toBe('custom-slug');
    });

    it('handles special characters in name for slug generation', function () {
        $category = Category::factory()->create([
            'name' => 'Test & Category: With Special! Characters',
            'slug' => null,
        ]);

        expect($category->slug)->toBe('test-category-with-special-characters');
    });

    it('handles unicode characters in name for slug generation', function () {
        $category = Category::factory()->create([
            'name' => 'Kategori Türkçe İçerik',
            'slug' => null,
        ]);

        expect($category->slug)->toMatch('/^[a-z0-9-]+$/'); // Should be ASCII slug
    });
});

describe('Category Model Attributes', function () {
    it('has correct fillable attributes', function () {
        $category = new Category;

        expect($category->getFillable())->toBe([
            'name',
            'slug',
            'description',
            'color',
            'icon',
            'is_active',
            'sort_order',
        ]);
    });

    it('casts attributes correctly', function () {
        $category = new Category;

        expect($category->getCasts())->toMatchArray([
            'is_active' => 'boolean',
        ]);
    });

    it('has default active status', function () {
        $category = Category::factory()->create();

        expect($category->is_active)->toBeBool();
    });
});

describe('Category Model Scopes and Queries', function () {
    it('can filter active categories', function () {
        // Create active and inactive categories
        $activeCategories = Category::factory(3)->create(['is_active' => true]);
        $inactiveCategories = Category::factory(2)->create(['is_active' => false]);

        $activeResults = Category::where('is_active', true)->get();

        expect($activeResults)->toHaveCount(3);
        $activeResults->each(function ($category) {
            expect($category->is_active)->toBeTrue();
        });
    });

    it('can order by sort order', function () {
        $categories = Category::factory(3)->create([
            'sort_order' => fn () => fake()->numberBetween(1, 100),
        ]);

        $orderedCategories = Category::orderBy('sort_order')->get();

        expect($orderedCategories)->toHaveCount(3);

        // Verify they're in ascending order
        $sortOrders = $orderedCategories->pluck('sort_order')->toArray();
        expect($sortOrders)->toBe(collect($sortOrders)->sort()->values()->toArray());
    });

    it('can find category by slug', function () {
        $category = Category::factory()->create(['slug' => 'test-category']);

        $foundCategory = Category::where('slug', 'test-category')->first();

        expect($foundCategory)->not->toBeNull();
        expect($foundCategory->id)->toBe($category->id);
    });
});

describe('Category Model Factory', function () {
    it('creates valid category with factory', function () {
        $category = Category::factory()->create();

        expect($category->name)->toBeString();
        expect($category->slug)->toBeString();
        expect($category->description)->toBeString();
        expect($category->color)->toBeString();
        expect($category->is_active)->toBeBool();
        expect($category->sort_order)->toBeInt();
        expect($category->created_at)->toBeInstanceOf(\Carbon\Carbon::class);
    });

    it('creates category with custom attributes', function () {
        $category = Category::factory()->create([
            'name' => 'Laravel',
            'is_active' => false,
            'sort_order' => 10,
        ]);

        expect($category->name)->toBe('Laravel');
        expect($category->is_active)->toBeFalse();
        expect($category->sort_order)->toBe(10);
    });

    it('creates multiple categories with unique names and slugs', function () {
        $categories = Category::factory(5)->create();

        expect($categories)->toHaveCount(5);

        $names = $categories->pluck('name')->toArray();
        $slugs = $categories->pluck('slug')->toArray();

        expect($names)->toBe(array_unique($names)); // All names should be unique
        expect($slugs)->toBe(array_unique($slugs)); // All slugs should be unique
    });
});
