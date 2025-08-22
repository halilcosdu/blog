<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EpisodeComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'episode_id',
        'user_id',
        'content',
        'is_best_answer',
    ];

    protected function casts(): array
    {
        return [
            'is_best_answer' => 'boolean',
        ];
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsBestAnswer(): void
    {
        // Remove best answer status from other comments
        $this->episode->comments()->update(['is_best_answer' => false]);

        // Mark this comment as best answer
        $this->update(['is_best_answer' => true]);
    }

    public function removeBestAnswer(): void
    {
        $this->update(['is_best_answer' => false]);
    }
}
