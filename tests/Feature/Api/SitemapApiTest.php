<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

uses(RefreshDatabase::class);

describe('Sitemap API Endpoint', function () {
    it('returns XML sitemap with correct content type', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false);
    });
    
    it('includes homepage in sitemap', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<loc>' . config('app.url') . '</loc>', false);
        $response->assertSee('<changefreq>daily</changefreq>', false);
        $response->assertSee('<priority>1.0</priority>', false);
    });
    
    it('includes pricing page in sitemap', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<loc>' . config('app.url') . '/pricing</loc>', false);
        $response->assertSee('<changefreq>monthly</changefreq>', false);
        $response->assertSee('<priority>0.8</priority>', false);
    });
    
    it('includes published posts in sitemap', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        
        $publishedPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'published-post',
            'is_published' => true,
        ]);
        
        $unpublishedPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'unpublished-post',
            'is_published' => false,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<loc>' . config('app.url') . '/posts/published-post</loc>', false);
        $response->assertDontSee('<loc>' . config('app.url') . '/posts/unpublished-post</loc>', false);
    });
    
    it('includes active categories in sitemap', function () {
        $activeCategory = Category::factory()->create([
            'slug' => 'active-category',
            'is_active' => true,
        ]);
        
        $inactiveCategory = Category::factory()->create([
            'slug' => 'inactive-category',
            'is_active' => false,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<loc>' . config('app.url') . '/category/active-category</loc>', false);
        $response->assertDontSee('<loc>' . config('app.url') . '/category/inactive-category</loc>', false);
    });
    
    it('orders posts by published date descending', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        
        $olderPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'older-post',
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);
        
        $newerPost = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'newer-post',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $content = $response->getContent();
        $newerPostPos = strpos($content, '/posts/newer-post');
        $olderPostPos = strpos($content, '/posts/older-post');
        
        expect($newerPostPos)->toBeLessThan($olderPostPos);
    });
    
    it('includes correct lastmod dates for posts', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'test-post',
            'is_published' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<lastmod>' . $post->updated_at->toISOString() . '</lastmod>', false);
    });
    
    it('includes correct lastmod dates for categories', function () {
        $category = Category::factory()->create([
            'slug' => 'test-category',
            'is_active' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<lastmod>' . $category->updated_at->toISOString() . '</lastmod>', false);
    });
    
    it('uses correct priorities for different content types', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);
        
        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        $content = $response->getContent();
        
        // Homepage has priority 1.0
        expect($content)->toContain('<priority>1.0</priority>');
        
        // Posts have priority 0.9
        expect($content)->toContain('<priority>0.9</priority>');
        
        // Pricing page has priority 0.8
        expect($content)->toContain('<priority>0.8</priority>');
        
        // Categories have priority 0.7
        expect($content)->toContain('<priority>0.7</priority>');
    });
    
    it('uses correct changefreq for different content types', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);
        
        Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        $content = $response->getContent();
        
        // Homepage changes daily
        expect($content)->toContain('<changefreq>daily</changefreq>');
        
        // Posts and categories change weekly
        expect($content)->toContain('<changefreq>weekly</changefreq>');
        
        // Pricing page changes monthly
        expect($content)->toContain('<changefreq>monthly</changefreq>');
    });
    
    it('sets correct cache headers', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertHeader('Cache-Control', 'max-age=3600, public');
    });
    
    it('caches sitemap for performance', function () {
        Cache::shouldReceive('remember')
            ->once()
            ->with('sitemap.xml', 3600, \Closure::class)
            ->andReturn('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
        
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
    });
    
    it('generates well-formed XML structure', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);
        
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $content = $response->getContent();
        
        // Test that it's well-formed XML
        $xml = simplexml_load_string($content);
        expect($xml)->not->toBeFalse();
        
        // Test namespace
        expect($xml->getName())->toBe('urlset');
        
        // Test that URLs have required elements
        $urls = $xml->url;
        foreach ($urls as $url) {
            expect($url->loc)->not->toBeNull();
            expect($url->lastmod)->not->toBeNull();
            expect($url->changefreq)->not->toBeNull();
            expect($url->priority)->not->toBeNull();
        }
    });
    
    it('handles empty database gracefully', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertSuccessful();
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false);
        $response->assertSee('</urlset>', false);
        
        // Should still include homepage and pricing
        $response->assertSee(config('app.url'), false);
        $response->assertSee(config('app.url') . '/pricing', false);
    });
    
    it('escapes URLs properly in XML', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => true]);
        
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'slug' => 'test-post-with-special-chars',
            'is_published' => true,
        ]);
        
        $response = $this->get('/sitemap.xml');
        
        $content = $response->getContent();
        $xml = simplexml_load_string($content);
        
        expect($xml)->not->toBeFalse();
    });
    
    it('has correct route name', function () {
        expect(route('sitemap'))->toBe(url('/sitemap.xml'));
    });
    
    it('returns 200 status code', function () {
        $response = $this->get('/sitemap.xml');
        
        $response->assertStatus(200);
    });
    
    it('handles large number of posts and categories efficiently', function () {
        $user = User::factory()->create();
        $categories = Category::factory(10)->create(['is_active' => true]);
        
        foreach ($categories as $category) {
            Post::factory(10)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'is_published' => true,
            ]);
        }
        
        $startTime = microtime(true);
        $response = $this->get('/sitemap.xml');
        $endTime = microtime(true);
        
        $response->assertSuccessful();
        
        // Should complete within reasonable time (2 seconds)
        expect($endTime - $startTime)->toBeLessThan(2.0);
        
        // Should include all posts and categories
        $content = $response->getContent();
        expect(substr_count($content, '<url>'))->toBeGreaterThan(100); // 100 posts + 10 categories + homepage + pricing
    });
});