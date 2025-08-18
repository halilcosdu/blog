<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    <x-shared.header current-page="watch" />
    <x-shared.announcements />

    <!-- Hero Section -->
    <section class="relative py-12 lg:py-16 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-red-50/40 via-orange-50/20 to-yellow-50/40 dark:from-red-950/10 dark:via-orange-950/5 dark:to-yellow-950/10"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 dark:from-white dark:via-slate-100 dark:to-white bg-clip-text text-transparent">
                        Watch & Learn
                    </span>
                </h1>
                <p class="text-lg lg:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Comprehensive video courses and tutorials to master modern PHP & Laravel development
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="flex justify-center items-center gap-8 text-sm text-slate-600 dark:text-slate-400 mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span>24 Series</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                    <span>156 Lessons</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                    <span>45+ Hours</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Recently Watched & Continue Watching Sections -->
    <section class="relative py-8" x-data="recentWatchedData()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Continue Watching Section -->
            <div x-show="continueWatching.length > 0" class="mb-12">
                <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-950/20 dark:to-orange-950/20 rounded-2xl p-6 border border-red-100/50 dark:border-red-900/30">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">Continue Watching</h2>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Pick up where you left off</p>
                            </div>
                        </div>
                        <button @click="viewAllContent()" class="inline-flex items-center gap-2 px-4 py-2 bg-white/50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all cursor-pointer">
                            View All
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Horizontal Scroll Container -->
                    <div class="relative overflow-visible">
                        <div x-ref="continueScrollContainer" class="flex gap-4 overflow-x-auto overflow-y-visible pb-4 pt-2 scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <template x-for="item in continueWatching" :key="item.id">
                                <div class="group relative bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-white/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-red-200/20 dark:hover:shadow-red-900/20 transition-all duration-300 hover:-translate-y-1 hover:border-red-200/60 dark:hover:border-red-700/60 flex-shrink-0 w-80">
                                    <a :href="item.url" class="block">
                                        <div class="flex">
                                            <!-- Thumbnail -->
                                            <div class="w-24 h-16 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 relative overflow-hidden rounded-lg m-3">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <span class="text-lg" x-text="item.emoji"></span>
                                                </div>
                                                <!-- Play Button Overlay -->
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                    <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                        <svg class="w-3 h-3 text-red-600 dark:text-red-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 p-3 flex flex-col justify-between">
                                                <div>
                                                    <h4 class="font-medium text-slate-900 dark:text-slate-100 text-sm mb-1 line-clamp-1 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors" x-text="item.title"></h4>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400 mb-2" x-text="item.seriesTitle"></p>
                                                </div>

                                                <!-- Progress Info -->
                                                <div class="space-y-2">
                                                    <div class="flex items-center justify-between text-xs">
                                                        <span class="text-slate-600 dark:text-slate-400" x-text="`${item.progress}% complete`"></span>
                                                        <span class="text-red-600 dark:text-red-400 font-medium" x-text="item.timeRemaining"></span>
                                                    </div>
                                                    <!-- Progress Bar -->
                                                    <div class="h-1.5 bg-slate-200/50 dark:bg-slate-700/50 rounded-full overflow-hidden">
                                                        <div class="h-full bg-gradient-to-r from-red-500 to-orange-500 transition-all duration-500" :style="`width: ${item.progress}%`"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>
                        </div>

                        <!-- Scroll Indicators -->
                        <div class="absolute top-1/2 -translate-y-1/2 -left-2">
                            <button @click="scrollContinueLeft()" class="w-8 h-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition-all shadow-lg cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                        </div>
                        <div class="absolute top-1/2 -translate-y-1/2 -right-2">
                            <button @click="scrollContinueRight()" class="w-8 h-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition-all shadow-lg cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recently Watched Section -->
            <div x-show="recentlyWatched.length > 0" class="mb-12">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/20 dark:to-indigo-950/20 rounded-2xl p-6 border border-blue-100/50 dark:border-blue-900/30">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100">Recently Watched</h2>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Your learning history</p>
                            </div>
                        </div>
                        <button @click="viewAllContent()" class="inline-flex items-center gap-2 px-4 py-2 bg-white/50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all cursor-pointer">
                            View All
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Horizontal Scroll Container -->
                    <div class="relative overflow-visible">
                        <div x-ref="recentScrollContainer" class="flex gap-4 overflow-x-auto overflow-y-visible pb-4 pt-2 scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <template x-for="item in recentlyWatched" :key="item.id">
                                <div class="group relative bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-white/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-blue-200/20 dark:hover:shadow-blue-900/20 transition-all duration-300 hover:-translate-y-1 hover:border-blue-200/60 dark:hover:border-blue-700/60 flex-shrink-0 w-48">
                                    <a :href="item.url" class="block">
                                        <div class="relative">
                                            <!-- Thumbnail -->
                                            <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 relative overflow-hidden">
                                                <div class="absolute inset-0 flex items-center justify-center">
                                                    <span class="text-2xl" x-text="item.emoji"></span>
                                                </div>
                                                <!-- Play Button Overlay -->
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                    <div class="w-10 h-10 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                        <svg class="w-3 h-3 text-blue-600 dark:text-blue-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <!-- Completed Badge -->
                                                <div x-show="item.completed" class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-lg flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Done
                                                </div>
                                                <!-- Duration Badge -->
                                                <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md" x-text="item.duration"></div>
                                            </div>
                                        </div>

                                        <div class="p-4">
                                            <h4 class="font-medium text-slate-900 dark:text-slate-100 text-sm mb-1 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" x-text="item.title"></h4>
                                            <div class="flex items-center gap-2 mt-2">
                                                <div x-show="item.completed" class="w-2 h-2 bg-green-500 rounded-full"></div>
                                                <div x-show="!item.completed" class="w-2 h-2 bg-slate-400 rounded-full"></div>
                                                <span class="text-xs" :class="item.completed ? 'text-green-600 dark:text-green-400' : 'text-slate-500 dark:text-slate-400'" x-text="item.completed ? 'Completed' : 'Watched'"></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>
                        </div>

                        <!-- Scroll Indicators -->
                        <div class="absolute top-1/2 -translate-y-1/2 -left-2">
                            <button @click="scrollLeft()" class="w-8 h-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition-all shadow-lg cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                        </div>
                        <div class="absolute top-1/2 -translate-y-1/2 -right-2">
                            <button @click="scrollRight()" class="w-8 h-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition-all shadow-lg cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Main Content -->
    <main class="relative pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Content Layout: Sidebar + Main -->
            <div class="flex flex-col lg:flex-row lg:gap-8">

                <!-- Left Sidebar - Filters -->
                <aside class="lg:w-80 mb-8 lg:mb-0" x-data="{
                    searchQuery: '',
                    contentType: 'all',
                    selectedCategories: [],
                    selectedLevels: [],
                    selectedDurations: [],
                    showFilters: true,

                    toggleCategory(categoryId) {
                        if (this.selectedCategories.includes(categoryId)) {
                            this.selectedCategories = this.selectedCategories.filter(id => id !== categoryId);
                        } else {
                            this.selectedCategories.push(categoryId);
                        }
                    },

                    toggleLevel(level) {
                        if (this.selectedLevels.includes(level)) {
                            this.selectedLevels = this.selectedLevels.filter(l => l !== level);
                        } else {
                            this.selectedLevels.push(level);
                        }
                    },

                    toggleDuration(duration) {
                        if (this.selectedDurations.includes(duration)) {
                            this.selectedDurations = this.selectedDurations.filter(d => d !== duration);
                        } else {
                            this.selectedDurations.push(duration);
                        }
                    },

                    clearAllFilters() {
                        this.searchQuery = '';
                        this.contentType = 'all';
                        this.selectedCategories = [];
                        this.selectedLevels = [];
                        this.selectedDurations = [];
                    },

                    get hasActiveFilters() {
                        return this.searchQuery !== '' ||
                               this.contentType !== 'all' ||
                               this.selectedCategories.length > 0 ||
                               this.selectedLevels.length > 0 ||
                               this.selectedDurations.length > 0;
                    }
                }">
                    <div class="sticky top-24 space-y-6 z-[60]">

                        <!-- Search Bar with Autocomplete -->
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6 relative z-[70]" x-data="quickSearch()">
                            <div class="relative">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-red-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="search" placeholder="Search courses, lessons..."
                                           x-model="searchQuery"
                                           @input="handleSearch()"
                                           @focus="showSuggestions = true"
                                           @keydown.escape="showSuggestions = false"
                                           @keydown.arrow-down.prevent="navigateDown()"
                                           @keydown.arrow-up.prevent="navigateUp()"
                                           @keydown.enter.prevent="selectHighlighted()"
                                           class="block w-full pl-12 pr-10 py-3.5 text-sm border-0 rounded-xl bg-slate-50/60 dark:bg-slate-700/60 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:bg-white dark:focus:bg-slate-600/80 transition-all duration-200 shadow-inner">

                                    <!-- Clear button -->
                                    <button x-show="searchQuery !== ''"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            @click="clearSearch()"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer group">
                                        <div class="p-1 rounded-full hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                            <svg class="h-4 w-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </div>

                                <!-- Search Suggestions Dropdown -->
                                <div x-show="showSuggestions && (searchResults.length > 0 || recentSearches.length > 0 || popularSearches.length > 0)"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-1"
                                     @click.outside="showSuggestions = false"
                                     class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-xl shadow-slate-200/20 dark:shadow-slate-900/40 backdrop-blur-xl z-[100] max-h-96 overflow-y-auto">

                                    <!-- Search Results -->
                                    <div x-show="searchResults.length > 0" class="p-2">
                                        <div class="px-3 py-2 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Search Results
                                        </div>
                                        <template x-for="(result, index) in searchResults" :key="result.id">
                                            <div @click="selectResult(result)"
                                                 @mouseenter="highlightedIndex = getResultIndex(index)"
                                                 :class="highlightedIndex === getResultIndex(index) ? 'bg-red-50 dark:bg-red-900/20' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50'"
                                                 class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer transition-colors">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-medium shrink-0"
                                                     :class="result.type === 'series' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300'">
                                                    <span x-text="result.type === 'series' ? 'S' : 'L'"></span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-sm font-medium text-slate-900 dark:text-white truncate" x-text="result.title"></div>
                                                    <div class="text-xs text-slate-500 dark:text-slate-400 capitalize" x-text="result.type + (result.category ? ' • ' + result.category : '')"></div>
                                                </div>
                                                <div class="flex items-center text-xs text-slate-400 dark:text-slate-500">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span x-text="result.duration || result.lessons_count + ' lessons'"></span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Recent Searches -->
                                    <div x-show="searchQuery === '' && recentSearches.length > 0" class="p-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                        <div class="px-3 py-2 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Recent Searches
                                        </div>
                                        <template x-for="(search, index) in recentSearches" :key="search">
                                            <div @click="applyRecentSearch(search)"
                                                 @mouseenter="highlightedIndex = getRecentIndex(index)"
                                                 :class="highlightedIndex === getRecentIndex(index) ? 'bg-red-50 dark:bg-red-900/20' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50'"
                                                 class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer transition-colors">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-sm text-slate-700 dark:text-slate-300" x-text="search"></span>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Popular Searches -->
                                    <div x-show="searchQuery === '' && popularSearches.length > 0" class="p-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                        <div class="px-3 py-2 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Popular Searches
                                        </div>
                                        <template x-for="(search, index) in popularSearches" :key="search.query">
                                            <div @click="applyPopularSearch(search.query)"
                                                 @mouseenter="highlightedIndex = getPopularIndex(index)"
                                                 :class="highlightedIndex === getPopularIndex(index) ? 'bg-red-50 dark:bg-red-900/20' : 'hover:bg-slate-50 dark:hover:bg-slate-700/50'"
                                                 class="flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer transition-colors">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                                </svg>
                                                <div class="flex-1">
                                                    <span class="text-sm text-slate-700 dark:text-slate-300" x-text="search.query"></span>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2" x-text="search.count + ' searches'"></span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Quick Filters -->
                                    <div x-show="searchQuery === ''" class="p-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                        <div class="px-3 py-2 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide">
                                            Quick Filters
                                        </div>
                                        <div class="flex flex-wrap gap-2 px-3 py-2">
                                            <template x-for="filter in quickFilters" :key="filter.label">
                                                <button @click="applyQuickFilter(filter)"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                                    <span x-text="filter.icon"></span>
                                                    <span x-text="filter.label"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Panels -->
                        <div class="space-y-4">

                            <!-- Content Type Filter -->
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 bg-red-500 rounded-full"></div>
                                    Content Type
                                </h3>
                                <div class="space-y-2">
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="contentType = 'all'">
                                        <div class="relative">
                                            <input type="radio" name="content_type" value="all" x-model="contentType" class="sr-only">
                                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="contentType === 'all' ? 'border-red-500 bg-red-500' : ''">
                                                <div x-show="contentType === 'all'"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">All Content</span>
                                        <span class="ml-auto text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">180</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="contentType = 'series'">
                                        <div class="relative">
                                            <input type="radio" name="content_type" value="series" x-model="contentType" class="sr-only">
                                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="contentType === 'series' ? 'border-red-500 bg-red-500' : ''">
                                                <div x-show="contentType === 'series'"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Series Only</span>
                                        <span class="ml-auto text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">24</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="contentType = 'lessons'">
                                        <div class="relative">
                                            <input type="radio" name="content_type" value="lessons" x-model="contentType" class="sr-only">
                                            <div class="w-5 h-5 rounded-full border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="contentType === 'lessons' ? 'border-red-500 bg-red-500' : ''">
                                                <div x-show="contentType === 'lessons'"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-2 h-2 bg-white rounded-full"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Individual Lessons</span>
                                        <span class="ml-auto text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">156</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Categories Filter -->
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                                    Categories
                                </h3>
                                <div class="space-y-2">
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleCategory('laravel')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedCategories.includes('laravel')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedCategories.includes('laravel') ? 'border-red-500 bg-red-500' : ''">
                                                <svg x-show="selectedCategories.includes('laravel')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Laravel</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">42</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleCategory('php')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedCategories.includes('php')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-blue-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedCategories.includes('php') ? 'border-blue-500 bg-blue-500' : ''">
                                                <svg x-show="selectedCategories.includes('php')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">PHP</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">28</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleCategory('livewire')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedCategories.includes('livewire')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-purple-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedCategories.includes('livewire') ? 'border-purple-500 bg-purple-500' : ''">
                                                <svg x-show="selectedCategories.includes('livewire')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Livewire</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">18</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleCategory('testing')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedCategories.includes('testing')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-green-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedCategories.includes('testing') ? 'border-green-500 bg-green-500' : ''">
                                                <svg x-show="selectedCategories.includes('testing')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Testing</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">15</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Difficulty Level -->
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                                    Difficulty Level
                                </h3>
                                <div class="space-y-2">
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleLevel('beginner')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedLevels.includes('beginner')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-green-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedLevels.includes('beginner') ? 'border-green-500 bg-green-500' : ''">
                                                <svg x-show="selectedLevels.includes('beginner')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Beginner</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">67</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleLevel('intermediate')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedLevels.includes('intermediate')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-yellow-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedLevels.includes('intermediate') ? 'border-yellow-500 bg-yellow-500' : ''">
                                                <svg x-show="selectedLevels.includes('intermediate')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Intermediate</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">84</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleLevel('advanced')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedLevels.includes('advanced')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedLevels.includes('advanced') ? 'border-red-500 bg-red-500' : ''">
                                                <svg x-show="selectedLevels.includes('advanced')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Advanced</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">29</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Duration Filter -->
                            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100 mb-5 flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 bg-orange-500 rounded-full"></div>
                                    Duration
                                </h3>
                                <div class="space-y-2">
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleDuration('short')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedDurations.includes('short')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-emerald-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedDurations.includes('short') ? 'border-emerald-500 bg-emerald-500' : ''">
                                                <svg x-show="selectedDurations.includes('short')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">Under 30 min</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">45</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleDuration('medium')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedDurations.includes('medium')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-orange-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedDurations.includes('medium') ? 'border-orange-500 bg-orange-500' : ''">
                                                <svg x-show="selectedDurations.includes('medium')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">30min - 1 hour</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">67</span>
                                    </label>
                                    <label class="relative flex items-center gap-3 cursor-pointer group p-3 rounded-xl hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-all duration-200" @click="toggleDuration('long')">
                                        <div class="relative">
                                            <input type="checkbox" :checked="selectedDurations.includes('long')" class="sr-only">
                                            <div class="w-5 h-5 rounded-lg border-2 border-slate-300 dark:border-slate-600 group-hover:border-red-400 transition-colors duration-200 flex items-center justify-center"
                                                 :class="selectedDurations.includes('long') ? 'border-red-500 bg-red-500' : ''">
                                                <svg x-show="selectedDurations.includes('long')"
                                                     x-transition:enter="transition ease-out duration-200"
                                                     x-transition:enter-start="opacity-0 scale-50"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2 flex-1">
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors duration-200">1+ hours</span>
                                        </div>
                                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400 bg-slate-100/80 dark:bg-slate-700/80 px-2.5 py-1 rounded-full">68</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Clear All Filters -->
                            <div x-show="hasActiveFilters"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                                <button @click="clearAllFilters()"
                                        class="w-full group flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-slate-100 to-slate-50 dark:from-slate-700 dark:to-slate-600 hover:from-slate-200 hover:to-slate-100 dark:hover:from-slate-600 dark:hover:to-slate-500 text-slate-700 dark:text-slate-300 font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                                    <div class="p-1.5 bg-slate-200/80 dark:bg-slate-600/80 rounded-lg group-hover:bg-slate-300/80 dark:group-hover:bg-slate-500/80 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                    <span>Clear All Filters</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </aside>

                <!-- Right Content Area -->
                <div class="flex-1">

                    <!-- Results Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">
                                All Courses <span class="text-slate-500 dark:text-slate-400 font-normal">(180 results)</span>
                            </h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                Comprehensive video tutorials for modern web development
                            </p>
                        </div>

                        <!-- Sort Options -->
                        <div class="flex items-center gap-3">
                            <label class="text-sm text-slate-600 dark:text-slate-400">Sort by:</label>
                            <div class="relative">
                                <select class="text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500/50 transition-all appearance-none cursor-pointer">
                                    <option value="newest">Newest First</option>
                                    <option value="popular">Most Popular</option>
                                    <option value="duration">Duration</option>
                                    <option value="difficulty">Difficulty</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Grid -->
                    <div class="space-y-8" x-data="infiniteScroll()" x-init="init()">

                        <!-- Series Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Featured Series</h3>
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            </div>

                            <!-- Series Grid -->
                            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">

                                <!-- Laravel Mastery Series -->
                                <div class="group relative" x-data="{ showPreview: false }">
                                    <!-- Background Blur Overlay -->
                                    <div x-show="showPreview"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[45]"></div>
                                    <a href="/series/laravel-mastery-complete-guide" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1 block">
                                    <div class="relative">
                                        <!-- Video Thumbnail -->
                                        <div class="aspect-video bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-red-50/40 via-orange-50/20 to-yellow-50/40 dark:from-red-950/10 dark:via-orange-950/5 dark:to-yellow-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-6xl text-red-400/60 dark:text-red-500/40">
                                                    🚀
                                                </div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-16 h-16 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-200/50 dark:bg-slate-700/50">
                                                <div class="h-full bg-red-500 w-3/5"></div>
                                            </div>
                                        </div>
                                        <!-- Episode Count Badge -->
                                        <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md">
                                            15 episodes
                                        </div>
                                        <!-- New/Updated Badge -->
                                        <div class="absolute top-3 left-3 bg-green-500 text-white text-xs px-2 py-1 rounded-md font-medium">
                                            New
                                        </div>
                                        <!-- Preview Icon -->
                                        <button @click.prevent="showPreview = !showPreview"
                                                class="absolute top-14 left-3 w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:border-red-200/60 dark:hover:border-red-700/60 transition-all cursor-pointer opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <!-- Series Title & Description -->
                                        <div class="mb-4">
                                            <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors leading-tight">
                                                Laravel Mastery: Complete Guide
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                Master Laravel from basics to advanced concepts. Build real-world applications with modern best practices.
                                            </p>
                                        </div>

                                        <!-- Instructor -->
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                                TC
                                            </div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Taylor Otwell</span>
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2 mb-5">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200/50 dark:border-red-800/50">
                                                Laravel
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200/50 dark:border-blue-800/50">
                                                PHP
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200/50 dark:border-green-800/50">
                                                Beginner
                                            </span>
                                        </div>

                                        <!-- Stats Grid -->
                                        <div class="grid grid-cols-3 gap-4 text-center">
                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">24.3k</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">views</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">6h</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">45m</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="text-xl font-bold text-green-600 dark:text-green-400">60%</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">complete</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Preview Card Overlay -->
                                <div x-show="showPreview"
                                     @mouseenter="showPreview = true"
                                     @mouseleave="showPreview = false"
                                     @click.outside="showPreview = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                     class="absolute bottom-full left-0 right-0 mb-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-xl shadow-slate-200/20 dark:shadow-slate-900/40 backdrop-blur-xl z-[50] pt-4 pb-4 pl-4 pr-10">

                                    <!-- Close Button -->
                                    <button @click="showPreview = false"
                                            class="absolute top-3 right-3 w-6 h-6 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-full flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-all duration-200 z-10">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <div class="space-y-3">
                                        <!-- Quick Preview Info -->
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">Laravel Mastery: Complete Guide</h5>
                                                <p class="text-xs text-slate-600 dark:text-slate-400">by Taylor Otwell</p>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs text-slate-500 dark:text-slate-400">15 episodes</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">6h 45m total</div>
                                            </div>
                                        </div>

                                        <!-- Episode List Preview -->
                                        <div class="space-y-2">
                                            <div class="text-xs font-medium text-slate-700 dark:text-slate-300 mb-2">Recent Episodes:</div>
                                            <div class="space-y-1.5">
                                                <div class="flex items-center justify-between py-1">
                                                    <div class="flex items-center gap-2 flex-1 min-w-0">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">01. Laravel Installation & Setup</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">12m</span>
                                                </div>
                                                <div class="flex items-center justify-between py-1">
                                                    <div class="flex items-center gap-2 flex-1 min-w-0">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">02. Routing Fundamentals</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">18m</span>
                                                </div>
                                                <div class="flex items-center justify-between py-1">
                                                    <div class="flex items-center gap-2 flex-1 min-w-0">
                                                        <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">03. Controllers & Middleware</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">25m</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="flex items-center gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                            <button class="flex-1 text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 px-3 py-2 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors">
                                                Continue Watching
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                </svg>
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <!-- Livewire Fundamentals Series (Not Started) -->
                                <div class="group relative" x-data="{ showPreview: false }">
                                    <!-- Background Blur Overlay -->
                                    <div x-show="showPreview"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[45]"></div>
                                    <a href="/series/livewire-fundamentals" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1 block">
                                    <div class="relative">
                                        <!-- Video Thumbnail -->
                                        <div class="aspect-video bg-gradient-to-br from-purple-100 to-blue-100 dark:from-purple-900/30 dark:to-blue-900/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/40 via-blue-50/20 to-indigo-50/40 dark:from-purple-950/10 dark:via-blue-950/5 dark:to-indigo-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-6xl text-purple-400/60 dark:text-purple-500/40">
                                                    ⚡
                                                </div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-16 h-16 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- No Progress Bar for Not Started -->
                                        </div>
                                        <!-- Episode Count Badge -->
                                        <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md">
                                            12 episodes
                                        </div>
                                        <!-- Not Started Badge -->
                                        <div class="absolute top-3 left-3 bg-slate-500 text-white text-xs px-2 py-1 rounded-md font-medium">
                                            Not Started
                                        </div>
                                        <!-- Preview Icon -->
                                        <button @click.prevent="showPreview = !showPreview"
                                                class="absolute top-14 left-3 w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-purple-600 dark:hover:text-purple-400 hover:border-purple-200/60 dark:hover:border-purple-700/60 transition-all cursor-pointer opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <!-- Series Title & Description -->
                                        <div class="mb-4">
                                            <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors leading-tight">
                                                Livewire Fundamentals
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                Build dynamic, reactive components with Laravel Livewire. Learn real-time updates, form handling, and state management.
                                            </p>
                                        </div>

                                        <!-- Instructor -->
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                                CK
                                            </div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Caleb Krzyz</span>
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2 mb-5">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 border border-purple-200/50 dark:border-purple-800/50">
                                                Livewire
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200/50 dark:border-blue-800/50">
                                                PHP
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 border border-yellow-200/50 dark:border-yellow-800/50">
                                                Intermediate
                                            </span>
                                        </div>

                                        <!-- Stats Grid -->
                                        <div class="grid grid-cols-3 gap-4 text-center">
                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">8.7k</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">views</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">4h</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">20m</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="text-xl font-bold text-slate-500 dark:text-slate-400">0%</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">complete</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Preview Card Overlay -->
                                <div x-show="showPreview"
                                     @mouseenter="showPreview = true"
                                     @mouseleave="showPreview = false"
                                     @click.outside="showPreview = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                     class="absolute bottom-full left-0 right-0 mb-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-xl shadow-slate-200/20 dark:shadow-slate-900/40 backdrop-blur-xl z-[50] pt-4 pb-4 pl-4 pr-10">

                                    <!-- Close Button -->
                                    <button @click="showPreview = false"
                                            class="absolute top-3 right-3 w-6 h-6 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-full flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-all duration-200 z-10">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <div class="space-y-3">
                                        <!-- Quick Preview Info -->
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">Livewire Fundamentals</h5>
                                                <p class="text-xs text-slate-600 dark:text-slate-400">by Caleb Krzyz</p>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs text-slate-500 dark:text-slate-400">12 episodes</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">4h 20m total</div>
                                            </div>
                                        </div>

                                        <!-- Course Description -->
                                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Master Livewire's reactive components, wire models, and real-time updates. Perfect for building modern, interactive Laravel applications.
                                        </p>

                                        <!-- Episode List Preview -->
                                        <div class="space-y-2">
                                            <div class="text-xs font-medium text-slate-700 dark:text-slate-300 mb-2">Course Contents:</div>
                                            <div class="space-y-1.5 max-h-20 overflow-y-auto">
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">01. Introduction to Livewire</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">18m</span>
                                                </div>
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">02. Your First Component</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">22m</span>
                                                </div>
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">03. Data Binding & Actions</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">28m</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="flex items-center gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                            <button class="flex-1 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 px-3 py-2 rounded-lg hover:bg-purple-200 dark:hover:bg-purple-900/50 transition-colors">
                                                Start Learning
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                </svg>
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <!-- PHP Testing Mastery Series (Completed) -->
                                <div class="group relative" x-data="{ showPreview: false }">
                                    <!-- Background Blur Overlay -->
                                    <div x-show="showPreview"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="fixed inset-0 bg-black/20 backdrop-blur-sm z-[45]"></div>
                                    <a href="/series/php-testing-mastery" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1 block">
                                    <div class="relative">
                                        <!-- Video Thumbnail -->
                                        <div class="aspect-video bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-green-50/40 via-emerald-50/20 to-teal-50/40 dark:from-green-950/10 dark:via-emerald-950/5 dark:to-teal-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-6xl text-green-400/60 dark:text-green-500/40">
                                                    ✅
                                                </div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-16 h-16 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Full Progress Bar for Completed -->
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-200/50 dark:bg-slate-700/50">
                                                <div class="h-full bg-green-500 w-full"></div>
                                            </div>
                                        </div>
                                        <!-- Episode Count Badge -->
                                        <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md">
                                            18 episodes
                                        </div>
                                        <!-- Completed Badge -->
                                        <div class="absolute top-3 left-3 bg-green-500 text-white text-xs px-2 py-1 rounded-md font-medium">
                                            Completed
                                        </div>
                                        <!-- Preview Icon -->
                                        <button @click.prevent="showPreview = !showPreview"
                                                class="absolute top-14 left-3 w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-400 hover:text-green-600 dark:hover:text-green-400 hover:border-green-200/60 dark:hover:border-green-700/60 transition-all cursor-pointer opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-6">
                                        <!-- Series Title & Description -->
                                        <div class="mb-4">
                                            <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors leading-tight">
                                                PHP Testing Mastery
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                Complete guide to testing in PHP. Learn PHPUnit, Pest, mocking, and test-driven development best practices.
                                            </p>
                                        </div>

                                        <!-- Instructor -->
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                                JW
                                            </div>
                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Jeffrey Way</span>
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2 mb-5">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200/50 dark:border-green-800/50">
                                                Testing
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200/50 dark:border-blue-800/50">
                                                PHPUnit
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 border border-purple-200/50 dark:border-purple-800/50">
                                                Pest
                                            </span>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 border border-red-200/50 dark:border-red-800/50">
                                                Advanced
                                            </span>
                                        </div>

                                        <!-- Stats Grid -->
                                        <div class="grid grid-cols-3 gap-4 text-center">
                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">42.1k</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">views</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-bold text-slate-900 dark:text-slate-100">8h</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">15m</div>
                                            </div>

                                            <div class="space-y-1">
                                                <div class="text-xl font-bold text-green-600 dark:text-green-400">100%</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">complete</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Preview Card Overlay -->
                                <div x-show="showPreview"
                                     @mouseenter="showPreview = true"
                                     @mouseleave="showPreview = false"
                                     @click.outside="showPreview = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                     class="absolute bottom-full left-0 right-0 mb-2 bg-white dark:bg-slate-800 rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-xl shadow-slate-200/20 dark:shadow-slate-900/40 backdrop-blur-xl z-[50] pt-4 pb-4 pl-4 pr-10">

                                    <!-- Close Button -->
                                    <button @click="showPreview = false"
                                            class="absolute top-3 right-3 w-6 h-6 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-full flex items-center justify-center text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-all duration-200 z-10">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>

                                    <div class="space-y-3">
                                        <!-- Quick Preview Info -->
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">PHP Testing Mastery</h5>
                                                <p class="text-xs text-slate-600 dark:text-slate-400">by Jeffrey Way</p>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xs text-slate-500 dark:text-slate-400">18 episodes</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">8h 15m total</div>
                                            </div>
                                        </div>

                                        <!-- Course Description -->
                                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                            Master PHP testing with PHPUnit and Pest. Learn TDD, mocking, integration testing, and best practices for maintainable test suites.
                                        </p>

                                        <!-- Episode List Preview -->
                                        <div class="space-y-2">
                                            <div class="text-xs font-medium text-slate-700 dark:text-slate-300 mb-2">Course Contents:</div>
                                            <div class="space-y-1.5 max-h-20 overflow-y-auto">
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">01. Introduction to Testing</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">15m</span>
                                                </div>
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">02. PHPUnit Fundamentals</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">32m</span>
                                                </div>
                                                <div class="flex items-center justify-between text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full shrink-0"></div>
                                                        <span class="text-xs text-slate-700 dark:text-slate-300 truncate">03. Pest Testing Framework</span>
                                                    </div>
                                                    <span class="text-xs text-slate-500 dark:text-slate-400 ml-2">28m</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Actions -->
                                        <div class="flex items-center gap-2 pt-2 border-t border-slate-200/60 dark:border-slate-700/60">
                                            <button class="flex-1 text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-3 py-2 rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-colors">
                                                Review Course
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                </svg>
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>

                        <!-- Learning Pathways Section -->
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Learning Pathways</h3>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                </div>
                                <a href="/learning-paths" class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-medium transition-colors">
                                    View All Paths →
                                </a>
                            </div>

                            <!-- Pathways Grid -->
                            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 mb-8">
                                
                                <!-- Laravel Developer Path -->
                                <div class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1">
                                    <div class="relative">
                                        <!-- Header Gradient -->
                                        <div class="h-24 bg-gradient-to-br from-red-500 via-orange-500 to-yellow-500 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-red-500/80 via-orange-500/80 to-yellow-500/80"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-3xl text-white/90">🚀</div>
                                            </div>
                                            <!-- Progress indicator -->
                                            <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                                3/8 completed
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                                    Laravel Developer
                                                </h4>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                    Master Laravel from fundamentals to advanced concepts. Build real-world applications with modern best practices.
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Skills Tags -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                                MVC
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300">
                                                Eloquent
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300">
                                                APIs
                                            </span>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400 mb-2">
                                                <span>Progress</span>
                                                <span>37%</span>
                                            </div>
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-red-500 to-orange-500 h-2 rounded-full" style="width: 37%"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Path Stats -->
                                        <div class="grid grid-cols-3 gap-4 text-center text-xs">
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">8</div>
                                                <div class="text-slate-500 dark:text-slate-400">courses</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">24h</div>
                                                <div class="text-slate-500 dark:text-slate-400">duration</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">Mid</div>
                                                <div class="text-slate-500 dark:text-slate-400">level</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Continue Button -->
                                        <button class="w-full mt-4 bg-gradient-to-r from-red-500 to-orange-500 text-white text-sm font-medium py-2.5 rounded-lg hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                            Continue Path
                                        </button>
                                    </div>
                                </div>

                                <!-- Full-Stack JavaScript Path -->
                                <div class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1">
                                    <div class="relative">
                                        <!-- Header Gradient -->
                                        <div class="h-24 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/80 via-indigo-500/80 to-purple-500/80"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-3xl text-white/90">💻</div>
                                            </div>
                                            <!-- New Badge -->
                                            <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                                New Path
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                    Full-Stack JavaScript
                                                </h4>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                    Complete JavaScript mastery from vanilla JS to modern frameworks like Vue.js and Node.js.
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Skills Tags -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                Vue.js
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                                                Node.js
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">
                                                ES6+
                                            </span>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400 mb-2">
                                                <span>Progress</span>
                                                <span>0%</span>
                                            </div>
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" style="width: 0%"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Path Stats -->
                                        <div class="grid grid-cols-3 gap-4 text-center text-xs">
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">12</div>
                                                <div class="text-slate-500 dark:text-slate-400">courses</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">36h</div>
                                                <div class="text-slate-500 dark:text-slate-400">duration</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">Adv</div>
                                                <div class="text-slate-500 dark:text-slate-400">level</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Start Button -->
                                        <button class="w-full mt-4 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium py-2.5 rounded-lg hover:from-blue-600 hover:to-purple-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                            Start Path
                                        </button>
                                    </div>
                                </div>

                                <!-- Testing Specialist Path -->
                                <div class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1">
                                    <div class="relative">
                                        <!-- Header Gradient -->
                                        <div class="h-24 bg-gradient-to-br from-green-500 via-emerald-500 to-teal-500 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-green-500/80 via-emerald-500/80 to-teal-500/80"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-3xl text-white/90">🧪</div>
                                            </div>
                                            <!-- Completed Badge -->
                                            <div class="absolute top-3 right-3 bg-white/20 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                                Completed
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-bold text-slate-900 dark:text-slate-100 mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                                    Testing Specialist
                                                </h4>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                                    Master software testing with PHPUnit, Pest, TDD, and integration testing best practices.
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Skills Tags -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                                PHPUnit
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">
                                                Pest
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-teal-100 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300">
                                                TDD
                                            </span>
                                        </div>
                                        
                                        <!-- Progress Bar -->
                                        <div class="mb-4">
                                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-400 mb-2">
                                                <span>Progress</span>
                                                <span>100%</span>
                                            </div>
                                            <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-green-500 to-teal-500 h-2 rounded-full" style="width: 100%"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Path Stats -->
                                        <div class="grid grid-cols-3 gap-4 text-center text-xs">
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">6</div>
                                                <div class="text-slate-500 dark:text-slate-400">courses</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">18h</div>
                                                <div class="text-slate-500 dark:text-slate-400">duration</div>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-slate-100">Adv</div>
                                                <div class="text-slate-500 dark:text-slate-400">level</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Review Button -->
                                        <button class="w-full mt-4 bg-gradient-to-r from-green-500 to-teal-500 text-white text-sm font-medium py-2.5 rounded-lg hover:from-green-600 hover:to-teal-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                            Review Path
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Skill-Based Recommendations -->
                            <div class="bg-gradient-to-r from-purple-100 via-blue-50 to-indigo-100 dark:from-purple-900/20 dark:via-blue-900/10 dark:to-indigo-900/20 rounded-2xl border border-purple-200/60 dark:border-purple-800/40 p-6 mb-8">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center text-white text-xl shrink-0">
                                        🎯
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">
                                            Recommended for You
                                        </h4>
                                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 leading-relaxed">
                                            Based on your Laravel experience and testing knowledge, we recommend exploring advanced API development and microservices architecture.
                                        </p>
                                        
                                        <!-- Recommended Series -->
                                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                                            <a href="/series/laravel-api-mastery" class="group flex items-center gap-3 bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-purple-200/60 dark:border-purple-700/60 rounded-lg p-3 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all">
                                                <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center text-white text-sm shrink-0">
                                                    🔗
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-medium text-slate-900 dark:text-slate-100 text-sm group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                                        Laravel API Mastery
                                                    </div>
                                                    <div class="text-xs text-slate-500 dark:text-slate-400">8 episodes • 4h 30m</div>
                                                </div>
                                            </a>
                                            
                                            <a href="/series/microservices-with-laravel" class="group flex items-center gap-3 bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-purple-200/60 dark:border-purple-700/60 rounded-lg p-3 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-lg flex items-center justify-center text-white text-sm shrink-0">
                                                    🏗️
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-medium text-slate-900 dark:text-slate-100 text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                                        Microservices Architecture
                                                    </div>
                                                    <div class="text-xs text-slate-500 dark:text-slate-400">12 episodes • 6h 15m</div>
                                                </div>
                                            </a>
                                            
                                            <a href="/series/advanced-livewire" class="group flex items-center gap-3 bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-purple-200/60 dark:border-purple-700/60 rounded-lg p-3 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all">
                                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-lg flex items-center justify-center text-white text-sm shrink-0">
                                                    ⚡
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="font-medium text-slate-900 dark:text-slate-100 text-sm group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                        Advanced Livewire
                                                    </div>
                                                    <div class="text-xs text-slate-500 dark:text-slate-400">10 episodes • 5h 20m</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Lessons Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Recent Lessons</h3>
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            </div>

                            <!-- Lessons List -->
                            <div class="space-y-4">

                                <!-- Laravel Routing Lesson -->
                                <a href="/lessons/advanced-laravel-routing-techniques" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-0.5 block">
                                    <div class="flex gap-4">
                                        <!-- Video Thumbnail -->
                                        <div class="relative w-40 h-24 bg-gradient-to-br from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 rounded-lg overflow-hidden shrink-0 group">
                                            <div class="absolute inset-0 bg-gradient-to-br from-red-50/40 via-orange-50/20 to-yellow-50/40 dark:from-red-950/10 dark:via-orange-950/5 dark:to-yellow-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-2xl text-red-400/60 dark:text-red-500/40">🛣️</div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-3 h-3 text-red-600 dark:text-red-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Duration Badge -->
                                            <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs px-1.5 py-0.5 rounded">
                                                12:34
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-200/50 dark:bg-slate-700/50">
                                                <div class="h-full bg-red-500 w-2/3"></div>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-3 mb-2">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors line-clamp-1">
                                                        Advanced Laravel Routing Techniques
                                                    </h4>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                                        Learn advanced routing patterns, route model binding, and custom route constraints. Build clean, maintainable URL structures for complex applications.
                                                    </p>
                                                </div>
                                                <!-- Bookmark Icon -->
                                                <button class="opacity-0 group-hover:opacity-100 transition-opacity p-1.5 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                                                    <svg class="w-4 h-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Instructor & Metadata -->
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-5 h-5 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        TC
                                                    </div>
                                                    <span class="text-xs text-slate-600 dark:text-slate-400">Taylor Otwell</span>
                                                </div>
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">3 days ago</span>
                                            </div>

                                            <!-- Tags & Stats -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                                        <span>Laravel</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                                        <span>Intermediate</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>2.4k views</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-green-600 dark:text-green-400 font-medium">
                                                    67% watched
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Livewire Real-time Components Lesson -->
                                <a href="/lessons/building-realtime-components-with-livewire" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-0.5 block">
                                    <div class="flex gap-4">
                                        <!-- Video Thumbnail -->
                                        <div class="relative w-40 h-24 bg-gradient-to-br from-purple-100 to-blue-100 dark:from-purple-900/30 dark:to-blue-900/30 rounded-lg overflow-hidden shrink-0 group">
                                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/40 via-blue-50/20 to-indigo-50/40 dark:from-purple-950/10 dark:via-blue-950/5 dark:to-indigo-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-2xl text-purple-400/60 dark:text-purple-500/40">⚡</div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-3 h-3 text-purple-600 dark:text-purple-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Duration Badge -->
                                            <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs px-1.5 py-0.5 rounded">
                                                24:17
                                            </div>
                                            <!-- New Badge -->
                                            <div class="absolute top-2 left-2 bg-green-500 text-white text-xs px-1.5 py-0.5 rounded font-medium">
                                                New
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-3 mb-2">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors line-clamp-1">
                                                        Building Real-time Components with Livewire
                                                    </h4>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                                        Create dynamic, reactive components that update in real-time without writing JavaScript. Perfect for dashboards and live data.
                                                    </p>
                                                </div>
                                                <!-- Bookmark Icon -->
                                                <button class="opacity-0 group-hover:opacity-100 transition-opacity p-1.5 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                                                    <svg class="w-4 h-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Instructor & Metadata -->
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-5 h-5 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        CO
                                                    </div>
                                                    <span class="text-xs text-slate-600 dark:text-slate-400">Caleb Orzoo</span>
                                                </div>
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">1 day ago</span>
                                            </div>

                                            <!-- Tags & Stats -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                                        <span>Livewire</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                                        <span>Intermediate</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>1.8k views</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                                    Not started
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- PHP 8.4 Features Lesson -->
                                <a href="/lessons/whats-new-in-php-84-complete-overview" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-0.5 block">
                                    <div class="flex gap-4">
                                        <!-- Video Thumbnail -->
                                        <div class="relative w-40 h-24 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-lg overflow-hidden shrink-0 group">
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/40 via-indigo-50/20 to-purple-50/40 dark:from-blue-950/10 dark:via-indigo-950/5 dark:to-purple-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-2xl text-blue-400/60 dark:text-blue-500/40">🐘</div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Duration Badge -->
                                            <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs px-1.5 py-0.5 rounded">
                                                18:45
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-200/50 dark:bg-slate-700/50">
                                                <div class="h-full bg-blue-500 w-full"></div>
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-3 mb-2">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-1">
                                                        What's New in PHP 8.4: Complete Overview
                                                    </h4>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                                        Explore the latest PHP 8.4 features including property hooks, new array functions, and performance improvements.
                                                    </p>
                                                </div>
                                                <!-- Bookmark Icon -->
                                                <button class="opacity-0 group-hover:opacity-100 transition-opacity p-1.5 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Instructor & Metadata -->
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-5 h-5 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        JH
                                                    </div>
                                                    <span class="text-xs text-slate-600 dark:text-slate-400">Jeffrey Hinton</span>
                                                </div>
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">1 week ago</span>
                                            </div>

                                            <!-- Tags & Stats -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                        <span>PHP</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                                        <span>Beginner</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>5.2k views</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-green-600 dark:text-green-400 font-medium">
                                                    ✓ Completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- TDD with Pest Lesson -->
                                <a href="/lessons/test-driven-development-with-pest-best-practices" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-0.5 block">
                                    <div class="flex gap-4">
                                        <!-- Video Thumbnail -->
                                        <div class="relative w-40 h-24 bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 rounded-lg overflow-hidden shrink-0 group">
                                            <div class="absolute inset-0 bg-gradient-to-br from-green-50/40 via-emerald-50/20 to-teal-50/40 dark:from-green-950/10 dark:via-emerald-950/5 dark:to-teal-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-2xl text-green-400/60 dark:text-green-500/40">🧪</div>
                                            </div>
                                            <!-- Play Button Overlay -->
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg">
                                                    <svg class="w-3 h-3 text-green-600 dark:text-green-400 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!-- Duration Badge -->
                                            <div class="absolute bottom-2 right-2 bg-black/70 backdrop-blur-sm text-white text-xs px-1.5 py-0.5 rounded">
                                                31:22
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-3 mb-2">
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors line-clamp-1">
                                                        Test-Driven Development with Pest: Best Practices
                                                    </h4>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                                        Master TDD workflow with Pest. Learn to write tests first, refactor with confidence, and build robust applications.
                                                    </p>
                                                </div>
                                                <!-- Bookmark Icon -->
                                                <button class="opacity-0 group-hover:opacity-100 transition-opacity p-1.5 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg">
                                                    <svg class="w-4 h-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Instructor & Metadata -->
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-5 h-5 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                        NM
                                                    </div>
                                                    <span class="text-xs text-slate-600 dark:text-slate-400">Nuno Maduro</span>
                                                </div>
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span class="text-xs text-slate-500 dark:text-slate-400">2 weeks ago</span>
                                            </div>

                                            <!-- Tags & Stats -->
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                                        <span>Testing</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                                        <span>Advanced</span>
                                                    </div>
                                                    <span>•</span>
                                                    <div class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>3.7k views</span>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                                                    Not started
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>

                        <!-- Skeleton Loading for Infinite Scroll -->
                        <div x-show="loading" class="space-y-4">
                            <!-- Series Skeletons -->
                            <div x-show="!contentTypeFilter || contentTypeFilter === 'series'">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-32 animate-pulse"></div>
                                    <div class="w-2 h-2 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse"></div>
                                </div>
                                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                                    <template x-for="i in 6">
                                        <div class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden animate-pulse">
                                            <div class="aspect-video bg-slate-200 dark:bg-slate-700"></div>
                                            <div class="p-5 space-y-3">
                                                <div class="h-5 bg-slate-200 dark:bg-slate-700 rounded w-3/4"></div>
                                                <div class="space-y-2">
                                                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-5/6"></div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-6 h-6 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
                                                    <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-24"></div>
                                                </div>
                                                <div class="flex gap-2">
                                                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-16"></div>
                                                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-12"></div>
                                                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-20"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Lessons Skeletons -->
                            <div x-show="!contentTypeFilter || contentTypeFilter === 'lessons'">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="h-6 bg-slate-200 dark:bg-slate-700 rounded w-28 animate-pulse"></div>
                                    <div class="w-2 h-2 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse"></div>
                                </div>
                                <div class="space-y-4">
                                    <template x-for="i in 8">
                                        <div class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 animate-pulse">
                                            <div class="flex gap-4">
                                                <div class="w-40 h-24 bg-slate-200 dark:bg-slate-700 rounded-lg shrink-0"></div>
                                                <div class="flex-1 space-y-3">
                                                    <div class="h-5 bg-slate-200 dark:bg-slate-700 rounded w-3/4"></div>
                                                    <div class="space-y-2">
                                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded"></div>
                                                        <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded w-4/5"></div>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-5 h-5 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
                                                        <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-20"></div>
                                                    </div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="flex gap-3">
                                                            <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-12"></div>
                                                            <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-16"></div>
                                                            <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-14"></div>
                                                        </div>
                                                        <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded w-20"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Load More Trigger -->
                        <div x-intersect.once="loadMoreContent()" class="flex justify-center py-8">
                            <div x-show="hasMore && !loading" class="text-slate-500 dark:text-slate-400">
                                <svg class="w-6 h-6 animate-spin mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-shared.footer :top-lessons="collect()" />
    <x-shared.mobile-nav-script />

    <!-- Infinite Scroll JavaScript -->
    <script>
        function infiniteScroll() {
            return {
                loading: false,
                hasMore: true,
                currentPage: 1,
                contentTypeFilter: 'all',

                init() {
                    // Initialize content type filter
                    this.contentTypeFilter = 'all';

                    // Listen for filter changes
                    this.$watch('contentTypeFilter', () => {
                        this.resetPagination();
                    });
                },

                async loadMoreContent() {
                    if (this.loading || !this.hasMore) return;

                    this.loading = true;

                    // Simulate API call delay
                    await new Promise(resolve => setTimeout(resolve, 1500));

                    // Mock: After 3 pages, no more content
                    this.currentPage++;
                    if (this.currentPage >= 4) {
                        this.hasMore = false;
                    }

                    this.loading = false;

                    // In real implementation, this would load more content from server
                    console.log(`Loading page ${this.currentPage} for content type: ${this.contentTypeFilter}`);
                },

                resetPagination() {
                    this.currentPage = 1;
                    this.hasMore = true;
                    this.loading = false;
                },

                setContentType(type) {
                    this.contentTypeFilter = type;
                    console.log(`Content filter changed to: ${type}`);
                }
            }
        }

        function quickSearch() {
            return {
                searchQuery: '',
                showSuggestions: false,
                searchResults: [],
                recentSearches: ['Laravel Basics', 'PHP 8 Features', 'Livewire'],
                popularSearches: [
                    { query: 'Laravel', count: 1250 },
                    { query: 'PHP', count: 980 },
                    { query: 'Livewire', count: 650 },
                    { query: 'Vue.js', count: 420 },
                    { query: 'JavaScript', count: 380 }
                ],
                quickFilters: [
                    { label: 'Beginner', icon: '🌱', filter: { level: 'beginner' } },
                    { label: 'Laravel', icon: '🚀', filter: { category: 'laravel' } },
                    { label: 'Free', icon: '💚', filter: { type: 'free' } },
                    { label: 'New', icon: '✨', filter: { recent: true } }
                ],
                highlightedIndex: -1,
                searchTimeout: null,

                init() {
                    // Load recent searches from localStorage
                    const stored = localStorage.getItem('phpuzem_recent_searches');
                    if (stored) {
                        this.recentSearches = JSON.parse(stored).slice(0, 5);
                    }
                },

                async handleSearch() {
                    // Clear existing timeout
                    if (this.searchTimeout) {
                        clearTimeout(this.searchTimeout);
                    }

                    if (this.searchQuery.length < 2) {
                        this.searchResults = [];
                        this.showSuggestions = this.searchQuery === '' && (this.recentSearches.length > 0 || this.popularSearches.length > 0);
                        return;
                    }

                    // Debounce search
                    this.searchTimeout = setTimeout(async () => {
                        await this.performSearch();
                    }, 300);
                },

                async performSearch() {
                    // Mock search results - in real implementation, this would be an API call
                    const mockResults = [
                        { id: 1, title: 'Laravel Fundamentals', type: 'series', category: 'Laravel', lessons_count: 24, duration: '4h 30m' },
                        { id: 2, title: 'Laravel Authentication Deep Dive', type: 'lesson', category: 'Laravel', duration: '45m' },
                        { id: 3, title: 'Building APIs with Laravel', type: 'series', category: 'Laravel', lessons_count: 18, duration: '3h 15m' },
                        { id: 4, title: 'Laravel Testing Fundamentals', type: 'lesson', category: 'Laravel', duration: '32m' },
                        { id: 5, title: 'Laravel Livewire Components', type: 'series', category: 'Livewire', lessons_count: 12, duration: '2h 10m' },
                        { id: 6, title: 'PHP 8 Features Overview', type: 'lesson', category: 'PHP', duration: '28m' }
                    ];

                    // Filter results based on search query
                    this.searchResults = mockResults.filter(item =>
                        item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        item.category.toLowerCase().includes(this.searchQuery.toLowerCase())
                    ).slice(0, 6);

                    this.showSuggestions = true;
                    this.highlightedIndex = -1;
                },

                selectResult(result) {
                    this.addToRecentSearches(result.title);
                    // In real implementation, navigate to the result
                    console.log('Selected result:', result);
                    this.showSuggestions = false;
                    this.searchQuery = '';
                },

                applyRecentSearch(search) {
                    this.searchQuery = search;
                    this.handleSearch();
                },

                applyPopularSearch(search) {
                    this.searchQuery = search;
                    this.handleSearch();
                },

                applyQuickFilter(filter) {
                    // Apply the filter to the main page filters
                    console.log('Applying quick filter:', filter);
                    this.showSuggestions = false;
                },

                clearSearch() {
                    this.searchQuery = '';
                    this.searchResults = [];
                    this.showSuggestions = false;
                    this.highlightedIndex = -1;
                },

                addToRecentSearches(query) {
                    if (!this.recentSearches.includes(query)) {
                        this.recentSearches.unshift(query);
                        this.recentSearches = this.recentSearches.slice(0, 5);
                        localStorage.setItem('phpuzem_recent_searches', JSON.stringify(this.recentSearches));
                    }
                },

                // Keyboard navigation
                navigateDown() {
                    const totalItems = this.getTotalNavigableItems();
                    if (totalItems > 0) {
                        this.highlightedIndex = (this.highlightedIndex + 1) % totalItems;
                    }
                },

                navigateUp() {
                    const totalItems = this.getTotalNavigableItems();
                    if (totalItems > 0) {
                        this.highlightedIndex = this.highlightedIndex <= 0 ? totalItems - 1 : this.highlightedIndex - 1;
                    }
                },

                selectHighlighted() {
                    if (this.highlightedIndex < 0) return;

                    if (this.searchResults.length > 0 && this.highlightedIndex < this.searchResults.length) {
                        this.selectResult(this.searchResults[this.highlightedIndex]);
                    } else {
                        // Handle recent or popular searches
                        const resultCount = this.searchResults.length;
                        const recentIndex = this.highlightedIndex - resultCount;

                        if (recentIndex >= 0 && recentIndex < this.recentSearches.length) {
                            this.applyRecentSearch(this.recentSearches[recentIndex]);
                        } else {
                            const popularIndex = recentIndex - this.recentSearches.length;
                            if (popularIndex >= 0 && popularIndex < this.popularSearches.length) {
                                this.applyPopularSearch(this.popularSearches[popularIndex].query);
                            }
                        }
                    }
                },

                getTotalNavigableItems() {
                    return this.searchResults.length + this.recentSearches.length + this.popularSearches.length;
                },

                getResultIndex(index) {
                    return index;
                },

                getRecentIndex(index) {
                    return this.searchResults.length + index;
                },

                getPopularIndex(index) {
                    return this.searchResults.length + this.recentSearches.length + index;
                }
            }
        }

        function recentWatchedData() {
            return {
                continueWatching: [
                    {
                        id: 1,
                        title: 'Laravel Authentication Deep Dive',
                        seriesTitle: 'Laravel Mastery: Complete Guide',
                        url: '/lesson/laravel-authentication-deep-dive',
                        progress: 65,
                        timeRemaining: '12m left',
                        lastWatched: '2 hours ago',
                        emoji: '🔐'
                    },
                    {
                        id: 2,
                        title: 'Component Basics',
                        seriesTitle: 'Livewire Fundamentals',
                        url: '/lesson/livewire-component-basics',
                        progress: 40,
                        timeRemaining: '15m left',
                        lastWatched: '1 day ago',
                        emoji: '⚡'
                    },
                    {
                        id: 3,
                        title: 'Testing Controllers',
                        seriesTitle: 'Testing with Pest',
                        url: '/lesson/testing-controllers-pest',
                        progress: 80,
                        timeRemaining: '5m left',
                        lastWatched: '3 days ago',
                        emoji: '🧪'
                    }
                ],
                recentlyWatched: [
                    {
                        id: 1,
                        title: 'Laravel Installation & Setup',
                        duration: '12m',
                        url: '/lesson/laravel-installation-setup',
                        completed: true,
                        emoji: '🚀'
                    },
                    {
                        id: 2,
                        title: 'Routing Fundamentals',
                        duration: '18m',
                        url: '/lesson/routing-fundamentals',
                        completed: true,
                        emoji: '🛣️'
                    },
                    {
                        id: 3,
                        title: 'What is Livewire?',
                        duration: '15m',
                        url: '/lesson/what-is-livewire',
                        completed: true,
                        emoji: '⚡'
                    },
                    {
                        id: 4,
                        title: 'Database Migrations',
                        duration: '22m',
                        url: '/lesson/database-migrations',
                        completed: false,
                        emoji: '🗃️'
                    },
                    {
                        id: 5,
                        title: 'PHP 8 Features Overview',
                        duration: '28m',
                        url: '/lesson/php8-features',
                        completed: true,
                        emoji: '🐘'
                    },
                    {
                        id: 6,
                        title: 'API Authentication',
                        duration: '35m',
                        url: '/lesson/api-authentication',
                        completed: false,
                        emoji: '🔑'
                    }
                ],

                // Continue Watching Scroll functions
                scrollContinueLeft() {
                    this.$refs.continueScrollContainer.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                },

                scrollContinueRight() {
                    this.$refs.continueScrollContainer.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                },

                // Recently Watched Scroll functions
                scrollLeft() {
                    this.$refs.recentScrollContainer.scrollBy({
                        left: -200,
                        behavior: 'smooth'
                    });
                },

                scrollRight() {
                    this.$refs.recentScrollContainer.scrollBy({
                        left: 200,
                        behavior: 'smooth'
                    });
                },

                // View All functions
                viewAllContent() {
                    console.log('View All clicked - would navigate to full list');
                    // In real implementation, this would navigate to a dedicated page
                }
            }
        }
    </script>

</div>
