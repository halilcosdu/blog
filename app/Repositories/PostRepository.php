<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    /**
     * Get published posts
     */
    public function getPublished(): Collection
    {
        return $this->model->published()->get();
    }

    /**
     * Get featured post
     */
    public function getFeatured(): ?Post
    {
        return $this->model
            ->published()
            ->featured()
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->latest('published_at')
            ->first();
    }

    /**
     * Get latest posts
     */
    public function getLatest(int $limit = 6): Collection
    {
        return $this->model
            ->published()
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    /**
     * Get top posts by views
     */
    public function getTopByViews(int $limit = 12): Collection
    {
        return $this->model
            ->published()
            ->whereNotNull('featured_image')
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->orderByDesc('views_count')
            ->take($limit)
            ->get();
    }

    /**
     * Get popular posts by views
     */
    public function getPopular(int $limit = 6): Collection
    {
        return $this->model
            ->published()
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->orderByDesc('views_count')
            ->take($limit)
            ->get();
    }

    /**
     * Get posts by category
     */
    public function getByCategory(int $categoryId, ?int $limit = null): Collection
    {
        $query = $this->model
            ->published()
            ->where('category_id', $categoryId)
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->latest('published_at');

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Search posts
     */
    public function search(string $term, ?int $limit = null): Collection
    {
        $query = $this->model
            ->published()
            ->where(function ($query) use ($term) {
                $query->where('title', 'like', "%{$term}%")
                    ->orWhere('content', 'like', "%{$term}%")
                    ->orWhere('excerpt', 'like', "%{$term}%");
            })
            ->with(['user:id,name,email', 'category:id,name,slug'])
            ->latest('published_at');

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Get posts with tags for trending analysis
     */
    public function getRecentWithTags(int $limit = 100): Collection
    {
        return $this->model
            ->published()
            ->whereHas('tags')
            ->with(['tags:id,name,slug'])
            ->latest('published_at')
            ->take($limit)
            ->get(['id', 'title', 'slug', 'published_at']);
    }
}
