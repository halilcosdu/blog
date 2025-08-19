<?php

namespace App\Console\Commands;

use App\Models\Discussion;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixDuplicateDiscussionSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discussion:fix-slugs {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix duplicate discussion slugs by making them unique';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $isDryRun = $this->option('dry-run');

        if ($isDryRun) {
            $this->info('Running in dry-run mode. No changes will be made.');
        }

        // Find discussions with duplicate slugs
        $duplicateSlugGroups = Discussion::select('slug', DB::raw('count(*) as slug_count'))
            ->groupBy('slug')
            ->havingRaw('count(*) > 1')
            ->get();

        if ($duplicateSlugGroups->isEmpty()) {
            $this->info('No duplicate slugs found.');

            return;
        }

        $this->info("Found {$duplicateSlugGroups->count()} slug groups with duplicates.");

        $totalFixed = 0;

        foreach ($duplicateSlugGroups as $group) {
            $discussions = Discussion::where('slug', $group->slug)
                ->orderBy('id')
                ->get();

            $this->line("Processing slug: '{$group->slug}' ({$group->slug_count} discussions)");

            // Keep the first one as is, update the rest
            foreach ($discussions->skip(1) as $index => $discussion) {
                $newSlug = Discussion::generateUniqueSlug($discussion->title, $discussion->id);

                if ($isDryRun) {
                    $this->line("  Would update Discussion ID {$discussion->id}: '{$discussion->slug}' → '{$newSlug}'");
                } else {
                    $discussion->update(['slug' => $newSlug]);
                    $this->line("  Updated Discussion ID {$discussion->id}: '{$discussion->slug}' → '{$newSlug}'");
                }

                $totalFixed++;
            }
        }

        if ($isDryRun) {
            $this->info("Dry-run complete. Would fix {$totalFixed} duplicate slugs.");
            $this->line('Run without --dry-run to apply changes.');
        } else {
            $this->info("Fixed {$totalFixed} duplicate slugs.");
        }
    }
}
