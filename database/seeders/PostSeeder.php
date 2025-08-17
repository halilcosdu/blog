<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure at least one user exists
        $user = User::query()->first() ?? User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        // Ensure base categories exist
        if (Category::query()->count() === 0) {
            $this->call(CategorySeeder::class);
        }

        // Create featured post
        Post::factory()->count(1)->state([
            'is_featured' => true,
        ])->create();

        // Create additional posts for listings / top lessons
        Post::factory()->count(40)->create();
    }
}
