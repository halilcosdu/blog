<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $query = trim($request->get('q', ''));

        // Log the incoming query for debugging
        \Log::info('User search API called', ['query' => $query, 'empty' => empty($query)]);

        if (empty($query)) {
            // Return first 8 users if no query
            $users = User::query()
                ->select(['id', 'username', 'name'])
                ->whereNotNull('username')
                ->where('username', '!=', '')
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get();
        } else {
            // Search users by username or name (case insensitive)
            $userQuery = User::query()
                ->select(['id', 'username', 'name'])
                ->whereNotNull('username')
                ->where('username', '!=', '')
                ->where(function ($q) use ($query) {
                    $q->where('username', 'ilike', "%{$query}%")
                        ->orWhere('name', 'ilike', "%{$query}%");
                });

            // Log the SQL query for debugging
            \Log::info('SQL Query', ['sql' => $userQuery->toSql(), 'bindings' => $userQuery->getBindings()]);

            $users = $userQuery
                ->orderByRaw('
                    CASE 
                        WHEN username = ? THEN 1
                        WHEN username ILIKE ? THEN 2
                        WHEN name ILIKE ? THEN 3
                        ELSE 4
                    END
                ', [$query, "{$query}%", "{$query}%"])
                ->orderBy('username')
                ->limit(8)
                ->get();
        }

        \Log::info('User search results', ['count' => $users->count(), 'query' => $query]);

        // Ensure all users have required fields
        $users = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
            ];
        });

        return response()->json($users);
    }
}
