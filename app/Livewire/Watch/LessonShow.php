<?php

namespace App\Livewire\Watch;

use App\Models\Episode;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LessonShow extends Component
{
    public Episode $episode;

    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;

        // Find standalone episode
        $this->episode = Episode::published()
            ->with(['category', 'user', 'tags'])
            ->where('slug', $slug)
            ->where('is_standalone', true)
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
        if (! auth()->check()) {
            return;
        }

        // Update lesson progress
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
        if (! auth()->check()) {
            return;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->where('progressable_id', $this->episode->id)
            ->first();

        if ($progress) {
            $progress->markAsCompleted();

            $this->dispatch('lesson-completed', [
                'lesson_id' => $this->episode->id,
                'message' => 'Lesson completed! 🎉',
            ]);
        }
    }

    #[Computed]
    public function isInWatchlist(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return UserWatchlist::isInWatchlist(auth()->id(), Episode::class, $this->episode->id);
    }

    #[Computed]
    public function userProgress(): int
    {
        if (! auth()->check()) {
            return 0;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->where('progressable_id', $this->episode->id)
            ->first();

        return $progress ? (int) $progress->progress_percentage : 0;
    }

    #[Computed]
    public function relatedLessons(): array
    {
        // Get similar standalone episodes from same category or with similar tags
        $episodes = Episode::published()
            ->where('is_standalone', true)
            ->where('id', '!=', $this->episode->id)
            ->where(function ($query) {
                $query->where('category_id', $this->episode->category_id)
                    ->orWhereHas('tags', function ($tagQuery) {
                        $tagQuery->whereIn('slug', $this->episode->tags->pluck('slug')->toArray());
                    });
            })
            ->orderByDesc('views_count')
            ->limit(6)
            ->get();

        return $episodes->map(function (Episode $episode) {
            return [
                'id' => $episode->id,
                'title' => $episode->title,
                'duration' => $episode->formatted_duration,
                'level' => $episode->level,
                'thumbnail' => $episode->thumbnail,
                'url' => route('watch.lesson.show', ['slug' => $episode->slug]),
                'category' => $episode->category?->name ?? '',
                'views' => $episode->views_count,
            ];
        })->toArray();
    }

    public function render()
    {
        $seoData = [
            'title' => $this->episode->title.' - Standalone Lesson',
            'description' => $this->episode->description,
            'keywords' => implode(', ', $this->episode->tags->pluck('name')->toArray()),
            'url' => request()->url(),
            'type' => 'video.other',
            'image' => $this->episode->thumbnail,
        ];

        return view('livewire.watch.lesson-show')
            ->title($this->episode->title.' - Standalone Lesson')
            ->layout('components.layouts.app', compact('seoData'));
    }
}
