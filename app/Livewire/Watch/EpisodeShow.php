<?php

namespace App\Livewire\Watch;

use App\Models\Series;
use App\Models\Episode;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Component;

class EpisodeShow extends Component
{
    public Episode $episode;
    public ?Series $series = null;
    public string $seriesSlug;
    public string $episodeSlug;

    public function mount(string $seriesSlug, string $episodeSlug): void
    {
        $this->seriesSlug = $seriesSlug;
        $this->episodeSlug = $episodeSlug;
        
        // Find the series first
        $this->series = Series::published()
            ->with(['category', 'user', 'tags'])
            ->where('slug', $seriesSlug)
            ->firstOrFail();

        // Find the episode within this series
        $this->episode = Episode::published()
            ->with(['category', 'user', 'tags', 'series'])
            ->where('slug', $episodeSlug)
            ->where('series_id', $this->series->id)
            ->firstOrFail();
    }

    public function toggleWatchlist(): void
    {
        if (!auth()->check()) {
            $this->dispatch('auth-required', [
                'message' => 'Please login to manage your watchlist.',
            ]);
            return;
        }

        if ($this->isInWatchlist) {
            UserWatchlist::removeFromWatchlist(auth()->id(), Episode::class, $this->episode->id);
            $this->dispatch('watchlist-updated', [
                'type' => 'removed',
                'message' => 'Removed from watchlist!',
            ]);
        } else {
            UserWatchlist::addToWatchlist(auth()->id(), Episode::class, $this->episode->id);
            $this->dispatch('watchlist-updated', [
                'type' => 'added',
                'message' => 'Added to watchlist!',
            ]);
        }
    }

    public function updateProgress(int $watchedSeconds, int $totalSeconds): void
    {
        if (!auth()->check()) {
            return;
        }

        // Update episode-level progress
        $progress = UserProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'progressable_type' => Episode::class,
            'progressable_id' => $this->episode->id,
        ], [
            'watched_seconds' => 0,
            'total_seconds' => $this->episode->duration_minutes * 60,
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

    public function markAsCompleted(): void
    {
        if (!auth()->check()) {
            return;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->where('progressable_id', $this->episode->id)
            ->first();

        if ($progress) {
            $progress->markAsCompleted();
            
            $this->dispatch('episode-completed', [
                'episode_id' => $this->episode->id,
                'message' => 'Episode completed! 🎉',
            ]);
        }
    }

    #[Computed]
    public function isInWatchlist(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return UserWatchlist::isInWatchlist(auth()->id(), Episode::class, $this->episode->id);
    }

    #[Computed]
    public function userProgress(): int
    {
        if (!auth()->check()) {
            return 0;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->where('progressable_id', $this->episode->id)
            ->first();

        return $progress ? (int) $progress->progress_percentage : 0;
    }

    #[Computed]
    public function nextEpisode(): ?Episode
    {
        if (!$this->series) {
            return null;
        }

        return Episode::published()
            ->where('series_id', $this->series->id)
            ->where('episode_number', '>', $this->episode->episode_number)
            ->orderBy('episode_number')
            ->first();
    }

    #[Computed]
    public function previousEpisode(): ?Episode
    {
        if (!$this->series) {
            return null;
        }

        return Episode::published()
            ->where('series_id', $this->series->id)
            ->where('episode_number', '<', $this->episode->episode_number)
            ->orderByDesc('episode_number')
            ->first();
    }

    #[Computed]
    public function relatedEpisodes(): array
    {
        if (!$this->series) {
            return [];
        }

        $episodes = Episode::published()
            ->where('series_id', $this->series->id)
            ->where('id', '!=', $this->episode->id)
            ->orderBy('episode_number')
            ->limit(6)
            ->get();

        return $episodes->map(function (Episode $episode) {
            return [
                'id' => $episode->id,
                'title' => $episode->title,
                'episode_number' => $episode->episode_number,
                'duration' => $episode->formatted_duration,
                'thumbnail' => $episode->thumbnail,
                'url' => route('watch.episode.show', [
                    'seriesSlug' => $this->series->slug,
                    'episodeSlug' => $episode->slug
                ]),
            ];
        })->toArray();
    }

    public function render()
    {
        $seoData = [
            'title' => $this->episode->title . ' - ' . ($this->series?->title ?? 'Episode'),
            'description' => $this->episode->description,
            'keywords' => implode(', ', $this->episode->tags->pluck('name')->toArray()),
            'url' => request()->url(),
            'type' => 'video.episode',
            'image' => $this->episode->thumbnail,
        ];

        return view('livewire.watch.episode-show')
            ->title($this->episode->title . ' - ' . ($this->series?->title ?? 'Episode'))
            ->layout('components.layouts.app', compact('seoData'));
    }
}
