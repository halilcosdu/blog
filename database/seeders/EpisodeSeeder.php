<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Series;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    public function run(): void
    {
        $adminUserId = 1;
        
        // Get existing series
        $laravelSeries = Series::where('slug', 'master-laravel-11')->first();
        $filamentSeries = Series::where('slug', 'advanced-filament-development')->first();
        $testingSeries = Series::where('slug', 'testing-laravel-applications')->first();
        
        $episodes = [
            // Laravel 11 Series Episodes
            [
                'series_id' => $laravelSeries->id,
                'title' => 'Laravel 11 Introduction and Setup',
                'slug' => 'laravel-11-introduction-setup',
                'description' => 'Get started with Laravel 11, learn about new features and set up your development environment.',
                'content' => 'In this episode, we\'ll explore what\'s new in Laravel 11 and set up a fresh project.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400',
                'vimeo_id' => '234567890',
                'vimeo_data' => [
                    'title' => 'Laravel 11 Introduction and Setup',
                    'duration' => 1200,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567890_640.jpg'
                ],
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'beginner',
                'duration_minutes' => 20,
                'episode_number' => 1,
                'views_count' => 2845,
                'rating' => 4.8,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => true,
                'is_standalone' => false,
                'published_at' => now()->subDays(6),
                'tags' => ['laravel', 'setup', 'introduction']
            ],
            [
                'series_id' => $laravelSeries->id,
                'title' => 'Routing and Controllers in Laravel 11',
                'slug' => 'routing-controllers-laravel-11',
                'description' => 'Master Laravel 11 routing system and controller patterns.',
                'content' => 'Deep dive into Laravel 11 routing features and controller best practices.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400',
                'vimeo_id' => '234567891',
                'vimeo_data' => [
                    'title' => 'Routing and Controllers in Laravel 11',
                    'duration' => 1800,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567891_640.jpg'
                ],
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 30,
                'episode_number' => 2,
                'views_count' => 1920,
                'rating' => 4.9,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'is_standalone' => false,
                'published_at' => now()->subDays(5),
                'tags' => ['laravel', 'routing', 'controllers']
            ],
            
            // Filament Series Episodes
            [
                'series_id' => $filamentSeries->id,
                'title' => 'Filament v4 Custom Components',
                'slug' => 'filament-v4-custom-components',
                'description' => 'Learn to create powerful custom components in Filament v4.',
                'content' => 'Build reusable custom components that extend Filament\'s functionality.',
                'thumbnail' => 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=400',
                'vimeo_id' => '234567892',
                'vimeo_data' => [
                    'title' => 'Filament v4 Custom Components',
                    'duration' => 2100,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567892_640.jpg'
                ],
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'advanced',
                'duration_minutes' => 35,
                'episode_number' => 1,
                'views_count' => 1456,
                'rating' => 4.7,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'is_standalone' => false,
                'published_at' => now()->subDays(13),
                'tags' => ['filament', 'components', 'laravel']
            ],
            
            // Testing Series Episodes
            [
                'series_id' => $testingSeries->id,
                'title' => 'Getting Started with Pest Testing',
                'slug' => 'getting-started-pest-testing',
                'description' => 'Introduction to Pest testing framework and its elegant syntax.',
                'content' => 'Learn the basics of Pest and how it improves your testing experience.',
                'thumbnail' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400',
                'vimeo_id' => '234567893',
                'vimeo_data' => [
                    'title' => 'Getting Started with Pest Testing',
                    'duration' => 1500,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567893_640.jpg'
                ],
                'category_id' => Category::where('slug', 'testing')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'beginner',
                'duration_minutes' => 25,
                'episode_number' => 1,
                'views_count' => 2234,
                'rating' => 4.6,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => true,
                'is_standalone' => false,
                'published_at' => now()->subDays(20),
                'tags' => ['pest', 'testing', 'laravel']
            ],
            
            // Standalone Episodes
            [
                'series_id' => null,
                'title' => 'Building Real-time Apps with Livewire',
                'slug' => 'building-realtime-apps-livewire',
                'description' => 'Learn to create dynamic interfaces without leaving PHP using Livewire v3 features.',
                'content' => 'Master Livewire v3 for building reactive user interfaces.',
                'thumbnail' => 'https://images.unsplash.com/photo-1536148935331-408321065b18?w=400',
                'vimeo_id' => '234567894',
                'vimeo_data' => [
                    'title' => 'Building Real-time Apps with Livewire',
                    'duration' => 2700,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567894_640.jpg'
                ],
                'category_id' => Category::where('slug', 'livewire')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 45,
                'episode_number' => null,
                'views_count' => 15670,
                'rating' => 4.9,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'is_standalone' => true,
                'published_at' => now()->subDays(10),
                'tags' => ['livewire', 'realtime', 'laravel']
            ],
            [
                'series_id' => null,
                'title' => 'Database Optimization Techniques',
                'slug' => 'database-optimization-techniques',
                'description' => 'Advanced MySQL optimization, indexing strategies, and query performance tuning.',
                'content' => 'Learn advanced database optimization techniques for better performance.',
                'thumbnail' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=400',
                'vimeo_id' => '234567895',
                'vimeo_data' => [
                    'title' => 'Database Optimization Techniques',
                    'duration' => 3120,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567895_640.jpg'
                ],
                'category_id' => Category::where('slug', 'databases')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'advanced',
                'duration_minutes' => 52,
                'episode_number' => null,
                'views_count' => 7890,
                'rating' => 4.7,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => true,
                'is_standalone' => true,
                'published_at' => now()->subDays(15),
                'tags' => ['mysql', 'optimization', 'performance']
            ],
            [
                'series_id' => null,
                'title' => 'Docker for Laravel Development',
                'slug' => 'docker-laravel-development',
                'description' => 'Set up consistent development environments with Docker and Laravel Sail.',
                'content' => 'Master Docker for Laravel development with Sail.',
                'thumbnail' => 'https://images.unsplash.com/photo-1605745341112-85968b19335b?w=400',
                'vimeo_id' => '234567896',
                'vimeo_data' => [
                    'title' => 'Docker for Laravel Development',
                    'duration' => 2280,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567896_640.jpg'
                ],
                'category_id' => Category::where('slug', 'devops')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 38,
                'episode_number' => null,
                'views_count' => 5440,
                'rating' => 4.5,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'is_standalone' => true,
                'published_at' => now()->subDays(8),
                'tags' => ['docker', 'laravel', 'devops']
            ],
            [
                'series_id' => null,
                'title' => 'Vue.js 3 Composition API',
                'slug' => 'vuejs-3-composition-api',
                'description' => 'Master the Composition API and reactive programming in Vue.js 3.',
                'content' => 'Deep dive into Vue.js 3 Composition API and reactive patterns.',
                'thumbnail' => 'https://images.unsplash.com/photo-1633356122102-3fe601e05bd2?w=400',
                'vimeo_id' => '234567897',
                'vimeo_data' => [
                    'title' => 'Vue.js 3 Composition API',
                    'duration' => 3300,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567897_640.jpg'
                ],
                'category_id' => Category::where('slug', 'vue')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'duration_minutes' => 55,
                'episode_number' => null,
                'views_count' => 6720,
                'rating' => 4.8,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'is_standalone' => true,
                'published_at' => now()->subDays(12),
                'tags' => ['vue', 'composition-api', 'javascript']
            ],
            [
                'series_id' => null,
                'title' => 'Security Best Practices for Laravel',
                'slug' => 'security-best-practices-laravel',
                'description' => 'Implement comprehensive security measures and protect against common vulnerabilities.',
                'content' => 'Learn essential security practices for Laravel applications.',
                'thumbnail' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400',
                'vimeo_id' => '234567898',
                'vimeo_data' => [
                    'title' => 'Security Best Practices for Laravel',
                    'duration' => 2940,
                    'thumbnail' => 'https://i.vimeocdn.com/video/234567898_640.jpg'
                ],
                'category_id' => Category::where('slug', 'security')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'advanced',
                'duration_minutes' => 49,
                'episode_number' => null,
                'views_count' => 9870,
                'rating' => 4.9,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'is_standalone' => true,
                'published_at' => now()->subDays(5),
                'tags' => ['security', 'laravel', 'best-practices']
            ]
        ];

        foreach ($episodes as $episodeData) {
            $tags = $episodeData['tags'];
            unset($episodeData['tags']);
            
            $episodeModel = Episode::create($episodeData);
            
            // Attach tags
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::where('slug', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
            
            if (!empty($tagIds)) {
                $episodeModel->tags()->attach($tagIds);
            }
        }
    }
}