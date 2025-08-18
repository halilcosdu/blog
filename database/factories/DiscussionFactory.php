<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(rand(4, 8));

        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(rand(3, 7), true),
            'is_resolved' => $this->faker->boolean(30), // 30% chance of being resolved
            'views_count' => $this->faker->numberBetween(0, 5000),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => fn (array $attributes) => $this->faker->dateTimeBetween($attributes['created_at'], 'now'),
        ];
    }
}
