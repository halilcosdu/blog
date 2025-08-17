<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Laravel', 'PHP', 'Frontend', 'DevOps', 'Testing', 'Databases', 'Security', 'Cloud',
        ]);

        $colors = ['#EF4444', '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#6366F1', '#06B6D4', '#DB2777'];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(10),
            'color' => $this->faker->randomElement($colors),
            'icon' => null,
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 50),
        ];
    }
}
