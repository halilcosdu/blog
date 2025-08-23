<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Series;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4, false);

        return [
            'series_id' => null, // Can be overridden when creating episodes for a series
            'title' => $title,
            'slug' => str($title)->slug(),
            'description' => $this->faker->paragraph(3),
            'content' => $this->faker->paragraphs(5, true),
            'thumbnail' => $this->faker->imageUrl(640, 360, 'technology'),
            'vimeo_id' => $this->faker->numberBetween(100000000, 999999999),
            'vimeo_data' => [
                'duration' => $this->faker->numberBetween(300, 3600),
                'width' => 1920,
                'height' => 1080,
                'thumbnail' => $this->faker->imageUrl(640, 360),
            ],
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'duration_minutes' => $this->faker->numberBetween(5, 60),
            'episode_number' => 1, // Will be auto-incremented if part of a series
            'views_count' => $this->faker->numberBetween(0, 5000),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'is_published' => true,
            'is_featured' => $this->faker->boolean(15),
            'is_free' => $this->faker->boolean(25),
            'is_standalone' => $this->faker->boolean(40),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
