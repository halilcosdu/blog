<?php

namespace App\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        // Cache expensive queries for better performance
        $featuredPost = \Cache::remember('homepage.featured_post', 300, function () {
            return Post::query()
                ->published()
                ->featured()
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->latest('published_at')
                ->first();
        });

        $latestPosts = \Cache::remember('homepage.latest_posts', 300, function () {
            return Post::query()
                ->published()
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->latest('published_at')
                ->take(6)
                ->get();
        });

        $categories = \Cache::remember('homepage.categories', 600, function () {
            return Category::query()
                ->where('is_active', true)
                ->withCount(['posts as posts_count' => function ($query) {
                    $query->published();
                }])
                ->orderBy('sort_order')
                ->take(24)
                ->get();
        });


        $topLessons = \Cache::remember('homepage.top_lessons', 600, function () {
            return Post::query()
                ->published()
                ->whereNotNull('featured_image')
                ->with(['user:id,name,email', 'category:id,name,slug'])
                ->orderByDesc('views_count')
                ->take(12)
                ->get();
        });

        $seoData = [
            'title' => 'phpuzem - Modern PHP & Laravel Development',
            'description' => 'Practical screencasts and complete learning paths for modern PHP & Laravel development. Learn by building real projects, at your own pace.',
            'keywords' => 'Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding, Tailwind, Livewire, Tutorial, Screencast',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-homepage.jpg'),
        ];

        return view('livewire.blog.homepage', [
            'featuredPost' => $featuredPost,
            'latestPosts' => $latestPosts,
            'categories' => $categories,
            'topLessons' => $topLessons,
        ])
            ->title('phpuzem - Modern PHP & Laravel Development')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
