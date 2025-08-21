<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Blog\Homepage::class)->name('home');
Route::get('/pricing', App\Livewire\Blog\Pricing::class)->name('pricing');
Route::get('/sponsors', App\Livewire\Sponsors\SponsorsPage::class)->name('sponsors');
Route::get('/posts', App\Livewire\Blog\PostsList::class)->name('posts.index');
Route::get('/posts/{slug}', App\Livewire\Blog\PostShow::class)->name('posts.show');
Route::get('/watch', App\Livewire\Watch\ModernWatchPage::class)->name('watch');

// Watch content routes
Route::prefix('watch')->name('watch.')->group(function () {
    Route::get('/series/{slug}', App\Livewire\Watch\SeriesShow::class)->name('series.show');
    Route::get('/series/{seriesSlug}/episode/{episodeSlug}', App\Livewire\Watch\EpisodeShow::class)->name('episode.show');
    Route::get('/lesson/{slug}', App\Livewire\Watch\LessonShow::class)->name('lesson.show');
    Route::get('/pathways/{slug}', App\Livewire\Watch\PathwayShow::class)->name('pathway.show');
});

// Test route for markdown editor
Route::get('/test-editor', function () {
    return view('test-editor');
})->name('test.editor');

// API endpoint for user search (for @mentions)
Route::get('/api/users/search', function () {
    $query = request('q', '');

    // Return empty array if no query provided for security
    if (empty($query)) {
        return response()->json([]);
    }

    // Minimum 2 characters required for search
    if (strlen($query) < 2) {
        return response()->json([]);
    }

    $users = \App\Models\User::query()
        ->where(function ($subQuery) use ($query) {
            // Use LIKE for SQLite compatibility, ILIKE for PostgreSQL
            $likeOperator = config('database.default') === 'pgsql' ? 'ILIKE' : 'LIKE';
            $subQuery->where('name', $likeOperator, "%{$query}%")
                ->orWhere('username', $likeOperator, "%{$query}%");
        })
        ->select('id', 'name', 'username')
        ->limit(8)
        ->get();

    return response()->json($users);
})->middleware('throttle:60,1')->name('api.users.search');

// Discussion routes
Route::get('/discussions', App\Livewire\Discussion\DiscussionForum::class)->name('discussions.index');

// Authenticated discussion routes
Route::middleware('auth')->group(function () {
    Route::get('/discussions/create', App\Livewire\Discussion\CreateDiscussion::class)->name('discussions.create');
    Route::get('/discussions/{slug}/edit', App\Livewire\Discussion\EditDiscussion::class)->name('discussions.edit');
});

// Development/Demo routes
Route::get('/demo/notifications', App\Livewire\NotificationDemo::class)->name('demo.notifications');

// Discussion detail (must be last to avoid conflicts)
Route::get('/discussions/{slug}', App\Livewire\Discussion\DiscussionShow::class)->name('discussions.show');

// SEO Routes
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
