<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryId = null;
    public $sortBy = 'latest'; // latest, popular, oldest

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryId' => ['except' => null, 'as' => 'category'],
        'sortBy' => ['except' => 'latest', 'as' => 'sort'],
        'page' => ['except' => 1],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryId(): void
    {
        $this->resetPage();
    }

    public function updatingSortBy(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::query()
            ->published()
            ->with(['user:id,name,email', 'category:id,name,slug']);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        // Apply category filter
        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'popular':
                $query->orderByDesc('views_count');
                break;
            case 'oldest':
                $query->orderBy('published_at');
                break;
            default: // latest
                $query->latest('published_at');
                break;
        }

        $posts = $query->paginate(12);
        
        $categories = \Cache::remember('posts_list.categories', 600, function () {
            return \App\Models\Category::query()
                ->where('is_active', true)
                ->withCount(['posts as posts_count' => function ($query) {
                    $query->published();
                }])
                ->having('posts_count', '>', 0)
                ->orderBy('name')
                ->get();
        });

        $seoData = [
            'title' => 'All Posts - phpuzem | Laravel & PHP Tutorials',
            'description' => 'Browse all our Laravel and PHP tutorials, screencasts, and learning resources. Find exactly what you need to improve your development skills.',
            'keywords' => 'Laravel tutorials, PHP posts, web development articles, coding tutorials, programming guides',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-posts.jpg'),
        ];

        return view('livewire.blog.posts-list', [
            'posts' => $posts,
            'categories' => $categories,
        ])
            ->title('All Posts - phpuzem | Laravel & PHP Tutorials')
            ->layout('components.layouts.app', compact('seoData'));
    }
}