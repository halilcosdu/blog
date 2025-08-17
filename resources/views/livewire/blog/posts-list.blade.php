<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    
    <x-shared.header current-page="posts" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative">
        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 dark:text-white mb-4">
                    All Posts
                </h1>
                <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Browse our complete collection of Laravel and PHP tutorials, screencasts, and learning resources.
                </p>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-6 mb-8">
                <div class="grid md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="sr-only">Search posts</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="search" type="search" id="search" 
                                   class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                   placeholder="Search posts...">
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="sr-only">Filter by category</label>
                        <select wire:model.live="categoryId" id="category"
                                class="block w-full py-2 px-3 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->posts_count }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Options -->
                    <div>
                        <label for="sort" class="sr-only">Sort by</label>
                        <select wire:model.live="sortBy" id="sort"
                                class="block w-full py-2 px-3 border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="latest">Latest</option>
                            <option value="popular">Most Popular</option>
                            <option value="oldest">Oldest</option>
                        </select>
                    </div>
                </div>

                <!-- Results count -->
                <div class="mt-4 text-sm text-slate-600 dark:text-slate-400">
                    Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                </div>
            </div>

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

    <x-shared.footer />
    <x-shared.mobile-nav-script />
</div>