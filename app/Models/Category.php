<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function (Category $category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class);
    }

    public function publishedPosts(): HasMany
    {
        return $this->posts()->where('is_published', true);
    }

    public function series(): HasMany
    {
        return $this->hasMany(Series::class);
    }

    public function publishedSeries(): HasMany
    {
        return $this->series()->where('is_published', true);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function publishedEpisodes(): HasMany
    {
        return $this->episodes()->where('is_published', true);
    }

    public function pathways(): HasMany
    {
        return $this->hasMany(Pathway::class);
    }

    public function publishedPathways(): HasMany
    {
        return $this->pathways()->where('is_published', true);
    }
}
