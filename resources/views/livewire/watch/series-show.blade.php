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
            @if($series->thumbnail)
            <div class="absolute inset-0 opacity-20">
                <img src="{{ $series->thumbnail }}" alt="{{ $series->title }}" class="w-full h-full object-cover">
            </div>
            @endif

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    {{-- Left Content --}}
                    <div class="text-white">
                        {{-- Category Badge --}}
                        @if($series->category)
                        <div class="inline-flex items-center px-3 py-1 bg-red-600/20 backdrop-blur-sm text-red-400 rounded-full text-sm font-medium mb-4 border border-red-500/30">
                            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                            {{ $series->category->name }}
                        </div>
                        @endif

                        {{-- Title --}}
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                            {{ $series->title }}
                        </h1>

                        {{-- Description --}}
                        @if($series->description)
                        <p class="text-lg text-slate-300 mb-6 leading-relaxed">
                            {{ $series->description }}
                        </p>
                        @endif

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-6 text-sm text-slate-400 mb-8">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ number_format($series->views_count) }} views
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                                {{ $series->episodes_count }} {{ Str::plural('episode', $series->episodes_count) }}
                            </div>

                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $series->formatted_duration }}
                            </div>

                            <span class="px-3 py-1 bg-slate-700/50 rounded-full text-xs font-medium capitalize">
                                {{ $series->level }}
                            </span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-4">
                            {{-- Start Watching Button --}}
                            @if($currentEpisode)
                            <a href="{{ route('watch.episode.show', [$series->slug, $currentEpisode->slug]) }}" 
                               class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-semibold transition-all duration-200 shadow-lg hover:shadow-xl cursor-pointer">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                                @if($this->userProgress > 0)
                                    Continue Watching
                                @else
                                    Start Watching
                                @endif
                            </a>
                            @endif

                            {{-- Watchlist Button --}}
                            @auth
                            <button
                                wire:click="toggleWatchlist"
                                class="inline-flex items-center px-4 py-3 {{ $this->isInWatchlist ? 'bg-purple-600/20 text-purple-400 border-purple-500' : 'bg-slate-700/50 text-slate-300 border-slate-600 hover:bg-slate-600/50' }} border rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer"
                                title="{{ $this->isInWatchlist ? 'Remove from watchlist' : 'Add to watchlist' }}"
                            >
                                <svg class="w-5 h-5 mr-2" fill="{{ $this->isInWatchlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                                {{ $this->isInWatchlist ? 'In Watchlist' : 'Add to Watchlist' }}
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
                                <div class="bg-red-500 h-2 rounded-full transition-all duration-300"
                                     style="width: {{ $this->userProgress }}%"></div>
                            </div>
                        </div>
                        @endif
                        @endauth
                    </div>

                    {{-- Right Content - Series Visual --}}
                    <div class="lg:order-last">
                        <div class="relative aspect-video bg-gradient-to-br from-slate-800 via-slate-700 to-slate-800 rounded-xl overflow-hidden shadow-2xl">
                            @if($series->trailer_vimeo_id)
                                {{-- Trailer Embed --}}
                                <iframe
                                    src="https://player.vimeo.com/video/{{ $series->trailer_vimeo_id }}?h=0&title=0&byline=0&portrait=0&color=ef4444&autoplay=0&loop=0&muted=0&pip=1&responsive=1"
                                    class="absolute inset-0 w-full h-full"
                                    frameborder="0"
                                    allow="autoplay; fullscreen; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            @elseif($series->thumbnail)
                                {{-- Series Thumbnail with Overlay --}}
                                <img src="{{ $series->thumbnail }}" alt="{{ $series->title }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute inset-0 flex items-center justify-center bg-black/20 hover:bg-black/40 transition-colors">
                                    <div class="text-center text-white">
                                        <div class="w-16 h-16 bg-red-600/90 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 cursor-pointer hover:bg-red-700 transition-colors">
                                            <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Dynamic Visual Placeholder --}}
                                <div class="absolute inset-0 overflow-hidden">
                                    {{-- Background Pattern --}}
                                    <div class="absolute inset-0 opacity-10">
                                        <div class="absolute top-4 left-4 w-8 h-8 bg-red-500 rounded-full animate-pulse"></div>
                                        <div class="absolute top-12 right-8 w-6 h-6 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 0.5s"></div>
                                        <div class="absolute bottom-8 left-12 w-4 h-4 bg-green-500 rounded-full animate-pulse" style="animation-delay: 1s"></div>
                                        <div class="absolute bottom-16 right-6 w-5 h-5 bg-purple-500 rounded-full animate-pulse" style="animation-delay: 1.5s"></div>
                                    </div>
                                    
                                    {{-- Center Content --}}
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center text-slate-300">
                                            {{-- Dynamic Icon based on category --}}
                                            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                                @if($series->category && str_contains(strtolower($series->category->name), 'api'))
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                @elseif($series->category && (str_contains(strtolower($series->category->name), 'design') || str_contains(strtolower($series->category->name), 'ui')))
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                    </svg>
                                                @elseif($series->category && str_contains(strtolower($series->category->name), 'database'))
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                                                        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                                                        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            {{-- Series Info --}}
                                            <h3 class="text-lg font-semibold mb-2">{{ $series->episodes_count }} Episodes</h3>
                                            <p class="text-sm opacity-75">{{ $series->formatted_duration }} of content</p>
                                            
                                            {{-- Visual Elements --}}
                                            <div class="flex justify-center gap-2 mt-4">
                                                @for($i = 0; $i < min($series->episodes_count, 5); $i++)
                                                <div class="w-2 h-2 bg-red-500 rounded-full opacity-60"></div>
                                                @endfor
                                                @if($series->episodes_count > 5)
                                                <div class="text-xs opacity-50">+{{ $series->episodes_count - 5 }}</div>
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

                        {{-- Episode List --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
                            <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                            </svg>
                                        </div>
                                        Episodes
                                    </h2>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $series->episodes_count }} {{ Str::plural('episode', $series->episodes_count) }}
                                    </span>
                                </div>
                            </div>

                            <div class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($series->episodes as $episode)
                                <a href="{{ route('watch.episode.show', [$series->slug, $episode->slug]) }}" class="group block p-6 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors cursor-pointer">
                                    <div class="flex gap-4">
                                        {{-- Episode Thumbnail --}}
                                        <div class="relative w-32 h-20 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0">
                                            @if($episode->thumbnail)
                                            <img src="{{ $episode->thumbnail }}" alt="{{ $episode->title }}" class="w-full h-full object-cover">
                                            @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800">
                                                <svg class="w-8 h-8 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                </svg>
                                            </div>
                                            @endif

                                            {{-- Duration Overlay --}}
                                            <div class="absolute bottom-1 right-1 bg-black/80 text-white text-xs px-2 py-1 rounded">
                                                {{ $episode->formatted_duration }}
                                            </div>

                                            {{-- Progress Overlay --}}
                                            @auth
                                            @php
                                                $episodeProgress = $this->episodeProgress[$episode->id] ?? 0;
                                            @endphp
                                            @if($episodeProgress > 0)
                                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/30">
                                                <div class="h-full bg-red-500 transition-all duration-300"
                                                     style="width: {{ $episodeProgress }}%"></div>
                                            </div>
                                            @endif
                                            @endauth

                                            {{-- Play Icon Overlay --}}
                                            <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 hover:opacity-100 transition-opacity">
                                                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Episode Info --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between mb-2">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex items-center justify-center w-8 h-8 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-full text-sm font-semibold">
                                                        {{ $episode->episode_number }}
                                                    </span>
                                                    <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 text-lg leading-tight transition-colors">
                                                        {{ $episode->title }}
                                                    </h3>
                                                </div>

                                                {{-- Episode Status Indicators --}}
                                                <div class="flex items-center gap-2 ml-4">
                                                    @auth
                                                    @php
                                                        $episodeProgress = $this->episodeProgress[$episode->id] ?? 0;
                                                    @endphp
                                                    @if($episodeProgress >= 100)
                                                    <div class="flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                        Completed
                                                    </div>
                                                    @elseif($episodeProgress > 0)
                                                    <div class="flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $episodeProgress }}%
                                                    </div>
                                                    @endif
                                                    @endauth

                                                    @if($episode->is_free)
                                                    <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-xs font-medium">
                                                        Free
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- Episode Description --}}
                                            @if($episode->description)
                                            <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2 mb-3">
                                                {{ $episode->description }}
                                            </p>
                                            @endif

                                            {{-- Episode Meta --}}
                                            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-500">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ number_format($episode->views_count) }} views
                                                </div>

                                                <div class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $episode->published_at->diffForHumans() }}
                                                </div>

                                                <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-xs font-medium capitalize">
                                                    {{ $episode->level }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Series Description --}}
                        @if($series->excerpt || $series->description)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">
                            <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-3">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-1H8v1a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v4H7V5zm2 6H7v2h2v-2zm2-6h2v4h-2V5zm2 6h-2v2h2v-2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    About This Series
                                </h3>
                            </div>
                            
                            <div class="p-6">
                                <div class="prose prose-slate dark:prose-invert max-w-none">
                                    @if($series->excerpt)
                                        <p class="text-lg text-slate-700 dark:text-slate-300 mb-4">{{ $series->excerpt }}</p>
                                    @endif
                                    @if($series->description && $series->description !== $series->excerpt)
                                        <div class="text-slate-600 dark:text-slate-400">
                                            {!! nl2br(e($series->description)) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                    {{-- Sidebar --}}
                    <div class="xl:col-span-1">
                        {{-- Series Stats --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    Series Stats
                                </h3>
                            </div>
                            
                            <div class="p-5 space-y-4">
                                {{-- Total Episodes --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Episodes</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $series->episodes_count }}</div>
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
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $series->formatted_duration }}</div>
                                    </div>
                                </div>

                                {{-- Views --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Views</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ number_format($series->views_count) }}</div>
                                    </div>
                                </div>

                                {{-- Level --}}
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br {{ $series->level === 'beginner' ? 'from-green-400 to-green-600' : ($series->level === 'intermediate' ? 'from-yellow-400 to-orange-500' : 'from-red-400 to-red-600') }} rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            @if($series->level === 'beginner')
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                            @elseif($series->level === 'intermediate')
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                                            @else
                                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Level</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white capitalize">{{ $series->level }}</div>
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
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $series->published_at->format('M j, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Instructor Info --}}
                        @if($series->user)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-6">
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Instructor
                                </h3>
                            </div>
                            
                            <div class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ substr($series->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white">{{ $series->user->name }}</p>
                                        <p class="text-sm text-slate-600 dark:text-slate-400">Series Creator</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Tags --}}
                        @if($series->tags->isNotEmpty())
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
                                    @foreach($series->tags as $tag)
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

    {{-- JavaScript for Episode Selection --}}
    @script
    <script>
    // Episode changed event (for future use)
    $wire.on('episode-changed', (...args) => {
        console.log('Episode changed:', args);
        // Add any episode selection logic here if needed
    });
    </script>
    @endscript
</div>