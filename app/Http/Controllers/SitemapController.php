<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        // Try to get cached sitemap first
        $xml = \Cache::remember('sitemap.xml', 3600, function () {
            $posts = Post::query()
                ->published()
                ->select(['slug', 'updated_at', 'published_at'])
                ->orderByDesc('published_at')
                ->get();

            $categories = Category::query()
                ->where('is_active', true)
                ->select(['slug', 'updated_at'])
                ->get();

            return $this->generateSitemapXml($posts, $categories);
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600', // Cache for 1 hour
        ]);
    }

    private function generateSitemapXml($posts, $categories): string
    {
        $baseUrl = config('app.url');
        $now = now()->toISOString();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->addUrlToSitemap($baseUrl, $now, 'daily', '1.0');

        // Pricing page
        $xml .= $this->addUrlToSitemap($baseUrl . '/pricing', $now, 'monthly', '0.8');

        // Posts
        foreach ($posts as $post) {
            $url = $baseUrl . '/posts/' . $post->slug;
            $lastmod = $post->updated_at->toISOString();
            $xml .= $this->addUrlToSitemap($url, $lastmod, 'weekly', '0.9');
        }

        // Categories
        foreach ($categories as $category) {
            $url = $baseUrl . '/category/' . $category->slug;
            $lastmod = $category->updated_at->toISOString();
            $xml .= $this->addUrlToSitemap($url, $lastmod, 'weekly', '0.7');
        }

        $xml .= '</urlset>';

        return $xml;
    }

    private function addUrlToSitemap(string $url, string $lastmod, string $changefreq, string $priority): string
    {
        return "  <url>\n" .
               "    <loc>{$url}</loc>\n" .
               "    <lastmod>{$lastmod}</lastmod>\n" .
               "    <changefreq>{$changefreq}</changefreq>\n" .
               "    <priority>{$priority}</priority>\n" .
               "  </url>\n";
    }
}