<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Blog\Homepage::class)->name('home');
Route::get('/pricing', App\Livewire\Blog\Pricing::class)->name('pricing');
Route::get('/posts', App\Livewire\Blog\PostsList::class)->name('posts.index');
Route::get('/posts/{slug}', App\Livewire\Blog\PostShow::class)->name('posts.show');
Route::get('/watch', App\Livewire\Watch\WatchPage::class)->name('watch');

// Test route for markdown editor
Route::get('/test-editor', function () {
    return view('test-editor');
})->name('test.editor');

// Discussion routes
Route::get('/discussions', App\Livewire\Discussion\DiscussionForum::class)->name('discussions.index');

// Authenticated discussion routes
Route::middleware('auth')->group(function () {
    Route::get('/discussions/create', App\Livewire\Discussion\CreateDiscussion::class)->name('discussions.create');
    Route::get('/discussions/{slug}/edit', App\Livewire\Discussion\EditDiscussion::class)->name('discussions.edit');
});

// Discussion detail (must be last to avoid conflicts)
Route::get('/discussions/{slug}', App\Livewire\Discussion\DiscussionShow::class)->name('discussions.show');

// SEO Routes
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
