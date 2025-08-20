<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    public function run(): void
    {
        // Mevcut postları al
        $posts = Post::all();

        if ($posts->isEmpty()) {
            $this->command->info('No posts found. Creating sample posts with tags...');

            // Örnek postlar oluştur
            $samplePosts = [
                [
                    'title' => 'Laravel 11 ile Modern Web Geliştirme',
                    'slug' => 'laravel-11-modern-web-gelistirme',
                    'excerpt' => 'Laravel 11\'in yeni özellikleri ve modern web geliştirme teknikleri',
                    'content' => 'Laravel 11 birçok yeni özellik ve iyileştirme ile birlikte geldi. Bu yazıda Laravel 11\'in getirdiği yenilikleri ve modern web geliştirme yaklaşımlarını inceleyeceğiz.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Laravel', 'PHP', 'Tutorial', 'Advanced'],
                ],
                [
                    'title' => 'Vue.js 3 Composition API Rehberi',
                    'slug' => 'vuejs-3-composition-api-rehberi',
                    'excerpt' => 'Vue.js 3\'ün Composition API özelliğini öğrenin',
                    'content' => 'Vue.js 3 ile gelen Composition API, daha esnek ve güçlü component geliştirme imkanı sunuyor. Bu rehberde Composition API\'yi detaylı bir şekilde ele alacağız.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Vue.js', 'JavaScript', 'Tutorial', 'Beginner'],
                ],
                [
                    'title' => 'Tailwind CSS ile Hızlı UI Geliştirme',
                    'slug' => 'tailwind-css-hizli-ui-gelistirme',
                    'excerpt' => 'Tailwind CSS kullanarak nasıl hızlıca modern arayüzler geliştirebilirsiniz',
                    'content' => 'Tailwind CSS, utility-first yaklaşımı ile hızlı ve esnek UI geliştirme imkanı sunuyor. Bu yazıda Tailwind CSS\'in temellerini ve ileri tekniklerini öğreneceksiniz.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Tailwind CSS', 'CSS', 'Tutorial', 'Tips'],
                ],
                [
                    'title' => 'Laravel Livewire ile Reactive Components',
                    'slug' => 'laravel-livewire-reactive-components',
                    'excerpt' => 'Livewire ile JavaScript yazmadan reactive componentler geliştirin',
                    'content' => 'Laravel Livewire, PHP ile JavaScript benzeri deneyim sunan güçlü bir araçtır. Bu yazıda Livewire ile reactive componentler nasıl geliştirileceğini öğreneceksiniz.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Laravel', 'Livewire', 'PHP', 'Tutorial'],
                ],
                [
                    'title' => 'Docker ile Laravel Geliştirme Ortamı',
                    'slug' => 'docker-laravel-gelistirme-ortami',
                    'excerpt' => 'Docker kullanarak tutarlı Laravel geliştirme ortamı kurma',
                    'content' => 'Docker, tutarlı ve taşınabilir geliştirme ortamları oluşturmak için mükemmel bir araçtır. Bu rehberde Laravel projeleriniz için Docker ortamı kuracağız.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Docker', 'Laravel', 'DevOps', 'Tutorial'],
                ],
                [
                    'title' => 'API Testing ile Laravel',
                    'slug' => 'api-testing-laravel',
                    'excerpt' => 'Laravel ile API testleri nasıl yazılır',
                    'content' => 'Güvenilir API\'ler geliştirmek için kapsamlı testler yazmak kritik önem taşır. Bu yazıda Laravel ile API testleri yazmayı detaylı olarak ele alacağız.',
                    'user_id' => 1,
                    'category_id' => 1,
                    'is_published' => true,
                    'published_at' => now(),
                    'tags' => ['Laravel', 'API', 'Testing', 'Best Practices'],
                ],
            ];

            foreach ($samplePosts as $postData) {
                $tags = $postData['tags'];
                unset($postData['tags']);

                $post = Post::create($postData);
                $post->syncTags($tags);
            }
        } else {
            // Mevcut postlara rastgele taglar ata
            $this->command->info('Assigning tags to existing posts...');

            $tagGroups = [
                ['Laravel', 'PHP', 'Tutorial'],
                ['Vue.js', 'JavaScript', 'Beginner'],
                ['React', 'JavaScript', 'Advanced'],
                ['Tailwind CSS', 'Tutorial', 'Tips'],
                ['Laravel', 'Livewire', 'PHP'],
                ['API', 'Laravel', 'Best Practices'],
                ['Testing', 'PHP', 'Advanced'],
                ['Performance', 'Laravel', 'Tips'],
                ['Security', 'PHP', 'Best Practices'],
                ['Docker', 'DevOps', 'Tutorial'],
            ];

            foreach ($posts as $index => $post) {
                $tagGroup = $tagGroups[$index % count($tagGroups)];
                $post->syncTags($tagGroup);
                $this->command->info("Assigned tags to post: {$post->title}");
            }
        }
    }
}
