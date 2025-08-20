<?php

namespace Database\Seeders;

use App\Models\Discussion;
use Illuminate\Database\Seeder;

class DiscussionTagSeeder extends Seeder
{
    public function run(): void
    {
        // Mevcut discussionları al
        $discussions = Discussion::all();

        if ($discussions->isEmpty()) {
            $this->command->info('No discussions found. Creating sample discussions with tags...');

            // Örnek discussionlar oluştur
            $sampleDiscussions = [
                [
                    'title' => 'Laravel 11\'de N+1 Problem Nasıl Çözülür?',
                    'slug' => 'laravel-11-n-1-problem-cozumu',
                    'content' => 'Laravel projemde N+1 query problemi yaşıyorum. Bu sorunu nasıl çözebilirim? Önerilerinizi bekliyorum.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Laravel', 'Performance', 'PHP', 'Advanced'],
                ],
                [
                    'title' => 'Vue.js ile Laravel API Entegrasyonu',
                    'slug' => 'vuejs-laravel-api-entegrasyonu',
                    'content' => 'Vue.js frontend\'ini Laravel API\'ye nasıl entegre edebilirim? CORS problemleri yaşıyorum.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Vue.js', 'Laravel', 'API', 'JavaScript'],
                ],
                [
                    'title' => 'Tailwind CSS Custom Components',
                    'slug' => 'tailwind-css-custom-components',
                    'content' => 'Tailwind CSS ile kendi component kütüphanemi oluşturmak istiyorum. En iyi yaklaşım nedir?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Tailwind CSS', 'Tips', 'Best Practices'],
                ],
                [
                    'title' => 'Livewire vs Inertia.js Karşılaştırması',
                    'slug' => 'livewire-vs-inertiajs-karsilastirmasi',
                    'content' => 'Yeni bir proje için Livewire mi yoksa Inertia.js mi kullanmalıyım? Avantajları ve dezavantajları nelerdir?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Livewire', 'Inertia.js', 'Laravel', 'Comparison'],
                ],
                [
                    'title' => 'Docker ile Laravel Development Setup',
                    'slug' => 'docker-laravel-development-setup',
                    'content' => 'Laravel projem için Docker ortamı kurarken bazı sorunlar yaşıyorum. Yardım edebilir misiniz?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Docker', 'Laravel', 'DevOps', 'Beginner'],
                ],
                [
                    'title' => 'Laravel API Testing Best Practices',
                    'slug' => 'laravel-api-testing-best-practices',
                    'content' => 'API testlerimi daha verimli yazmak için hangi stratejileri kullanmalıyım?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Laravel', 'Testing', 'API', 'Best Practices'],
                ],
                [
                    'title' => 'PHP 8.3 Yeni Özellikler',
                    'slug' => 'php-8-3-yeni-ozellikler',
                    'content' => 'PHP 8.3 ile gelen yeni özellikler hakkında deneyimlerinizi paylaşabilir misiniz?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['PHP', 'Advanced', 'Tips'],
                ],
                [
                    'title' => 'Laravel Security Checklist',
                    'slug' => 'laravel-security-checklist',
                    'content' => 'Production\'a çıkmadan önce kontrol etmem gereken güvenlik önlemleri nelerdir?',
                    'user_id' => 1,
                    'category_id' => 1,
                    'tags' => ['Laravel', 'Security', 'Best Practices', 'PHP'],
                ],
            ];

            foreach ($sampleDiscussions as $discussionData) {
                $tags = $discussionData['tags'];
                unset($discussionData['tags']);

                $discussion = Discussion::create($discussionData);
                $discussion->syncTags($tags);
            }
        } else {
            // Mevcut discussionlara rastgele taglar ata
            $this->command->info('Assigning tags to existing discussions...');

            $tagGroups = [
                ['Laravel', 'PHP', 'Help'],
                ['Vue.js', 'JavaScript', 'Beginner'],
                ['React', 'JavaScript', 'Advanced'],
                ['Tailwind CSS', 'Tips', 'Help'],
                ['Laravel', 'Livewire', 'Question'],
                ['API', 'Laravel', 'Help'],
                ['Testing', 'PHP', 'Best Practices'],
                ['Performance', 'Laravel', 'Advanced'],
                ['Security', 'PHP', 'Important'],
                ['Docker', 'DevOps', 'Help'],
            ];

            foreach ($discussions as $index => $discussion) {
                $tagGroup = $tagGroups[$index % count($tagGroups)];
                $discussion->syncTags($tagGroup);
                $this->command->info("Assigned tags to discussion: {$discussion->title}");
            }
        }
    }
}
