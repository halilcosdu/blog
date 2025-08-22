<div>
    {{-- Header --}}
    <x-shared.header current-page="watch" />

    <x-shared.announcements />

    {{-- Main Content --}}
    <div class="min-h-screen bg-slate-50 dark:bg-slate-950">

        {{-- Video and Related Section --}}
        <section class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">

                    {{-- Video Player --}}
                    <div class="xl:col-span-3">
                        {{-- Video Player Container - Matching bottom elements style --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden p-4">
                            <div class="relative aspect-video bg-black rounded-lg overflow-hidden">
                                @if($episode->vimeo_id)
                                    {{-- Vimeo Embed --}}
                                    <iframe
                                        src="https://player.vimeo.com/video/{{ $episode->vimeo_id }}?h=0&title=0&byline=0&portrait=0&color=ef4444&autoplay=0&loop=0&muted=0&pip=1&responsive=1"
                                        class="absolute inset-0 w-full h-full"
                                        frameborder="0"
                                        allow="autoplay; fullscreen; picture-in-picture"
                                        allowfullscreen
                                        data-lesson-id="{{ $episode->id }}"
                                        data-lesson-duration="{{ $episode->duration_minutes * 60 }}"
                                    ></iframe>
                                @else
                                    {{-- Placeholder if no video --}}
                                    <div class="absolute inset-0 flex items-center justify-center bg-slate-900">
                                        <div class="text-center text-white">
                                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                            </svg>
                                            <p class="text-lg opacity-75">Video coming soon</p>
                                        </div>
                                    </div>
                                @endif

                                {{-- Progress Bar --}}
                                @auth
                                <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/30">
                                    <div class="h-full bg-red-500 transition-all duration-300"
                                         style="width: {{ $this->userProgress }}%"></div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>

                    {{-- Related Lessons Sidebar --}}
                    <div class="xl:col-span-1">
                        @if(count($this->relatedLessons) > 0)
                        <div class="sticky top-24">
                            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                                <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                        <div class="w-5 h-5 bg-gradient-to-br from-red-500 to-orange-600 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                            </svg>
                                        </div>
                                        Up Next
                                    </h2>
                                </div>
                                <div class="overflow-y-auto" data-video-height-limit>
                                    <div class="p-2">
                                        @foreach($this->relatedLessons as $lesson)
                                        <a href="{{ $lesson['url'] }}" class="block group p-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                            <div class="flex gap-3">
                                                {{-- Thumbnail --}}
                                                <div class="relative w-24 h-16 bg-slate-200 dark:bg-slate-700 rounded-lg overflow-hidden flex-shrink-0">
                                                    @if($lesson['thumbnail'])
                                                    <img src="{{ $lesson['thumbnail'] }}" alt="{{ $lesson['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                                    @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800">
                                                        <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                                        </svg>
                                                    </div>
                                                    @endif

                                                    {{-- Duration Overlay --}}
                                                    <div class="absolute bottom-1 right-1 bg-black/80 text-white text-xs px-1.5 py-0.5 rounded">
                                                        {{ $lesson['duration'] }}
                                                    </div>
                                                </div>

                                                {{-- Content --}}
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="font-medium text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors text-sm leading-tight mb-1 line-clamp-2">
                                                        {{ $lesson['title'] }}
                                                    </h3>

                                                    <div class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-500 mb-1">
                                                        <div class="w-4 h-4 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white font-semibold text-xs">H</span>
                                                        </div>
                                                        <span>Halil Cosdu</span>
                                                    </div>

                                                    <div class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400">
                                                        <span>{{ number_format($lesson['views']) }} views</span>
                                                        <span>•</span>
                                                        <span class="capitalize">{{ $lesson['category'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Section --}}
        <section class="pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 xl:grid-cols-4 gap-4">

                    {{-- Main Content --}}
                    <div class="xl:col-span-3">

                        {{-- Lesson Header --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-5 mb-5">
                            {{-- Title and Meta --}}
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h1 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white mb-2">
                                        {{ $episode->title }}
                                    </h1>

                                    {{-- Meta Info --}}
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600 dark:text-slate-400">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $episode->formatted_duration }}
                                        </div>

                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ number_format($episode->views_count) }} views
                                        </div>

                                        <span class="px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-xs font-medium">
                                            {{ ucfirst($episode->level) }}
                                        </span>

                                        @if($episode->category)
                                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-xs font-medium">
                                            {{ $episode->category->name }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                @auth
                                <div class="flex items-center gap-2 ml-4">
                                    {{-- Watchlist Button --}}
                                    <button
                                        wire:click="toggleWatchlist"
                                        class="p-2 rounded-lg transition-colors {{ $this->isInWatchlist ? 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700' }}"
                                        title="{{ $this->isInWatchlist ? 'Remove from watchlist' : 'Add to watchlist' }}"
                                    >
                                        <svg class="w-4 h-4" fill="{{ $this->isInWatchlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                        </svg>
                                    </button>

                                    {{-- Mark Complete Button --}}
                                    @if($this->userProgress < 100)
                                    <button
                                        wire:click="markAsCompleted"
                                        class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-medium transition-colors"
                                    >
                                        Complete
                                    </button>
                                    @else
                                    <div class="px-3 py-1.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Done
                                    </div>
                                    @endif
                                </div>
                                @endauth
                            </div>

                            {{-- Progress Bar for authenticated users --}}
                            @auth
                            @if($this->userProgress > 0)
                            <div class="mb-4">
                                <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-400 mb-1">
                                    <span>Your Progress</span>
                                    <span>{{ $this->userProgress }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full transition-all duration-300"
                                         style="width: {{ $this->userProgress }}%"></div>
                                </div>
                            </div>
                            @endif
                            @endauth

                            {{-- Instructor Info --}}
                            @if($episode->user)
                            <div class="flex items-center gap-3 pt-3 border-t border-slate-200 dark:border-slate-700">
                                <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">
                                        {{ substr($episode->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900 dark:text-white text-sm">{{ $episode->user->name }}</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Instructor</p>
                                </div>
                            </div>
                            @endif
                        </div>


                        {{-- Comments Section --}}
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-5">
                            {{-- Comments Header --}}
                            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Discussion</h2>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">3 comments</span>
                                </div>
                            </div>

                            {{-- Comments Content --}}
                            <div class="p-6">

                            {{-- Add Comment Form --}}
                            @auth
                            <div class="mb-6 pb-6 border-b border-slate-200 dark:border-slate-700">
                                <div class="flex-1">
                                    <livewire:simple-markdown-editor 
                                        name="newComment"
                                        :value="$newComment"
                                        placeholder="Share your thoughts about this lesson... (Markdown supported)"
                                        :rows="4"
                                    />
                                    <div class="flex items-center justify-end mt-3">
                                        <button
                                            wire:click="postComment"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors"
                                        >
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="mb-6 pb-6 border-b border-slate-200 dark:border-slate-700">
                                <div class="text-center py-4 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <p class="text-slate-600 dark:text-slate-400 mb-3">Join the discussion</p>
                                    <a href="{{ route('filament.dashboard.auth.login') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        Login to Comment
                                    </a>
                                </div>
                            </div>
                            @endauth

                            {{-- Comments List --}}
                            <div class="space-y-6">
                                {{-- Sample Comment 1 --}}
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-semibold text-xs">J</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="font-medium text-slate-900 dark:text-white text-sm">John Doe</span>
                                            <span class="text-xs text-slate-500 dark:text-slate-400">2 hours ago</span>
                                        </div>
                                        <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                            <p>Great lesson! The **Livewire** integration examples were really helpful. I especially liked the part about <code>wire:model.live</code> vs regular <code>wire:model</code>.</p>
                                        </div>
                                        <div class="flex items-center gap-4 mt-3">
                                            <button class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                5
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sample Comment 2 --}}
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-green-600 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-semibold text-xs">S</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="font-medium text-slate-900 dark:text-white text-sm">Sarah Wilson</span>
                                            <span class="text-xs text-slate-500 dark:text-slate-400">5 hours ago</span>
                                        </div>
                                        <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                            <p>Could you make a follow-up video about Livewire with Alpine.js? I'm curious about the best practices for combining them.</p>
                                        </div>
                                        <div class="flex items-center gap-4 mt-3">
                                            <button class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                2
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sample Comment 3 with Reply --}}
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-semibold text-xs">M</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="font-medium text-slate-900 dark:text-white text-sm">Mike Chen</span>
                                            <span class="text-xs text-slate-500 dark:text-slate-400">1 day ago</span>
                                        </div>
                                        <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                            <p>Thanks for this tutorial! Quick question: how do you handle <strong>form validation</strong> in Livewire v3?</p>
                                        </div>
                                        <div class="flex items-center gap-4 mt-3">
                                            <button class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                8
                                            </button>
                                            <button class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                                Reply
                                            </button>
                                        </div>

                                        {{-- Reply --}}
                                        <div class="mt-4 ml-4 pl-4 border-l-2 border-slate-200 dark:border-slate-700">
                                            <div class="flex gap-3">
                                                <div class="w-6 h-6 bg-gradient-to-r from-red-600 to-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <span class="text-white font-semibold text-xs">H</span>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="font-medium text-slate-900 dark:text-white text-sm">Halil Cosdu</span>
                                                        <span class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 px-2 py-0.5 rounded-full text-xs font-medium">Author</span>
                                                        <span class="text-xs text-slate-500 dark:text-slate-400">1 day ago</span>
                                                    </div>
                                                    <div class="prose prose-sm prose-slate dark:prose-invert max-w-none">
                                                        <p>Great question! I use <code>$this->validate()</code> in Livewire v3. I'll cover this in detail in the next episode. Stay tuned! 🚀</p>
                                                    </div>
                                                    <div class="flex items-center gap-4 mt-3">
                                                        <button class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                            </svg>
                                                            12
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>

                    {{-- Stats Sidebar --}}
                    <div class="xl:col-span-1">
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                            <!-- Header with gradient -->
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    Lesson Details
                                </h3>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-5 space-y-4">
                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Views</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ number_format($episode->views_count) }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Duration</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $episode->formatted_duration }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br {{ $episode->level === 'beginner' ? 'from-green-400 to-green-600' : ($episode->level === 'intermediate' ? 'from-yellow-400 to-orange-500' : 'from-red-400 to-red-600') }} rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            @if($episode->level === 'beginner')
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                            @elseif($episode->level === 'intermediate')
                                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                                            @else
                                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Level</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white capitalize">
                                            {{ $episode->level }}
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">Published</div>
                                        <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $episode->published_at->format('M j, Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        @if($episode->description)
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mt-4">
                            <!-- Header with gradient -->
                            <div class="px-5 py-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 border-b border-slate-200 dark:border-slate-600">
                                <h3 class="text-base font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                    <div class="w-5 h-5 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-1H8v1a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v4H7V5zm2 6H7v2h2v-2zm2-6h2v4h-2V5zm2 6h-2v2h2v-2z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Description
                                </h3>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-5">
                                <div class="prose prose-sm prose-slate dark:prose-invert max-w-none text-sm">
                                    {!! nl2br(e($episode->description)) !!}
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Tags --}}
                        @if($episode->tags->isNotEmpty())
                        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mt-4">
                            <!-- Header with gradient -->
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
                            
                            <!-- Content -->
                            <div class="p-5">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($episode->tags as $tag)
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

    {{-- JavaScript for Video Progress Tracking --}}
    @script
    <script>
    // Vimeo Player Progress Tracking
    document.addEventListener('DOMContentLoaded', function() {
        const iframe = document.querySelector('iframe[data-lesson-id]');
        
        // Set Up Next sidebar height to match video player height
        function setUpNextHeight() {
            const videoContainer = document.querySelector('.aspect-video');
            const upNextContainer = document.querySelector('[data-video-height-limit]');
            
            if (videoContainer && upNextContainer) {
                const videoHeight = videoContainer.offsetHeight;
                // Subtract header height (4rem = 64px) from video height
                const maxHeight = Math.max(200, videoHeight - 64);
                upNextContainer.style.maxHeight = maxHeight + 'px';
            }
        }
        
        // Set height on load and resize
        setUpNextHeight();
        window.addEventListener('resize', setUpNextHeight);

        if (iframe && typeof Vimeo !== 'undefined') {
            const player = new Vimeo.Player(iframe);
            const lessonId = iframe.dataset.lessonId;
            const lessonDuration = parseInt(iframe.dataset.lessonDuration);

            let progressUpdateInterval;

            player.on('timeupdate', function(data) {
                const watchedSeconds = Math.floor(data.seconds);
                const totalSeconds = Math.floor(data.duration);

                // Update progress every 5 seconds
                if (watchedSeconds % 5 === 0) {
                    $wire.updateProgress(watchedSeconds, totalSeconds);
                }
            });

            player.on('ended', function() {
                $wire.markAsCompleted();
            });
        }
    });

    // Watchlist notifications
    $wire.on('watchlist-updated', (data) => {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg transition-all duration-300 ${
            data.type === 'added' ? 'bg-green-600' : 'bg-red-600'
        } text-white`;
        toast.textContent = data.message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    });

    // Lesson completion notification
    $wire.on('lesson-completed', (data) => {
        // Create celebration toast
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 z-50 px-6 py-4 bg-green-600 text-white rounded-lg shadow-lg';
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                ${data.message}
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 5000);
    });

    // Comment posted notification
    $wire.on('comment-posted', (data) => {
        // Create success toast
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 z-50 px-6 py-4 bg-blue-600 text-white rounded-lg shadow-lg';
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                </svg>
                ${data.message}
            </div>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    });
    </script>
    @endscript

    {{-- Vimeo Player API --}}
    <script src="https://player.vimeo.com/api/player.js"></script>

</div>
