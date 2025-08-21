<?php

namespace App\Livewire\Watch;

use App\Models\Episode;
use App\Models\Pathway;
use App\Models\Series;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PathwayShow extends Component
{
    public Pathway $pathway;

    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;

        $this->pathway = Pathway::published()
            ->with(['category', 'user', 'tags', 'pathwayItems' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function toggleWatchlist(): void
    {
        if (! auth()->check()) {
            $this->dispatch('auth-required', [
                'message' => 'Please login to manage your watchlist.',
            ]);

            return;
        }

        if ($this->isInWatchlist) {
            UserWatchlist::removeFromWatchlist(auth()->id(), Pathway::class, $this->pathway->id);
            $this->dispatch('watchlist-updated', [
                'type' => 'removed',
                'message' => 'Removed from watchlist!',
            ]);
        } else {
            UserWatchlist::addToWatchlist(auth()->id(), Pathway::class, $this->pathway->id);
            $this->dispatch('watchlist-updated', [
                'type' => 'added',
                'message' => 'Added to watchlist!',
            ]);
        }
    }

    public function updateProgress(int $watchedSeconds, int $totalSeconds): void
    {
        if (! auth()->check()) {
            return;
        }

        // Update pathway-level progress
        $progress = UserProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'progressable_type' => Pathway::class,
            'progressable_id' => $this->pathway->id,
        ], [
            'watched_seconds' => 0,
            'total_seconds' => $this->pathway->total_duration_minutes * 60,
            'progress_percentage' => 0,
            'is_completed' => false,
        ]);

        $progress->update([
            'watched_seconds' => $watchedSeconds,
            'total_seconds' => $totalSeconds,
        ]);

        $this->dispatch('progress-updated', [
            'progress' => $progress->progress_percentage,
            'is_completed' => $progress->is_completed,
        ]);
    }

    #[Computed]
    public function isInWatchlist(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return UserWatchlist::isInWatchlist(auth()->id(), Pathway::class, $this->pathway->id);
    }

    #[Computed]
    public function userProgress(): int
    {
        if (! auth()->check()) {
            return 0;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Pathway::class)
            ->where('progressable_id', $this->pathway->id)
            ->first();

        return $progress ? (int) $progress->progress_percentage : 0;
    }

    #[Computed]
    public function pathwayItems(): array
    {
        $items = [];

        foreach ($this->pathway->pathwayItems as $pathwayItem) {
            $item = null;
            $type = '';
            $url = '';
            $progress = 0;

            if ($pathwayItem->item_type === Series::class) {
                $item = Series::with(['category', 'user'])->find($pathwayItem->item_id);
                $type = 'series';
                $url = route('watch.series.show', ['slug' => $item?->slug]);

                if (auth()->check() && $item) {
                    $userProgress = UserProgress::where('user_id', auth()->id())
                        ->where('progressable_type', Series::class)
                        ->where('progressable_id', $item->id)
                        ->first();
                    $progress = $userProgress ? (int) $userProgress->progress_percentage : 0;
                }
            } elseif ($pathwayItem->item_type === Episode::class) {
                $item = Episode::with(['category', 'user', 'series'])->find($pathwayItem->item_id);
                $type = 'episode';

                if ($item) {
                    $url = $item->is_standalone ?
                        route('watch.lessons.show', ['slug' => $item->slug]) :
                        route('watch.episode.show', [
                            'seriesSlug' => $item->series?->slug,
                            'episodeSlug' => $item->slug,
                        ]);
                }

                if (auth()->check() && $item) {
                    $userProgress = UserProgress::where('user_id', auth()->id())
                        ->where('progressable_type', Episode::class)
                        ->where('progressable_id', $item->id)
                        ->first();
                    $progress = $userProgress ? (int) $userProgress->progress_percentage : 0;
                }
            }

            if ($item) {
                $items[] = [
                    'id' => $item->id,
                    'type' => $type,
                    'title' => $item->title,
                    'description' => $item->description,
                    'thumbnail' => $item->thumbnail,
                    'duration' => $item->formatted_duration ?? ($item->duration_minutes.' min'),
                    'level' => $item->level,
                    'category' => $item->category?->name ?? '',
                    'instructor' => $item->user?->name ?? '',
                    'url' => $url,
                    'progress' => $progress,
                    'is_required' => $pathwayItem->is_required,
                    'sort_order' => $pathwayItem->sort_order,
                    'series_title' => $type === 'episode' && ! $item->is_standalone ? $item->series?->title : null,
                ];
            }
        }

        return $items;
    }

    #[Computed]
    public function relatedPathways(): array
    {
        // Get similar pathways from same category or with similar tags
        $pathways = Pathway::published()
            ->where('id', '!=', $this->pathway->id)
            ->where(function ($query) {
                $query->where('category_id', $this->pathway->category_id)
                    ->orWhereHas('tags', function ($tagQuery) {
                        $tagQuery->whereIn('slug', $this->pathway->tags->pluck('slug')->toArray());
                    });
            })
            ->orderByDesc('students_count')
            ->limit(6)
            ->get();

        return $pathways->map(function (Pathway $pathway) {
            return [
                'id' => $pathway->id,
                'title' => $pathway->title,
                'description' => $pathway->excerpt,
                'duration' => $pathway->formatted_duration,
                'level' => $pathway->level,
                'thumbnail' => $pathway->thumbnail,
                'url' => route('watch.pathway.show', ['slug' => $pathway->slug]),
                'students' => $pathway->students_count,
                'items' => $pathway->items_count,
                'category' => $pathway->category?->name ?? '',
            ];
        })->toArray();
    }

    public function render()
    {
        $seoData = [
            'title' => $this->pathway->title.' - Learning Pathway',
            'description' => $this->pathway->description,
            'keywords' => implode(', ', $this->pathway->tags->pluck('name')->toArray()),
            'url' => request()->url(),
            'type' => 'website',
            'image' => $this->pathway->thumbnail,
        ];

        return view('livewire.watch.pathway-show')
            ->title($this->pathway->title.' - Learning Pathway')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
