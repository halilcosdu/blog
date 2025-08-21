<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Episode;
use App\Models\Pathway;
use App\Models\PathwayItem;
use App\Models\Series;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PathwaySeeder extends Seeder
{
    public function run(): void
    {
        $adminUserId = 1;

        // Get existing series and episodes
        $laravelSeries = Series::where('slug', 'master-laravel-11')->first();
        $testingSeries = Series::where('slug', 'testing-laravel-applications')->first();
        $livewireEpisode = Episode::where('slug', 'building-realtime-apps-livewire')->first();
        $securityEpisode = Episode::where('slug', 'security-best-practices-laravel')->first();

        $pathways = [
            [
                'title' => 'Laravel from Zero to Hero',
                'slug' => 'laravel-zero-to-hero',
                'description' => 'Complete beginner-friendly path to master Laravel development. Start from the basics and build up to advanced concepts.',
                'excerpt' => 'Master Laravel development from beginner to advanced level.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600',
                'category_id' => Category::where('slug', 'laravel')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'beginner',
                'total_duration_minutes' => 600,
                'items_count' => 3,
                'students_count' => 2847,
                'views_count' => 12450,
                'sort_order' => 1,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => false,
                'published_at' => now()->subDays(30),
                'tags' => ['laravel', 'beginner', 'complete-course'],
                'items' => [
                    ['type' => Series::class, 'item' => $laravelSeries, 'sort_order' => 1, 'is_required' => true],
                    ['type' => Episode::class, 'item' => $livewireEpisode, 'sort_order' => 2, 'is_required' => true],
                    ['type' => Episode::class, 'item' => $securityEpisode, 'sort_order' => 3, 'is_required' => false],
                ],
            ],
            [
                'title' => 'Testing and Quality Assurance',
                'slug' => 'testing-quality-assurance',
                'description' => 'Learn comprehensive testing strategies, from basic unit tests to advanced integration testing with Pest and Laravel.',
                'excerpt' => 'Master testing strategies for Laravel applications.',
                'thumbnail' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=600',
                'category_id' => Category::where('slug', 'testing')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'total_duration_minutes' => 349,
                'items_count' => 2,
                'students_count' => 1923,
                'views_count' => 8340,
                'sort_order' => 2,
                'is_published' => true,
                'is_featured' => true,
                'is_free' => true,
                'published_at' => now()->subDays(25),
                'tags' => ['testing', 'pest', 'quality-assurance'],
                'items' => [
                    ['type' => Series::class, 'item' => $testingSeries, 'sort_order' => 1, 'is_required' => true],
                    ['type' => Episode::class, 'item' => $securityEpisode, 'sort_order' => 2, 'is_required' => true],
                ],
            ],
            [
                'title' => 'Modern Frontend Integration',
                'slug' => 'modern-frontend-integration',
                'description' => 'Connect Laravel with modern frontend technologies like Vue.js, React, and build reactive user interfaces.',
                'excerpt' => 'Master frontend integration with Laravel.',
                'thumbnail' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=600',
                'category_id' => Category::where('slug', 'frontend')->first()->id,
                'user_id' => $adminUserId,
                'level' => 'intermediate',
                'total_duration_minutes' => 100,
                'items_count' => 1,
                'students_count' => 1456,
                'views_count' => 5670,
                'sort_order' => 3,
                'is_published' => true,
                'is_featured' => false,
                'is_free' => false,
                'published_at' => now()->subDays(20),
                'tags' => ['frontend', 'vue', 'react', 'integration'],
                'items' => [
                    ['type' => Episode::class, 'item' => $livewireEpisode, 'sort_order' => 1, 'is_required' => true],
                ],
            ],
        ];

        foreach ($pathways as $pathwayData) {
            $tags = $pathwayData['tags'];
            $items = $pathwayData['items'];
            unset($pathwayData['tags'], $pathwayData['items']);

            $pathwayModel = Pathway::create($pathwayData);

            // Attach tags
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::where('slug', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }

            if (! empty($tagIds)) {
                $pathwayModel->tags()->attach($tagIds);
            }

            // Add pathway items
            foreach ($items as $itemData) {
                PathwayItem::create([
                    'pathway_id' => $pathwayModel->id,
                    'item_type' => $itemData['type'],
                    'item_id' => $itemData['item']->id,
                    'sort_order' => $itemData['sort_order'],
                    'is_required' => $itemData['is_required'],
                ]);
            }
        }
    }
}
