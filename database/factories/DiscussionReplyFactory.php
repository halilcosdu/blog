<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscussionReply>
 */
class DiscussionReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'discussion_id' => Discussion::factory(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'content' => $this->faker->paragraphs(rand(1, 4), true),
            'is_best_answer' => false,
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => fn (array $attributes) => $this->faker->dateTimeBetween($attributes['created_at'], 'now'),
        ];
    }
}