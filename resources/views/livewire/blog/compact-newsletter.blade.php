<div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl p-6 lg:p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">Latest Updates</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400">Stay informed with our latest posts</p>
            </div>
        </div>
        
        <!-- Filter Toggle -->
        <button wire:click="toggleFilters" 
                class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            Filters
        </button>
    </div>

    <!-- Filters Section -->
    @if($showFilters)
    <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200/50 dark:border-slate-600/50">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" 
                       type="text" 
                       placeholder="Search posts..."
                       class="w-full pl-10 pr-3 py-2 text-sm border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <!-- Category Filter -->
            <div class="relative">
                <select wire:model.live="selectedCategory" 
                        class="block w-full py-2 px-3 pr-10 text-sm border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent appearance-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }} ({{ $category->posts_count }})</option>
                    @endforeach
                </select>
                <!-- Dropdown Icon -->
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>

            <!-- Clear Filters -->
            <div>
                <button wire:click="clearFilters" 
                        class="w-full py-2 px-3 text-sm font-medium text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Newsletter Subscription -->
    @if(!$isSubscribed)
    <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-950/20 dark:to-orange-950/20 rounded-xl border border-red-200/50 dark:border-red-800/50">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1">Get updates in your inbox</h4>
                <p class="text-sm text-slate-600 dark:text-slate-400">Weekly digest of our best content</p>
            </div>
            <div class="flex items-center gap-3">
                <input wire:model="email" 
                       type="email" 
                       placeholder="your@email.com"
                       class="flex-1 min-w-0 px-3 py-2 text-sm border border-slate-200 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <button wire:click="subscribe" 
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-orange-500 rounded-lg hover:from-red-700 hover:to-orange-600 transition-all duration-200">
                    Subscribe
                </button>
            </div>
        </div>
        @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    @else
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-950/20 rounded-xl border border-green-200/50 dark:border-green-800/50">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7.25 7.25a1 1 0 01-1.414 0L3.293 10.5a1 1 0 111.414-1.414l3.043 3.043 6.543-6.543a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="font-semibold text-green-900 dark:text-green-100">Successfully subscribed!</h4>
                <p class="text-sm text-green-700 dark:text-green-300">You'll receive our updates soon.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Posts Grid -->
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($posts as $post)
        <article class="group">
            <a href="/posts/{{ $post->slug }}" class="block">
                <div class="relative bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-600/50 rounded-xl overflow-hidden hover:border-slate-300/50 dark:hover:border-slate-500/50 transition-all duration-300 group-hover:-translate-y-1">
                    <!-- Post Image -->
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=400&auto=format&fit=crop' }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    </div>
                    
                    <!-- Post Content -->
                    <div class="p-4">
                        <!-- Category Badge -->
                        @if($post->category)
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold"
                                  style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                                {{ $post->category->name }}
                            </span>
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ $post->formatted_published_date }}</span>
                        </div>
                        @endif
                        
                        <!-- Title -->
                        <h4 class="text-sm font-bold text-slate-900 dark:text-slate-100 mb-2 leading-tight line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                            {{ $post->title }}
                        </h4>
                        
                        <!-- Excerpt -->
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-2 mb-3">
                            {{ Str::limit($post->excerpt, 80) }}
                        </p>
                        
                        <!-- Meta -->
                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                            <span>{{ $post->user->name }}</span>
                            <span>{{ $post->reading_time }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </article>
        @endforeach
    </div>

    <!-- View All Link -->
    <div class="mt-6 text-center">
        <a href="/posts" class="inline-flex items-center gap-2 text-sm font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
            View all posts
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </a>
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-8">
        <div class="w-12 h-12 bg-slate-200 dark:bg-slate-700 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">No posts found</h4>
        <p class="text-slate-600 dark:text-slate-400 mb-4">
            @if($search || $selectedCategory)
                Try adjusting your filters or browse all posts.
            @else
                No posts available at the moment.
            @endif
        </p>
        @if($search || $selectedCategory)
        <button wire:click="clearFilters" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
            Clear Filters
        </button>
        @endif
    </div>
    @endif
</div>

<!-- Success Notification -->
@if($isSubscribed)
<script>
    // Show a toast notification when subscribed
    document.addEventListener('livewire:init', () => {
        Livewire.on('newsletter-subscribed', () => {
            // You can implement a toast notification here
            console.log('Newsletter subscription successful!');
        });
    });
</script>
@endif