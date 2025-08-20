<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // Programming Languages
            ['name' => 'PHP', 'slug' => 'php', 'color' => '#4F5B93', 'description' => 'PHP programlama dili ile ilgili içerikler'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#F7DF1E', 'description' => 'JavaScript ile ilgili içerikler'],
            ['name' => 'TypeScript', 'slug' => 'typescript', 'color' => '#3178C6', 'description' => 'TypeScript ile ilgili içerikler'],
            ['name' => 'Python', 'slug' => 'python', 'color' => '#3776AB', 'description' => 'Python programlama dili'],

            // Frameworks
            ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20', 'description' => 'Laravel framework ile ilgili içerikler', 'is_featured' => true],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'color' => '#4FC08D', 'description' => 'Vue.js framework'],
            ['name' => 'React', 'slug' => 'react', 'color' => '#61DAFB', 'description' => 'React framework'],
            ['name' => 'Livewire', 'slug' => 'livewire', 'color' => '#4E56A6', 'description' => 'Laravel Livewire'],
            ['name' => 'Inertia.js', 'slug' => 'inertiajs', 'color' => '#9553E9', 'description' => 'Inertia.js framework'],

            // Tools & Technologies
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css', 'color' => '#06B6D4', 'description' => 'Tailwind CSS framework', 'is_featured' => true],
            ['name' => 'Alpine.js', 'slug' => 'alpinejs', 'color' => '#8BC34A', 'description' => 'Alpine.js JavaScript framework'],
            ['name' => 'Vite', 'slug' => 'vite', 'color' => '#646CFF', 'description' => 'Vite build tool'],
            ['name' => 'Docker', 'slug' => 'docker', 'color' => '#2496ED', 'description' => 'Docker containerization'],

            // Database
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => '#4479A1', 'description' => 'MySQL veritabanı'],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'color' => '#336791', 'description' => 'PostgreSQL veritabanı'],
            ['name' => 'Redis', 'slug' => 'redis', 'color' => '#DC382D', 'description' => 'Redis cache'],

            // Concepts
            ['name' => 'API', 'slug' => 'api', 'color' => '#FF6B35', 'description' => 'API geliştirme ve entegrasyon'],
            ['name' => 'Testing', 'slug' => 'testing', 'color' => '#41B883', 'description' => 'Yazılım test etme'],
            ['name' => 'Performance', 'slug' => 'performance', 'color' => '#FF4081', 'description' => 'Performans optimizasyonu'],
            ['name' => 'Security', 'slug' => 'security', 'color' => '#F44336', 'description' => 'Güvenlik konuları'],
            ['name' => 'DevOps', 'slug' => 'devops', 'color' => '#FF9800', 'description' => 'DevOps ve deployment'],

            // General
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#2196F3', 'description' => 'Öğretici içerikler'],
            ['name' => 'Tips', 'slug' => 'tips', 'color' => '#4CAF50', 'description' => 'İpuçları ve püf noktaları'],
            ['name' => 'Best Practices', 'slug' => 'best-practices', 'color' => '#9C27B0', 'description' => 'En iyi pratikler'],
            ['name' => 'Beginner', 'slug' => 'beginner', 'color' => '#8BC34A', 'description' => 'Başlangıç seviyesi'],
            ['name' => 'Advanced', 'slug' => 'advanced', 'color' => '#FF5722', 'description' => 'İleri seviye'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }
}
