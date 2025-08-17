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
                    <div class="sticky top-24 space-y-6">
                        
                        <!-- Search Bar -->
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/40 dark:border-slate-700/40 shadow-lg shadow-slate-200/10 dark:shadow-slate-900/20 p-6">
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-red-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="search" placeholder="Search courses, lessons..." 
                                       x-model="searchQuery"
                                       class="block w-full pl-12 pr-10 py-3.5 text-sm border-0 rounded-xl bg-slate-50/60 dark:bg-slate-700/60 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:bg-white dark:focus:bg-slate-600/80 transition-all duration-200 shadow-inner">
                                <!-- Clear button -->
                                <button x-show="searchQuery !== ''" 
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        @click="searchQuery = ''"
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer group">
                                    <div class="p-1 rounded-full hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                                        <svg class="h-4 w-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
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
                    <div class="space-y-8">
                        
                        <!-- Series Section -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Featured Series</h3>
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            </div>
                            
                            <!-- Series Grid -->
                            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                                
                                <!-- Laravel Mastery Series -->
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
                                    </div>
                                    
                                    <div class="p-5">
                                        <!-- Series Title & Metadata -->
                                        <div class="mb-3">
                                            <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                                Laravel Mastery: Complete Guide
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2">
                                                Master Laravel from basics to advanced concepts. Build real-world applications with modern best practices.
                                            </p>
                                        </div>
                                        
                                        <!-- Instructor -->
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-6 h-6 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                TC
                                            </div>
                                            <span class="text-sm text-slate-600 dark:text-slate-400">Taylor Otwell</span>
                                        </div>
                                        
                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                                Laravel
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                PHP
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                                Beginner
                                            </span>
                                        </div>
                                        
                                        <!-- Stats -->
                                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>24.3k views</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>6h 45m</span>
                                                </div>
                                            </div>
                                            <div class="text-green-600 dark:text-green-400 font-medium">
                                                60% complete
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Livewire Fundamentals Series -->
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
                                        </div>
                                        <!-- Episode Count Badge -->
                                        <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md">
                                            12 episodes
                                        </div>
                                    </div>
                                    
                                    <div class="p-5">
                                        <!-- Series Title & Metadata -->
                                        <div class="mb-3">
                                            <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                                Livewire Fundamentals
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2">
                                                Learn to build dynamic interfaces with Livewire. No JavaScript required for reactive components.
                                            </p>
                                        </div>
                                        
                                        <!-- Instructor -->
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-6 h-6 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                CO
                                            </div>
                                            <span class="text-sm text-slate-600 dark:text-slate-400">Caleb Orzoo</span>
                                        </div>
                                        
                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">
                                                Livewire
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                                Laravel
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300">
                                                Intermediate
                                            </span>
                                        </div>
                                        
                                        <!-- Stats -->
                                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>18.7k views</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>4h 20m</span>
                                                </div>
                                            </div>
                                            <div class="text-slate-500 dark:text-slate-400 font-medium">
                                                Not started
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- Testing with Pest Series -->
                                <a href="/series/testing-with-pest" class="group bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl overflow-hidden hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 hover:-translate-y-1 block">
                                    <div class="relative">
                                        <!-- Video Thumbnail -->
                                        <div class="aspect-video bg-gradient-to-br from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-green-50/40 via-emerald-50/20 to-teal-50/40 dark:from-green-950/10 dark:via-emerald-950/5 dark:to-teal-950/10"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <div class="text-6xl text-green-400/60 dark:text-green-500/40">
                                                    🧪
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
                                            <!-- Progress Bar -->
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-200/50 dark:bg-slate-700/50">
                                                <div class="h-full bg-green-500 w-full"></div>
                                            </div>
                                        </div>
                                        <!-- Episode Count Badge -->
                                        <div class="absolute top-3 right-3 bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-md">
                                            8 episodes
                                        </div>
                                        <!-- Completed Badge -->
                                        <div class="absolute top-3 left-3 bg-green-500 text-white text-xs px-2 py-1 rounded-md font-medium">
                                            ✓ Completed
                                        </div>
                                    </div>
                                    
                                    <div class="p-5">
                                        <!-- Series Title & Metadata -->
                                        <div class="mb-3">
                                            <h4 class="font-semibold text-slate-900 dark:text-slate-100 mb-1 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                                Testing with Pest
                                            </h4>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 line-clamp-2">
                                                Write beautiful, expressive tests with Pest. Learn TDD and testing best practices for Laravel apps.
                                            </p>
                                        </div>
                                        
                                        <!-- Instructor -->
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="w-6 h-6 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                NM
                                            </div>
                                            <span class="text-sm text-slate-600 dark:text-slate-400">Nuno Maduro</span>
                                        </div>
                                        
                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-1 mb-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                                Testing
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300">
                                                Pest
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                                Advanced
                                            </span>
                                        </div>
                                        
                                        <!-- Stats -->
                                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                            <div class="flex items-center gap-4">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>12.1k views</span>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>3h 15m</span>
                                                </div>
                                            </div>
                                            <div class="text-green-600 dark:text-green-400 font-medium">
                                                100% complete
                                            </div>
                                        </div>
                                    </div>
                                </a>

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

                    </div>
                </div>

            </div>
        </div>
    </main>

    <x-shared.footer :top-lessons="collect()" />
    <x-shared.mobile-nav-script />

</div>