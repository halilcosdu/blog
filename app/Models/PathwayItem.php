<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PathwayItem extends Model
{
    protected $fillable = [
        'pathway_id',
        'item_type',
        'item_id',
        'sort_order',
        'is_required',
    ];

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function (PathwayItem $item) {
            // Update pathway counts when item is saved
            $item->pathway?->updateCounts();
        });

        static::deleted(function (PathwayItem $item) {
            // Update pathway counts when item is deleted
            $item->pathway?->updateCounts();
        });
    }

    // Relationships
    public function pathway(): BelongsTo
    {
        return $this->belongsTo(Pathway::class);
    }

    public function item(): MorphTo
    {
        return $this->morphTo();
    }
}