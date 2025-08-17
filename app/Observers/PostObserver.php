<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearCaches();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->clearCaches();
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearCaches();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearCaches();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearCaches();
    }

    /**
     * Clear all relevant caches when posts change
     */
    private function clearCaches(): void
    {
        Cache::forget('homepage.featured_post');
        Cache::forget('homepage.latest_posts');
        Cache::forget('homepage.popular_posts');
        Cache::forget('homepage.trending_tags');
        Cache::forget('homepage.top_lessons');
        Cache::forget('pricing.top_lessons');
        
        // Clear any cached posts by category
        Cache::flush(); // In production, be more specific with cache tags
    }
}
