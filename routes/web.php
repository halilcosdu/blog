<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Blog\Homepage::class)->name('home');
Route::get('/pricing', App\Livewire\Blog\Pricing::class)->name('pricing');
Route::get('/posts', App\Livewire\Blog\PostsList::class)->name('posts.index');
Route::get('/posts/{slug}', App\Livewire\Blog\PostShow::class)->name('posts.show');
Route::get('/discussion', App\Livewire\Discussion\DiscussionForum::class)->name('discussion');

// SEO Routes
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
