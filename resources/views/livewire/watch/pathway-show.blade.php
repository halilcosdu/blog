<div>
    {{-- Header --}}
    <x-shared.header current-page="watch" />

    <x-shared.announcements />

    {{-- Main Content --}}
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        {{-- Hero Section --}}
        <section class="relative overflow-hidden">
            {{-- Background with gradient overlay --}}
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>
            
            {{-- Optional background image --}}
            @if($pathway->thumbnail)
            <div class="absolute inset-0 opacity-20">
                <img src="{{ $pathway->thumbnail }}" alt="{{ $pathway->title }}" class="w-full h-full object-cover">
            </div>
            @endif

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    {{-- Left Content --}}
                    <div class="text-white">
                        {{-- Category Badge --}}
                        @if($pathway->category)
                        <div class="inline-flex items-center px-3 py-1 bg-purple-600/20 backdrop-blur-sm text-purple-400 rounded-full text-sm font-medium mb-4 border border-purple-500/30">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                            {{ $pathway->category->name }}
                        </div>
                        @endif

                        {{-- Pathway Badge --}}
                        <div class="inline-flex items-center px-3 py-1 bg-indigo-600/20 backdrop-blur-sm text-indigo-400 rounded-full text-sm font-medium mb-4 border border-indigo-500/30 ml-2">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            Learning Pathway
                        </div>

                        {{-- Title --}}
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                            {{ $pathway->title }}
                        </h1>

                        {{-- Description --}}
                        @if($pathway->description)
                        <p class="text-lg text-slate-300 mb-6 leading-relaxed">
                            {{ $pathway->description }}
                        </p>
                        @endif

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-6 text-sm text-slate-400 mb-8">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ count($this->pathwayItems) }} {{ Str::plural('item', count($this->pathwayItems)) }}
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $pathway->formatted_duration }}
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                </svg>
                                {{ number_format($pathway->students_count) }} students
                            </div>

                            <span class="px-3 py-1 bg-slate-700/50 rounded-full text-xs font-medium capitalize">
                                {{ $pathway->level }}
                            </span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            {{-- Start Learning Button --}}
                            @if($this->nextIncompleteItem)
                            @php
                                $nextItem = $this->nextIncompleteItem;
                            @endphp
                            <a href="{{ $nextItem['url'] }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-200 shadow-lg hover:shadow-xl cursor-pointer w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                @if($this->userProgress > 0)
                                    Continue Learning
                                @else
                                    Start Learning
                                @endif
                            </a>
                            @endif

                            {{-- Watchlist Button --}}
                            @auth
                            <button
                                wire:click="toggleWatchlist"
                                class="inline-flex items-center justify-center px-4 py-3 {{ $this->isInWatchlist ? 'bg-purple-600/20 text-purple-400 border-purple-500' : 'bg-slate-700/50 text-slate-300 border-slate-600 hover:bg-slate-600/50' }} border rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer w-full sm:w-auto"
                                title="{{ $this->isInWatchlist ? 'Remove from watchlist' : 'Add to watchlist' }}"
                            >
                                <svg class="w-5 h-5 mr-2" fill="{{ $this->isInWatchlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                <span class="sm:inline">{{ $this->isInWatchlist ? 'In Watchlist' : 'Add to Watchlist' }}</span>
                            </button>
                            @endauth
                        </div>

                        {{-- Progress Bar for authenticated users --}}
                        @auth
                        @if($this->userProgress > 0)
                        <div class="mt-6">
                            <div class="flex items-center justify-between text-sm text-slate-400 mb-2">
                                <span>Your Progress</span>
                                <span>{{ $this->userProgress }}%</span>
                            </div>
                            <div class="w-full bg-slate-700/50 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full transition-all duration-300"
                                     style="width: {{ $this->userProgress }}%"></div>
                            </div>
                        </div>
                        @endif
                        @endauth
                    </div>

                    {{-- Right Content - Pathway Visual --}}
                    <div class="lg:order-last">
                        <div class="relative aspect-video bg-gradient-to-br from-slate-800 via-slate-700 to-slate-800 rounded-xl overflow-hidden shadow-2xl">
                            @if($pathway->thumbnail)
                                {{-- Pathway Thumbnail with Overlay --}}
                                <img src="{{ $pathway->thumbnail }}" alt="{{ $pathway->title }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 hover:bg-black/40 transition-colors">
                                    <div class="text-center text-white">
                                        <div class="w-16 h-16 bg-indigo-600/90 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 cursor-pointer hover:bg-indigo-700 transition-colors">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Dynamic Visual Placeholder --}}
                                <div class="absolute inset-0 overflow-hidden">
                                    {{-- Background Pattern --}}
                                    <div class="absolute inset-0 opacity-10">
                                        <div class="absolute top-4 left-4 w-8 h-8 bg-indigo-500 rounded-full animate-pulse"></div>
                                        <div class="absolute top-12 right-8 w-6 h-6 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 0.5s"></div>
                                        <div class="absolute bottom-8 left-12 w-4 h-4 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 1s"></div>
                                        <div class="absolute bottom-16 right-6 w-5 h-5 bg-teal-500 rounded-full animate-pulse" style="animation-delay: 1.5s"></div>
                                    </div>
                                    
                                    {{-- Center Content --}}
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center text-slate-300">
                                            {{-- Pathway Icon --}}
                                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            
                                            {{-- Pathway Info --}}
                                            <h3 class="text-lg font-semibold mb-2">{{ count($this->pathwayItems) }} Learning Items</h3>
                                            <p class="text-sm opacity-75">{{ $pathway->formatted_duration }} of content</p>
                                            
                                            {{-- Visual Elements --}}
                                            <div class="flex justify-center gap-2 mt-4">
                                                @for($i = 0; $i < min(count($this->pathwayItems), 5); $i++)
                                                <div class="w-2 h-2 bg-indigo-500 rounded-full opacity-60"></div>
                                                @endfor
                                                @if(count($this->pathwayItems) > 5)
                                                <div class="text-xs opacity-50">+{{ count($this->pathwayItems) - 5 }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

                    {{-- Main Content --}}
                    <div class="xl:col-span-3">

                        {{-- Pathway Content List --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
                            <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                        <div class="w-6 h-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        Learning Content
                                    </h2>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ count($this->pathwayItems) }} {{ Str::plural('item', count($this->pathwayItems)) }}
                                    </span>
                                </div>
                            </div>

                            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($this->pathwayItems as $item)
                                <a href="{{ $item['url'] }}" class="group block p-4 md:p-6 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        {{-- Item Thumbnail --}}
                                        <div class="relative w-full sm:w-32 h-32 sm:h-20 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0">
                                            @if($item['thumbnail'])
                                            <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                            @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800">
                                                @if($item['type'] === 'series')
                                                <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                                </svg>
                                                @else
                                                <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                </svg>
                                                @endif
                                            </div>
                                            @endif

                                            {{-- Duration Overlay --}}
                                            <div class="absolute bottom-1 right-1 bg-black/80 text-white text-xs px-2 py-1 rounded">
                                                {{ $item['duration'] }}
                                            </div>

                                            {{-- Progress Overlay --}}
                                            @auth
                                            @if($item['progress'] > 0)
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/30">
                                                <div class="h-full bg-indigo-500 transition-all duration-300"
                                                     style="width: {{ $item['progress'] }}%"></div>
                                            </div>
                                            @endif
                                            @endauth

                                            {{-- Type Badge --}}
                                            <div class="absolute top-1 left-1 px-2 py-1 bg-black/80 text-white text-xs rounded capitalize">
                                                {{ $item['type'] }}
                                            </div>
                                        </div>

                                        {{-- Item Info --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-2">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex items-center justify-center w-8 h-8 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-full text-sm font-semibold flex-shrink-0">
                                                        {{ $item['sort_order'] }}
                                                    </span>
                                                    <div class="min-w-0">
                                                        <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 text-lg leading-tight transition-colors mb-1">
                                                            {{ $item['title'] }}
                                                        </h3>
                                                        @if($item['series_title'])
                                                        <p class="text-sm text-slate-500 dark:text-slate-400">
                                                            From: {{ $item['series_title'] }}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- Item Status Indicators --}}
                                                <div class="flex flex-wrap items-center gap-2 sm:ml-4">
                                                    @if($item['is_required'])
                                                    <div class="flex items-center gap-1 px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Required
                                                    </div>
                                                    @endif

                                                    @auth
                                                    @if($item['progress'] >= 100)
                                                    <div class="flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Completed
                                                    </div>
                                                    @elseif($item['progress'] > 0)
                                                    <div class="flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $item['progress'] }}%
                                                    </div>
                                                    @endif
                                                    @endauth
                                                </div>
                                            </div>

                                            {{-- Item Description --}}
                                            @if($item['description'])
                                            <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 mb-3">
                                                {{ $item['description'] }}
                                            </p>
                                            @endif

                                            {{-- Item Meta --}}
                                            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-slate-500">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $item['duration'] }}
                                                </div>

                                                <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-xs font-medium capitalize">
                                                    {{ $item['level'] }}
                                                </span>

                                                @if($item['category'])
                                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-medium">
                                                    {{ $item['category'] }}
                                                </span>
                                                @endif

                                                @if($item['instructor'])
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $item['instructor'] }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Pathway Description --}}
                        @if($pathway->description)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
                            <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-1H8v1a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v4H7V5zm2 6H7v2h2v-2zm2-6h2v4h-2V5zm2 6h-2v2h2v-2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    About This Pathway
                                </h3>
                            </div>
                            
                            <div class="p-6">
                                <div class="prose prose-slate dark:prose-invert max-w-none">
                                    <div class="text-slate-600 dark:text-slate-400">
                                        {!! nl2br(e($pathway->description)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                    {{-- Sidebar --}}
                    <div class="xl:col-span-1">
                        {{-- Pathway Stats --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    Pathway Stats
                                </h3>
                            </div>
                            
                            <div class="p-5 space-y-4">
                                {{-- Total Items --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Total Items</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ count($this->pathwayItems) }}</div>
                                    </div>
                                </div>

                                {{-- Total Duration --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Duration</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $pathway->formatted_duration }}</div>
                                    </div>
                                </div>

                                {{-- Students Count --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Students</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ number_format($pathway->students_count) }}</div>
                                    </div>
                                </div>

                                {{-- Level --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br {{ $pathway->level === 'beginner' ? 'from-green-400 to-green-600' : ($pathway->level === 'intermediate' ? 'from-yellow-400 to-orange-500' : 'from-red-400 to-red-600') }} rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            @if($pathway->level === 'beginner')
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                            @elseif($pathway->level === 'intermediate')
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                                            @else
                                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Level</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white capitalize">{{ $pathway->level }}</div>
                                    </div>
                                </div>

                                {{-- Published Date --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Published</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $pathway->published_at->format('M j, Y') }}</div>
                                    </div>
                                </div>

                                @auth
                                {{-- Your Progress --}}
                                @if($this->userProgress > 0)
                                <div class="border-t border-slate-200 dark:border-slate-700 pt-4">
                                    <div class="flex items-center gap-3 p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-xs text-indigo-600 dark:text-indigo-400 uppercase tracking-wide font-medium">Your Progress</div>
                                            <div class="text-lg font-bold text-indigo-700 dark:text-indigo-300">{{ $this->userProgress }}%</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>

                        {{-- Instructor Info --}}
                        @if($pathway->user)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Pathway Creator
                                </h3>
                            </div>
                            
                            <div class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ substr($pathway->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $pathway->user->name }}</p>
                                        <p class="text-sm text-slate-600 dark:text-slate-400">Learning Path Designer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Related Pathways --}}
                        @if(count($this->relatedPathways) > 0)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Related Pathways
                                </h3>
                            </div>
                            
                            <div class="p-4 space-y-3">
                                @foreach($this->relatedPathways as $relatedPathway)
                                <a href="{{ $relatedPathway['url'] }}" class="block group p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                    <div class="flex gap-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 text-sm line-clamp-2 transition-colors">
                                                {{ $relatedPathway['title'] }}
                                            </h4>
                                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-500 mt-1">
                                                <span>{{ $relatedPathway['items'] }} items</span>
                                                <span>•</span>
                                                <span>{{ $relatedPathway['duration'] }}</span>
                                                <span>•</span>
                                                <span class="capitalize">{{ $relatedPathway['level'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Tags --}}
                        @if($pathway->tags->isNotEmpty())
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Tags
                                </h3>
                            </div>
                            
                            <div class="p-5">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($pathway->tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 text-slate-700 dark:text-slate-300 rounded-full text-xs font-medium hover:from-slate-200 hover:to-slate-300 dark:hover:from-slate-600 dark:hover:to-slate-700 transition-all cursor-pointer border border-slate-200 dark:border-slate-600">
                                        <svg class="w-3 h-3 mr-1.5 text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $tag->name }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Notification Event Listeners --}}
    @script
    <script>
        // Listen for watchlist updates
        $wire.on('watchlist-updated', (event) => {
            const data = Array.isArray(event) ? event[0] : event;
            const type = data.type === 'added' ? 'success' : 'info';
            window.showNotification(type, data.message);
        });

        // Listen for auth required events  
        $wire.on('auth-required', (event) => {
            const data = Array.isArray(event) ? event[0] : event;
            window.showNotification('warning', data.message);
        });
    </script>
    @endscript
</div>