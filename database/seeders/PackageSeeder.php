<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'phpuzem/laravel-boost',
                'slug' => 'laravel-boost',
                'description' => 'Supercharge your Laravel development workflow with advanced debugging tools, performance monitoring, and developer utilities.',
                'status' => 'Coming Soon',
                'icon' => '🚀',
                'url' => '#',
                'github_url' => 'https://github.com/phpuzem/laravel-boost',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/laravel-boost',
                'documentation_url' => 'https://docs.phpuzem.com/laravel-boost',
                'tags' => ['laravel', 'debugging', 'performance', 'development'],
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
                'version' => '1.0.0-alpha',
                'downloads_count' => 0,
                'stars_count' => 125,
            ],
            [
                'name' => 'phpuzem/eloquent-plus',
                'slug' => 'eloquent-plus',
                'description' => 'Advanced Eloquent model enhancements with automatic caching, advanced relationships, and query optimizations.',
                'status' => 'In Development',
                'icon' => '⚡',
                'url' => '#',
                'github_url' => 'https://github.com/phpuzem/eloquent-plus',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/eloquent-plus',
                'documentation_url' => 'https://docs.phpuzem.com/eloquent-plus',
                'tags' => ['laravel', 'eloquent', 'orm', 'caching'],
                'sort_order' => 2,
                'is_featured' => true,
                'is_active' => true,
                'version' => '0.5.0-beta',
                'downloads_count' => 1250,
                'stars_count' => 89,
            ],
            [
                'name' => 'phpuzem/test-helpers',
                'slug' => 'test-helpers',
                'description' => 'Powerful testing utilities for Laravel with custom assertions, database helpers, and API testing tools.',
                'status' => 'Beta',
                'icon' => '🧪',
                'url' => '#',
                'github_url' => 'https://github.com/phpuzem/test-helpers',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/test-helpers',
                'documentation_url' => 'https://docs.phpuzem.com/test-helpers',
                'tags' => ['laravel', 'testing', 'pest', 'phpunit'],
                'sort_order' => 3,
                'is_featured' => false,
                'is_active' => true,
                'version' => '0.8.2-beta',
                'downloads_count' => 756,
                'stars_count' => 45,
            ],
            [
                'name' => 'phpuzem/api-kit',
                'slug' => 'api-kit',
                'description' => 'Complete API development toolkit with automatic documentation, versioning, and response formatting.',
                'status' => 'Planning',
                'icon' => '🔧',
                'url' => '#',
                'github_url' => 'https://github.com/phpuzem/api-kit',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/api-kit',
                'documentation_url' => 'https://docs.phpuzem.com/api-kit',
                'tags' => ['laravel', 'api', 'documentation', 'versioning'],
                'sort_order' => 4,
                'is_featured' => false,
                'is_active' => true,
                'version' => null,
                'downloads_count' => 0,
                'stars_count' => 12,
            ],
            [
                'name' => 'phpuzem/livewire-components',
                'slug' => 'livewire-components',
                'description' => 'A collection of beautiful, reusable Livewire components for rapid UI development.',
                'status' => 'Released',
                'icon' => '🎨',
                'url' => 'https://livewire-components.phpuzem.com',
                'github_url' => 'https://github.com/phpuzem/livewire-components',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/livewire-components',
                'documentation_url' => 'https://docs.phpuzem.com/livewire-components',
                'tags' => ['livewire', 'components', 'ui', 'frontend'],
                'sort_order' => 5,
                'is_featured' => true,
                'is_active' => true,
                'version' => '2.1.4',
                'downloads_count' => 3420,
                'stars_count' => 234,
            ],
            [
                'name' => 'phpuzem/deployment-tools',
                'slug' => 'deployment-tools',
                'description' => 'Zero-downtime deployment tools with automatic rollback, health checks, and multi-environment support.',
                'status' => 'In Development',
                'icon' => '🚀',
                'url' => '#',
                'github_url' => 'https://github.com/phpuzem/deployment-tools',
                'packagist_url' => 'https://packagist.org/packages/phpuzem/deployment-tools',
                'documentation_url' => 'https://docs.phpuzem.com/deployment-tools',
                'tags' => ['deployment', 'devops', 'automation', 'laravel'],
                'sort_order' => 6,
                'is_featured' => false,
                'is_active' => true,
                'version' => '0.3.0-alpha',
                'downloads_count' => 189,
                'stars_count' => 67,
            ],
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }
    }
}
