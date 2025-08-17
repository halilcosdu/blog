<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Laravel', 'color' => '#EF4444', 'icon' => null, 'description' => 'Productive development with the Laravel framework'],
            ['name' => 'PHP', 'color' => '#3B82F6', 'icon' => null, 'description' => 'Modern PHP 8+ features and best practices'],
            ['name' => 'Frontend', 'color' => '#10B981', 'icon' => null, 'description' => 'Tailwind, Vue, React and modern frontend'],
            ['name' => 'DevOps', 'color' => '#8B5CF6', 'icon' => null, 'description' => 'Docker, CI/CD, deployments, and monitoring'],
            ['name' => 'JavaScript', 'color' => '#F59E0B', 'icon' => null, 'description' => 'ESNext, tooling, patterns, and interop'],
            ['name' => 'TypeScript', 'color' => '#0EA5E9', 'icon' => null, 'description' => 'Types, generics, ergonomics, and DX'],
            ['name' => 'Vue', 'color' => '#22C55E', 'icon' => null, 'description' => 'Vue 3 composition API and ecosystem'],
            ['name' => 'React', 'color' => '#06B6D4', 'icon' => null, 'description' => 'Modern React patterns and ecosystem'],
            ['name' => 'Tailwind CSS', 'color' => '#334155', 'icon' => null, 'description' => 'Design systems and utility-first workflows'],
            ['name' => 'Livewire', 'color' => '#DB2777', 'icon' => null, 'description' => 'Server-driven UIs and interactivity'],
            ['name' => 'APIs', 'color' => '#16A34A', 'icon' => null, 'description' => 'REST, JSON:API, GraphQL, and versioning'],
            ['name' => 'Databases', 'color' => '#6366F1', 'icon' => null, 'description' => 'Modeling, indexing, and performance tuning'],
            ['name' => 'Security', 'color' => '#DC2626', 'icon' => null, 'description' => 'Auth, OWASP, and secure coding'],
            ['name' => 'Cloud', 'color' => '#3B82F6', 'icon' => null, 'description' => 'AWS, serverless, scaling, and costs'],
            ['name' => 'Testing', 'color' => '#0EA5E9', 'icon' => null, 'description' => 'Pest, TDD/BDD, and maintainable tests'],
            ['name' => 'Performance', 'color' => '#F97316', 'icon' => null, 'description' => 'Caching, queues, and perceived speed'],
            ['name' => 'Architecture', 'color' => '#7C3AED', 'icon' => null, 'description' => 'Patterns, boundaries, and domain logic'],
            ['name' => 'Tooling', 'color' => '#475569', 'icon' => null, 'description' => 'DX, CLIs, linters, and formatters'],
        ];

        foreach ($categories as $index => $data) {
            Category::query()->firstOrCreate(
                ['slug' => str($data['name'])->slug()],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'color' => $data['color'],
                    'icon' => $data['icon'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
