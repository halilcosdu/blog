@props([
    'title' => 'phpuzem - Modern PHP & Laravel Development',
    'description' => 'Practical screencasts and complete learning paths for modern PHP & Laravel development. Learn by building real projects, at your own pace.',
    'keywords' => 'Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding, Tailwind, Livewire',
    'image' => asset('images/og-default.jpg'),
    'url' => request()->url(),
    'type' => 'website',
    'siteName' => 'phpuzem',
    'locale' => 'en_US',
    'author' => 'phpuzem',
    'publishedTime' => null,
    'modifiedTime' => null,
    'section' => null,
    'tags' => [],
    'breadcrumbs' => [],
    'readingTime' => null,
    'wordCount' => null,
    'category' => null,
    'authorEmail' => null,
    'authorImage' => null,
])

<!-- Primary Meta Tags -->
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="revisit-after" content="7 days">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $url }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">
@if($author && $type === 'article')
<meta property="og:article:author" content="{{ $author }}">
@endif

@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif

@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

@if($section)
<meta property="article:section" content="{{ $section }}">
@endif

@if($tags && count($tags) > 0)
    @foreach($tags as $tag)
    <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@phpuzem">
<meta name="twitter:creator" content="@phpuzem">
<meta name="twitter:url" content="{{ $url }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:image:alt" content="{{ $title }}">
@if($author && $type === 'article')
<meta name="twitter:label1" content="Written by">
<meta name="twitter:data1" content="{{ $author }}">
@endif
@if($readingTime && $type === 'article')
<meta name="twitter:label2" content="Reading time">
<meta name="twitter:data2" content="{{ $readingTime }}">
@endif

<!-- Additional SEO -->
<meta name="theme-color" content="#ef4444">
<meta name="msapplication-TileColor" content="#ef4444">

<!-- Schema.org structured data -->
@if($type === 'article')
<!-- Article Schema -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $title,
    'description' => $description,
    'url' => $url,
    'image' => [
        '@type' => 'ImageObject',
        'url' => $image,
        'width' => 1200,
        'height' => 630
    ],
    'author' => array_filter([
        '@type' => 'Person',
        'name' => $author,
        'email' => $authorEmail,
        'image' => $authorImage
    ]),
    'publisher' => [
        '@type' => 'Organization',
        'name' => $siteName,
        'url' => config('app.url'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/logo.png'),
            'width' => 600,
            'height' => 60
        ],
        'sameAs' => [
            'https://twitter.com/phpuzem',
            'https://github.com/phpuzem'
        ]
    ],
    'datePublished' => $publishedTime,
    'dateModified' => $modifiedTime,
    'articleSection' => $section,
    'about' => $category ? ['@type' => 'Thing', 'name' => $category] : null,
    'keywords' => $tags && count($tags) > 0 ? $tags : null,
    'timeRequired' => $readingTime,
    'wordCount' => $wordCount,
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $url
    ],
    'inLanguage' => 'en-US'
] + array_filter([]), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
@else
<!-- Website/WebPage Schema -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $title,
    'description' => $description,
    'url' => $url,
    'image' => $image,
    'publisher' => [
        '@type' => 'Organization',
        'name' => $siteName,
        'url' => config('app.url'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => asset('images/logo.png'),
            'width' => 600,
            'height' => 60
        ],
        'sameAs' => [
            'https://twitter.com/phpuzem',
            'https://github.com/phpuzem'
        ]
    ],
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => config('app.url') . '/search?q={search_term_string}',
        'query-input' => 'required name=search_term_string'
    ],
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $url
    ],
    'inLanguage' => 'en-US'
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif

<!-- Organization Schema -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $siteName,
    'url' => config('app.url'),
    'logo' => [
        '@type' => 'ImageObject',
        'url' => asset('images/logo.png'),
        'width' => 600,
        'height' => 60
    ],
    'description' => 'Modern PHP & Laravel development platform offering practical screencasts, tutorials, and complete learning paths for web developers.',
    'foundingDate' => '2024',
    'sameAs' => [
        'https://twitter.com/phpuzem',
        'https://github.com/phpuzem'
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'customer service',
        'availableLanguage' => 'English'
    ]
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>

@if($breadcrumbs && count($breadcrumbs) > 0)
<!-- BreadcrumbList Schema -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => collect($breadcrumbs)->map(function($breadcrumb, $index) {
        return [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $breadcrumb['name'],
            'item' => $breadcrumb['url']
        ];
    })->values()->toArray()
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
@endif