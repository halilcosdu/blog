<?php

namespace App\Livewire\Blog;

use App\Livewire\BaseComponent;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class TrendingSection extends BaseComponent
{
    public $trendingTags = [];

    public $topAuthors = [];

    public $popularPosts = [];

    public $loaded = false;

    public function loadContent(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->trendingTags = $this->cacheLong($this->getCacheKey('trending_tags_v2'), function () {
            $posts = $this->repository(PostRepository::class)->getRecentWithTags(100);

            $allTags = collect();
            foreach ($posts as $post) {
                if (is_array($post->tags) && ! empty($post->tags)) {
                    $allTags = $allTags->concat($post->tags);
                }
            }

            return $allTags
                ->filter()
                ->countBy()
                ->sortDesc()
                ->take(10)
                ->keys()
                ->toArray();
        });

        $this->topAuthors = $this->cacheLong($this->getCacheKey('top_authors_v2'), function () {
            return $this->repository(UserRepository::class)->getTopAuthors(6);
        });

        $this->popularPosts = $this->cacheMedium($this->getCacheKey('popular_posts_v2'), function () {
            return $this->repository(PostRepository::class)->getPopular(6);
        });

        $this->loaded = true;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.blog.trending-section');
    }
}
