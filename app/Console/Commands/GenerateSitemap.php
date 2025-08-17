<?php

namespace App\Console\Commands;

use App\Http\Controllers\SitemapController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate XML sitemap and cache it for better performance';

    public function handle(): int
    {
        $this->info('Generating XML sitemap...');

        try {
            $controller = new SitemapController();
            $response = $controller->index();
            $sitemapXml = $response->getContent();

            // Cache the sitemap for 1 hour
            Cache::put('sitemap.xml', $sitemapXml, 3600);

            // Optionally save to storage for static serving
            Storage::disk('public')->put('sitemap.xml', $sitemapXml);

            $this->info('✅ Sitemap generated successfully!');
            $this->line("📍 Available at: " . config('app.url') . '/sitemap.xml');

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('❌ Failed to generate sitemap: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}