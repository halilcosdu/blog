<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;

class Homepage extends BaseComponent
{
    /**
     * Get the featured post for the homepage
     */
    private function getFeaturedPost(): ?\App\Models\Post
    {
        return $this->cacheShort($this->getCacheKey('featured_post'), function () {
            return $this->repository(PostRepository::class)->getFeatured();
        });
    }

    /**
     * Get the latest posts for the homepage
     */
    private function getLatestPosts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->cacheShort($this->getCacheKey('latest_posts'), function () {
            return $this->repository(PostRepository::class)->getLatest(6);
        });
    }

    /**
     * Get active categories with post counts
     */
    private function getCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->cacheMedium($this->getCacheKey('categories'), function () {
            return $this->repository(CategoryRepository::class)->getActive(24);
        });
    }

    /**
     * Get top lessons (standalone episodes)
     */
    private function getTopLessons(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->cacheMedium($this->getCacheKey('top_lessons'), function () {
            return \App\Models\Episode::published()
                ->where('is_standalone', true)
                ->whereNotNull('thumbnail')
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->orderByDesc('views_count')
                ->take(12)
                ->get();
        });
    }

    /**
     * Get all data needed for the homepage view
     */
    private function getViewData(): array
    {
        return [
            'featuredPost' => $this->getFeaturedPost(),
            'latestPosts' => $this->getLatestPosts(),
            'categories' => $this->getCategories(),
            'topLessons' => $this->getTopLessons(),
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $viewData = $this->getViewData();
        $seoData = $this->getHomepageSEO();

        return view('livewire.blog.homepage', $viewData)
            ->title('phpuzem - Modern PHP & Laravel Development')
            ->layout('components.layouts.app', $seoData);
    }
}
