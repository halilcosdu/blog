<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(6);
        $content = collect(range(1, mt_rand(4, 8)))
            ->map(fn () => '<p>'.$this->faker->paragraph(mt_rand(3, 7)).'</p>')
            ->implode('');

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(20),
            'content' => $content,
            'featured_image' => $this->faker->randomElement([
                'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1536148935331-408321065b18?w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=1200&auto=format&fit=crop',
            ]),
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'is_published' => true,
            'is_featured' => false,
            'published_at' => now()->subDays(mt_rand(0, 30)),
            'views_count' => mt_rand(10, 2000),
            'read_time' => null,
        ];
    }
}
