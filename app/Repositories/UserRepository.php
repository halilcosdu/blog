<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Get top authors by post count
     */
    public function getTopAuthors(int $limit = 6): Collection
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            return $this->model
                ->withCount(['posts' => function ($query) {
                    $query->published();
                }])
                ->whereHas('posts', function ($query) {
                    $query->published();
                })
                ->orderByDesc('posts_count')
                ->take($limit)
                ->get();
        }

        return $this->model
            ->withCount(['posts as posts_count' => function ($query) {
                $query->published();
            }])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take($limit)
            ->get();
    }

    /**
     * Get user by email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Get users with published posts
     */
    public function getAuthors(): Collection
    {
        return $this->model
            ->whereHas('posts', function ($query) {
                $query->published();
            })
            ->withCount(['posts as posts_count' => function ($query) {
                $query->published();
            }])
            ->orderByDesc('posts_count')
            ->get();
    }
}
