<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'usage_count',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'usage_count' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tag $tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });

        static::updating(function (Tag $tag) {
            if ($tag->isDirty('name') && empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    // Polymorphic relationships
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function discussions(): MorphToMany
    {
        return $this->morphedByMany(Discussion::class, 'taggable');
    }

    public function packages(): MorphToMany
    {
        return $this->morphedByMany(Package::class, 'taggable');
    }

    // Future models for episodes and series
    public function episodes(): MorphToMany
    {
        return $this->morphedByMany(Episode::class, 'taggable');
    }

    public function series(): MorphToMany
    {
        return $this->morphedByMany(Series::class, 'taggable');
    }

    public function pathways(): MorphToMany
    {
        return $this->morphedByMany(Pathway::class, 'taggable');
    }

    // Helper methods
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    public function decrementUsage(): void
    {
        $this->decrement('usage_count');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
