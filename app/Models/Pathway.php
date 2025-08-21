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

class Pathway extends Model
{
    use Taggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'thumbnail',
        'category_id',
        'user_id',
        'level',
        'total_duration_minutes',
        'items_count',
        'students_count',
        'views_count',
        'rating',
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
            'total_duration_minutes' => 'integer',
            'items_count' => 'integer',
            'students_count' => 'integer',
            'views_count' => 'integer',
            'rating' => 'decimal:2',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Pathway $pathway) {
            if (empty($pathway->slug)) {
                $pathway->slug = Str::slug($pathway->title);
            }
        });

        static::updating(function (Pathway $pathway) {
            if ($pathway->isDirty('title') && empty($pathway->slug)) {
                $pathway->slug = Str::slug($pathway->title);
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

    public function pathwayItems(): HasMany
    {
        return $this->hasMany(PathwayItem::class)->orderBy('sort_order');
    }

    public function series(): MorphToMany
    {
        return $this->morphedByMany(Series::class, 'item', 'pathway_items');
    }

    public function episodes(): MorphToMany
    {
        return $this->morphedByMany(Episode::class, 'item', 'pathway_items');
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
        return $query->orderByDesc('students_count');
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    // Helper methods
    public function getFormattedDurationAttribute(): string
    {
        if ($this->total_duration_minutes < 60) {
            return $this->total_duration_minutes.' min';
        }

        $hours = floor($this->total_duration_minutes / 60);
        $minutes = $this->total_duration_minutes % 60;

        if ($minutes === 0) {
            return $hours.' hour'.($hours > 1 ? 's' : '');
        }

        return $hours.'h '.$minutes.'m';
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementStudents(): void
    {
        $this->increment('students_count');
    }

    public function updateCounts(): void
    {
        $this->items_count = $this->pathwayItems()->count();

        // Calculate total duration from all items
        $totalDuration = 0;
        foreach ($this->pathwayItems as $item) {
            if ($item->item_type === Series::class) {
                $totalDuration += $item->item->duration_minutes ?? 0;
            } elseif ($item->item_type === Episode::class) {
                $totalDuration += $item->item->duration_minutes ?? 0;
            }
        }

        $this->total_duration_minutes = $totalDuration;
        $this->save();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
