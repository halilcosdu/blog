<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\EpisodeComment;
use App\Models\User;
use Illuminate\Database\Seeder;

class EpisodeCommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $episodes = Episode::all();

        $realComments = [
            'Mükemmel anlatım! Laravel 12 ile ilgili öğrendiğim en kapsamlı kurs.',
            'Çok detaylı ve anlaşılır. Teşekkürler hocam.',
            'Bu seride hangi editörü kullanıyorsunuz? VS Code mu?',
            'Filament ile böyle projeler yapabilir miyiz?',
            'Authentication kısmını daha detaylı açıklar mısınız?',
            'Gerçekten çok faydalı bir ders. Ellerinize sağlık.',
            'API kısmında cors hatası alıyorum, nasıl çözebilirim?',
            'Laravel 11 ile 12 arasında ne fark var?',
            'Middleware kullanımını örneklerle gösterebilir misiniz?',
            'Database migration konusunda sıkıntı yaşıyorum.',
            'Bu proje Github\'da mevcut mu?',
            'Livewire 3 ile alakalı daha detaylı video gelecek mi?',
            'Testing kısmı çok güzel açıklanmış.',
            'Docker setup\'ı tam olarak nasıl yapıyoruz?',
            'Vue.js entegrasyonu hangi versiyonda çalışıyor?',
            'Security best practices başka videolarda da gösterebilir misiniz?',
            'Bu dersi izledikten sonra hangi projeye başlayabilirim?',
            'Kod örneklerini paylaşabilir misiniz?',
            'Çok net anlatıyorsunuz, takip etmesi kolay.',
            'Laravel community\'den çok şey öğreniyorum.',
        ];

        foreach ($episodes as $episode) {
            // Her episode için 3-8 arası yorum ekle
            $commentCount = rand(3, 8);
            
            for ($i = 0; $i < $commentCount; $i++) {
                $user = $users->random();
                $content = $realComments[array_rand($realComments)];
                
                EpisodeComment::create([
                    'episode_id' => $episode->id,
                    'user_id' => $user->id,
                    'content' => $content,
                    'is_best_answer' => false,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        // Bazı yorumları en iyi cevap olarak işaretle
        EpisodeComment::inRandomOrder()
            ->limit(10)
            ->update(['is_best_answer' => true]);
    }
}