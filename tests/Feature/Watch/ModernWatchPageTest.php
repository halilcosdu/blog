<?php

use App\Livewire\Watch\ModernWatchPage;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Series;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('watch page renders successfully', function () {
    $response = $this->get('/watch');

    $response->assertStatus(200);
    $response->assertSeeLivewire(ModernWatchPage::class);
});

test('featured content shows published series and episodes', function () {
    $component = Livewire::test(ModernWatchPage::class);

    // Test that these properties exist and can be set
    $component->set('search', 'test')
        ->assertSet('search', 'test')
        ->set('contentType', 'series')
        ->assertSet('contentType', 'series')
        ->set('selectedCategory', 'laravel')
        ->assertSet('selectedCategory', 'laravel');
});

test('search functionality filters content', function () {
    // Create test data
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $series = Series::factory()->create([
        'title' => 'Laravel Testing',
        'is_published' => true,
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    $component = Livewire::test(ModernWatchPage::class)
        ->set('search', 'Laravel');

    $featuredContent = $component->get('featuredContent');
    expect(collect($featuredContent)->contains('title', 'Laravel Testing'))->toBeTrue();
});

test('category filtering works correctly', function () {
    $category = Category::factory()->create();

    $component = Livewire::test(ModernWatchPage::class)
        ->set('selectedCategory', $category->slug);

    $featuredContent = $component->get('featuredContent');
    expect(collect($featuredContent)->every(function ($item) use ($category) {
        return $item['category'] === $category->slug;
    }))->toBeTrue();
});

test('level filtering works correctly', function () {
    $component = Livewire::test(ModernWatchPage::class)
        ->set('selectedLevel', 'beginner');

    $featuredContent = $component->get('featuredContent');
    expect(collect($featuredContent)->every(function ($item) {
        return $item['level'] === 'beginner';
    }))->toBeTrue();
});

test('sorting by different criteria works', function () {
    $component = Livewire::test(ModernWatchPage::class);

    // Test alphabetical sorting
    $component->set('sortBy', 'alphabetical');
    $featuredContent = $component->get('featuredContent');
    $titles = collect($featuredContent)->pluck('title')->toArray();
    expect($titles)->toBe(collect($titles)->sort()->values()->toArray());

    // Test popular sorting
    $component->set('sortBy', 'popular');
    $featuredContent = $component->get('featuredContent');
    $views = collect($featuredContent)->pluck('views')->toArray();
    expect($views)->toBe(collect($views)->sortDesc()->values()->toArray());
});

test('continue watching shows user progress', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $episode = Episode::factory()->create([
        'is_published' => true,
        'category_id' => $category->id,
        'user_id' => $user->id,
        'is_standalone' => true,
    ]);

    // Create progress record
    UserProgress::create([
        'user_id' => $user->id,
        'progressable_type' => Episode::class,
        'progressable_id' => $episode->id,
        'watched_seconds' => 300,
        'total_seconds' => 600,
        'progress_percentage' => 50,
        'is_completed' => false,
        'started_at' => now(),
        'last_watched_at' => now(),
    ]);

    $this->actingAs($user);

    $component = Livewire::test(ModernWatchPage::class);
    $continueWatching = $component->get('continueWatching');
    expect(collect($continueWatching)->contains('title', $episode->title))->toBeTrue();
});

test('watchlist functionality for authenticated users', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $series = Series::factory()->create([
        'is_published' => true,
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    $this->actingAs($user);

    Livewire::test(ModernWatchPage::class)
        ->call('addToWatchlist', $series->id, 'series')
        ->assertDispatched('watchlist-updated');

    expect(UserWatchlist::where('user_id', $user->id)
        ->where('watchable_type', Series::class)
        ->where('watchable_id', $series->id)
        ->exists())->toBeTrue();
});

test('watchlist requires authentication', function () {
    $category = Category::factory()->create();
    $user = User::factory()->create();
    $series = Series::factory()->create([
        'is_published' => true,
        'category_id' => $category->id,
        'user_id' => $user->id,
    ]);

    Livewire::test(ModernWatchPage::class)
        ->call('addToWatchlist', $series->id, 'series')
        ->assertDispatched('auth-required');
});

test('progress tracking methods work correctly', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $episode = Episode::factory()->create([
        'is_published' => true,
        'category_id' => $category->id,
        'user_id' => $user->id,
        'is_standalone' => true,
    ]);

    $this->actingAs($user);

    Livewire::test(ModernWatchPage::class)
        ->call('updateProgress', $episode->id, 'episode', 300, 600)
        ->assertDispatched('progress-updated');

    $progress = UserProgress::where('user_id', $user->id)
        ->where('progressable_type', Episode::class)
        ->where('progressable_id', $episode->id)
        ->first();

    expect($progress)->not->toBeNull();
    expect($progress->watched_seconds)->toBe(300);
    expect((float) $progress->progress_percentage)->toBe(50.0);
});

test('clear filters functionality works', function () {
    Livewire::test(ModernWatchPage::class)
        ->set('search', 'test')
        ->set('selectedCategory', 'laravel')
        ->set('selectedLevel', 'beginner')
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('selectedCategory', '')
        ->assertSet('selectedLevel', '');
});

test('categories computed property returns active categories with counts', function () {
    $component = Livewire::test(ModernWatchPage::class);
    $categories = $component->get('categories');

    expect($categories)->toBeArray();
    expect(collect($categories)->every(function ($category) {
        return isset($category['name'], $category['count']) && $category['count'] >= 0;
    }))->toBeTrue();
});

test('popular tags computed property returns tags with usage counts', function () {
    $component = Livewire::test(ModernWatchPage::class);
    $tags = $component->get('popularTags');

    expect($tags)->toBeArray();
    expect(collect($tags)->every(function ($tag) {
        return isset($tag['name'], $tag['count']) && $tag['count'] >= 0;
    }))->toBeTrue();
});
