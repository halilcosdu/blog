<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Series extends Model
{
    use HasFactory, Taggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'thumbnail',
        'trailer_vimeo_id',
        'trailer_vimeo_data',
        'category_id',
        'user_id',
        'level',
        'duration_minutes',
        'episodes_count',
        'views_count',
        'sort_order',
        'is_published',
        'is_featured',
        'is_free',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'is_free' => 'boolean',
            'published_at' => 'datetime',
            'trailer_vimeo_data' => 'array',
            'duration_minutes' => 'integer',
            'episodes_count' => 'integer',
            'views_count' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Series $series) {
            if (empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });

        static::updating(function (Series $series) {
            if ($series->isDirty('title') && empty($series->slug)) {
                $series->slug = Str::slug($series->title);
            }
        });
    }

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class)->orderBy('episode_number');
    }

    public function publishedEpisodes(): HasMany
    {
        return $this->episodes()->where('is_published', true);
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

    // Scopes
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
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

    public function updateEpisodesCount(): void
    {
        $this->episodes_count = $this->episodes()->count();
        $this->save();
    }

    public function updateDuration(): void
    {
        $this->duration_minutes = $this->episodes()->sum('duration_minutes');
        $this->save();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
