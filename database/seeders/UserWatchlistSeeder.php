<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Pathway;
use App\Models\Series;
use App\Models\User;
use App\Models\UserWatchlist;
use Illuminate\Database\Seeder;

class UserWatchlistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('type', 0)->get(); // Normal users only
        $episodes = Episode::all();
        $series = Series::all();
        $pathways = Pathway::all();

        foreach ($users as $user) {
            // Episodes to watchlist
            $episodeCount = min(rand(2, 8), $episodes->count());
            $randomEpisodes = $episodes->random($episodeCount);
            foreach ($randomEpisodes as $episode) {
                UserWatchlist::create([
                    'user_id' => $user->id,
                    'watchable_type' => Episode::class,
                    'watchable_id' => $episode->id,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }

            // Series to watchlist
            $seriesCount = min(rand(1, 3), $series->count());
            $randomSeries = $series->random($seriesCount);
            foreach ($randomSeries as $seriesItem) {
                UserWatchlist::create([
                    'user_id' => $user->id,
                    'watchable_type' => Series::class,
                    'watchable_id' => $seriesItem->id,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }

            // Pathways to watchlist
            if (rand(0, 1)) { // 50% chance
                $randomPathway = $pathways->random();
                UserWatchlist::create([
                    'user_id' => $user->id,
                    'watchable_type' => Pathway::class,
                    'watchable_id' => $randomPathway->id,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}