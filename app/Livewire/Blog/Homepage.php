<?php

namespace App\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        $featuredPost = Post::query()
            ->published()
            ->featured()
            ->with(['user', 'category'])
            ->latest('published_at')
            ->first();

        $latestPosts = Post::query()
            ->published()
            ->with(['user', 'category'])
            ->latest('published_at')
            ->take(6)
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('livewire.blog.homepage', [
            'featuredPost' => $featuredPost,
            'latestPosts' => $latestPosts,
            'categories' => $categories,
        ])
            ->title('Ana Sayfa - CodeBlog')
            ->layout('components.layouts.app');
    }
}
