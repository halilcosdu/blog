<?php

namespace App\Livewire\Watch;

use App\Models\Episode;
use App\Models\EpisodeComment;
use App\Models\Series;
use App\Models\UserProgress;
use App\Models\UserWatchlist;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EpisodeShow extends Component
{
    public Episode $episode;

    public ?Series $series = null;

    public string $seriesSlug;

    public string $episodeSlug;

    #[Rule('required|string|min:10|max:1000')]
    public string $newComment = '';

    public ?int $editingCommentId = null;

    #[Rule('required|string|min:10|max:1000')]
    public string $editCommentContent = '';

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
            ->with(['category', 'user', 'tags', 'series', 'comments.user'])
            ->where('slug', $episodeSlug)
            ->where('series_id', $this->series->id)
            ->firstOrFail();
    }

    public function toggleWatchlist(): void
    {
        if (! auth()->check()) {
            $this->dispatch('show-notification', [
                'type' => 'warning',
                'message' => 'Please login to manage your watchlist',
            ]);

            return;
        }

        if ($this->isInWatchlist) {
            UserWatchlist::removeFromWatchlist(auth()->id(), Episode::class, $this->episode->id);
            $this->dispatch('show-notification', [
                'type' => 'info',
                'message' => 'Episode removed from your watchlist',
            ]);
        } else {
            UserWatchlist::addToWatchlist(auth()->id(), Episode::class, $this->episode->id);
            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Episode added to your watchlist',
            ]);
        }

        // Force refresh the computed property
        unset($this->isInWatchlist);
    }

    public function updateProgress(int $watchedSeconds, int $totalSeconds): void
    {
        if (! auth()->check()) {
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
        if (! auth()->check()) {
            return;
        }

        $progress = UserProgress::where('user_id', auth()->id())
            ->where('progressable_type', Episode::class)
            ->where('progressable_id', $this->episode->id)
            ->first();

        if ($progress) {
            $progress->markAsCompleted();

            $this->dispatch('show-notification', [
                'type' => 'success',
                'message' => 'Episode completed! 🎉',
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
    public function nextEpisode(): ?Episode
    {
        if (! $this->series) {
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
        if (! $this->series) {
            return null;
        }

        return Episode::published()
            ->where('series_id', $this->series->id)
            ->where('episode_number', '<', $this->episode->episode_number)
            ->orderByDesc('episode_number')
            ->first();
    }

    #[On('content-updated')]
    public function updateCommentContent(string $name, string $content): void
    {
        if ($name === 'newComment') {
            $this->newComment = $content;
        } elseif ($name === 'editCommentContent') {
            $this->editCommentContent = $content;
        }
    }

    public function postComment(): void
    {
        if (! auth()->check()) {
            $this->dispatch('show-notification', [
                'type' => 'warning',
                'message' => 'Please login to post a comment',
            ]);

            return;
        }

        $this->validateOnly('newComment');

        EpisodeComment::create([
            'episode_id' => $this->episode->id,
            'user_id' => auth()->id(),
            'content' => $this->newComment,
        ]);

        // Reset the form and clear the editor
        $this->newComment = '';
        $this->dispatch('clear-editor-content');
        $this->dispatch('show-notification', [
            'type' => 'success',
            'message' => 'Your comment has been posted!',
        ]);

        // Refresh episode with comments
        $this->episode->load('comments.user');
    }

    public function startEditingComment(int $commentId): void
    {
        $comment = EpisodeComment::findOrFail($commentId);

        // Only comment author can edit their comment
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'You can only edit your own comments.');
        }

        $this->editingCommentId = $commentId;
        $this->editCommentContent = $comment->content;
    }

    public function updateComment(): void
    {
        $this->validateOnly('editCommentContent');

        $comment = EpisodeComment::findOrFail($this->editingCommentId);

        // Only comment author can edit their comment
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'You can only edit your own comments.');
        }

        $comment->update([
            'content' => $this->editCommentContent,
        ]);

        // Reset editing state
        $this->editingCommentId = null;
        $this->editCommentContent = '';
        $this->dispatch('comment-updated');

        // Refresh episode with comments
        $this->episode->load('comments.user');

        $this->dispatch('show-notification', [
            'type' => 'success',
            'message' => 'Comment updated successfully!',
        ]);
    }

    public function cancelEditingComment(): void
    {
        $this->editingCommentId = null;
        $this->editCommentContent = '';
    }

    public function deleteComment(int $commentId): void
    {
        $comment = EpisodeComment::findOrFail($commentId);

        // Only comment author can delete their comment
        if (auth()->id() !== $comment->user_id) {
            abort(403, 'You can only delete your own comments.');
        }

        $comment->delete();

        // Refresh episode with comments
        $this->episode->load('comments.user');

        $this->dispatch('show-notification', [
            'type' => 'success',
            'message' => 'Comment deleted successfully!',
        ]);
    }

    public function markAsBestAnswer(int $commentId): void
    {
        // Only episode author can mark best answer
        if (auth()->id() !== $this->episode->user_id) {
            abort(403, 'Only the episode author can mark a best answer.');
        }

        $comment = EpisodeComment::findOrFail($commentId);

        // Ensure the comment belongs to this episode
        if ($comment->episode_id !== $this->episode->id) {
            abort(403, 'This comment does not belong to this episode.');
        }

        $comment->markAsBestAnswer();

        // Refresh episode with comments
        $this->episode->load('comments.user');

        $this->dispatch('show-notification', [
            'type' => 'success',
            'message' => 'Comment marked as best answer!',
        ]);
    }

    #[Computed]
    public function commentsCount(): int
    {
        return $this->episode->comments->count();
    }

    public function render()
    {
        $seoData = [
            'title' => $this->episode->title.' - '.($this->series?->title ?? 'Episode'),
            'description' => $this->episode->description,
            'keywords' => implode(', ', $this->episode->tags->pluck('name')->toArray()),
            'url' => request()->url(),
            'type' => 'video.episode',
            'image' => $this->episode->thumbnail,
        ];

        return view('livewire.watch.episode-show')
            ->title($this->episode->title.' - '.($this->series?->title ?? 'Episode'))
            ->layout('components.layouts.app', compact('seoData'));
    }
}
