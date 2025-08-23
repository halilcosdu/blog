<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Database\Seeder;

class UserProgressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('type', 0)->get(); // Normal users only
        $episodes = Episode::all();

        foreach ($users as $user) {
            // Her kullanıcı için rastgele episodlarda progress oluştur
            $episodeCount = min(rand(3, 12), $episodes->count());
            $randomEpisodes = $episodes->random($episodeCount);
            
            foreach ($randomEpisodes as $episode) {
                $watchedSeconds = rand(60, $episode->duration_minutes * 60);
                $totalSeconds = $episode->duration_minutes * 60;
                $progressPercentage = min(100, ($watchedSeconds / $totalSeconds) * 100);
                $isCompleted = $progressPercentage >= 95;
                
                UserProgress::create([
                    'user_id' => $user->id,
                    'progressable_type' => Episode::class,
                    'progressable_id' => $episode->id,
                    'watched_seconds' => $watchedSeconds,
                    'total_seconds' => $totalSeconds,
                    'progress_percentage' => round($progressPercentage, 2),
                    'is_completed' => $isCompleted,
                    'started_at' => now()->subDays(rand(1, 60)),
                    'completed_at' => $isCompleted ? now()->subDays(rand(0, 30)) : null,
                    'last_watched_at' => now()->subDays(rand(0, 7)),
                ]);
            }
        }
    }
}