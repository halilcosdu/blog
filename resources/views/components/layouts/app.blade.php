<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CodeBlog' }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Laravel, PHP ve modern web teknolojileri hakkında güncel yazılar, kod örnekleri ve rehberler.">
    <meta name="keywords" content="Laravel, PHP, JavaScript, Vue.js, React, Web Development, Coding">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    {{ $slot }}
    
    @livewireScripts
</body>
</html>