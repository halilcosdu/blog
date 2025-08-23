<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users first
        $this->call([
            UserSeeder::class,
        ]);

        // Seed base data
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            DiscussionSeeder::class,
            PackageSeeder::class,
        ]);

        // Seed tags and assign them to content
        $this->call([
            PostTagSeeder::class,
            DiscussionTagSeeder::class,
            PackageTagSeeder::class,
        ]);

        // Seed video content
        $this->call([
            SeriesSeeder::class,
            EpisodeSeeder::class,
            PathwaySeeder::class,
        ]);

        // Seed user interactions
        $this->call([
            EpisodeCommentSeeder::class,
            UserProgressSeeder::class,
            UserWatchlistSeeder::class,
        ]);
    }
}
