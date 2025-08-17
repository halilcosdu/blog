<?php

namespace App\Services;

class SEOService
{
    /**
     * Get homepage SEO data
     */
    public function getHomepageSEO(): array
    {
        return [
            'title' => 'phpuzem - Modern PHP & Laravel Development',
            'description' => 'Practical screencasts and complete learning paths for modern PHP & Laravel development. Learn by building real projects, at your own pace.',
            'keywords' => 'Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding, Tailwind, Livewire, Tutorial, Screencast',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-homepage.jpg'),
        ];
    }

    /**
     * Get post SEO data
     */
    public function getPostSEO($post): array
    {
        return [
            'title' => $post->title.' - phpuzem',
            'description' => $post->excerpt ?? $post->title,
            'keywords' => implode(', ', $post->tags ?? []).', Laravel, PHP, Tutorial',
            'url' => request()->url(),
            'type' => 'article',
            'image' => $post->featured_image ?? asset('images/og-default.jpg'),
            'article' => [
                'published_time' => $post->published_at?->toISOString(),
                'modified_time' => $post->updated_at?->toISOString(),
                'author' => $post->user->name ?? '',
                'section' => $post->category->name ?? '',
                'tag' => $post->tags ?? [],
            ],
        ];
    }

    /**
     * Get category SEO data
     */
    public function getCategorySEO($category): array
    {
        return [
            'title' => $category->name.' - phpuzem',
            'description' => $category->description ?? "Learn {$category->name} with practical tutorials and screencasts.",
            'keywords' => $category->name.', Laravel, PHP, Tutorial, Screencast',
            'url' => request()->url(),
            'type' => 'website',
            'image' => $category->image ?? asset('images/og-default.jpg'),
        ];
    }

    /**
     * Get pricing page SEO data
     */
    public function getPricingSEO(): array
    {
        return [
            'title' => 'Pricing - phpuzem',
            'description' => 'Choose your learning path. Start free or upgrade to premium for access to all courses and exclusive content.',
            'keywords' => 'phpuzem pricing, Laravel courses, PHP tutorials, programming education',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-pricing.jpg'),
        ];
    }

    /**
     * Get generic page SEO data
     */
    public function getPageSEO(string $title, ?string $description = null, array $extra = []): array
    {
        $defaultDescription = 'Learn modern PHP & Laravel development with practical screencasts and tutorials.';

        return array_merge([
            'title' => $title.' - phpuzem',
            'description' => $description ?? $defaultDescription,
            'keywords' => 'Laravel, PHP, Tutorial, Screencast, Web Development',
            'url' => request()->url(),
            'type' => 'website',
            'image' => asset('images/og-default.jpg'),
        ], $extra);
    }

    /**
     * Generate structured data for homepage
     */
    public function getHomepageStructuredData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'phpuzem',
            'description' => 'Modern PHP & Laravel Development Tutorials',
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/search?q={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate structured data for post
     */
    public function getPostStructuredData($post): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => $post->featured_image,
            'datePublished' => $post->published_at?->toISOString(),
            'dateModified' => $post->updated_at?->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $post->user->name ?? '',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'phpuzem',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
        ];
    }
}
