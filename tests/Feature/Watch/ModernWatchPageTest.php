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
    Livewire::test(ModernWatchPage::class)
        ->assertViewHas('featuredContent')
        ->assertPropertyWired('search')
        ->assertPropertyWired('contentType')
        ->assertPropertyWired('selectedCategory');
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

    Livewire::test(ModernWatchPage::class)
        ->set('search', 'Laravel')
        ->assertComputed('featuredContent', function ($featuredContent) {
            return collect($featuredContent)->contains('title', 'Laravel Testing');
        });
});

test('category filtering works correctly', function () {
    $category = Category::first();

    Livewire::test(ModernWatchPage::class)
        ->set('selectedCategory', $category->slug)
        ->assertComputed('featuredContent', function ($featuredContent) use ($category) {
            return collect($featuredContent)->every(function ($item) use ($category) {
                return $item['category'] === $category->slug;
            });
        });
});

test('level filtering works correctly', function () {
    Livewire::test(ModernWatchPage::class)
        ->set('selectedLevel', 'beginner')
        ->assertComputed('featuredContent', function ($featuredContent) {
            return collect($featuredContent)->every(function ($item) {
                return $item['level'] === 'beginner';
            });
        });
});

test('sorting by different criteria works', function () {
    $component = Livewire::test(ModernWatchPage::class);

    // Test alphabetical sorting
    $component->set('sortBy', 'alphabetical')
        ->assertComputed('featuredContent', function ($featuredContent) {
            $titles = collect($featuredContent)->pluck('title')->toArray();

            return $titles === collect($titles)->sort()->values()->toArray();
        });

    // Test popular sorting
    $component->set('sortBy', 'popular')
        ->assertComputed('featuredContent', function ($featuredContent) {
            $views = collect($featuredContent)->pluck('views')->toArray();

            return $views === collect($views)->sortDesc()->values()->toArray();
        });
});

test('continue watching shows user progress', function () {
    $user = User::factory()->create();
    $episode = Episode::published()->first();

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

    Livewire::test(ModernWatchPage::class)
        ->assertComputed('continueWatching', function ($continueWatching) use ($episode) {
            return collect($continueWatching)->contains('title', $episode->title);
        });
});

test('watchlist functionality for authenticated users', function () {
    $user = User::factory()->create();
    $series = Series::published()->first();

    $this->actingAs($user);

    Livewire::test(ModernWatchPage::class)
        ->call('addToWatchlist', $series->id, 'series')
        ->assertDispatched('watchlist-updated');

    expect(UserWatchlist::isInWatchlist($user->id, Series::class, $series->id))->toBeTrue();
});

test('watchlist requires authentication', function () {
    $series = Series::published()->first();

    Livewire::test(ModernWatchPage::class)
        ->call('addToWatchlist', $series->id, 'series')
        ->assertDispatched('auth-required');
});

test('progress tracking methods work correctly', function () {
    $user = User::factory()->create();
    $episode = Episode::published()->first();

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
    expect($progress->progress_percentage)->toBe(50.0);
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
    Livewire::test(ModernWatchPage::class)
        ->assertComputed('categories', function ($categories) {
            return is_array($categories) &&
                   collect($categories)->every(function ($category) {
                       return isset($category['name'], $category['count']) && $category['count'] > 0;
                   });
        });
});

test('popular tags computed property returns tags with usage counts', function () {
    Livewire::test(ModernWatchPage::class)
        ->assertComputed('popularTags', function ($tags) {
            return is_array($tags) &&
                   collect($tags)->every(function ($tag) {
                       return isset($tag['name'], $tag['count']) && $tag['count'] > 0;
                   });
        });
});
