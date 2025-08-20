<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    use Taggable;

    protected $fillable = [
        'series_id',
        'title',
        'slug',
        'description',
        'content',
        'duration',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'duration' => 'integer',
        ];
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
