<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic SEO Meta Tags -->
    @if(isset($seoData))
        <x-seo.meta-tags v-bind="$seoData" />
    @else
        <!-- Fallback Meta Tags -->
        <title>{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}</title>
        <meta name="description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development. Learn by building real projects, at your own pace.">
        <meta name="keywords" content="Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding, Tailwind, Livewire">
        <meta name="author" content="phpuzem">
        <link rel="canonical" href="{{ request()->url() }}">
        
        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ request()->url() }}">
        <meta property="og:title" content="{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}">
        <meta property="og:description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development.">
        <meta property="og:site_name" content="phpuzem">
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="{{ $title ?? 'phpuzem - Modern PHP & Laravel Development' }}">
        <meta property="twitter:description" content="Practical screencasts and complete learning paths for modern PHP & Laravel development.">
    @endif
    
    <!-- Sitemap for search engines -->
    <link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

        <!-- Theme bootstrap: set initial light/dark before CSS to avoid FOUC -->
        <script>
            (function () {
                try {
                    var stored = localStorage.getItem('theme');
                    var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'dark' || (!stored && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) { /* no-op */ }
            })();
        </script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    {{ $slot }}
    
        @livewireScripts
        @stack('scripts')
        <!-- Global theme toggle handler -->
        <script>
            (function () {
                function setTheme(next) {
                    var html = document.documentElement;
                    if (next === 'dark') {
                        html.classList.add('dark');
                    } else {
                        html.classList.remove('dark');
                    }
                    try { localStorage.setItem('theme', next); } catch (e) {}
                }

                // Delegate clicks so it survives Livewire re-renders
                document.addEventListener('click', function (e) {
                    var btn = e.target.closest && e.target.closest('#theme-toggle');
                    if (!btn) return;
                    var isDark = document.documentElement.classList.contains('dark');
                    setTheme(isDark ? 'light' : 'dark');
                });

                // Optional: sync across tabs
                window.addEventListener('storage', function (e) {
                    if (e.key !== 'theme') return;
                    if (e.newValue === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                });
            })();
        </script>
</body>
</html>