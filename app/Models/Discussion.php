<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Discussion extends Model
{
    use HasFactory, Taggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'is_resolved',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'is_resolved' => 'boolean',
            'views_count' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Discussion $discussion): void {
            if (empty($discussion->slug)) {
                $discussion->slug = static::generateUniqueSlug($discussion->title);
            }
        });

        static::updating(function (Discussion $discussion): void {
            if ($discussion->isDirty('title')) {
                $discussion->slug = static::generateUniqueSlug($discussion->title, $discussion->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = static::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;

            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(DiscussionReply::class)->orderBy('created_at', 'desc');
    }

    public function incrementViewCount(): void
    {
        $this->increment('views_count');
    }

    public function markAsResolved(): void
    {
        $this->update(['is_resolved' => true]);
    }

    public function markAsUnresolved(): void
    {
        $this->update(['is_resolved' => false]);
    }
}
