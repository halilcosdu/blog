<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Series;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    public function run(): void
    {
        $adminUserId = 1;

        $series = [
            [
                'title' => 'Master Laravel 11',
                'slug' => 'master-laravel-11',
                'description' => 'Complete guide to Laravel 11 features and best practices including new capabilities and modern patterns. Learn everything from routing to advanced architecture.',
                'excerpt' => 'Master Laravel 11 with comprehensive coverage of new features and best practices.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                'trailer_vimeo_id' => '123456789',
                'trailer_vimeo_data' => [
                    'title' => 'Laravel 11 Masterclass Trailer',
                    'duration' => 120,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456789_640.jpg',
                ],
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 480,
                'episodes_count' => 24,
                'views_count' => 12450,
                'rating' => 4.9,
                'sort_order' => 1,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'published_at' => now()->subDays(7),
                'tags' => ['laravel', 'eloquent', 'artisan', 'blade', 'routing'],
            ],
            [
                'title' => 'Advanced Filament Development',
                'slug' => 'advanced-filament-development',
                'description' => 'Deep dive into Filament v4 with custom components, actions, and complex relationships. Build powerful admin panels and dashboards.',
                'excerpt' => 'Master Filament v4 with advanced components and custom functionality.',
                'thumbnail' => 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=800',
                'trailer_vimeo_id' => '123456790',
                'trailer_vimeo_data' => [
                    'title' => 'Advanced Filament Development Trailer',
                    'duration' => 90,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456790_640.jpg',
                ],
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'advanced',
                'duration_minutes' => 390,
                'episodes_count' => 18,
                'views_count' => 8920,
                'rating' => 4.8,
                'sort_order' => 2,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'published_at' => now()->subDays(14),
                'tags' => ['laravel', 'filament', 'components', 'relationships', 'validation'],
            ],
            [
                'title' => 'Testing Laravel Applications',
                'slug' => 'testing-laravel-applications',
                'description' => 'Comprehensive testing strategies with Pest, feature tests, and TDD approach. Write maintainable and effective tests.',
                'excerpt' => 'Learn comprehensive testing with Pest and TDD methodology.',
                'thumbnail' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=800',
                'trailer_vimeo_id' => '123456791',
                'trailer_vimeo_data' => [
                    'title' => 'Testing Laravel Applications Trailer',
                    'duration' => 75,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456791_640.jpg',
                ],
                'category_id' => Category::where('slug', 'testing')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 300,
                'episodes_count' => 15,
                'views_count' => 6750,
                'rating' => 4.7,
                'sort_order' => 3,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => true,
                'published_at' => now()->subDays(21),
                'tags' => ['testing', 'pest', 'tdd', 'validation', 'security'],
            ],
            [
                'title' => 'API Development with Laravel',
                'slug' => 'api-development-with-laravel',
                'description' => 'Build robust REST APIs with authentication, rate limiting, and documentation. Learn best practices for API design.',
                'excerpt' => 'Master REST API development with Laravel and best practices.',
                'thumbnail' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=800',
                'trailer_vimeo_id' => '123456792',
                'trailer_vimeo_data' => [
                    'title' => 'API Development with Laravel Trailer',
                    'duration' => 110,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456792_640.jpg',
                ],
                'category_id' => Category::where('slug', 'apis')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 450,
                'episodes_count' => 22,
                'views_count' => 9340,
                'rating' => 4.6,
                'sort_order' => 4,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'published_at' => now()->subDays(28),
                'tags' => ['laravel', 'api', 'authentication', 'middleware', 'validation'],
            ],
            [
                'title' => 'Modern PHP Practices',
                'slug' => 'modern-php-practices',
                'description' => 'Learn PHP 8.4 features, design patterns, and clean code principles. Stay current with modern PHP development.',
                'excerpt' => 'Master PHP 8.4 features and modern development practices.',
                'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800',
                'trailer_vimeo_id' => '123456793',
                'trailer_vimeo_data' => [
                    'title' => 'Modern PHP Practices Trailer',
                    'duration' => 95,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456793_640.jpg',
                ],
                'category_id' => Category::where('slug', 'php')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'beginner',
                'duration_minutes' => 360,
                'episodes_count' => 20,
                'views_count' => 11280,
                'rating' => 4.8,
                'sort_order' => 5,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'published_at' => now()->subDays(35),
                'tags' => ['php', 'modern', 'patterns', 'clean-code', 'oop'],
            ],
            [
                'title' => 'Frontend Build Tools Mastery',
                'slug' => 'frontend-build-tools-mastery',
                'description' => 'Deep dive into Vite, Webpack, and modern build processes for web development. Optimize your development workflow.',
                'excerpt' => 'Master modern build tools like Vite and Webpack.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=800',
                'trailer_vimeo_id' => '123456794',
                'trailer_vimeo_data' => [
                    'title' => 'Build Tools Mastery Trailer',
                    'duration' => 85,
                    'thumbnail' => 'https://i.vimeocdn.com/video/123456794_640.jpg',
                ],
                'category_id' => Category::where('slug', 'frontend')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 240,
                'episodes_count' => 12,
                'views_count' => 4530,
                'rating' => 4.7,
                'sort_order' => 6,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => true,
                'published_at' => now()->subDays(42),
                'tags' => ['vite', 'webpack', 'build-tools', 'frontend', 'optimization'],
            ],
        ];

        foreach ($series as $seriesData) {
            $tags = $seriesData['tags'];
            unset($seriesData['tags']);

            $seriesModel = Series::create($seriesData);

            // Attach tags
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::where('slug', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }

            if (! empty($tagIds)) {
                $seriesModel->tags()->attach($tagIds);
            }
        }
    }
}
