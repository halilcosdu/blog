<div class="min-h-screen bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    {{-- Header --}}
    <x-shared.header current-page="watch" />
    <x-shared.announcements />

    {{-- Hero Section --}}
    <section class="relative pt-20 pb-12 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-pink-600/10"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(120,119,198,0.1),transparent_50%)]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Master Development
                    <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent block">
                        Through Video
                    </span>
                </h1>
                <p class="text-xl text-slate-300 mb-8 leading-relaxed">
                    Join thousands of developers learning through hands-on screencasts, structured learning paths, and comprehensive series
                </p>

                {{-- Stats --}}
                <div class="flex flex-wrap justify-center gap-8 text-sm font-medium">
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span>240+ Lessons</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                        <span>45 Series</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
                        <span>15 Learning Paths</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300">
                        <div class="w-2 h-2 bg-orange-400 rounded-full"></div>
                        <span>150+ Hours</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Continue Watching Section --}}
    @if(count($this->continueWatching) > 0)
    <section class="py-8 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Continue Watching</h2>
                    <p class="text-slate-600 dark:text-slate-400">Pick up where you left off</p>
                </div>
                <button class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium text-sm transition-colors cursor-pointer">
                    View All
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($this->continueWatching as $video)
                <a href="{{ $video['url'] }}" class="group bg-white dark:bg-slate-700 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-600 cursor-pointer block">
                    <div class="aspect-video bg-slate-100 dark:bg-slate-600 relative overflow-hidden">
                        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                            <div class="w-12 h-12 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 scale-90 group-hover:scale-100">
                                <svg class="w-5 h-5 text-red-600 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                            </div>
                        </div>
                        {{-- Progress bar --}}
                        <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/20">
                            <div class="h-full bg-red-500 transition-all duration-300" style="width: {{ $video['progress'] }}%"></div>
                        </div>
                        {{-- Duration badge --}}
                        <div class="absolute top-2 right-2">
                            <span class="px-2 py-1 bg-black/70 text-white text-xs font-medium rounded">
                                {{ $video['duration'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                            {{ $video['title'] }}
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">{{ $video['series'] }}</p>
                        <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                            <span>{{ $video['progress'] }}% complete</span>
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ number_format(rand(500, 2000)) }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Main Content Area --}}
    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Content Tabs --}}
            <div class="mb-8">
                <div class="border-b border-slate-200 dark:border-slate-700">
                    <nav class="-mb-px flex space-x-8">
                        <button 
                            wire:click="setActiveTab('all')"
                            class="py-2 px-1 border-b-2 font-medium text-sm transition-colors cursor-pointer {{ $activeTab === 'all' ? 'border-red-500 text-red-600 dark:text-red-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                            All Content
                        </button>
                        <button 
                            wire:click="setActiveTab('series')"
                            class="py-2 px-1 border-b-2 font-medium text-sm transition-colors cursor-pointer {{ $activeTab === 'series' ? 'border-red-500 text-red-600 dark:text-red-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                            Series
                        </button>
                        <button 
                            wire:click="setActiveTab('lessons')"
                            class="py-2 px-1 border-b-2 font-medium text-sm transition-colors cursor-pointer {{ $activeTab === 'lessons' ? 'border-red-500 text-red-600 dark:text-red-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                            Individual Lessons
                        </button>
                        <button 
                            wire:click="setActiveTab('pathways')"
                            class="py-2 px-1 border-b-2 font-medium text-sm transition-colors cursor-pointer {{ $activeTab === 'pathways' ? 'border-red-500 text-red-600 dark:text-red-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                            Learning Paths
                        </button>
                        @auth
                        <button 
                            wire:click="setActiveTab('watchlist')"
                            class="py-2 px-1 border-b-2 font-medium text-sm transition-colors relative cursor-pointer {{ $activeTab === 'watchlist' ? 'border-purple-500 text-purple-600 dark:text-purple-400' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 hover:border-slate-300 dark:hover:border-slate-600' }}"
                        >
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                Watchlist
                                @if($this->watchlistCount > 0)
                                    <span class="bg-purple-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $this->watchlistCount }}</span>
                                @endif
                            </div>
                        </button>
                        @endauth
                    </nav>
                </div>
            </div>

            {{-- Search and Filter Bar --}}
            <div class="mb-8">
                <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
                    {{-- Search Input --}}
                    <div class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="search" 
                                wire:model.live.debounce.300ms="search"
                                placeholder="Search courses, lessons, topics..." 
                                class="block w-full pl-10 pr-3 py-3 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                            >
                            @if($search)
                            <button 
                                wire:click="$set('search', '')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                            >
                                <svg class="h-4 w-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>

                    {{-- Controls --}}
                    <div class="flex items-center gap-3">
                        {{-- Filter Toggle --}}
                        <button 
                            wire:click="toggleFilters"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-600 transition-all cursor-pointer {{ $showFilters ? 'ring-2 ring-red-500 ring-opacity-50 bg-red-50 dark:bg-red-900/20' : '' }}"
                        >
                            <svg class="w-4 h-4 transition-transform {{ $showFilters ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                            </svg>
                            <span>Filters</span>
                            @if($showFilters)
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                            @if($this->hasActiveFilters)
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            @endif
                        </button>

                        {{-- View Mode Toggle --}}
                        @if($activeTab !== 'pathways' && $activeTab !== 'watchlist')
                        <button 
                            wire:click="toggleViewMode"
                            class="p-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-600 transition-all cursor-pointer"
                        >
                            @if($viewMode === 'grid')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            @endif
                        </button>
                        @endif

                        {{-- Sort Dropdown --}}
                        <div class="relative sort-dropdown">
                            <button 
                                wire:click="toggleSortDropdown"
                                class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all cursor-pointer"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $this->sortOptions[$sortBy]['icon'] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                </svg>
                                <span>{{ $this->sortOptions[$sortBy]['label'] ?? 'Most Recent' }}</span>
                                <svg class="w-4 h-4 transition-transform {{ $showSortDropdown ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            @if($showSortDropdown)
                            <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200 dark:border-slate-700 z-20 animate-in fade-in duration-200">
                                <div class="py-2">
                                    @foreach($this->sortOptions as $value => $option)
                                    <button 
                                        wire:click="setSortBy('{{ $value }}')"
                                        class="w-full flex items-center gap-3 px-4 py-2 text-left text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors cursor-pointer {{ $sortBy === $value ? 'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400' : '' }}"
                                    >
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $option['icon'] }}"/>
                                        </svg>
                                        <span class="flex-1">{{ $option['label'] }}</span>
                                        @if($sortBy === $value)
                                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        @endif
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Active Filters --}}
                @if($this->hasActiveFilters)
                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Active filters:</span>
                    
                    @if($contentType !== 'all')
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 text-sm rounded-full">
                        {{ ucfirst($contentType) }}
                        <button wire:click="$set('contentType', 'all')" class="ml-1 text-red-600 dark:text-red-300 hover:text-red-800 dark:hover:text-red-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endif

                    @if($selectedCategory)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 text-sm rounded-full">
                        {{ ucfirst($selectedCategory) }}
                        <button wire:click="$set('selectedCategory', '')" class="ml-1 text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endif

                    @if($selectedLevel)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200 text-sm rounded-full">
                        {{ ucfirst($selectedLevel) }}
                        <button wire:click="$set('selectedLevel', '')" class="ml-1 text-purple-600 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endif

                    @if($selectedDuration)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 text-sm rounded-full">
                        {{ $selectedDuration === 'short' ? 'Short' : ($selectedDuration === 'medium' ? 'Medium' : 'Long') }}
                        <button wire:click="$set('selectedDuration', '')" class="ml-1 text-orange-600 dark:text-orange-300 hover:text-orange-800 dark:hover:text-orange-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endif

                    @if($selectedInstructor)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 text-sm rounded-full">
                        @php
                            $instructorMap = ['halil' => 'Halil Coşdu', 'taylor' => 'Taylor Otwell', 'jeffrey' => 'Jeffrey Way', 'caleb' => 'Caleb Porzio'];
                        @endphp
                        {{ $instructorMap[$selectedInstructor] ?? $selectedInstructor }}
                        <button wire:click="$set('selectedInstructor', '')" class="ml-1 text-indigo-600 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endif

                    @foreach($selectedTags as $tag)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-pink-100 dark:bg-pink-900/30 text-pink-800 dark:text-pink-200 text-sm rounded-full">
                        #{{ $tag }}
                        <button wire:click="toggleTag('{{ $tag }}')" class="ml-1 text-pink-600 dark:text-pink-300 hover:text-pink-800 dark:hover:text-pink-100 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                    @endforeach

                    <button 
                        wire:click="clearFilters"
                        class="text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 underline cursor-pointer"
                    >
                        Clear all
                    </button>
                </div>
                @endif
            </div>

            {{-- Collapsible Filters Panel --}}
            @if($showFilters)
            <div class="mb-8">
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                    {{-- Popular Tags Section --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($this->popularTags as $tag)
                            <button 
                                wire:click="toggleTag('{{ $tag['name'] }}')"
                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-full transition-all duration-200 cursor-pointer {{ in_array($tag['name'], $selectedTags) ? 'bg-pink-100 dark:bg-pink-900/30 text-pink-800 dark:text-pink-200 ring-2 ring-pink-200 dark:ring-pink-700' : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600' }}"
                            >
                                <span class="w-2 h-2 rounded-full bg-{{ $tag['color'] }}-500"></span>
                                #{{ $tag['name'] }}
                                <span class="text-xs opacity-70">({{ $tag['count'] }})</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        {{-- Categories --}}
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Categories</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedCategory" 
                                        value=""
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">All Categories</span>
                                </label>
                                @foreach($this->categories as $category)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedCategory" 
                                        value="{{ $category['id'] }}"
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ $category['name'] }}</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">({{ $category['count'] }})</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Skill Level --}}
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Skill Level</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedLevel" 
                                        value=""
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">All Levels</span>
                                </label>
                                @foreach($this->levels as $level)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedLevel" 
                                        value="{{ $level['id'] }}"
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <div class="flex flex-col">
                                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $level['name'] }}</span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">{{ $level['description'] }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Duration</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedDuration" 
                                        value=""
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">Any Duration</span>
                                </label>
                                @foreach($this->durations as $duration)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedDuration" 
                                        value="{{ $duration['id'] }}"
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ $duration['name'] }}</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">({{ $duration['count'] }})</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Instructors --}}
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Instructors</h3>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedInstructor" 
                                        value=""
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <span class="text-sm text-slate-700 dark:text-slate-300">All Instructors</span>
                                </label>
                                @foreach($this->instructors as $instructor)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input 
                                        type="radio" 
                                        wire:model.live="selectedInstructor" 
                                        value="{{ $instructor['id'] }}"
                                        class="w-4 h-4 text-red-600 bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 focus:ring-red-500 dark:focus:ring-red-400"
                                    >
                                    <img src="{{ $instructor['avatar'] }}" alt="{{ $instructor['name'] }}" class="w-5 h-5 rounded-full">
                                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ $instructor['name'] }}</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">({{ $instructor['count'] }})</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Learning Paths Section --}}
            @if($activeTab === 'pathways')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($this->pathways as $pathway)
                <a href="{{ $pathway['url'] }}" class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-700 hover:-translate-y-1 cursor-pointer block">
                    {{-- Pathway Header --}}
                    <div class="relative">
                        <div class="aspect-[16/9] bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 relative overflow-hidden">
                            <img src="{{ $pathway['thumbnail'] }}" alt="{{ $pathway['title'] }}" class="w-full h-full object-cover mix-blend-overlay">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                            
                            {{-- Pathway Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 dark:bg-slate-800/90 text-slate-900 dark:text-white text-xs font-bold rounded-full backdrop-blur-sm">
                                    LEARNING PATH
                                </span>
                            </div>

                            {{-- Progress (if any) --}}
                            @if($pathway['progress'] > 0)
                            <div class="absolute top-4 right-4">
                                <div class="w-12 h-12 relative">
                                    <svg class="w-12 h-12 transform -rotate-90" viewBox="0 0 36 36">
                                        <path class="text-white/20" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                        <path class="text-green-400" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="{{ $pathway['progress'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-bold text-white">{{ $pathway['progress'] }}%</span>
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{-- Play Button --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 scale-75 group-hover:scale-100">
                                    <svg class="w-7 h-7 text-red-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pathway Content --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                            {{ $pathway['title'] }}
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">
                            {{ $pathway['description'] }}
                        </p>

                        {{-- Pathway Stats --}}
                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $pathway['duration'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <span>{{ $pathway['lessons'] }} lessons</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                <span>{{ number_format($pathway['students']) }} students</span>
                            </div>
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                <span class="capitalize">{{ $pathway['level'] }}</span>
                            </div>
                        </div>

                        {{-- Instructor & Category --}}
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded text-xs font-medium text-slate-700 dark:text-slate-300">
                                    {{ ucfirst($pathway['category']) }}
                                </span>
                            </div>
                            <span class="text-sm text-slate-600 dark:text-slate-400">{{ $pathway['instructor'] }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @elseif($activeTab === 'watchlist')
            {{-- Watchlist Section --}}
            @if(count($this->watchlistItems) > 0)
            <div class="space-y-6">
                {{-- Watchlist Header --}}
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                            My Watchlist
                            <span class="text-lg text-slate-500 dark:text-slate-400">({{ $this->watchlistCount }})</span>
                        </h2>
                        <p class="text-slate-600 dark:text-slate-400 mt-1">Content you've saved to watch later</p>
                    </div>
                    @if(count($this->watchlistItems) > 0)
                    <button 
                        wire:click="clearWatchlist"
                        wire:confirm="Are you sure you want to clear your entire watchlist?"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors text-sm font-medium cursor-pointer"
                    >
                        Clear All
                    </button>
                    @endif
                </div>

                {{-- Watchlist Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($this->watchlistItems as $content)
                    <div class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-700 relative">
                        {{-- Remove from watchlist button --}}
                        <button 
                            wire:click="removeFromWatchlist({{ $content['id'] }}, '{{ $content['type'] ?? 'auto' }}')"
                            class="absolute top-2 right-2 z-10 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200 cursor-pointer"
                            title="Remove from watchlist"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        
                        {{-- Content Link --}}
                        <a href="{{ $content['url'] }}" class="block cursor-pointer">
                            {{-- Content Thumbnail --}}
                            <div class="aspect-video bg-slate-100 dark:bg-slate-700 relative overflow-hidden">
                                <img src="{{ $content['thumbnail'] }}" alt="{{ $content['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                
                                {{-- Content Type Badge --}}
                                <div class="absolute top-2 left-2">
                                    <span class="px-2 py-1 bg-black/70 text-white text-xs font-bold rounded uppercase tracking-wide">
                                        {{ ($content['type'] ?? 'content') === 'lesson' ? 'Lesson' : ucfirst($content['type'] ?? 'content') }}
                                    </span>
                                </div>

                                {{-- Duration/Episodes --}}
                                <div class="absolute bottom-2 right-2">
                                    <span class="px-2 py-1 bg-black/70 text-white text-xs font-medium rounded">
                                        @if(($content['type'] ?? '') === 'series')
                                            {{ $content['episodes'] ?? 0 }} episodes
                                        @else
                                            {{ $content['duration'] ?? 'N/A' }}
                                        @endif
                                    </span>
                                </div>

                                {{-- Play Button --}}
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                    <div class="w-12 h-12 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 scale-90 group-hover:scale-100">
                                        <svg class="w-5 h-5 text-purple-600 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Content Info --}}
                            <div class="p-4">
                                <h3 class="font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                    {{ $content['title'] }}
                                </h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                    {{ $content['description'] }}
                                </p>
                                
                                {{-- Meta Info --}}
                                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-3">
                                    <span class="capitalize">{{ $content['level'] ?? 'All levels' }}</span>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ number_format($content['views'] ?? rand(1000, 15000)) }}</span>
                                    </div>
                                </div>

                                {{-- Added Date --}}
                                <div class="pt-3 border-t border-slate-200 dark:border-slate-700">
                                    <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                        </svg>
                                        <span>Added {{ $content['added_to_watchlist'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            {{-- Empty Watchlist --}}
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-2">Your watchlist is empty</h3>
                <p class="text-slate-600 dark:text-slate-400 mb-6 max-w-md mx-auto">
                    Start adding series and lessons you want to watch later. Click the bookmark icon on any content to add it to your watchlist.
                </p>
                <button 
                    wire:click="setActiveTab('all')"
                    class="px-6 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors font-medium cursor-pointer"
                >
                    Browse Content
                </button>
            </div>
            @endif
            @else
            {{-- Regular Content (Series & Lessons) --}}
            @if($viewMode === 'grid')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($this->featuredContent as $content)
                <div class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-700 hover:-translate-y-1 relative">
                    {{-- Content Link --}}
                    <a href="{{ $content['url'] }}" class="block cursor-pointer">
                        {{-- Thumbnail --}}
                        <div class="aspect-video bg-slate-100 dark:bg-slate-700 relative overflow-hidden">
                            <img src="{{ $content['thumbnail'] }}" alt="{{ $content['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 scale-75 group-hover:scale-100">
                                    <svg class="w-6 h-6 text-red-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Badges --}}
                            <div class="absolute top-3 left-3 flex gap-2">
                                @if($content['type'] === 'series')
                                <span class="px-2 py-1 bg-red-600 text-white text-xs font-medium rounded-md">SERIES</span>
                                @endif
                                @if(isset($content['isNew']) && $content['isNew'])
                                <span class="px-2 py-1 bg-green-600 text-white text-xs font-medium rounded-md">NEW</span>
                                @endif
                                @if(isset($content['isPopular']) && $content['isPopular'])
                                <span class="px-2 py-1 bg-orange-600 text-white text-xs font-medium rounded-md">POPULAR</span>
                                @endif
                            </div>

                            {{-- Duration & Rating --}}
                            <div class="absolute bottom-3 right-3 flex gap-2">
                                @if(isset($content['rating']))
                                <span class="px-2 py-1 bg-black/70 text-white text-xs font-medium rounded flex items-center gap-1">
                                    <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    {{ $content['rating'] }}
                                </span>
                                @endif
                                <span class="px-2 py-1 bg-black/70 text-white text-xs font-medium rounded">
                                    {{ $content['duration'] }}
                                </span>
                            </div>

                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <h3 class="font-semibold text-slate-900 dark:text-white mb-2 line-clamp-2 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                {{ $content['title'] }}
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">
                                {{ $content['description'] }}
                            </p>

                            {{-- Meta Info --}}
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">
                                            {{ ucfirst($content['category']) }}
                                        </span>
                                        <span class="capitalize">{{ $content['level'] }}</span>
                                    </div>
                                    @if($content['type'] === 'series' && isset($content['episodes']))
                                    <span>{{ $content['episodes'] }} episodes</span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
                                    <span>{{ $content['instructor'] }}</span>
                                    @if(isset($content['views']))
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ number_format($content['views']) }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>

                    {{-- Watchlist Actions (Outside the link) - Only for authenticated users --}}
                    @auth
                    <div class="absolute top-3 right-3">
                        <span 
                            wire:click="toggleWatchlist({{ $content['id'] }}, '{{ $content['type'] ?? 'auto' }}')"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer z-20 {{ $this->isInWatchlist($content['id'], $content['type'] ?? 'auto') ? 'bg-purple-500 text-white' : 'bg-black/50 hover:bg-black/70 text-white' }}"
                            title="{{ $this->isInWatchlist($content['id'], $content['type'] ?? 'auto') ? 'Remove from watchlist' : 'Add to watchlist' }}"
                        >
                            @if($this->isInWatchlist($content['id'], $content['type'] ?? 'auto'))
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            @endif
                        </span>
                    </div>
                    @endauth
                </div>
                @endforeach
            </div>
            @else
            {{-- List View --}}
            <div class="space-y-4">
                @foreach($this->featuredContent as $content)
                <div class="group bg-white dark:bg-slate-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-slate-200 dark:border-slate-700 p-4 relative">
                    {{-- Content Link --}}
                    <a href="{{ $content['url'] }}" class="block cursor-pointer">
                        <div class="flex gap-4">
                            {{-- Thumbnail --}}
                            <div class="w-40 h-24 bg-slate-100 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0 relative">
                                <img src="{{ $content['thumbnail'] }}" alt="{{ $content['title'] }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                    <div class="w-8 h-8 bg-white/90 dark:bg-slate-800/90 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <svg class="w-4 h-4 text-red-600 ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute bottom-1 right-1">
                                    <span class="px-1.5 py-0.5 bg-black/70 text-white text-xs font-medium rounded">
                                        {{ $content['duration'] }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0 pr-12">
                                <h3 class="font-semibold text-slate-900 dark:text-white mb-1 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                    {{ $content['title'] }}
                                </h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-3 line-clamp-2">
                                    {{ $content['description'] }}
                                </p>
                                <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                                    <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">{{ ucfirst($content['category']) }}</span>
                                    <span class="capitalize">{{ $content['level'] }}</span>
                                    <span>{{ $content['instructor'] }}</span>
                                    @if($content['type'] === 'series' && isset($content['episodes']))
                                    <span>{{ $content['episodes'] }} episodes</span>
                                    @endif
                                    @if(isset($content['views']))
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>{{ number_format($content['views']) }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    {{-- Watchlist Button (Outside link) - Only for authenticated users --}}
                    @auth
                    <div class="absolute top-4 right-4">
                        <span 
                            wire:click="toggleWatchlist({{ $content['id'] }}, '{{ $content['type'] ?? 'auto' }}')"
                            class="w-8 h-8 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer z-10 {{ $this->isInWatchlist($content['id'], $content['type'] ?? 'auto') ? 'bg-purple-500 text-white' : 'bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-400' }}"
                            title="{{ $this->isInWatchlist($content['id'], $content['type'] ?? 'auto') ? 'Remove from watchlist' : 'Add to watchlist' }}"
                        >
                            @if($this->isInWatchlist($content['id'], $content['type'] ?? 'auto'))
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            @endif
                        </span>
                    </div>
                    @endauth
                </div>
                @endforeach
            </div>
            @endif
            @endif

            {{-- Loading State --}}
            <div wire:loading class="flex items-center justify-center py-12">
                <div class="flex items-center gap-3 text-slate-600 dark:text-slate-400">
                    <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Loading content...</span>
                </div>
            </div>

            {{-- Empty State --}}
            @if(empty($this->featuredContent) && empty($this->pathways) && !$this->hasActiveFilters)
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 011 1v1a1 1 0 01-1 1h-1v11a3 3 0 01-3 3H7a3 3 0 01-3-3V7H3a1 1 0 01-1-1V5a1 1 0 011-1h4z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No content yet</h3>
                <p class="text-slate-600 dark:text-slate-400">We're working on adding amazing content. Check back soon!</p>
            </div>
            @endif

            {{-- No Results --}}
            @if((empty($this->featuredContent) && $activeTab !== 'pathways' && $activeTab !== 'watchlist') || (empty($this->pathways) && $activeTab === 'pathways') && $this->hasActiveFilters)
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No results found</h3>
                <p class="text-slate-600 dark:text-slate-400 mb-4">Try adjusting your search or filter criteria</p>
                <button 
                    wire:click="clearFilters"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors cursor-pointer"
                >
                    Clear all filters
                </button>
            </div>
            @endif
        </div>
    </main>
</div>

{{-- JavaScript for Watchlist Notifications --}}
@script
<script>
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = event.target.closest('.sort-dropdown');
        if (!dropdown && $wire.get('showSortDropdown')) {
            $wire.set('showSortDropdown', false);
        }
    });

    // Listen for watchlist updates
    $wire.on('watchlist-updated', (...args) => {
        console.log('Event args:', args); // Debug için
        
        // Livewire v3 named parameters are passed as separate arguments
        let type = 'unknown';
        let message = 'Watchlist updated';
        
        if (args.length >= 2) {
            type = args[0];
            message = args[1];
        } else if (args.length === 1 && typeof args[0] === 'object') {
            // Fallback for array format
            const data = args[0];
            type = data.type || 'unknown';
            message = data.message || 'Watchlist updated';
        }
        
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full opacity-0`;
        
        // Set colors based on type
        if (type === 'added') {
            toast.className += ' bg-green-500 text-white';
        } else if (type === 'removed') {
            toast.className += ' bg-red-500 text-white';
        } else if (type === 'cleared') {
            toast.className += ' bg-orange-500 text-white';
        }
        
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.classList.remove('translate-x-full', 'opacity-0');
        }, 100);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    });
</script>
@endscript

