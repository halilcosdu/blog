<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        $statuses = ['Released', 'Beta', 'Coming Soon', 'In Development', 'Planning'];
        
        return [
            'name' => ucwords($name),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement($statuses),
            'icon' => $this->faker->optional()->word(),
            'url' => $this->faker->optional()->url(),
            'github_url' => $this->faker->optional()->url(),
            'packagist_url' => $this->faker->optional()->url(),
            'documentation_url' => $this->faker->optional()->url(),
            'tags' => $this->faker->randomElements(['laravel', 'php', 'vue', 'javascript', 'package'], rand(1, 3)),
            'sort_order' => $this->faker->numberBetween(1, 100),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'version' => $this->faker->optional()->semver(),
            'downloads_count' => $this->faker->numberBetween(0, 100000),
            'stars_count' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
