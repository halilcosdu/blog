<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Package extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'icon',
        'url',
        'github_url',
        'packagist_url',
        'documentation_url',
        'tags',
        'sort_order',
        'is_featured',
        'is_active',
        'version',
        'downloads_count',
        'stars_count',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'downloads_count' => 'integer',
        'stars_count' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Scope to get active packages
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get featured packages
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get status colors for badges
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'Released' => 'success',
            'Beta' => 'warning',
            'Coming Soon' => 'info',
            'In Development' => 'primary',
            'Planning' => 'secondary',
            default => 'secondary',
        };
    }

    /**
     * Get the route key name for model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
