<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostsList extends Component
{
    use WithPagination;

    public $search = '';

    public $categoryIds = [];

    public $sortBy = 'latest'; // latest, popular, oldest

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryIds' => ['except' => []],
        'sortBy' => ['except' => 'latest', 'as' => 'sort'],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryIds(): void
    {
        $this->resetPage();
    }

    public function updatingSortBy(): void
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        // URL'den gelen query parametrelerini işle
        if (request()->has('categories')) {
            $categories = request()->get('categories');
            if (is_array($categories)) {
                $this->categoryIds = array_map('intval', $categories);
            } elseif (is_string($categories)) {
                $this->categoryIds = array_map('intval', explode(',', $categories));
            }
        }
    }

    public function clearAllFilters(): void
    {
        $this->search = '';
        $this->categoryIds = [];
        $this->resetPage();
    }

    public function toggleCategory($categoryId): void
    {
        if (in_array($categoryId, $this->categoryIds)) {
            $this->categoryIds = array_values(array_diff($this->categoryIds, [$categoryId]));
        } else {
            $this->categoryIds[] = $categoryId;
        }
        $this->resetPage();
    }

    public function getQueryString(): array
    {
        $query = [];

        if ($this->search) {
            $query['search'] = $this->search;
        }

        if (! empty($this->categoryIds)) {
            $query['categories'] = $this->categoryIds;
        }

        if ($this->sortBy !== 'latest') {
            $query['sort'] = $this->sortBy;
        }

        return $query;
    }

    public function paginationView(): string
    {
        return 'vendor.pagination.custom';
    }

    public function gotoPage($page): void
    {
        $this->setPage($page);
        $this->dispatch('scroll-to-posts');
    }

    public function previousPage(): void
    {
        $this->setPage($this->getPage() - 1);
        $this->dispatch('scroll-to-posts');
    }

    public function nextPage(): void
    {
        $this->setPage($this->getPage() + 1);
        $this->dispatch('scroll-to-posts');
    }

    public function render()
    {
        $query = Post::query()
            ->published()
            ->with(['user:id,name,email', 'category:id,name,slug']);

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%');
            });
        }

        // Apply category filter
        if (! empty($this->categoryIds)) {
            $query->whereIn('category_id', $this->categoryIds);
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
                ->whereHas('posts', function ($q): void {
                    $q->published();
                })
                ->withCount([
                    'posts' => function ($q): void {
                        $q->published();
                    },
                ])
                ->orderBy('name')
                ->get();
        });

        $topLessons = \Cache::remember('posts_list.top_lessons', 3600, function () {
            return Post::published()
                ->orderBy('views_count', 'desc')
                ->take(12)
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
            'topLessons' => $topLessons,
        ])
            ->title('All Posts - phpuzem | Laravel & PHP Tutorials')
            ->layout('components.layouts.app', compact('seoData'));
    }

    /**
     * Get dynamic category colors based on category name
     */
    public function getCategoryColors($categoryName): array
    {
        $colors = [
            'Laravel' => ['bg' => 'bg-red-100 dark:bg-red-900/30', 'text' => 'text-red-700 dark:text-red-300', 'border' => 'border-red-200 dark:border-red-800'],
            'PHP' => ['bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-700 dark:text-purple-300', 'border' => 'border-purple-200 dark:border-purple-800'],
            'Vue.js' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-700 dark:text-green-300', 'border' => 'border-green-200 dark:border-green-800'],
            'JavaScript' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-700 dark:text-yellow-300', 'border' => 'border-yellow-200 dark:border-yellow-800'],
            'React' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-700 dark:text-blue-300', 'border' => 'border-blue-200 dark:border-blue-800'],
            'CSS' => ['bg' => 'bg-indigo-100 dark:bg-indigo-900/30', 'text' => 'text-indigo-700 dark:text-indigo-300', 'border' => 'border-indigo-200 dark:border-indigo-800'],
            'Tutorial' => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-700 dark:text-emerald-300', 'border' => 'border-emerald-200 dark:border-emerald-800'],
            'Tips' => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-700 dark:text-orange-300', 'border' => 'border-orange-200 dark:border-orange-800'],
        ];

        // Generate hash-based color for unknown categories
        $hash = crc32($categoryName);
        $colorIndex = abs($hash) % 8;
        $defaultColors = [
            ['bg' => 'bg-slate-100 dark:bg-slate-900/30', 'text' => 'text-slate-700 dark:text-slate-300', 'border' => 'border-slate-200 dark:border-slate-800'],
            ['bg' => 'bg-pink-100 dark:bg-pink-900/30', 'text' => 'text-pink-700 dark:text-pink-300', 'border' => 'border-pink-200 dark:border-pink-800'],
            ['bg' => 'bg-cyan-100 dark:bg-cyan-900/30', 'text' => 'text-cyan-700 dark:text-cyan-300', 'border' => 'border-cyan-200 dark:border-cyan-800'],
            ['bg' => 'bg-lime-100 dark:bg-lime-900/30', 'text' => 'text-lime-700 dark:text-lime-300', 'border' => 'border-lime-200 dark:border-lime-800'],
            ['bg' => 'bg-violet-100 dark:bg-violet-900/30', 'text' => 'text-violet-700 dark:text-violet-300', 'border' => 'border-violet-200 dark:border-violet-800'],
            ['bg' => 'bg-rose-100 dark:bg-rose-900/30', 'text' => 'text-rose-700 dark:text-rose-300', 'border' => 'border-rose-200 dark:border-rose-800'],
            ['bg' => 'bg-teal-100 dark:bg-teal-900/30', 'text' => 'text-teal-700 dark:text-teal-300', 'border' => 'border-teal-200 dark:border-teal-800'],
            ['bg' => 'bg-amber-100 dark:bg-amber-900/30', 'text' => 'text-amber-700 dark:text-amber-300', 'border' => 'border-amber-200 dark:border-amber-800'],
        ];

        return $colors[$categoryName] ?? $defaultColors[$colorIndex];
    }

    /**
     * Get dot color from text color
     */
    public function getDotColor($textColor): string
    {
        $mapping = [
            'text-red-700 dark:text-red-300' => 'bg-red-600',
            'text-purple-700 dark:text-purple-300' => 'bg-purple-600',
            'text-green-700 dark:text-green-300' => 'bg-green-600',
            'text-yellow-700 dark:text-yellow-300' => 'bg-yellow-600',
            'text-blue-700 dark:text-blue-300' => 'bg-blue-600',
            'text-indigo-700 dark:text-indigo-300' => 'bg-indigo-600',
            'text-emerald-700 dark:text-emerald-300' => 'bg-emerald-600',
            'text-orange-700 dark:text-orange-300' => 'bg-orange-600',
            'text-slate-700 dark:text-slate-300' => 'bg-slate-600',
            'text-pink-700 dark:text-pink-300' => 'bg-pink-600',
            'text-cyan-700 dark:text-cyan-300' => 'bg-cyan-600',
            'text-lime-700 dark:text-lime-300' => 'bg-lime-600',
            'text-violet-700 dark:text-violet-300' => 'bg-violet-600',
            'text-rose-700 dark:text-rose-300' => 'bg-rose-600',
            'text-teal-700 dark:text-teal-300' => 'bg-teal-600',
            'text-amber-700 dark:text-amber-300' => 'bg-amber-600',
        ];

        return $mapping[$textColor] ?? 'bg-slate-600';
    }
}
