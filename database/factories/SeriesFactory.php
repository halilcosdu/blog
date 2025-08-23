<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Series>
 */
class SeriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3, false);

        return [
            'title' => $title,
            'slug' => str($title)->slug(),
            'description' => $this->faker->paragraph(3),
            'excerpt' => $this->faker->sentence(10),
            'thumbnail' => $this->faker->imageUrl(640, 360, 'technology'),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'duration_minutes' => $this->faker->numberBetween(60, 600),
            'episodes_count' => $this->faker->numberBetween(5, 20),
            'views_count' => $this->faker->numberBetween(0, 10000),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'is_published' => true,
            'is_featured' => $this->faker->boolean(20),
            'is_free' => $this->faker->boolean(30),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
