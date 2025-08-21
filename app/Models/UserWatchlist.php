<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;

class UserWatchlist extends Model
{
    protected $fillable = [
        'user_id',
        'watchable_type',
        'watchable_id',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function watchable(): MorphTo
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    // Helper methods
    public static function isInWatchlist(int $userId, string $watchableType, int $watchableId): bool
    {
        return static::where('user_id', $userId)
            ->where('watchable_type', $watchableType)
            ->where('watchable_id', $watchableId)
            ->exists();
    }

    public static function addToWatchlist(int $userId, string $watchableType, int $watchableId): static
    {
        return static::firstOrCreate([
            'user_id' => $userId,
            'watchable_type' => $watchableType,
            'watchable_id' => $watchableId,
        ]);
    }

    public static function removeFromWatchlist(int $userId, string $watchableType, int $watchableId): bool
    {
        return static::where('user_id', $userId)
            ->where('watchable_type', $watchableType)
            ->where('watchable_id', $watchableId)
            ->delete() > 0;
    }
}