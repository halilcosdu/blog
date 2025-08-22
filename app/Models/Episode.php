<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Episode extends Model
{
    use Taggable;

    protected $fillable = [
        'series_id',
        'title',
        'slug',
        'description',
        'content',
        'thumbnail',
        'vimeo_id',
        'vimeo_data',
        'category_id',
        'user_id',
        'level',
        'duration_minutes',
        'episode_number',
        'views_count',
        'sort_order',
        'is_published',
        'is_featured',
        'is_free',
        'is_standalone',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'is_free' => 'boolean',
            'is_standalone' => 'boolean',
            'published_at' => 'datetime',
            'vimeo_data' => 'array',
            'duration_minutes' => 'integer',
            'episode_number' => 'integer',
            'views_count' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Episode $episode) {
            if (empty($episode->slug)) {
                $episode->slug = Str::slug($episode->title);
            }

            // Auto-increment episode number if it's part of a series
            if ($episode->series_id && ! $episode->episode_number) {
                $lastEpisode = Episode::where('series_id', $episode->series_id)
                    ->orderByDesc('episode_number')
                    ->first();
                $episode->episode_number = $lastEpisode ? $lastEpisode->episode_number + 1 : 1;
            }
        });

        static::updating(function (Episode $episode) {
            if ($episode->isDirty('title') && empty($episode->slug)) {
                $episode->slug = Str::slug($episode->title);
            }
        });

        static::saved(function (Episode $episode) {
            // Update series counts when episode is saved
            if ($episode->series_id) {
                $episode->series?->updateEpisodesCount();
                $episode->series?->updateDuration();
            }
        });

        static::deleted(function (Episode $episode) {
            // Update series counts when episode is deleted
            if ($episode->series_id) {
                $episode->series?->updateEpisodesCount();
                $episode->series?->updateDuration();
            }
        });
    }

    // Relationships
    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pathwayItems(): MorphMany
    {
        return $this->morphMany(PathwayItem::class, 'item');
    }

    public function pathways(): MorphToMany
    {
        return $this->morphToMany(Pathway::class, 'item', 'pathway_items');
    }

    public function userProgress(): MorphMany
    {
        return $this->morphMany(UserProgress::class, 'progressable');
    }

    public function watchlists(): MorphMany
    {
        return $this->morphMany(UserWatchlist::class, 'watchable');
    }

    public function comments(): HasMany
    {
        // Episode comments relationship
        return $this->hasMany(EpisodeComment::class)->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeStandalone(Builder $query): Builder
    {
        return $query->where('is_standalone', true);
    }

    public function scopeInSeries(Builder $query): Builder
    {
        return $query->whereNotNull('series_id');
    }

    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeBySeries(Builder $query, int $seriesId): Builder
    {
        return $query->where('series_id', $seriesId);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->orderByDesc('views_count');
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    // Helper methods
    public function getFormattedDurationAttribute(): string
    {
        if ($this->duration_minutes < 60) {
            return $this->duration_minutes.' min';
        }

        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($minutes === 0) {
            return $hours.' hour'.($hours > 1 ? 's' : '');
        }

        return $hours.'h '.$minutes.'m';
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getNextEpisode(): ?Episode
    {
        if (! $this->series_id || ! $this->episode_number) {
            return null;
        }

        return Episode::where('series_id', $this->series_id)
            ->where('episode_number', '>', $this->episode_number)
            ->where('is_published', true)
            ->orderBy('episode_number')
            ->first();
    }

    public function getPreviousEpisode(): ?Episode
    {
        if (! $this->series_id || ! $this->episode_number) {
            return null;
        }

        return Episode::where('series_id', $this->series_id)
            ->where('episode_number', '<', $this->episode_number)
            ->where('is_published', true)
            ->orderByDesc('episode_number')
            ->first();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
