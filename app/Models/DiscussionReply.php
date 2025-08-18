<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscussionReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
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

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsBestAnswer(): void
    {
        // İlk olarak diğer tüm cevapları best answer olmaktan çıkar
        $this->discussion->replies()->update(['is_best_answer' => false]);
        
        // Bu cevabı best answer yap
        $this->update(['is_best_answer' => true]);
        
        // Discussion'ı çözüldü olarak işaretle
        $this->discussion->markAsResolved();
    }

    public function removeBestAnswer(): void
    {
        $this->update(['is_best_answer' => false]);
        
        // Eğer başka best answer yoksa discussion'ı çözülmemiş yap
        if (!$this->discussion->replies()->where('is_best_answer', true)->exists()) {
            $this->discussion->markAsUnresolved();
        }
    }
}
