<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TrendingSection extends Component
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

        $this->trendingTags = Cache::remember('trending_section.trending_tags_v2', 1800, function () {
            // Universal approach - works with all database drivers
            $posts = DB::table('posts')
                ->select('tags')
                ->where('is_published', true)
                ->whereNotNull('tags')
                ->latest('published_at')
                ->take(100)
                ->get();

            $allTags = collect();
            foreach ($posts as $post) {
                $tags = json_decode($post->tags, true);
                if (is_array($tags)) {
                    $allTags = $allTags->concat($tags);
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

        $this->topAuthors = Cache::remember('trending_section.top_authors_v2', 1800, function () {
            // PostgreSQL-compatible query
            $driver = DB::getDriverName();

            if ($driver === 'pgsql') {
                return User::query()
                    ->withCount(['posts' => function ($query) {
                        $query->published();
                    }])
                    ->whereHas('posts', function ($query) {
                        $query->published();
                    })
                    ->orderByDesc('posts_count')
                    ->take(6)
                    ->get();
            } else {
                return User::query()
                    ->withCount(['posts as posts_count' => function ($query) {
                        $query->published();
                    }])
                    ->having('posts_count', '>', 0)
                    ->orderByDesc('posts_count')
                    ->take(6)
                    ->get();
            }
        });

        $this->popularPosts = Cache::remember('trending_section.popular_posts_v2', 600, function () {
            return Post::query()
                ->published()
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->orderByDesc('views_count')
                ->take(6)
                ->get();
        });

        $this->loaded = true;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.blog.trending-section');
    }
}
