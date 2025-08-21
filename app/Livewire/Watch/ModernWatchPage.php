<?php

namespace App\Livewire\Watch;

use App\Models\Category;
use App\Models\Episode;
use App\Models\Pathway;
use App\Models\Series;
use App\Models\Tag;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ModernWatchPage extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'type')]
    public string $contentType = 'all';

    #[Url(as: 'category')]
    public string $selectedCategory = '';

    #[Url(as: 'level')]
    public string $selectedLevel = '';

    #[Url(as: 'duration')]
    public string $selectedDuration = '';

    #[Url(as: 'instructor')]
    public string $selectedInstructor = '';

    #[Url(as: 'pathway')]
    public string $selectedPathway = '';

    #[Url(as: 'tags')]
    public array $selectedTags = [];

    #[Url(as: 'sort')]
    public string $sortBy = 'recent';

    public string $viewMode = 'grid'; // grid, list

    public bool $showFilters = false;

    public string $activeTab = 'all'; // all, series, lessons, pathways, watchlist

    // UI state
    public bool $showSortDropdown = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'contentType' => ['except' => 'all'],
        'selectedCategory' => ['except' => ''],
        'selectedLevel' => ['except' => ''],
        'selectedDuration' => ['except' => ''],
        'selectedInstructor' => ['except' => ''],
        'selectedPathway' => ['except' => ''],
        'selectedTags' => ['except' => []],
        'sortBy' => ['except' => 'recent'],
        'activeTab' => ['except' => 'all'],
    ];

    public function mount(): void
    {
        // Set initial state based on user preferences or defaults
        $this->viewMode = session('watch.view_mode', 'grid');
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedContentType(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedCategory(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedLevel(): void
    {
        $this->resetPage();
    }

    public function updatedSortBy(): void
    {
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset(['search', 'contentType', 'selectedCategory', 'selectedLevel', 'selectedDuration', 'selectedInstructor', 'selectedPathway', 'selectedTags']);
        $this->resetPage();
    }

    public function toggleTag(string $tag): void
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_values(array_filter($this->selectedTags, fn ($t) => $t !== $tag));
        } else {
            $this->selectedTags[] = $tag;
        }
        $this->resetPage();
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function toggleViewMode(): void
    {
        $this->viewMode = $this->viewMode === 'grid' ? 'list' : 'grid';
        session(['watch.view_mode' => $this->viewMode]);
    }

    public function toggleFilters(): void
    {
        $this->showFilters = ! $this->showFilters;
    }

    public function toggleSortDropdown(): void
    {
        $this->showSortDropdown = ! $this->showSortDropdown;
    }

    public function setSortBy(string $sort): void
    {
        $this->sortBy = $sort;
        $this->showSortDropdown = false;
        $this->resetPage();
    }

    public function toggleWatchlist(int $contentId, string $contentType = 'auto'): void
    {
        if (! auth()->check()) {
            $this->dispatch('auth-required', [
                'message' => 'Please login to manage your watchlist.',
            ]);

            return;
        }

        if ($this->isInWatchlist($contentId, $contentType)) {
            $this->removeFromWatchlist($contentId, $contentType);
        } else {
            $this->addToWatchlist($contentId, $contentType);
        }
    }

    public function addToWatchlist(int $contentId, string $contentType = 'auto'): void
    {
        if (! auth()->check()) {
            return;
        }

        // Auto-detect content type if not provided
        if ($contentType === 'auto') {
            $contentType = $this->detectContentType($contentId);
        }

        if (! $contentType) {
            return;
        }

        $modelClass = $this->getModelClass($contentType);

        UserWatchlist::firstOrCreate([
            'user_id' => auth()->id(),
            'watchable_type' => $modelClass,
            'watchable_id' => $contentId,
        ]);

        $this->dispatch('watchlist-updated',
            type: 'added',
            message: 'Added to watchlist!'
        );
    }

    public function removeFromWatchlist(int $contentId, string $contentType = 'auto'): void
    {
        if (! auth()->check()) {
            return;
        }

        // Auto-detect content type if not provided
        if ($contentType === 'auto') {
            $contentType = $this->detectContentType($contentId);
        }

        if (! $contentType) {
            return;
        }

        $modelClass = $this->getModelClass($contentType);

        $deleted = UserWatchlist::where('user_id', auth()->id())
            ->where('watchable_type', $modelClass)
            ->where('watchable_id', $contentId)
            ->delete();

        if ($deleted > 0) {
            $this->dispatch('watchlist-updated',
                type: 'removed',
                message: 'Removed from watchlist!'
            );
        }
    }

    public function isInWatchlist(int $contentId, string $contentType = 'auto'): bool
    {
        if (! auth()->check()) {
            return false;
        }

        // Auto-detect content type if not provided
        if ($contentType === 'auto') {
            $contentType = $this->detectContentType($contentId);
        }

        if (! $contentType) {
            return false;
        }

        $modelClass = $this->getModelClass($contentType);

        return UserWatchlist::where('user_id', auth()->id())
            ->where('watchable_type', $modelClass)
            ->where('watchable_id', $contentId)
            ->exists();
    }

    public function clearWatchlist(): void
    {
        if (! auth()->check()) {
            return;
        }

        UserWatchlist::where('user_id', auth()->id())->delete();

        $this->dispatch('watchlist-updated',
            type: 'cleared',
            message: 'Watchlist cleared!'
        );
    }

    private function detectContentType(int $contentId): ?string
    {
        // Try to find the content in different models
        if (Series::find($contentId)) {
            return 'series';
        }

        if (Episode::find($contentId)) {
            return 'episode';
        }

        if (Pathway::find($contentId)) {
            return 'pathway';
        }

        return null;
    }

    private function getModelClass(string $contentType): string
    {
        return match ($contentType) {
            'series' => Series::class,
            'episode', 'lesson' => Episode::class,
            'pathway' => Pathway::class,
            default => Episode::class,
        };
    }

    public function updateProgress(int $contentId, string $contentType, int $watchedSeconds, int $totalSeconds): void
    {
        if (! auth()->check()) {
            return;
        }

        $modelClass = $this->getModelClass($contentType);

        // Get or create progress record
        $progress = UserProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'progressable_type' => $modelClass,
            'progressable_id' => $contentId,
        ], [
            'watched_seconds' => 0,
            'total_seconds' => $totalSeconds,
            'progress_percentage' => 0,
            'is_completed' => false,
        ]);

        // Update progress
        $progress->update([
            'watched_seconds' => $watchedSeconds,
            'total_seconds' => $totalSeconds,
        ]);

        // Emit progress updated event
        $this->dispatch('progress-updated', [
            'content_id' => $contentId,
            'content_type' => $contentType,
            'progress' => $progress->progress_percentage,
            'is_completed' => $progress->is_completed,
        ]);
    }

    public function markAsCompleted(int $contentId, string $contentType): void
    {
        if (! auth()->check()) {
            return;
        }

        $modelClass = $this->getModelClass($contentType);

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', $modelClass)
            ->where('progressable_id', $contentId)
            ->first();

        if ($progress) {
            $progress->markAsCompleted();

            $this->dispatch('content-completed', [
                'content_id' => $contentId,
                'content_type' => $contentType,
                'message' => 'Congratulations! You completed this content.',
            ]);
        }
    }

    public function resetProgress(int $contentId, string $contentType): void
    {
        if (! auth()->check()) {
            return;
        }

        $modelClass = $this->getModelClass($contentType);

        UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', $modelClass)
            ->where('progressable_id', $contentId)
            ->delete();

        $this->dispatch('progress-reset', [
            'content_id' => $contentId,
            'content_type' => $contentType,
            'message' => 'Progress has been reset.',
        ]);
    }

    public function getProgressStats(): array
    {
        if (! auth()->check()) {
            return [
                'total_watched' => 0,
                'completed_count' => 0,
                'in_progress_count' => 0,
                'total_watch_time' => '0 min',
            ];
        }

        $completedCount = UserProgress::forUser(auth()->id())->completed()->count();
        $inProgressCount = UserProgress::forUser(auth()->id())->inProgress()->count();
        $totalWatchedSeconds = UserProgress::forUser(auth()->id())->sum('watched_seconds');

        return [
            'total_watched' => $completedCount + $inProgressCount,
            'completed_count' => $completedCount,
            'in_progress_count' => $inProgressCount,
            'total_watch_time' => $this->formatWatchTime($totalWatchedSeconds),
        ];
    }

    private function formatWatchTime(int $seconds): string
    {
        if ($seconds < 60) {
            return $seconds.' sec';
        }

        $minutes = floor($seconds / 60);
        if ($minutes < 60) {
            return $minutes.' min';
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($remainingMinutes === 0) {
            return $hours.' hr';
        }

        return $hours.' hr '.$remainingMinutes.' min';
    }

    #[Computed]
    public function sortOptions(): array
    {
        return [
            'recent' => [
                'label' => 'Most Recent',
                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            ],
            'popular' => [
                'label' => 'Most Popular',
                'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
            ],
            'alphabetical' => [
                'label' => 'A-Z',
                'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
            ],
            'duration' => [
                'label' => 'By Duration',
                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
            ],
        ];
    }

    #[Computed]
    public function hasActiveFilters(): bool
    {
        return ! empty($this->search) ||
               $this->contentType !== 'all' ||
               ! empty($this->selectedCategory) ||
               ! empty($this->selectedLevel) ||
               ! empty($this->selectedDuration) ||
               ! empty($this->selectedInstructor) ||
               ! empty($this->selectedPathway) ||
               ! empty($this->selectedTags);
    }

    #[Computed]
    public function categories(): array
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $categories->map(function (Category $category) {
            // Count published content in this category based on current tab
            $count = 0;

            if ($this->activeTab === 'all') {
                // For "All Content" tab: count series + all episodes
                $seriesCount = $category->publishedSeries()->count();
                $episodesCount = $category->publishedEpisodes()->count();
                $count = $seriesCount + $episodesCount;
            } elseif ($this->activeTab === 'series') {
                // For "Series" tab: count only series
                $count = $category->publishedSeries()->count();
            } elseif ($this->activeTab === 'lessons') {
                // For "Individual Lessons" tab: count only standalone episodes
                $count = $category->publishedEpisodes()->where('is_standalone', true)->count();
            } elseif ($this->activeTab === 'pathways') {
                // For "Learning Paths" tab: count only pathways
                $count = $category->publishedPathways()->count();
            } else {
                // For other tabs (watchlist): show all content count
                $seriesCount = $category->publishedSeries()->count();
                $episodesCount = $category->publishedEpisodes()->count();
                $pathwaysCount = $category->publishedPathways()->count();
                $count = $seriesCount + $episodesCount + $pathwaysCount;
            }

            return [
                'id' => $category->slug,
                'name' => $category->name,
                'count' => $count,
                'color' => $this->getCategoryColor($category->color ?? $category->slug),
                'description' => $category->description,
            ];
        })->filter(fn ($category) => $category['count'] > 0)->toArray();
    }

    private function getCategoryColor(string $colorOrSlug): string
    {
        // If it's already a valid color format, return it
        if (str_starts_with($colorOrSlug, '#')) {
            return $colorOrSlug;
        }

        // Map category slugs to colors for consistency
        $colorMap = [
            'laravel' => '#EF4444',
            'php' => '#3B82F6',
            'frontend' => '#10B981',
            'testing' => '#8B5CF6',
            'devops' => '#F59E0B',
            'javascript' => '#F59E0B',
            'databases' => '#6366F1',
            'apis' => '#EC4899',
            'vue' => '#22C55E',
            'react' => '#06B6D4',
            'tailwind-css' => '#334155',
            'livewire' => '#DB2777',
            'security' => '#DC2626',
            'cloud' => '#3B82F6',
            'performance' => '#F97316',
            'architecture' => '#7C3AED',
            'tooling' => '#475569',
        ];

        return $colorMap[$colorOrSlug] ?? '#6B7280';
    }

    #[Computed]
    public function durations(): array
    {
        return [
            ['id' => 'short', 'name' => 'Short (< 10 min)', 'count' => 45],
            ['id' => 'medium', 'name' => 'Medium (10-30 min)', 'count' => 125],
            ['id' => 'long', 'name' => 'Long (30+ min)', 'count' => 67],
        ];
    }

    #[Computed]
    public function instructors(): array
    {
        return [
            ['id' => 'halil', 'name' => 'Halil Coşdu', 'count' => 89, 'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100'],
            ['id' => 'taylor', 'name' => 'Taylor Otwell', 'count' => 45, 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100'],
            ['id' => 'jeffrey', 'name' => 'Jeffrey Way', 'count' => 67, 'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100'],
            ['id' => 'caleb', 'name' => 'Caleb Porzio', 'count' => 34, 'avatar' => 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?w=100'],
        ];
    }

    #[Computed]
    public function popularTags(): array
    {
        // Get tags that are used by published series, episodes, or pathways
        $tags = Tag::whereHas('series', function ($q) {
            $q->where('is_published', true);
        })
            ->orWhereHas('episodes', function ($q) {
                $q->where('is_published', true);
            })
            ->orWhereHas('pathways', function ($q) {
                $q->where('is_published', true);
            })
            ->withCount([
                'series as series_count' => function ($q) {
                    $q->where('is_published', true);
                },
                'episodes as episodes_count' => function ($q) {
                    $q->where('is_published', true);
                },
                'pathways as pathways_count' => function ($q) {
                    $q->where('is_published', true);
                },
            ])
            ->get()
            ->map(function ($tag) {
                $tag->total_usage = $tag->series_count + $tag->episodes_count + $tag->pathways_count;

                return $tag;
            })
            ->where('total_usage', '>', 0)
            ->sortByDesc('total_usage')
            ->take(15);

        return $tags->map(function (Tag $tag) {
            return [
                'name' => $tag->slug,
                'displayName' => $tag->name,
                'count' => $tag->total_usage,
                'color' => $this->getTagColor($tag->color ?? $tag->slug),
                'description' => $tag->description,
            ];
        })->toArray();
    }

    private function getTagColor(string $colorOrSlug): string
    {
        // If it's already a valid color format, return it
        if (str_starts_with($colorOrSlug, '#')) {
            return $colorOrSlug;
        }

        // Map tag slugs to Tailwind CSS color classes
        $colorMap = [
            'laravel' => 'red',
            'php' => 'blue',
            'eloquent' => 'blue',
            'authentication' => 'green',
            'validation' => 'purple',
            'middleware' => 'orange',
            'blade' => 'red',
            'artisan' => 'indigo',
            'migrations' => 'pink',
            'relationships' => 'teal',
            'components' => 'yellow',
            'routing' => 'gray',
            'caching' => 'emerald',
            'queues' => 'cyan',
            'events' => 'violet',
            'notifications' => 'rose',
            'security' => 'amber',
            'testing' => 'purple',
            'pest' => 'purple',
            'tdd' => 'purple',
            'filament' => 'orange',
            'livewire' => 'pink',
            'vue' => 'green',
            'react' => 'cyan',
            'javascript' => 'yellow',
            'typescript' => 'blue',
            'frontend' => 'green',
            'api' => 'pink',
            'docker' => 'blue',
            'devops' => 'orange',
        ];

        return $colorMap[$colorOrSlug] ?? 'gray';
    }

    #[Computed]
    public function levels(): array
    {
        return [
            ['id' => 'beginner', 'name' => 'Beginner', 'description' => 'New to the topic'],
            ['id' => 'intermediate', 'name' => 'Intermediate', 'description' => 'Some experience'],
            ['id' => 'advanced', 'name' => 'Advanced', 'description' => 'Expert level'],
        ];
    }

    #[Computed]
    public function pathways(): array
    {
        // Build base query
        $pathwaysQuery = Pathway::published()->with(['category', 'user', 'tags', 'pathwayItems']);

        // Apply filters
        if ($this->selectedCategory) {
            $pathwaysQuery->whereHas('category', fn ($q) => $q->where('slug', $this->selectedCategory));
        }

        if ($this->selectedLevel) {
            $pathwaysQuery->where('level', $this->selectedLevel);
        }

        if ($this->search) {
            $searchTerm = '%'.$this->search.'%';
            $pathwaysQuery->where(function ($q) use ($searchTerm) {
                $q->where('title', 'ILIKE', $searchTerm)
                    ->orWhere('description', 'ILIKE', $searchTerm);
            });
        }

        if (! empty($this->selectedTags)) {
            $pathwaysQuery->whereHas('tags', fn ($q) => $q->whereIn('slug', $this->selectedTags));
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'popular':
                $pathwaysQuery->orderByDesc('students_count');
                break;
            case 'alphabetical':
                $pathwaysQuery->orderBy('title');
                break;
            case 'duration':
                $pathwaysQuery->orderBy('total_duration_minutes');
                break;
            default: // recent
                $pathwaysQuery->orderByDesc('published_at');
        }

        $pathways = $pathwaysQuery->get();

        return $pathways->map(function (Pathway $pathway) {
            return $this->formatPathwayForFrontend($pathway);
        })->toArray();
    }

    private function formatPathwayForFrontend(Pathway $pathway): array
    {
        // Calculate user progress if authenticated
        $userProgress = 0;
        if (auth()->check()) {
            $progress = UserProgress::where('user_id', auth()->id())
                ->where('progressable_type', Pathway::class)
                ->where('progressable_id', $pathway->id)
                ->first();
            $userProgress = $progress ? $progress->progress_percentage : 0;
        }

        return [
            'id' => $pathway->id,
            'slug' => $pathway->slug,
            'title' => $pathway->title,
            'description' => $pathway->description,
            'duration' => $pathway->formatted_duration,
            'students' => $pathway->students_count,
            'lessons' => $pathway->items_count,
            'level' => $pathway->level,
            'category' => $pathway->category?->slug ?? '',
            'thumbnail' => $pathway->thumbnail,
            'instructor' => $pathway->user?->name ?? '',
            'progress' => $userProgress,
            'rating' => (float) $pathway->rating,
            'tags' => $pathway->tags->pluck('slug')->toArray(),
            'url' => route('watch.pathway.show', ['slug' => $pathway->slug]),
        ];
    }

    #[Computed]
    public function continueWatching(): array
    {
        if (! auth()->check()) {
            return [];
        }

        // Get user's progress records for Series and Episodes that are in progress
        $seriesProgress = UserProgress::forUser(auth()->id())
            ->inProgress()
            ->where('progressable_type', Series::class)
            ->with(['progressable.category', 'progressable.user'])
            ->recentlyWatched()
            ->limit(6)
            ->get();

        $episodeProgress = UserProgress::forUser(auth()->id())
            ->inProgress()
            ->where('progressable_type', Episode::class)
            ->with(['progressable.category', 'progressable.user', 'progressable.series'])
            ->recentlyWatched()
            ->limit(6)
            ->get();

        $continueWatchingItems = [];

        // Format series progress
        foreach ($seriesProgress as $progress) {
            $series = $progress->progressable;
            if ($series && $series->is_published) {
                $continueWatchingItems[] = [
                    'id' => $series->id,
                    'type' => 'series',
                    'title' => $series->title,
                    'series' => null,
                    'progress' => (int) $progress->progress_percentage,
                    'thumbnail' => $series->thumbnail,
                    'duration' => $series->formatted_duration,
                    'url' => route('watch.series.show', ['slug' => $series->slug]),
                    'last_watched' => $progress->last_watched_at,
                    'instructor' => $series->user?->name ?? '',
                ];
            }
        }

        // Format episode progress
        foreach ($episodeProgress as $progress) {
            $episode = $progress->progressable;
            if ($episode && $episode->is_published) {
                $continueWatchingItems[] = [
                    'id' => $episode->id,
                    'type' => 'episode',
                    'title' => $episode->title,
                    'series' => $episode->series?->title ?? null,
                    'progress' => (int) $progress->progress_percentage,
                    'thumbnail' => $episode->thumbnail,
                    'duration' => $episode->formatted_duration,
                    'url' => $episode->is_standalone ?
                        route('watch.lessons.show', ['slug' => $episode->slug]) :
                        route('watch.episode.show', [
                            'seriesSlug' => $episode->series?->slug,
                            'episodeSlug' => $episode->slug,
                        ]),
                    'last_watched' => $progress->last_watched_at,
                    'instructor' => $episode->user?->name ?? '',
                ];
            }
        }

        // Sort by last watched time and return top 6
        return collect($continueWatchingItems)
            ->sortByDesc('last_watched')
            ->take(6)
            ->values()
            ->toArray();
    }

    #[Computed]
    public function watchlistItems(): array
    {
        if (! auth()->check()) {
            return [];
        }

        // Get user's watchlist items from database
        $watchlistItems = UserWatchlist::where('user_id', auth()->id())
            ->with('watchable')
            ->recent()
            ->get();

        $items = [];

        foreach ($watchlistItems as $watchlistItem) {
            $watchable = $watchlistItem->watchable;

            if (! $watchable) {
                continue;
            }

            // Format based on content type
            if ($watchable instanceof Series) {
                $items[] = array_merge(
                    $this->formatSeriesForFrontend($watchable),
                    ['added_to_watchlist' => $watchlistItem->created_at->format('M j, Y')]
                );
            } elseif ($watchable instanceof Episode) {
                $items[] = array_merge(
                    $this->formatEpisodeForFrontend($watchable),
                    ['added_to_watchlist' => $watchlistItem->created_at->format('M j, Y')]
                );
            } elseif ($watchable instanceof Pathway) {
                $items[] = array_merge(
                    $this->formatPathwayForFrontend($watchable),
                    [
                        'type' => 'pathway',
                        'added_to_watchlist' => $watchlistItem->created_at->format('M j, Y'),
                    ]
                );
            }
        }

        return $items;
    }

    #[Computed]
    public function watchlistCount(): int
    {
        if (! auth()->check()) {
            return 0;
        }

        return UserWatchlist::where('user_id', auth()->id())->count();
    }

    #[Computed]
    public function featuredContent(): array
    {
        // Get dynamic content from database
        $allContent = [];

        // Get content based on active tab and apply filters accordingly
        if ($this->activeTab === 'all' || $this->activeTab === 'series') {
            // Build series query
            $seriesQuery = Series::published()->with(['category', 'user', 'tags']);

            // Apply filters to series
            if ($this->selectedCategory) {
                $seriesQuery->whereHas('category', fn ($q) => $q->where('slug', $this->selectedCategory));
            }
            if ($this->selectedLevel) {
                $seriesQuery->where('level', $this->selectedLevel);
            }
            if ($this->search) {
                $searchTerm = '%'.$this->search.'%';
                $seriesQuery->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'ILIKE', $searchTerm)
                        ->orWhere('description', 'ILIKE', $searchTerm);
                });
            }
            if (! empty($this->selectedTags)) {
                $seriesQuery->whereHas('tags', fn ($q) => $q->whereIn('slug', $this->selectedTags));
            }

            // Apply sorting to series
            switch ($this->sortBy) {
                case 'popular':
                    $seriesQuery->orderByDesc('views_count');
                    break;
                case 'alphabetical':
                    $seriesQuery->orderBy('title');
                    break;
                case 'duration':
                    $seriesQuery->orderBy('duration_minutes');
                    break;
                default: // recent
                    $seriesQuery->orderByDesc('published_at');
            }

            $series = $seriesQuery->get();
            foreach ($series as $item) {
                $allContent[] = $this->formatSeriesForFrontend($item);
            }
        }

        if ($this->activeTab === 'all' || $this->activeTab === 'lessons') {
            // Build episodes query - for lessons tab, only standalone episodes
            $episodesQuery = Episode::published()->with(['category', 'user', 'tags', 'series']);

            // For 'lessons' tab, only show standalone episodes (not part of a series)
            if ($this->activeTab === 'lessons') {
                $episodesQuery->where('is_standalone', true);
            }

            // Apply filters to episodes
            if ($this->selectedCategory) {
                $episodesQuery->whereHas('category', fn ($q) => $q->where('slug', $this->selectedCategory));
            }
            if ($this->selectedLevel) {
                $episodesQuery->where('level', $this->selectedLevel);
            }
            if ($this->search) {
                $searchTerm = '%'.$this->search.'%';
                $episodesQuery->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'ILIKE', $searchTerm)
                        ->orWhere('description', 'ILIKE', $searchTerm);
                });
            }
            if (! empty($this->selectedTags)) {
                $episodesQuery->whereHas('tags', fn ($q) => $q->whereIn('slug', $this->selectedTags));
            }

            // Apply sorting to episodes
            switch ($this->sortBy) {
                case 'popular':
                    $episodesQuery->orderByDesc('views_count');
                    break;
                case 'alphabetical':
                    $episodesQuery->orderBy('title');
                    break;
                case 'duration':
                    $episodesQuery->orderBy('duration_minutes');
                    break;
                default: // recent
                    $episodesQuery->orderByDesc('published_at');
            }

            $episodes = $episodesQuery->get();
            foreach ($episodes as $item) {
                $allContent[] = $this->formatEpisodeForFrontend($item);
            }
        }

        // Handle pathways and watchlist tabs
        if ($this->activeTab === 'pathways' || $this->activeTab === 'watchlist') {
            return []; // These are handled by separate methods
        }

        return $allContent;
    }

    private function formatSeriesForFrontend(Series $series): array
    {
        // Calculate user progress if authenticated
        $userProgress = 0;
        if (auth()->check()) {
            $progress = UserProgress::where('user_id', auth()->id())
                ->where('progressable_type', Series::class)
                ->where('progressable_id', $series->id)
                ->first();
            $userProgress = $progress ? (int) $progress->progress_percentage : 0;
        }

        return [
            'id' => $series->id,
            'type' => 'series',
            'title' => $series->title,
            'description' => $series->description,
            'thumbnail' => $series->thumbnail,
            'episodes' => $series->episodes_count,
            'duration' => $series->formatted_duration,
            'level' => $series->level,
            'category' => $series->category?->slug ?? '',
            'instructor' => $series->user?->name ?? '',
            'views' => $series->views_count,
            'isNew' => $series->published_at?->isAfter(now()->subDays(7)) ?? false,
            'isPopular' => $series->views_count > 10000,
            'isFeatured' => $series->is_featured,
            'progress' => $userProgress,
            'tags' => $series->tags->pluck('slug')->toArray(),
            'url' => route('watch.series.show', ['slug' => $series->slug]),
        ];
    }

    private function formatEpisodeForFrontend(Episode $episode): array
    {
        // Calculate user progress if authenticated
        $userProgress = 0;
        if (auth()->check()) {
            $progress = UserProgress::where('user_id', auth()->id())
                ->where('progressable_type', Episode::class)
                ->where('progressable_id', $episode->id)
                ->first();
            $userProgress = $progress ? (int) $progress->progress_percentage : 0;
        }

        return [
            'id' => $episode->id,
            'type' => 'lesson',
            'title' => $episode->title,
            'description' => $episode->description,
            'thumbnail' => $episode->thumbnail,
            'duration' => $episode->formatted_duration,
            'level' => $episode->level,
            'category' => $episode->category?->slug ?? '',
            'instructor' => $episode->user?->name ?? '',
            'views' => $episode->views_count,
            'isNew' => $episode->published_at?->isAfter(now()->subDays(7)) ?? false,
            'isPopular' => $episode->views_count > 10000,
            'isFeatured' => $episode->is_featured,
            'isStandalone' => $episode->is_standalone,
            'series' => $episode->series?->title ?? null,
            'progress' => $userProgress,
            'tags' => $episode->tags->pluck('slug')->toArray(),
            'url' => $episode->is_standalone ?
                route('watch.lessons.show', ['slug' => $episode->slug]) :
                route('watch.episode.show', [
                    'seriesSlug' => $episode->series?->slug,
                    'episodeSlug' => $episode->slug,
                ]),
        ];
    }

    public function render()
    {
        $seoData = [
            'title' => 'Watch & Learn - Modern Video Learning Platform',
            'description' => 'Discover comprehensive video courses and tutorials for modern web development. Learn Laravel, PHP, and more through hands-on screencasts.',
            'keywords' => 'video courses, PHP tutorials, Laravel screencasts, web development videos, programming lessons',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-watch.jpg'),
        ];

        return view('livewire.watch.modern-watch-page')
            ->title('Watch & Learn - Modern Video Learning Platform')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
