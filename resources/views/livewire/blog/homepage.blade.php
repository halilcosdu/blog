<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    
    <x-shared.header current-page="home" />

    <x-shared.announcements />

    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Minimal background -->
        <div class="absolute inset-0 bg-gradient-to-br from-red-50/60 via-orange-50/30 to-yellow-50/60 dark:from-red-950/20 dark:via-orange-950/10 dark:to-yellow-950/20"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto">
                <!-- Brand pill -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 mb-8">
                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">phpuzem · Screencasts</span>
                </div>

                <!-- Headline -->
                <h1 class="text-5xl lg:text-7xl font-bold mb-4 leading-tight">
                    <span class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 dark:from-white dark:via-slate-100 dark:to-white bg-clip-text text-transparent">
                        Learn PHP the Modern Way
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-slate-600 dark:text-slate-400 mb-8 leading-relaxed max-w-3xl mx-auto">
                    Hands‑on screencasts and complete series for PHP & Laravel developers. Start free — upgrade anytime.
                </p>

                <!-- Spotlight trigger search in hero -->
                <div class="max-w-2xl mx-auto mb-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input data-spotlight-trigger type="text" placeholder="Search series, lessons…  (⌘K)" class="pl-12 pr-4 py-4 w-full text-base bg-white/70 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all" />
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10">
                    <a href="#latest-series" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-2xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300 hover:-translate-y-0.5 cursor-pointer">
                        <span>Start Learning Free</span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </a>
                    <button type="button" data-trailer-open class="group inline-flex items-center px-8 py-4 bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-slate-200/70 dark:border-slate-700/70 text-slate-800 dark:text-slate-200 font-semibold rounded-2xl hover:bg-white/90 dark:hover:bg-slate-800/90 transition-all duration-300 hover:-translate-y-0.5 cursor-pointer">
                        <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 4l10 6-10 6V4z"/></svg>
                        <span>Watch Trailer</span>
                    </button>
                </div>

                <!-- Quick categories / trust -->
                <div class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm text-slate-600 dark:text-slate-400">
                    <div class="flex items-center justify-center gap-2"><svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> No credit card for free lessons</div>
                    <div class="flex items-center justify-center gap-2"><svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Project‑based curriculum</div>
                    <div class="flex items-center justify-center gap-2"><svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Beginner → advanced paths</div>
                </div>

                <!-- Latest Series Slider (replaces stats) -->
                <div class="mt-4 text-center">
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Latest Series</h2>
                    </div>

                    <div class="w-screen ml-[calc(50%-50vw)]">
                        <div id="series-track" class="flex gap-5 overflow-x-auto overflow-y-hidden snap-x snap-mandatory scroll-smooth pb-2 pl-4 sm:pl-6 pr-0 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                        @php
                            $hasSeries = isset($series) && method_exists($series, 'count') ? $series->count() > 0 : false;
                        @endphp
                        @if($hasSeries)
                            @foreach($series as $s)
                                <a href="/series/{{ $s->slug }}" class="group w-[320px] shrink-0 snap-start cursor-pointer">
                                    <div class="relative aspect-video overflow-hidden rounded-2xl border border-slate-200/70 dark:border-slate-700/70 bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm">
                                        <img src="{{ $s->cover_url }}" alt="{{ $s->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
                                        <div class="absolute top-3 left-3 inline-flex items-center px-2 py-1 text-[11px] font-semibold rounded-md bg-white/90 text-slate-800 dark:bg-slate-900/70 dark:text-slate-100">
                                            {{ $s->is_free ? 'Free' : ($s->price ? '$'.$s->price : 'Premium') }}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-200 leading-tight line-clamp-2 transition-colors group-hover:text-red-600 dark:group-hover:text-red-400">{{ $s->title }}</h3>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400 line-clamp-2">{{ $s->description }}</p>
                                        <div class="mt-2 flex items-center justify-center gap-3 text-[12px] text-slate-500 dark:text-slate-400">
                                            <span class="inline-flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-red-500/70"></span> {{ $s->lessons_count }} lessons</span>
                                            <span>•</span>
                                            <span>{{ $s->total_duration }}</span>
                                            <span>•</span>
                                            <span>{{ ucfirst($s->level ?? 'all') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            @php
                                $seriesFallback = [
                                    [
                                        'slug' => 'laravel-12-fundamentals',
                                        'title' => 'Laravel 12 Fundamentals',
                                        'desc' => 'Build real-world apps while learning routing, Eloquent, queues, and testing.',
                                        'cover' => 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=1200&auto=format&fit=crop',
                                        'lessons' => 24,
                                        'duration' => '6h 10m',
                                        'level' => 'beginner',
                                        'badge' => 'Premium',
                                    ],
                                    [
                                        'slug' => 'modern-php-patterns',
                                        'title' => 'Modern PHP Patterns',
                                        'desc' => 'SOLID, value objects, DTOs, and clean architecture in PHP 8.4.',
                                        'cover' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=1200&auto=format&fit=crop',
                                        'lessons' => 18,
                                        'duration' => '4h 05m',
                                        'level' => 'intermediate',
                                        'badge' => 'Premium',
                                    ],
                                    [
                                        'slug' => 'livewire-3-zero-to-hero',
                                        'title' => 'Livewire 3: Zero to Hero',
                                        'desc' => 'Server-driven UIs, actions, and testing with Livewire v3.',
                                        'cover' => 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=1200&auto=format&fit=crop',
                                        'lessons' => 20,
                                        'duration' => '5h 20m',
                                        'level' => 'intermediate',
                                        'badge' => 'Free',
                                    ],
                                    [
                                        'slug' => 'testing-with-pest-v3',
                                        'title' => 'Testing with Pest v3',
                                        'desc' => 'TDD your Laravel apps with elegant, readable tests.',
                                        'cover' => 'https://images.unsplash.com/photo-1536148935331-408321065b18?w=1200&auto=format&fit=crop',
                                        'lessons' => 14,
                                        'duration' => '3h 10m',
                                        'level' => 'all',
                                        'badge' => 'Free',
                                    ],
                                ];
                                // add a few more to ensure overflow
                                $seriesFallback = array_merge($seriesFallback, $seriesFallback);
                            @endphp
                            @foreach($seriesFallback as $it)
                                <a href="/series/{{ $it['slug'] }}" class="group w-[320px] shrink-0 snap-start">
                                    <div class="relative aspect-video overflow-hidden rounded-2xl border border-slate-200/70 dark:border-slate-700/70 bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm">
                                        <img src="{{ $it['cover'] }}" alt="{{ $it['title'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>
                                        <div class="absolute top-3 left-3 inline-flex items-center px-2 py-1 text-[11px] font-semibold rounded-md bg-white/90 text-slate-800 dark:bg-slate-900/70 dark:text-slate-100">{{ $it['badge'] }}</div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="text-base font-bold text-slate-800 dark:text-slate-200 leading-tight line-clamp-2 transition-colors group-hover:text-red-600 dark:group-hover:text-red-400">{{ $it['title'] }}</h3>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400 line-clamp-2">{{ $it['desc'] }}</p>
                                        <div class="mt-2 flex items-center justify-center gap-3 text-[12px] text-slate-500 dark:text-slate-400">
                                            <span class="inline-flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-red-500/70"></span> {{ $it['lessons'] }} lessons</span>
                                            <span>•</span>
                                            <span>{{ $it['duration'] }}</span>
                                            <span>•</span>
                                            <span>{{ ucfirst($it['level']) }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        </div>
                    </div>

                    <!-- Centered controls under slider -->
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <button type="button" aria-label="Previous" data-series-prev onclick="window.seriesSliderScroll && window.seriesSliderScroll(-1)" class="p-2 rounded-xl bg-white/70 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700/70 hover:bg-white/90 dark:hover:bg-slate-800/90 transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                        <button type="button" aria-label="Next" data-series-next onclick="window.seriesSliderScroll && window.seriesSliderScroll(1)" class="p-2 rounded-xl bg-white/70 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700/70 hover:bg-white/90 dark:hover:bg-slate-800/90 transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories (Rebuilt Slider) -->
    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">Popular Categories</h2>
                    <p class="mt-2 text-slate-600 dark:text-slate-400">Discover trending topics to explore</p>
                </div>
                <div class="flex items-center gap-2 relative z-10">
                    <button type="button" aria-label="Previous" data-cats-prev onclick="window.catsSliderScroll && window.catsSliderScroll(-1)" class="p-2 rounded-xl bg-white/70 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700/70 hover:bg-white/90 dark:hover:bg-slate-800/90 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    </button>
                    <button type="button" aria-label="Next" data-cats-next onclick="window.catsSliderScroll && window.catsSliderScroll(1)" class="p-2 rounded-xl bg-white/70 dark:bg-slate-800/70 border border-slate-200/70 dark:border-slate-700/70 hover:bg-white/90 dark:hover:bg-slate-800/90 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            </div>

                <div class="relative">
                <div id="categories-track" class="flex gap-5 overflow-x-auto overflow-y-hidden snap-x snap-mandatory scroll-smooth py-4 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @php $hasCategories = $categories->count() > 0; @endphp
                    @if($hasCategories)
                        @foreach($categories as $category)
                            <a href="/category/{{ $category->slug }}" class="cat-card group w-[280px] shrink-0 snap-start relative cursor-pointer">
                                <div class="relative p-[1px] rounded-2xl" style="background: linear-gradient(135deg, {{ $category->color }}55, {{ $category->color }}22);">
                                    <div class="relative h-[200px] bg-white/90 dark:bg-slate-900/60 backdrop-blur-sm rounded-2xl border border-slate-200/70 dark:border-slate-700/70 shadow-sm transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1 will-change-transform">
                                        <div class="p-5 h-full flex flex-col">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, {{ $category->color }}26, {{ $category->color }}1a); box-shadow: 0 0 0 3px {{ $category->color }}22 inset;">
                                                    @if($category->icon)
                                                        <i class="{{ $category->icon }} w-5 h-5" style="color: {{ $category->color }};"></i>
                                                    @else
                                                        <svg class="w-5 h-5" style="color: {{ $category->color }};" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">{{ $category->name }}</h3>
                                            </div>
                                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2 mb-4">{{ $category->description ?? 'Category description' }}</p>
                                            <div class="mt-auto inline-flex items-center gap-2">
                                                <span class="px-2 py-1 rounded-md text-[11px] font-semibold border" style="border-color: {{ $category->color }}55; color: {{ $category->color }};">Explore</span>
                                                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="pointer-events-none absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity" style="box-shadow: 0 12px 28px -12px {{ $category->color }}44;"></div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        @php
                            $fallback = [
                                ['slug' => 'laravel', 'name' => 'Laravel', 'desc' => 'Building web applications with the modern PHP framework', 'color' => '#EF4444'],
                                ['slug' => 'php', 'name' => 'PHP', 'desc' => 'PHP 8+ features, best practices, and tips', 'color' => '#3B82F6'],
                                ['slug' => 'frontend', 'name' => 'Frontend', 'desc' => 'Vue.js, React, Tailwind CSS, and modern frontend', 'color' => '#10B981'],
                                ['slug' => 'devops', 'name' => 'DevOps', 'desc' => 'Docker, deployment, testing, and automation', 'color' => '#8B5CF6'],
                                ['slug' => 'testing', 'name' => 'Testing', 'desc' => 'Pest, TDD/BDD, and maintainable tests', 'color' => '#0EA5E9'],
                                ['slug' => 'databases', 'name' => 'Databases', 'desc' => 'Modeling, indexing, and performance tuning', 'color' => '#6366F1'],
                                ['slug' => 'security', 'name' => 'Security', 'desc' => 'Auth, OWASP, and secure coding', 'color' => '#DC2626'],
                                ['slug' => 'cloud', 'name' => 'Cloud', 'desc' => 'AWS, serverless, scaling, and costs', 'color' => '#3B82F6'],
                            ];
                        @endphp
                        @foreach($fallback as $it)
                            <a href="/category/{{ $it['slug'] }}" class="cat-card group w-[280px] shrink-0 snap-start relative">
                                <div class="relative p-[1px] rounded-2xl" style="background: linear-gradient(135deg, {{ $it['color'] }}55, {{ $it['color'] }}22);">
                                    <div class="relative h-[200px] bg-white/90 dark:bg-slate-900/60 backdrop-blur-sm rounded-2xl border border-slate-200/70 dark:border-slate-700/70 shadow-sm transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1">
                                        <div class="p-5 h-full flex flex-col">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, {{ $it['color'] }}26, {{ $it['color'] }}1a); box-shadow: 0 0 0 3px {{ $it['color'] }}22 inset;"></div>
                                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">{{ $it['name'] }}</h3>
                                            </div>
                                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2 mb-4">{{ $it['desc'] }}</p>
                                            <div class="mt-auto inline-flex items-center gap-2">
                                                <span class="px-2 py-1 rounded-md text-[11px] font-semibold border" style="border-color: {{ $it['color'] }}55; color: {{ $it['color'] }};">Explore</span>
                                                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                            </div>
                                        </div>
                                        <div class="pointer-events-none absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity" style="box-shadow: 0 12px 28px -12px {{ $it['color'] }}44;"></div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts -->
    <section id="latest-posts" class="py-16 lg:py-24 bg-slate-50/50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-2">
                        Latest Posts
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400">Our newest and freshest content</p>
                </div>
                <a href="/posts" class="hidden sm:inline-flex items-center px-6 py-3 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 font-medium rounded-xl hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all duration-300 group cursor-pointer">
                    <span>View all</span>
                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            @if($featuredPost)
                <!-- Featured Post -->
                <div class="mb-16">
                    <article class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-orange-500/10 opacity-0 group-hover:opacity-100 rounded-3xl blur transition-opacity duration-500"></div>
                        <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-3xl overflow-hidden hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-500 group-hover:-translate-y-1">
                            <div class="grid grid-cols-1 lg:grid-cols-2">
                                <div class="aspect-video lg:aspect-auto">
                                     <img src="{{ $featuredPost->featured_image ?? 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=1200&auto=format&fit=crop' }}"
                                         alt="{{ $featuredPost->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="p-8 lg:p-12">
                                    <div class="flex items-center mb-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold tracking-wide uppercase"
                                              style="background-color: {{ $featuredPost->category->color }}20; color: {{ $featuredPost->category->color }};">
                                            {{ $featuredPost->category->name }}
                                        </span>
                                        <span class="ml-4 text-slate-500 dark:text-slate-400 text-sm">{{ $featuredPost->formatted_published_date }}</span>
                                    </div>
                                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-800 dark:text-slate-200 mb-4 leading-tight">
                                        <a href="/posts/{{ $featuredPost->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors cursor-pointer">
                                            {{ $featuredPost->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-600 dark:text-slate-400 mb-8 text-lg leading-relaxed">
                                        {{ $featuredPost->excerpt }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                     <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=96&auto=format&fit=crop&crop=face"
                                                 alt="{{ $featuredPost->user->name }}"
                                                 class="w-12 h-12 rounded-full">
                                            <div class="ml-4">
                                                <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $featuredPost->user->name }}</p>
                                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $featuredPost->reading_time }}</p>
                                            </div>
                                        </div>
                                        <a href="/posts/{{ $featuredPost->slug }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300 group cursor-pointer">
                                            <span>Read</span>
                                            <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endif

            <!-- Post Grid -->
            @if($latestPosts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestPosts as $post)
                        <article class="group">
                            <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 rounded-2xl overflow-hidden hover:border-slate-300/50 dark:hover:border-slate-600/50 transition-all duration-300 group-hover:-translate-y-1">
                                <div class="aspect-video overflow-hidden">
                                     <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=800&auto=format&fit=crop' }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold"
                                              style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                                            {{ $post->category->name }}
                                        </span>
                                        <span class="ml-3 text-slate-500 dark:text-slate-400 text-sm">{{ $post->formatted_published_date }}</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-3 leading-tight">
                                         <a href="/posts/{{ $post->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                            {{ $post->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 leading-relaxed">
                                        {{ Str::limit($post->excerpt, 120) }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                     <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=64&auto=format&fit=crop&crop=face"
                                                 alt="{{ $post->user->name }}"
                                                 class="w-8 h-8 rounded-full">
                                            <span class="ml-2 text-sm font-medium text-slate-700 dark:text-slate-300">{{ $post->user->name }}</span>
                                        </div>
                                        <span class="text-sm text-slate-500 dark:text-slate-400">{{ $post->reading_time }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-2">No posts yet</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">You can add new posts from the admin panel.</p>
                    <a href="/admin" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transition-all duration-300">
                        Admin Panel
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Lazy-loaded Trending Section -->
    <livewire:blog.trending-section />

    <!-- Compact Newsletter Section -->
    <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:blog.compact-newsletter />
        </div>
    </section>

    <x-shared.footer :top-lessons="$topLessons" />

    @push('scripts')
    <script>
        // Categories slider controls
        // Categories rebuilt slider logic with debug logs and robust scrolling
        (function initCategoriesSlider() {
            const log = (...args) => console.log('[CatsSlider]', ...args);
            const track = document.getElementById('categories-track');
            const prev = document.querySelector('[data-cats-prev]');
            const next = document.querySelector('[data-cats-next]');
            const fadeL = document.getElementById('cats-fade-left');
            const fadeR = document.getElementById('cats-fade-right');
            if (!track) { log('track not found'); return; }
            if (!prev || !next) { log('nav buttons missing', { prev: !!prev, next: !!next }); }

            // Clear any existing auto-scroll interval from previous inits
            if (window.__catsSliderInterval) {
                clearInterval(window.__catsSliderInterval);
                window.__catsSliderInterval = null;
            }
            if (window.__catsSliderPauseTO) {
                clearTimeout(window.__catsSliderPauseTO);
                window.__catsSliderPauseTO = null;
            }

            const getCardWidth = () => {
                const first = track.querySelector('.cat-card');
                if (!first) { log('no card found, fallback width'); return 300; }
                const rect = first.getBoundingClientRect();
                const style = window.getComputedStyle(track);
                const gap = parseInt(style.columnGap || style.gap || '20', 10) || 20;
                const w = Math.ceil(rect.width + gap);
                log('computed card+gap width =', w);
                return w;
            };

            const updateFades = () => {
                const maxScrollLeft = Math.max(0, track.scrollWidth - track.clientWidth - 1); // tolerance
                const atStart = track.scrollLeft <= 0;
                const atEnd = track.scrollLeft >= maxScrollLeft;
                if (fadeL) fadeL.style.opacity = atStart ? '0' : '1';
                if (fadeR) fadeR.style.opacity = atEnd ? '0' : '1';
            };

            const scrollByCards = (cards = 2, dir = 1) => {
                const delta = getCardWidth() * cards * dir;
                const before = track.scrollLeft;
                log('scrolling', { before, delta });
                try {
                    track.scrollBy({ left: delta, behavior: 'smooth' });
                } catch (e) {
                    // Fallback for older browsers
                    track.scrollLeft = before + delta;
                }
                setTimeout(() => {
                    log('after scroll', { after: track.scrollLeft });
                    updateFades();
                }, 50);
            };

            // Delegate click events to survive Livewire re-renders
            document.addEventListener('click', (e) => {
                const prevBtn = e.target.closest('[data-cats-prev]');
                const nextBtn = e.target.closest('[data-cats-next]');
                if (prevBtn) { e.preventDefault(); log('prev clicked'); scrollByCards(2, -1); }
                if (nextBtn) { e.preventDefault(); log('next clicked'); scrollByCards(2, 1); }
            });

            // Expose a tiny global for inline onclick fallback
            window.catsSliderScroll = (dir) => {
                log('inline trigger', dir);
                scrollByCards(2, dir);
            };

            track.addEventListener('scroll', updateFades, { passive: true });
            window.addEventListener('resize', updateFades);
            updateFades();
            log('initialized', { cards: track.querySelectorAll('.cat-card').length });

            // Auto-scroll every 3s, pause on hover/interaction/hidden
            let paused = false;
            const pauseFor = (ms = 5000) => {
                paused = true;
                if (window.__catsSliderPauseTO) clearTimeout(window.__catsSliderPauseTO);
                window.__catsSliderPauseTO = setTimeout(() => { paused = false; }, ms);
            };
            const tick = () => {
                const canScroll = track.scrollWidth > track.clientWidth + 4;
                if (!canScroll || paused || document.hidden) return;
                const maxScrollLeft = track.scrollWidth - track.clientWidth - 1;
                if (track.scrollLeft >= maxScrollLeft) {
                    try { track.scrollTo({ left: 0, behavior: 'smooth' }); } catch { track.scrollLeft = 0; }
                } else {
                    // move by 1 card
                    try { track.scrollBy({ left: getCardWidth(), behavior: 'smooth' }); } catch { track.scrollLeft += getCardWidth(); }
                }
                updateFades();
            };
            window.__catsSliderInterval = setInterval(tick, 3000);
            track.addEventListener('pointerenter', () => { paused = true; });
            track.addEventListener('pointerleave', () => { paused = false; });
            track.addEventListener('wheel', () => pauseFor());
            track.addEventListener('touchstart', () => pauseFor());
            track.addEventListener('mousedown', () => pauseFor());
            document.addEventListener('visibilitychange', () => { /* document.hidden handled in tick */ });

            // Re-init on Livewire navigation if present
            document.addEventListener('livewire:navigated', () => {
                log('livewire navigated - reinit');
                initCategoriesSlider();
            }, { once: true });
        })();

        // Spotlight search (macOS-style) on header search focus or Cmd/Ctrl+K
        (function initSpotlight() {
            const triggers = Array.from(document.querySelectorAll('[data-spotlight-trigger]'));
            // Build DOM once
            const overlay = document.createElement('div');
            overlay.id = 'spotlight-overlay';
            overlay.className = 'fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-200';
            overlay.innerHTML = `
                <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
                <div class="relative max-w-3xl mx-auto mt-24 px-4">
                  <div class="rounded-2xl overflow-hidden border border-slate-200/70 dark:border-slate-700/70 shadow-xl" data-spotlight-panel>
                    <div class="bg-white dark:bg-slate-900">
                      <div class="flex items-center px-4 py-3 border-b border-slate-200/70 dark:border-slate-800/70">
                        <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" placeholder="Search series, lessons..." autofocus class="flex-1 bg-transparent outline-none text-slate-900 dark:text-slate-100 placeholder-slate-400 py-1">
                        <span class="ml-3 hidden sm:inline-flex items-center text-[11px] text-slate-500 dark:text-slate-400">⌘K</span>
                      </div>
                      <div class="max-h-[65vh] overflow-auto divide-y divide-slate-100 dark:divide-slate-800">
                        <div class="px-4 py-2 text-[12px] text-slate-500 dark:text-slate-400">Type to search. Example: "Laravel", "Livewire"</div>
                        <ul id="spotlight-results" class="py-1"></ul>
                      </div>
                    </div>
                  </div>
                </div>`;
            document.body.appendChild(overlay);

            const panel = () => overlay.querySelector('[data-spotlight-panel]');
            const show = () => {
                overlay.classList.remove('hidden');
                // Prepare panel animation
                const p = panel();
                if (p) {
                    p.classList.add('opacity-0', 'translate-y-4', 'transition-all', 'duration-200', 'ease-out');
                }
                requestAnimationFrame(() => {
                    overlay.classList.add('opacity-100');
                    if (p) {
                        p.classList.remove('opacity-0', 'translate-y-4');
                        p.classList.add('opacity-100', 'translate-y-0');
                    }
                });
            };
            const hide = () => {
                const p = panel();
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                if (p) {
                    p.classList.remove('opacity-100', 'translate-y-0');
                    p.classList.add('opacity-0', 'translate-y-4');
                }
                // After transition, hide fully
                setTimeout(() => overlay.classList.add('hidden'), 200);
            };

            const openSpotlight = () => {
                show();
                setTimeout(() => {
                    const box = overlay.querySelector('input');
                    box && box.focus();
                }, 0);
            };
            triggers.forEach((el) => {
                el.addEventListener('focus', () => openSpotlight());
                el.addEventListener('click', (e) => { e.preventDefault(); openSpotlight(); });
                el.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') { e.preventDefault(); openSpotlight(); }
                });
            });
            document.addEventListener('keydown', (e) => {
                const isK = e.key.toLowerCase() === 'k';
                if ((e.metaKey || e.ctrlKey) && isK) {
                    e.preventDefault();
                    show();
                    setTimeout(() => { const box = overlay.querySelector('input'); box && box.focus(); }, 0);
                }
                if (e.key === 'Escape') hide();
            });
            overlay.addEventListener('mousedown', (e) => {
                const target = e.target;
                const isElement = target && typeof target === 'object' && 'closest' in target;
                if (!isElement) { hide(); return; }
                // Close when clicking backdrop or any area outside the panel
                if (!target.closest('[data-spotlight-panel]')) hide();
            });

            // Mock results data & rendering
            const MOCK_RESULTS = [
                { kind: 'Series', title: 'Laravel 12 Fundamentals', subtitle: 'From routing to Eloquent and queues', lessons: 24, duration: '6h 10m', level: 'Beginner', href: '/series/laravel-12-fundamentals', thumb: 'https://images.unsplash.com/photo-1526378722484-bd91ca387e72?w=800&auto=format&fit=crop' },
                { kind: 'Series', title: 'Livewire 3: Zero to Hero', subtitle: 'Server-driven UIs done right', lessons: 20, duration: '5h 20m', level: 'Intermediate', href: '/series/livewire-3-zero-to-hero', thumb: 'https://images.unsplash.com/photo-1518779578993-ec3579fee39f?w=800&auto=format&fit=crop' },
                { kind: 'Lesson', title: 'Eloquent Relationships Deep Dive', subtitle: 'Laravel 12 Fundamentals', duration: '18m', href: '/series/laravel-12-fundamentals/eloquent-relationships', thumb: 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=800&auto=format&fit=crop' },
                { kind: 'Lesson', title: 'Actions and File Uploads', subtitle: 'Livewire 3: Zero to Hero', duration: '22m', href: '/series/livewire-3-zero-to-hero/actions-and-uploads', thumb: 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=800&auto=format&fit=crop' },
                { kind: 'Series', title: 'Testing with Pest v3', subtitle: 'TDD your Laravel apps', lessons: 14, duration: '3h 10m', level: 'All', href: '/series/testing-with-pest-v3', thumb: 'https://images.unsplash.com/photo-1536148935331-408321065b18?w=800&auto=format&fit=crop' },
                { kind: 'Series', title: 'Modern PHP Patterns', subtitle: 'SOLID, DTOs, and clean architecture', lessons: 18, duration: '4h 05m', level: 'Intermediate', href: '/series/modern-php-patterns', thumb: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format&fit=crop' },
            ];
            const resultsEl = overlay.querySelector('#spotlight-results');
            const render = (items) => {
                if (!resultsEl) return;
                if (!items.length) {
                    resultsEl.innerHTML = `<li class="px-4 py-6 text-sm text-slate-500 dark:text-slate-400">No results found.</li>`;
                    return;
                }
                resultsEl.innerHTML = items.map((it) => {
                    const meta = it.kind === 'Series'
                        ? `${it.lessons} lessons • ${it.duration} • ${it.level}`
                        : `${it.subtitle} • ${it.duration}`;
                    const badgeColor = it.kind === 'Series' ? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300' : 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300';
                    return `
                    <li>
                      <a href="${it.href}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors" data-spotlight-result>
                        <img src="${it.thumb}" alt="${it.title}" class="w-16 h-10 rounded-md object-cover border border-slate-200/70 dark:border-slate-700/70">
                        <div class="flex-1 min-w-0">
                          <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold text-slate-900 dark:text-slate-100 line-clamp-1">${it.title}</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded border border-slate-200/70 dark:border-slate-700/70 ${badgeColor}">${it.kind}</span>
                          </div>
                          <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">${meta}</div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                      </a>
                    </li>`;
                }).join('');
                // Close on result click
                resultsEl.querySelectorAll('[data-spotlight-result]').forEach((el) => el.addEventListener('click', () => hide()));
            };
            // Initial render
            render(MOCK_RESULTS.slice(0, 5));

            // Filter on input
            const box = overlay.querySelector('input');
            const debounce = (fn, d=150) => { let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), d); }; };
            const doFilter = () => {
                const q = (box && box.value || '').toLowerCase().trim();
                if (!q) { render(MOCK_RESULTS.slice(0, 5)); return; }
                const out = MOCK_RESULTS.filter(it => it.title.toLowerCase().includes(q) || (it.subtitle && it.subtitle.toLowerCase().includes(q)));
                render(out);
            };
            box && box.addEventListener('input', debounce(doFilter, 150));
        })();
        // Series slider controls (simple scroll by one card)
        (function initSeriesSlider() {
            const track = document.getElementById('series-track');
            if (!track) return;
            const getCardWidth = () => {
                const first = track.querySelector('a');
                if (!first) return 340;
                const rect = first.getBoundingClientRect();
                const gap = parseInt(getComputedStyle(track).gap || '20', 10) || 20;
                return Math.ceil(rect.width + gap);
            };
            const by = () => getCardWidth();
            // Expose global for inline fallback
            window.seriesSliderScroll = (dir) => {
                try { track.scrollBy({ left: (dir || 1) * by(), behavior: 'smooth' }); } catch { track.scrollLeft += (dir || 1) * by(); }
            };
            document.addEventListener('click', (e) => {
                if (e.target.closest('[data-series-prev]')) {
                    e.preventDefault();
                    window.seriesSliderScroll(-1);
                }
                if (e.target.closest('[data-series-next]')) {
                    e.preventDefault();
                    window.seriesSliderScroll(1);
                }
            });

            // Auto-scroll every 3s; pause on hover/interactions
            let paused = false;
            const pauseFor = (ms = 4000) => {
                paused = true;
                clearTimeout(window.__seriesPauseTO);
                window.__seriesPauseTO = setTimeout(() => paused = false, ms);
            };
            const tick = () => {
                if (paused || document.hidden) return;
                const canScroll = track.scrollWidth > track.clientWidth + 4;
                if (!canScroll) return;
                const max = track.scrollWidth - track.clientWidth - 1;
                if (track.scrollLeft >= max) {
                    try { track.scrollTo({ left: 0, behavior: 'smooth' }); } catch { track.scrollLeft = 0; }
                } else {
                    window.seriesSliderScroll(1);
                }
            };
            clearInterval(window.__seriesInterval);
            window.__seriesInterval = setInterval(tick, 3000);
            track.addEventListener('pointerenter', () => { paused = true; });
            track.addEventListener('pointerleave', () => { paused = false; });
            track.addEventListener('wheel', () => pauseFor());
            track.addEventListener('touchstart', () => pauseFor());
            track.addEventListener('mousedown', () => pauseFor());
        })();

        // Mobile nav toggle
        (function initMobileNav() {
            const btn = document.querySelector('[data-mobile-toggle]');
            const nav = document.getElementById('mobile-nav');
            if (!btn || !nav) return;
            const iconOpen = btn.querySelector('[data-mobile-icon="open"]');
            const iconClose = btn.querySelector('[data-mobile-icon="close"]');
            const setState = (open) => {
                btn.setAttribute('aria-expanded', String(open));
                nav.classList.toggle('hidden', !open);
                if (iconOpen && iconClose) {
                    iconOpen.classList.toggle('hidden', open);
                    iconClose.classList.toggle('hidden', !open);
                }
            };
            let open = false;
            btn.addEventListener('click', () => { open = !open; setState(open); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && open) { open = false; setState(false); } });
            document.addEventListener('click', (e) => {
                if (!open) return;
                const t = e.target;
                const isEl = t && typeof t === 'object' && 'closest' in t;
                if (!isEl) return;
                if (!t.closest('#mobile-nav') && !t.closest('[data-mobile-toggle]')) { open = false; setState(false); }
            });
        })();

        // Mobile nav toggle
        (function initMobileNav() {
            const btn = document.querySelector('[data-mobile-toggle]');
            const nav = document.getElementById('mobile-nav');
            if (!btn || !nav) return;
            const iconOpen = btn.querySelector('[data-mobile-icon="open"]');
            const iconClose = btn.querySelector('[data-mobile-icon="close"]');
            
            let open = false;
            function setState(isOpen) {
                open = isOpen;
                nav.classList.toggle('hidden', !open);
                iconOpen.classList.toggle('hidden', open);
                iconClose.classList.toggle('hidden', !open);
                btn.setAttribute('aria-expanded', open);
            }
            
            btn.addEventListener('click', () => setState(!open));
            document.addEventListener('click', (e) => {
                const t = e.target;
                const isEl = t && typeof t === 'object' && 'closest' in t;
                if (!isEl) return;
                if (!t.closest('#mobile-nav') && !t.closest('[data-mobile-toggle]')) { open = false; setState(false); }
            });
        })();
    </script>
    @endpush
</div>
