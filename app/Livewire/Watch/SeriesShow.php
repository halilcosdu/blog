<?php

namespace App\Livewire\Watch;

use App\Models\Episode;
use App\Models\Series;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SeriesShow extends Component
{
    public Series $series;

    public ?Episode $currentEpisode = null;

    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;

        $this->series = Series::published()
            ->with(['category', 'user', 'tags', 'episodes' => function ($query) {
                $query->where('is_published', true)->orderBy('episode_number');
            }])
            ->where('slug', $slug)
            ->firstOrFail();

        // Set current episode to first episode if none specified
        $this->currentEpisode = $this->series->episodes->first();
    }

    public function selectEpisode(int $episodeId): void
    {
        $episode = $this->series->episodes->where('id', $episodeId)->first();

        if ($episode) {
            $this->currentEpisode = $episode;
            $this->dispatch('episode-changed', ['episode' => $episode->id]);
        }
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
            UserWatchlist::removeFromWatchlist(auth()->id(), Series::class, $this->series->id);
            $this->dispatch('watchlist-updated', [
                'type' => 'removed',
                'message' => 'Removed from watchlist!',
            ]);
        } else {
            UserWatchlist::addToWatchlist(auth()->id(), Series::class, $this->series->id);
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

        // Update series-level progress
        $progress = UserProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'progressable_type' => Series::class,
            'progressable_id' => $this->series->id,
        ], [
            'watched_seconds' => 0,
            'total_seconds' => $this->series->duration_minutes * 60,
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

        return UserWatchlist::isInWatchlist(auth()->id(), Series::class, $this->series->id);
    }

    #[Computed]
    public function userProgress(): int
    {
        if (! auth()->check()) {
            return 0;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Series::class)
            ->where('progressable_id', $this->series->id)
            ->first();

        return $progress ? (int) $progress->progress_percentage : 0;
    }

    #[Computed]
    public function episodeProgress(): array
    {
        if (! auth()->check()) {
            return [];
        }

        $episodeIds = $this->series->episodes->pluck('id')->toArray();

        $progressRecords = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->whereIn('progressable_id', $episodeIds)
            ->get()
            ->keyBy('progressable_id');

        $progress = [];
        foreach ($this->series->episodes as $episode) {
            $episodeProgress = $progressRecords->get($episode->id);
            $progress[$episode->id] = $episodeProgress ? (int) $episodeProgress->progress_percentage : 0;
        }

        return $progress;
    }

    #[Computed]
    public function nextEpisode(): ?Episode
    {
        if (! $this->currentEpisode) {
            return null;
        }

        return $this->series->episodes
            ->where('episode_number', '>', $this->currentEpisode->episode_number)
            ->first();
    }

    #[Computed]
    public function previousEpisode(): ?Episode
    {
        if (! $this->currentEpisode) {
            return null;
        }

        return $this->series->episodes
            ->where('episode_number', '<', $this->currentEpisode->episode_number)
            ->sortByDesc('episode_number')
            ->first();
    }

    public function render()
    {
        $seoData = [
            'title' => $this->series->title.' - Video Series',
            'description' => $this->series->description,
            'keywords' => implode(', ', $this->series->tags->pluck('name')->toArray()),
            'url' => request()->url(),
            'type' => 'video.tv_show',
            'image' => $this->series->thumbnail,
        ];

        return view('livewire.watch.series-show')
            ->title($this->series->title.' - Video Series')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
