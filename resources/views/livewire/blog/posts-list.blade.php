<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    <x-shared.header current-page="posts" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative">
        <!-- Search and Filters Section -->
        <section class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
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
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 lg:gap-6">
                    <!-- Search Input -->
                    <div class="sm:col-span-2 lg:col-span-6">
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
                            <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer">
                                <svg class="h-4 w-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="sm:col-span-1 lg:col-span-3 relative z-50">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Categories
                        </label>
                        <div class="relative z-50" x-data="{ open: false }" @click.away="open = false">
                            <!-- Dropdown Toggle -->
                            <button type="button" @click="open = !open"
                                    class="block w-full py-3 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all text-left cursor-pointer">
                                <span class="block truncate">
                                    @if(empty($categoryIds))
                                        All Categories
                                    @else
                                        {{ count($categoryIds) }} {{ count($categoryIds) === 1 ? 'category' : 'categories' }} selected
                                    @endif
                                </span>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute top-full left-0 right-0 mt-1 bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl shadow-2xl max-h-60 overflow-y-auto z-[999999]">
                                <div class="p-2 space-y-1">
                                    @foreach($categories as $category)
                                    <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-slate-100/50 dark:hover:bg-slate-700/50 cursor-pointer transition-colors">
                                        <input type="checkbox"
                                               wire:click="toggleCategory({{ $category->id }})"
                                               {{ in_array($category->id, $categoryIds) ? 'checked' : '' }}
                                               class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded focus:ring-red-500 focus:ring-2 cursor-pointer">
                                        <span class="text-sm text-slate-700 dark:text-slate-300 flex-1">
                                            {{ $category->name }}
                                        </span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">
                                            {{ $category->posts_count }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="sm:col-span-1 lg:col-span-3">
                        <label for="sort" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Sort By
                        </label>
                        <div class="relative">
                            <select wire:model.live="sortBy" id="sort"
                                    class="block w-full py-3 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all appearance-none cursor-pointer">
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
                @if($search || !empty($categoryIds))
                <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Active filters:</span>
                            <div class="flex items-center gap-2 flex-wrap">
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
                                @if(!empty($categoryIds))
                                @foreach($categoryIds as $categoryId)
                                @php $selectedCategory = $categories->firstWhere('id', $categoryId); @endphp
                                @if($selectedCategory)
                                @php $categoryColors = $this->getCategoryColors($selectedCategory->name); @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium {{ $categoryColors['bg'] }} {{ $categoryColors['text'] }} border {{ $categoryColors['border'] }}">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $this->getDotColor($categoryColors['text']) }} opacity-80"></div>
                                    {{ $selectedCategory->name }}
                                    <button wire:click="toggleCategory({{ $categoryId }})" class="ml-1 hover:opacity-70 transition-opacity">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <button wire:click="clearAllFilters"
                                class="text-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 transition-colors">
                            Clear all
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </section>

            <!-- Posts Section -->
            <div id="posts-section"></div>
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Skeleton Loading State -->
            <div wire:loading class="animate-in fade-in duration-300">
                <!-- Loading Header -->
                <div class="mb-8 text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-xl border border-slate-200/60 dark:border-slate-700/60">
                        <div class="w-4 h-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Loading amazing content...</span>
                    </div>
                </div>

                <!-- Skeleton Grid -->
                <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @for($i = 0; $i < 8; $i++)
                    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <!-- Skeleton Image -->
                        <div class="aspect-[16/9] bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 animate-pulse"></div>

                        <!-- Skeleton Content -->
                        <div class="p-5 space-y-4">
                            <!-- Skeleton Title -->
                            <div class="space-y-2">
                                <div class="h-4 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded animate-pulse"></div>
                                <div class="h-4 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded w-3/4 animate-pulse"></div>
                            </div>

                            <!-- Skeleton Excerpt -->
                            <div class="space-y-2">
                                <div class="h-3 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded animate-pulse"></div>
                                <div class="h-3 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded w-5/6 animate-pulse"></div>
                            </div>

                            <!-- Skeleton Meta -->
                            <div class="flex items-center justify-between pt-4 border-t border-slate-200/60 dark:border-slate-700/60">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded-full animate-pulse"></div>
                                    <div class="space-y-1">
                                        <div class="h-3 w-16 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded animate-pulse"></div>
                                        <div class="h-2 w-12 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded animate-pulse"></div>
                                    </div>
                                </div>
                                <div class="h-3 w-8 bg-gradient-to-r from-slate-200 via-slate-300 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 rounded animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Loading Dots Animation -->
                <div class="flex justify-center mt-12 space-x-2">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                    <div class="w-2 h-2 bg-orange-500 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-bounce"></div>
                </div>
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
            <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 animate-in slide-in-from-bottom-4 fade-in duration-500" wire:loading.remove>
                @foreach($posts as $post)
                <article class="group relative bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-xl hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1 cursor-pointer">
                    <!-- Image Container -->
                    @if($post->featured_image)
                    <div class="relative aspect-[16/9] overflow-hidden">
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Category Badge on Image -->
                        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                            @php $colors = $this->getCategoryColors($post->category->name); @endphp
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $colors['bg'] }} {{ $colors['text'] }} border {{ $colors['border'] }} backdrop-blur-sm shadow-sm hover:shadow-md transition-all duration-200 hover:scale-105">
                                <div class="w-1.5 h-1.5 rounded-full {{ $this->getDotColor($colors['text']) }} opacity-80"></div>
                                {{ $post->category->name }}
                            </span>
                        </div>

                        <!-- Reading Time Badge -->
                        @if($post->reading_time)
                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-black/20 text-white backdrop-blur-sm">
                                <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $post->reading_time }}
                            </span>
                        </div>
                        @endif
                    </div>
                    @else
                    <!-- No Image Placeholder -->
                    <div class="relative aspect-[16/9] bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center">
                        <!-- Category Badge for No Image -->
                        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                            @php $colors = $this->getCategoryColors($post->category->name); @endphp
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $colors['bg'] }} {{ $colors['text'] }} border {{ $colors['border'] }} shadow-sm hover:shadow-md transition-all duration-200 hover:scale-105">
                                <div class="w-1.5 h-1.5 rounded-full {{ $this->getDotColor($colors['text']) }} opacity-80"></div>
                                {{ $post->category->name }}
                            </span>
                        </div>

                        <div class="text-center">
                            <svg class="w-12 h-12 text-slate-400 dark:text-slate-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Article</p>
                        </div>

                        <!-- Reading Time Badge for No Image -->
                        @if($post->reading_time)
                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-white/80 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 backdrop-blur-sm">
                                <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $post->reading_time }}
                            </span>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="p-4 sm:p-5">
                        <!-- Title -->
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-3 line-clamp-2 leading-tight">
                            <a href="/posts/{{ $post->slug }}" class="group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        @if($post->excerpt)
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ Str::limit($post->excerpt, 120) }}
                        </p>
                        @endif

                        <!-- Meta Info -->
                        <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-slate-200/60 dark:border-slate-700/60">
                            <!-- Author -->
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full bg-gradient-to-r from-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-xs">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300 truncate">{{ $post->user->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $post->published_at->format('M j, Y') }}</p>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                <div class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>{{ number_format($post->views_count) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hover Effect Indicator -->
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-red-600 to-orange-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 animate-in slide-in-from-bottom-2 fade-in duration-300 delay-200">
                {{ $posts->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-12 animate-in zoom-in fade-in duration-500" wire:loading.remove>
                <div class="max-w-md mx-auto">
                    <svg class="h-24 w-24 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No posts found</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        @if($search || !empty($categoryIds))
                        Try adjusting your search criteria or browse all posts.
                        @else
                        There are no posts available at the moment.
                        @endif
                    </p>
                    @if($search || !empty($categoryIds))
                    <button wire:click="clearAllFilters"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
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

    <!-- Pagination Scroll Script -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('scroll-to-posts', () => {
                window.scrollTo({ 
                    top: 0, 
                    behavior: 'smooth' 
                });
            });
        });
    </script>
</div>