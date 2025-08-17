<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get active categories
     */
    public function getActive(?int $limit = null): Collection
    {
        $query = $this->model
            ->where('is_active', true)
            ->withCount(['posts as posts_count' => function ($query) {
                $query->published();
            }])
            ->orderBy('sort_order');

        if ($limit) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Get category by slug
     */
    public function findBySlug(string $slug): ?Category
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Get categories with posts
     */
    public function getWithPosts(): Collection
    {
        return $this->model
            ->where('is_active', true)
            ->whereHas('posts', function ($query) {
                $query->published();
            })
            ->withCount(['posts as posts_count' => function ($query) {
                $query->published();
            }])
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get popular categories by post count
     */
    public function getPopular(int $limit = 10): Collection
    {
        return $this->model
            ->where('is_active', true)
            ->withCount(['posts as posts_count' => function ($query) {
                $query->published();
            }])
            ->orderByDesc('posts_count')
            ->take($limit)
            ->get();
    }
}
