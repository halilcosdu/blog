<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Discussion extends Model
{
    use HasFactory;

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
                $discussion->slug = Str::slug($discussion->title);
            }
        });

        static::updating(function (Discussion $discussion): void {
            if ($discussion->isDirty('title')) {
                $discussion->slug = Str::slug($discussion->title);
            }
        });
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
        return $this->hasMany(DiscussionReply::class);
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
