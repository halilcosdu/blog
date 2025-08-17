<?php

namespace App\Livewire\Discussion;

use App\Models\Category;
use App\Models\Discussion;
use Livewire\Component;
use Livewire\WithPagination;

class DiscussionForum extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = 'all'; // all, resolved, unresolved
    public array $categoryIds = [];
    public string $sortBy = 'latest'; // latest, oldest, popular, most_commented

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'categoryIds' => ['except' => [], 'as' => 'categories'],
        'sortBy' => ['except' => 'latest', 'as' => 'sort'],
    ];

    public function toggleCategory(int $categoryId): void
    {
        if (in_array($categoryId, $this->categoryIds)) {
            $this->categoryIds = array_diff($this->categoryIds, [$categoryId]);
        } else {
            $this->categoryIds[] = $categoryId;
        }
        $this->resetPage();
    }

    public function clearCategories(): void
    {
        $this->categoryIds = [];
        $this->resetPage();
    }

    public function updating($key): void
    {
        if (in_array($key, ['search', 'status', 'categoryIds', 'sortBy'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Discussion::query()
            ->with(['user', 'category'])
            ->withCount('replies');

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%');
            });
        }

        // Status filter
        if ($this->status === 'resolved') {
            $query->where('is_resolved', true);
        } elseif ($this->status === 'unresolved') {
            $query->where('is_resolved', false);
        }

        // Category filter
        if (!empty($this->categoryIds)) {
            $query->whereIn('category_id', $this->categoryIds);
        }

        // Sorting
        match ($this->sortBy) {
            'oldest' => $query->oldest(),
            'popular' => $query->orderByDesc('views_count'),
            'most_commented' => $query->orderByDesc('replies_count'),
            default => $query->latest(),
        };

        $discussions = $query->paginate(10);

        // Data for filters sidebar
        $categories = Category::query()
            ->whereHas('discussions')
            ->withCount('discussions')
            ->get();

        $statusCounts = [
            'all' => Discussion::query()->count(),
            'resolved' => Discussion::query()->where('is_resolved', true)->count(),
            'unresolved' => Discussion::query()->where('is_resolved', false)->count(),
        ];

        return view('livewire.discussion.discussion-forum', [
            'discussions' => $discussions,
            'categories' => $categories,
            'statusCounts' => $statusCounts,
        ])
            ->layout('components.layouts.app', [
                'seoData' => [
                    'title' => 'Discussion Forum - phpuzem',
                    'description' => 'Ask questions, share knowledge, and connect with the PHP and Laravel community.',
                ]
            ]);
    }
}