<?php

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

trait Taggable
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function attachTag(string|Tag $tag): void
    {
        if (is_string($tag)) {
            $tag = Tag::query()->firstOrCreate([
                'name' => trim($tag),
                'slug' => Str::slug(trim($tag))
            ]);
        }

        if (!$this->tags->contains($tag)) {
            $this->tags()->attach($tag);
            $tag->incrementUsage();
        }
    }

    public function detachTag(string|Tag $tag): void
    {
        if (is_string($tag)) {
            $tag = Tag::query()->where('name', $tag)->first();
        }

        if ($tag && $this->tags->contains($tag)) {
            $this->tags()->detach($tag);
            $tag->decrementUsage();
        }
    }

    public function syncTags(array $tags): void
    {
        $tagIds = [];

        foreach ($tags as $tagName) {
            if (is_string($tagName) && !empty(trim($tagName))) {
                $tag = Tag::query()->firstOrCreate([
                    'name' => trim($tagName),
                    'slug' => Str::slug(trim($tagName))
                ]);
                $tagIds[] = $tag->id;
            }
        }

        // Get current tags before sync
        $currentTagIds = $this->tags()->pluck('tags.id')->toArray();

        // Sync tags
        $this->tags()->sync($tagIds);

        // Update usage counts
        $addedTags = array_diff($tagIds, $currentTagIds);
        $removedTags = array_diff($currentTagIds, $tagIds);

        if (!empty($addedTags)) {
            Tag::query()->whereIn('id', $addedTags)->increment('usage_count');
        }

        if (!empty($removedTags)) {
            Tag::query()->whereIn('id', $removedTags)->decrement('usage_count');
        }
    }

    public function getTagNames(): array
    {
        return $this->tags->pluck('name')->toArray();
    }

    public function hasTag(string|Tag $tag): bool
    {
        if (is_string($tag)) {
            return $this->tags->contains('name', $tag);
        }

        return $this->tags->contains($tag);
    }

    public function getTagsAttribute(): Collection
    {
        return $this->tags()->get();
    }
}
