<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    
    <x-shared.header current-page="posts" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative">
        <!-- Header Section -->
        <section class="relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-red-50/30 via-orange-50/20 to-yellow-50/30 dark:from-red-950/10 dark:via-orange-950/5 dark:to-yellow-950/10"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
                <div class="text-center">
                    <!-- Small badge -->
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 mb-6">
                        <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Latest Content</span>
                    </div>
                    
                    <!-- Main Title -->
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 dark:from-white dark:via-slate-100 dark:to-white bg-clip-text text-transparent">
                            All Posts
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="text-xl lg:text-2xl text-slate-600 dark:text-slate-400 mb-8 leading-relaxed max-w-3xl mx-auto">
                        Discover our complete collection of <span class="font-semibold text-slate-800 dark:text-slate-200">Laravel & PHP</span> tutorials, 
                        screencasts, and hands-on learning resources.
                    </p>
                    
                    <!-- Stats -->
                    <div class="flex flex-wrap items-center justify-center gap-8 text-sm text-slate-600 dark:text-slate-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Always up-to-date</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Beginner to advanced</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Real-world examples</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

            <!-- Search and Filters Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
            <!-- Main Filter Card -->
            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/60 dark:border-slate-700/60 shadow-xl shadow-slate-200/20 dark:shadow-slate-900/20 p-8">
                <!-- Filter Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Find Content</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Search and filter through our articles</p>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <span wire:loading.remove>{{ $posts->total() ?? 0 }} posts</span>
                        <span wire:loading class="animate-pulse">Searching...</span>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Search Input -->
                    <div class="lg:col-span-6">
                        <label for="search" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Search Posts
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="search" id="search" 
                                   class="block w-full pl-12 pr-4 py-3 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all"
                                   placeholder="Search by title, content, or tags...">
                            <!-- Clear button -->
                            @if($search)
                            <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg class="h-4 w-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="lg:col-span-3">
                        <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Category
                        </label>
                        <div class="relative">
                            <select wire:model.live="categoryId" id="category"
                                    class="block w-full py-3 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all appearance-none">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->posts_count }})</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="lg:col-span-3">
                        <label for="sort" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Sort By
                        </label>
                        <div class="relative">
                            <select wire:model.live="sortBy" id="sort"
                                    class="block w-full py-3 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all appearance-none">
                                <option value="latest">Latest First</option>
                                <option value="popular">Most Popular</option>
                                <option value="oldest">Oldest First</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters & Clear -->
                @if($search || $categoryId)
                <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Active filters:</span>
                            <div class="flex items-center gap-2">
                                @if($search)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                    Search: "{{ $search }}"
                                    <button wire:click="$set('search', '')" class="ml-1 hover:text-red-900 dark:hover:text-red-100">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                                @if($categoryId)
                                @php $selectedCategory = $categories->firstWhere('id', $categoryId); @endphp
                                @if($selectedCategory)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                    Category: {{ $selectedCategory->name }}
                                    <button wire:click="$set('categoryId', null)" class="ml-1 hover:text-blue-900 dark:hover:text-blue-100">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                                @endif
                            </div>
                        </div>
                        <button wire:click="$set('search', ''); $set('categoryId', null)" 
                                class="text-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Clear all
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </section>

            <!-- Posts Section -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Loading State -->
            <div wire:loading class="text-center py-8">
                <div class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-lg">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading posts...
                </div>
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" wire:loading.remove>
                @foreach($posts as $post)
                <article class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-lg transition-shadow group">
                    @if($post->featured_image)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                {{ $post->category->name }}
                            </span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $post->published_at->format('M j, Y') }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2">
                            <a href="/posts/{{ $post->slug }}" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>
                        @if($post->excerpt)
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3">
                            {{ $post->excerpt }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between text-sm text-slate-500 dark:text-slate-400">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-xs">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span>{{ number_format($post->views_count) }} views</span>
                                @if($post->reading_time)
                                <span>{{ $post->reading_time }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-12" wire:loading.remove>
                <div class="max-w-md mx-auto">
                    <svg class="h-24 w-24 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No posts found</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        @if($search || $categoryId)
                        Try adjusting your search criteria or browse all posts.
                        @else
                        There are no posts available at the moment.
                        @endif
                    </p>
                    @if($search || $categoryId)
                    <button wire:click="$set('search', '')" wire:click="$set('categoryId', null)" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Clear Filters
                    </button>
                    @endif
                </div>
            </div>
            @endif
            </section>
        </main>

    <x-shared.footer :top-lessons="$topLessons" />
    <x-shared.mobile-nav-script />
</div>