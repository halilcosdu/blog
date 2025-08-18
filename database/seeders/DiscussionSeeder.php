<?php

namespace Database\Seeders;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discussion::factory(30)->create()->each(function (Discussion $discussion) {
            $replies = DiscussionReply::factory(rand(0, 15))->create([
                'discussion_id' => $discussion->id,
            ]);

            if ($discussion->is_resolved && $replies->count() > 0) {
                $bestAnswer = $replies->random();
                $bestAnswer->is_best_answer = true;
                $bestAnswer->save();
            }
        });
    }
}
