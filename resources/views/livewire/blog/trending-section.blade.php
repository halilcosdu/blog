<!-- Trending Tags & Popular Posts -->
<section class="py-16 lg:py-24" wire:init="loadContent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!$loaded)
        <!-- Loading skeleton -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <!-- Trending Tags Skeleton -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded-lg w-40 mb-2 animate-pulse"></div>
                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-56 animate-pulse"></div>
                </div>
                <div class="flex flex-wrap gap-3 mb-10">
                    @for($i = 0; $i < 8; $i++)
                    <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded-full w-16 animate-pulse"></div>
                    @endfor
                </div>

                <!-- Top Authors Skeleton -->
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl p-5">
                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-32 mb-4 animate-pulse"></div>
                    <div class="space-y-4">
                        @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse"></div>
                            <div class="flex-1">
                                <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-24 mb-1 animate-pulse"></div>
                                <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-16 animate-pulse"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Packages Skeleton -->
                <div class="mt-10">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl p-5">
                        <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-24 mb-4 animate-pulse"></div>
                        <div class="space-y-4">
                            @for($i = 0; $i < 4; $i++)
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse"></div>
                                <div class="flex-1">
                                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-32 mb-1 animate-pulse"></div>
                                    <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-24 mb-1 animate-pulse"></div>
                                    <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-16 animate-pulse"></div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Posts Skeleton -->
            <div class="lg:col-span-2">
                <div class="mb-6">
                    <div class="h-8 bg-slate-200 dark:bg-slate-700 rounded-lg w-40 mb-2 animate-pulse"></div>
                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-56 animate-pulse"></div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    @for($i = 0; $i < 4; $i++)
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl overflow-hidden">
                        <div class="h-32 bg-slate-200 dark:bg-slate-700 animate-pulse"></div>
                        <div class="p-4">
                            <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded mb-2 animate-pulse"></div>
                            <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-3/4 mb-3 animate-pulse"></div>
                            <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-1/2 animate-pulse"></div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        @else
        <!-- Actual content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            <!-- Trending Tags -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">Trending Tags</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">What the community is reading now</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    @forelse($trendingTags as $tag)
                        <a href="/tags/{{ $tag }}" class="px-3 py-1.5 rounded-full text-sm bg-white/60 dark:bg-slate-800/60 backdrop-blur border border-slate-200/60 dark:border-slate-700/60 hover:bg-white/90 dark:hover:bg-slate-800/90 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                            #{{ $tag }}
                        </a>
                    @empty
                        <span class="text-slate-500 dark:text-slate-400 text-sm">No trending tags yet</span>
                    @endforelse
                </div>

                <!-- Top Authors -->
                <div class="mt-10">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">Top Authors</h4>
                        </div>
                        <ul class="divide-y divide-slate-200/60 dark:divide-slate-700/60">
                            @forelse($topAuthors as $author)
                                <li>
                                    <a href="/authors/{{ \Illuminate\Support\Str::slug($author->name) }}" class="flex items-center py-3 group">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-sm mr-3">
                                            {{ substr($author->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors truncate">
                                                {{ $author->name }}
                                            </p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                {{ $author->posts_count }} {{ Str::plural('post', $author->posts_count) }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="py-3 text-sm text-slate-500 dark:text-slate-400">No authors yet</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Packages -->
                <div class="mt-10">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">Packages</h4>
                        </div>
                        <ul class="divide-y divide-slate-200/60 dark:divide-slate-700/60">
                            @php
                                $packages = [
                                    [
                                        'name' => 'phpuzem/laravel-boost',
                                        'description' => 'Supercharge your Laravel development workflow',
                                        'status' => 'Coming Soon',
                                        'icon' => '🚀',
                                        'url' => '#'
                                    ],
                                    [
                                        'name' => 'phpuzem/eloquent-plus',
                                        'description' => 'Advanced Eloquent model enhancements',
                                        'status' => 'In Development',
                                        'icon' => '⚡',
                                        'url' => '#'
                                    ],
                                    [
                                        'name' => 'phpuzem/test-helpers',
                                        'description' => 'Powerful testing utilities for Laravel',
                                        'status' => 'Planning',
                                        'icon' => '🧪',
                                        'url' => '#'
                                    ],
                                    [
                                        'name' => 'phpuzem/api-kit',
                                        'description' => 'Complete API development toolkit',
                                        'status' => 'Planning',
                                        'icon' => '🔧',
                                        'url' => '#'
                                    ],
                                     [
                                        'name' => 'phpuzem/api-kit',
                                        'description' => 'Complete API development toolkit',
                                        'status' => 'Planning',
                                        'icon' => '🔧',
                                        'url' => '#'
                                    ]
                                ];
                            @endphp
                            @foreach($packages as $package)
                                <li>
                                    <div class="flex items-center py-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-600 to-purple-500 flex items-center justify-center text-white text-sm mr-3">
                                            {{ $package['icon'] }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium truncate">
                                                <a href="{{ $package['url'] }}" class="text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                                    {{ $package['name'] }}
                                                </a>
                                            </p>
                                            <p class="text-xs text-slate-600 dark:text-slate-300 mb-1">
                                                {{ $package['description'] }}
                                            </p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium
                                                    {{ $package['status'] === 'Coming Soon' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : '' }}
                                                    {{ $package['status'] === 'In Development' ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300' : '' }}
                                                    {{ $package['status'] === 'Planning' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' : '' }}">
                                                    {{ $package['status'] }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Popular Posts -->
            <div class="lg:col-span-2">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">Popular Posts</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Most viewed content</p>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($popularPosts as $post)
                        <article class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl overflow-hidden hover:shadow-lg transition-shadow group">
                            @if($post->featured_image)
                                <div class="aspect-video overflow-hidden">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @endif
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        {{ $post->category->name }}
                                    </span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ number_format($post->views_count) }} views
                                    </span>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-1 line-clamp-2">
                                    <a href="/posts/{{ $post->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    by {{ $post->user->name }} • {{ $post->published_at->format('M j, Y') }}
                                </p>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-2 text-center py-8 text-slate-500 dark:text-slate-400">
                            No popular posts yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
