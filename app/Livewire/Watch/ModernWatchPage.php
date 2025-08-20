<?php

namespace App\Livewire\Watch;

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

    public bool $showFilters = true;

    public string $activeTab = 'all'; // all, series, lessons, pathways, watchlist

    // Watchlist management
    public array $watchlist = [];

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

        // Load watchlist from session (mock data)
        $this->watchlist = session('watch.watchlist', [
            // Pre-populated with some mock items
            1, 6, 12, // IDs of items already in watchlist
        ]);
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

    public function toggleWatchlist(int $contentId): void
    {
        if ($this->isInWatchlist($contentId)) {
            $this->removeFromWatchlist($contentId);
        } else {
            $this->addToWatchlist($contentId);
        }
    }

    public function addToWatchlist(int $contentId): void
    {
        if (! $this->isInWatchlist($contentId)) {
            $this->watchlist[] = $contentId;
            session(['watch.watchlist' => $this->watchlist]);

            $this->dispatch('watchlist-updated', [
                'type' => 'added',
                'message' => 'Added to watchlist!',
            ]);
        }
    }

    public function removeFromWatchlist(int $contentId): void
    {
        $this->watchlist = array_values(array_filter($this->watchlist, fn ($id) => $id !== $contentId));
        session(['watch.watchlist' => $this->watchlist]);

        $this->dispatch('watchlist-updated', [
            'type' => 'removed',
            'message' => 'Removed from watchlist!',
        ]);
    }

    public function isInWatchlist(int $contentId): bool
    {
        return in_array($contentId, $this->watchlist);
    }

    public function clearWatchlist(): void
    {
        $this->watchlist = [];
        session(['watch.watchlist' => []]);

        $this->dispatch('watchlist-updated', [
            'type' => 'cleared',
            'message' => 'Watchlist cleared!',
        ]);
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
        return [
            ['id' => 'laravel', 'name' => 'Laravel', 'count' => 85, 'color' => 'red'],
            ['id' => 'php', 'name' => 'PHP', 'count' => 67, 'color' => 'blue'],
            ['id' => 'frontend', 'name' => 'Frontend', 'count' => 54, 'color' => 'green'],
            ['id' => 'testing', 'name' => 'Testing', 'count' => 38, 'color' => 'purple'],
            ['id' => 'devops', 'name' => 'DevOps', 'count' => 29, 'color' => 'orange'],
            ['id' => 'javascript', 'name' => 'JavaScript', 'count' => 42, 'color' => 'yellow'],
            ['id' => 'database', 'name' => 'Database', 'count' => 31, 'color' => 'indigo'],
            ['id' => 'api', 'name' => 'API Development', 'count' => 26, 'color' => 'pink'],
        ];
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
        return [
            ['name' => 'eloquent', 'count' => 45, 'color' => 'blue'],
            ['name' => 'authentication', 'count' => 38, 'color' => 'green'],
            ['name' => 'validation', 'count' => 42, 'color' => 'purple'],
            ['name' => 'middleware', 'count' => 29, 'color' => 'orange'],
            ['name' => 'blade', 'count' => 36, 'color' => 'red'],
            ['name' => 'artisan', 'count' => 31, 'color' => 'indigo'],
            ['name' => 'migrations', 'count' => 27, 'color' => 'pink'],
            ['name' => 'relationships', 'count' => 33, 'color' => 'teal'],
            ['name' => 'components', 'count' => 24, 'color' => 'yellow'],
            ['name' => 'routing', 'count' => 39, 'color' => 'gray'],
            ['name' => 'caching', 'count' => 18, 'color' => 'emerald'],
            ['name' => 'queues', 'count' => 22, 'color' => 'cyan'],
            ['name' => 'events', 'count' => 16, 'color' => 'violet'],
            ['name' => 'notifications', 'count' => 14, 'color' => 'rose'],
            ['name' => 'security', 'count' => 26, 'color' => 'amber'],
        ];
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
        return [
            [
                'id' => 'laravel-beginner',
                'title' => 'Laravel from Zero to Hero',
                'description' => 'Complete beginner-friendly path to master Laravel development',
                'duration' => '45 hours',
                'students' => 2847,
                'lessons' => 67,
                'level' => 'beginner',
                'category' => 'laravel',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600',
                'instructor' => 'Halil Coşdu',
                'progress' => 0,
                'url' => '/pathways/laravel-beginner',
            ],
            [
                'id' => 'api-mastery',
                'title' => 'API Development Mastery',
                'description' => 'Build robust APIs with Laravel, testing, and documentation',
                'duration' => '32 hours',
                'students' => 1923,
                'lessons' => 45,
                'level' => 'intermediate',
                'category' => 'api',
                'thumbnail' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=600',
                'instructor' => 'Jeffrey Way',
                'progress' => 25,
                'url' => '/pathways/api-mastery',
            ],
            [
                'id' => 'frontend-integration',
                'title' => 'Modern Frontend Integration',
                'description' => 'Connect Laravel with React, Vue, and Inertia.js',
                'duration' => '28 hours',
                'students' => 1456,
                'lessons' => 38,
                'level' => 'intermediate',
                'category' => 'frontend',
                'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=600',
                'instructor' => 'Caleb Porzio',
                'progress' => 0,
                'url' => '/pathways/frontend-integration',
            ],
        ];
    }

    #[Computed]
    public function continueWatching(): array
    {
        // Mock data - will be replaced with real data later
        return [
            [
                'id' => 1,
                'title' => 'Laravel Filament Advanced Components',
                'series' => 'Filament Deep Dive',
                'progress' => 65,
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400',
                'duration' => '12:34',
                'url' => '/watch/series/filament/episode/5',
            ],
            [
                'id' => 2,
                'title' => 'Testing with Pest: Feature Tests',
                'series' => 'Modern Testing in Laravel',
                'progress' => 30,
                'thumbnail' => 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=400',
                'duration' => '08:45',
                'url' => '/watch/series/testing/episode/3',
            ],
            [
                'id' => 3,
                'title' => 'Building APIs with Laravel Sanctum',
                'series' => 'API Development Mastery',
                'progress' => 85,
                'thumbnail' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=400',
                'duration' => '15:22',
                'url' => '/watch/series/api/episode/8',
            ],
            [
                'id' => 4,
                'title' => 'Livewire Component Communication',
                'series' => 'Advanced Livewire',
                'progress' => 45,
                'thumbnail' => 'https://images.unsplash.com/photo-1536148935331-408321065b18?w=400',
                'duration' => '09:15',
                'url' => '/watch/series/livewire/episode/12',
            ],
        ];
    }

    #[Computed]
    public function watchlistItems(): array
    {
        if (empty($this->watchlist)) {
            return [];
        }

        // Get all content and filter by watchlist IDs
        $allContent = $this->getAllContent();

        return collect($allContent)
            ->whereIn('id', $this->watchlist)
            ->map(function ($item) {
                $item['added_to_watchlist'] = now()->subDays(rand(1, 30))->format('M j, Y');

                return $item;
            })
            ->sortByDesc(function ($item) {
                // Sort by recently added to watchlist
                return array_search($item['id'], array_reverse($this->watchlist));
            })
            ->values()
            ->toArray();
    }

    #[Computed]
    public function watchlistCount(): int
    {
        return count($this->watchlist);
    }

    private function getAllContent(): array
    {
        // Combined content from featuredContent and pathways
        return array_merge($this->featuredContent, $this->pathways);
    }

    #[Computed]
    public function featuredContent(): array
    {
        $allContent = [
            // Series
            [
                'id' => 1,
                'type' => 'series',
                'title' => 'Master Laravel 11',
                'description' => 'Complete guide to Laravel 11 features and best practices including new capabilities and modern patterns',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                'episodes' => 24,
                'duration' => '8 hours',
                'level' => 'intermediate',
                'category' => 'laravel',
                'instructor' => 'Halil Coşdu',
                'views' => 12450,
                'rating' => 4.9,
                'isNew' => true,
                'tags' => ['eloquent', 'artisan', 'blade', 'routing'],
                'url' => '/watch/series/laravel-11',
            ],
            [
                'id' => 2,
                'type' => 'series',
                'title' => 'Advanced Filament Development',
                'description' => 'Deep dive into Filament v4 with custom components, actions, and complex relationships',
                'thumbnail' => 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=800',
                'episodes' => 18,
                'duration' => '6.5 hours',
                'level' => 'advanced',
                'category' => 'laravel',
                'instructor' => 'Jeffrey Way',
                'views' => 8920,
                'rating' => 4.8,
                'isPopular' => true,
                'tags' => ['components', 'relationships', 'validation'],
                'url' => '/watch/series/filament-advanced',
            ],
            [
                'id' => 3,
                'type' => 'series',
                'title' => 'Testing Laravel Applications',
                'description' => 'Comprehensive testing strategies with Pest, feature tests, and TDD approach',
                'thumbnail' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=800',
                'episodes' => 15,
                'duration' => '5 hours',
                'level' => 'intermediate',
                'category' => 'testing',
                'instructor' => 'Taylor Otwell',
                'views' => 6750,
                'rating' => 4.7,
                'tags' => ['testing', 'validation', 'security'],
                'url' => '/watch/series/testing-laravel',
            ],
            [
                'id' => 4,
                'type' => 'series',
                'title' => 'API Development with Laravel',
                'description' => 'Build robust REST APIs with authentication, rate limiting, and documentation',
                'thumbnail' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=800',
                'episodes' => 22,
                'duration' => '7.5 hours',
                'level' => 'intermediate',
                'category' => 'api',
                'instructor' => 'Caleb Porzio',
                'views' => 9340,
                'rating' => 4.6,
                'tags' => ['authentication', 'middleware', 'validation'],
                'url' => '/watch/series/api-development',
            ],
            [
                'id' => 5,
                'type' => 'series',
                'title' => 'Modern PHP Practices',
                'description' => 'Learn PHP 8.4 features, design patterns, and clean code principles',
                'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
                'episodes' => 20,
                'duration' => '6 hours',
                'level' => 'beginner',
                'category' => 'php',
                'instructor' => 'Halil Coşdu',
                'views' => 11280,
                'rating' => 4.8,
                'isPopular' => true,
                'tags' => ['eloquent', 'caching', 'events'],
                'url' => '/watch/series/modern-php',
            ],

            // Individual Lessons
            [
                'id' => 6,
                'type' => 'lesson',
                'title' => 'Building Real-time Apps with Livewire',
                'description' => 'Learn to create dynamic interfaces without leaving PHP using Livewire v3 features',
                'thumbnail' => 'https://images.unsplash.com/photo-1536148935331-408321065b18?w=800',
                'duration' => '45 min',
                'level' => 'beginner',
                'category' => 'laravel',
                'instructor' => 'Caleb Porzio',
                'views' => 15670,
                'rating' => 4.9,
                'isPopular' => true,
                'tags' => ['components', 'events', 'blade'],
                'url' => '/watch/lesson/livewire-realtime',
            ],
            [
                'id' => 7,
                'type' => 'lesson',
                'title' => 'Database Optimization Techniques',
                'description' => 'Advanced MySQL optimization, indexing strategies, and query performance tuning',
                'thumbnail' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800',
                'duration' => '52 min',
                'level' => 'advanced',
                'category' => 'database',
                'instructor' => 'Jeffrey Way',
                'views' => 7890,
                'rating' => 4.7,
                'tags' => ['eloquent', 'migrations', 'caching'],
                'url' => '/watch/lesson/database-optimization',
            ],
            [
                'id' => 8,
                'type' => 'lesson',
                'title' => 'Docker for Laravel Development',
                'description' => 'Set up consistent development environments with Docker and Laravel Sail',
                'thumbnail' => 'https://images.unsplash.com/photo-1605745341112-85968b19335b?w=800',
                'duration' => '38 min',
                'level' => 'intermediate',
                'category' => 'devops',
                'instructor' => 'Taylor Otwell',
                'views' => 5440,
                'rating' => 4.5,
                'isNew' => true,
                'tags' => ['artisan', 'queues'],
                'url' => '/watch/lesson/docker-laravel',
            ],
            [
                'id' => 9,
                'type' => 'lesson',
                'title' => 'Advanced JavaScript ES2024',
                'description' => 'Latest JavaScript features and modern development patterns for web applications',
                'thumbnail' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=800',
                'duration' => '41 min',
                'level' => 'intermediate',
                'category' => 'javascript',
                'instructor' => 'Halil Coşdu',
                'views' => 8920,
                'rating' => 4.6,
                'url' => '/watch/lesson/javascript-es2024',
            ],
            [
                'id' => 10,
                'type' => 'lesson',
                'title' => 'Vue.js 3 Composition API',
                'description' => 'Master the Composition API and reactive programming in Vue.js 3',
                'thumbnail' => 'https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?w=800',
                'duration' => '55 min',
                'level' => 'intermediate',
                'category' => 'frontend',
                'instructor' => 'Caleb Porzio',
                'views' => 6720,
                'rating' => 4.8,
                'url' => '/watch/lesson/vue-composition-api',
            ],
            [
                'id' => 11,
                'type' => 'series',
                'title' => 'Frontend Build Tools Mastery',
                'description' => 'Deep dive into Vite, Webpack, and modern build processes for web development',
                'thumbnail' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=800',
                'episodes' => 12,
                'duration' => '4 hours',
                'level' => 'intermediate',
                'category' => 'frontend',
                'instructor' => 'Jeffrey Way',
                'views' => 4530,
                'rating' => 4.7,
                'url' => '/watch/series/build-tools',
            ],
            [
                'id' => 12,
                'type' => 'lesson',
                'title' => 'Security Best Practices for Laravel',
                'description' => 'Implement comprehensive security measures and protect against common vulnerabilities',
                'thumbnail' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800',
                'duration' => '49 min',
                'level' => 'advanced',
                'category' => 'laravel',
                'instructor' => 'Taylor Otwell',
                'views' => 9870,
                'rating' => 4.9,
                'isPopular' => true,
                'url' => '/watch/lesson/laravel-security',
            ],
        ];

        // Filter based on active tab and other criteria
        $filtered = collect($allContent);

        if ($this->activeTab !== 'all') {
            if ($this->activeTab === 'pathways') {
                return []; // Pathways are handled separately
            }
            if ($this->activeTab === 'watchlist') {
                return []; // Watchlist is handled separately
            }
            $filtered = $filtered->where('type', $this->activeTab === 'lessons' ? 'lesson' : $this->activeTab);
        }

        if ($this->selectedCategory) {
            $filtered = $filtered->where('category', $this->selectedCategory);
        }

        if ($this->selectedLevel) {
            $filtered = $filtered->where('level', $this->selectedLevel);
        }

        if ($this->selectedInstructor) {
            $filtered = $filtered->where('instructor', function ($instructor) {
                $instructorMap = [
                    'halil' => 'Halil Coşdu',
                    'taylor' => 'Taylor Otwell',
                    'jeffrey' => 'Jeffrey Way',
                    'caleb' => 'Caleb Porzio',
                ];

                return $instructorMap[$this->selectedInstructor] ?? '';
            });
        }

        if ($this->search) {
            $filtered = $filtered->filter(function ($item) {
                return str_contains(strtolower($item['title']), strtolower($this->search)) ||
                       str_contains(strtolower($item['description']), strtolower($this->search)) ||
                       (isset($item['tags']) && collect($item['tags'])->some(fn ($tag) => str_contains(strtolower($tag), strtolower($this->search))));
            });
        }

        if (! empty($this->selectedTags)) {
            $filtered = $filtered->filter(function ($item) {
                if (! isset($item['tags'])) {
                    return false;
                }

                return collect($this->selectedTags)->every(fn ($selectedTag) => collect($item['tags'])->contains($selectedTag)
                );
            });
        }

        // Sort
        switch ($this->sortBy) {
            case 'popular':
                $filtered = $filtered->sortByDesc('views');
                break;
            case 'alphabetical':
                $filtered = $filtered->sortBy('title');
                break;
            case 'duration':
                $filtered = $filtered->sortBy(function ($item) {
                    if (isset($item['episodes'])) {
                        return $item['episodes'] * 25; // Estimate minutes per episode
                    }

                    return (int) $item['duration'];
                });
                break;
            default: // recent
                $filtered = $filtered->reverse();
        }

        return $filtered->values()->toArray();
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
