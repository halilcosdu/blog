<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'progressable_type',
        'progressable_id',
        'watched_seconds',
        'total_seconds',
        'progress_percentage',
        'is_completed',
        'started_at',
        'completed_at',
        'last_watched_at',
    ];

    protected function casts(): array
    {
        return [
            'watched_seconds' => 'integer',
            'total_seconds' => 'integer',
            'progress_percentage' => 'decimal:2',
            'is_completed' => 'boolean',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'last_watched_at' => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::updating(function (UserProgress $progress) {
            // Auto-calculate progress percentage
            if ($progress->total_seconds > 0) {
                $progress->progress_percentage = min(100, ($progress->watched_seconds / $progress->total_seconds) * 100);
            }

            // Mark as completed if progress is 100%
            if ($progress->progress_percentage >= 100 && !$progress->is_completed) {
                $progress->is_completed = true;
                $progress->completed_at = now();
            }

            // Set started_at if not set
            if (!$progress->started_at && $progress->watched_seconds > 0) {
                $progress->started_at = now();
            }

            // Update last_watched_at
            if ($progress->isDirty('watched_seconds')) {
                $progress->last_watched_at = now();
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function progressable(): MorphTo
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('is_completed', true);
    }

    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('is_completed', false)
                    ->where('watched_seconds', '>', 0);
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecentlyWatched(Builder $query): Builder
    {
        return $query->whereNotNull('last_watched_at')
                    ->orderByDesc('last_watched_at');
    }

    // Helper methods
    public function updateProgress(int $watchedSeconds): void
    {
        $this->watched_seconds = $watchedSeconds;
        $this->save();
    }

    public function markAsCompleted(): void
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
            'progress_percentage' => 100,
        ]);
    }
}