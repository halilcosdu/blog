<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CachesData
{
    /**
     * Cache data with a given key and TTL
     *
     * @param  int  $ttl  Time to live in seconds
     */
    protected function cacheData(string $key, int $ttl, callable $callback): mixed
    {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Cache data for 5 minutes (300 seconds)
     */
    protected function cacheShort(string $key, callable $callback): mixed
    {
        return $this->cacheData($key, 300, $callback);
    }

    /**
     * Cache data for 10 minutes (600 seconds)
     */
    protected function cacheMedium(string $key, callable $callback): mixed
    {
        return $this->cacheData($key, 600, $callback);
    }

    /**
     * Cache data for 30 minutes (1800 seconds)
     */
    protected function cacheLong(string $key, callable $callback): mixed
    {
        return $this->cacheData($key, 1800, $callback);
    }

    /**
     * Cache data for 1 hour (3600 seconds)
     */
    protected function cacheVeryLong(string $key, callable $callback): mixed
    {
        return $this->cacheData($key, 3600, $callback);
    }

    /**
     * Get cache key with component prefix
     */
    protected function getCacheKey(string $suffix): string
    {
        $componentName = strtolower(class_basename(static::class));

        return "{$componentName}.{$suffix}";
    }

    /**
     * Forget cache by key
     */
    protected function forgetCache(string $key): bool
    {
        return Cache::forget($key);
    }

    /**
     * Forget cache by pattern (if using Redis/Array driver)
     */
    protected function forgetCacheByPattern(string $pattern): void
    {
        try {
            $keys = Cache::getRedis()->keys("*{$pattern}*");
            if (! empty($keys)) {
                Cache::getRedis()->del($keys);
            }
        } catch (\Exception $e) {
            // Fallback for non-Redis drivers - just clear all cache
            // In production, you might want to implement a more sophisticated approach
            logger('Cache pattern clearing failed: '.$e->getMessage());
        }
    }
}
