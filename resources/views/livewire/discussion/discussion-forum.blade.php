<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    <x-shared.header current-page="discussion" />
    <x-shared.announcements />

    <!-- Main Content -->
    <main class="relative py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                    Discussion Forum
                </h1>
                <p class="mt-4 text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                    Ask questions, share knowledge, and connect with the community.
                </p>
            </div>

            <!-- Main Layout -->
            <div class="flex flex-col lg:flex-row lg:gap-8">
                <!-- Left Sidebar (Filters) -->
                <aside class="lg:w-1/4 mb-8 lg:mb-0">
                    <div class="sticky top-24 space-y-6">
                        <!-- New Discussion Button -->
                        @auth
                            <a href="{{ route('discussions.create') }}" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                                <span>New Discussion</span>
                            </a>
                        @else
                            <a href="/dashboard/login" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                <span>Login to Join Discussion</span>
                            </a>
                        @endauth

                        <!-- Filters Panel -->
                        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-5">
                            <!-- Search -->
                            <div class="relative mb-5">
                                <label for="forum-search" class="sr-only">Search forum</label>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="search" id="forum-search" placeholder="Search discussions..." class="block w-full pl-10 pr-4 py-2.5 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all">
                            </div>

                            <!-- Status Filters -->
                            <div>
                                <h4 class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3">Status</h4>
                                <ul class="space-y-2 text-sm">
                                    <li><button wire:click="$set('status', 'all')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all {{ $status === 'all' ? 'bg-green-100/50 dark:bg-green-900/20 text-green-700 dark:text-green-300 font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300' }}"><span>All Discussions</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">{{ $statusCounts['all'] }}</span></button></li>
                                    @auth
                                        <li><button wire:click="$set('status', 'mine')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all {{ $status === 'mine' ? 'bg-blue-100/50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300' }}"><span>My Discussions</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">{{ $statusCounts['mine'] }}</span></button></li>
                                        <li><button wire:click="$set('status', 'commented')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all {{ $status === 'commented' ? 'bg-purple-100/50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300 font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300' }}"><span>Commented</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">{{ $statusCounts['commented'] }}</span></button></li>
                                    @endauth
                                    <li><button wire:click="$set('status', 'resolved')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all {{ $status === 'resolved' ? 'bg-green-100/50 dark:bg-green-900/20 text-green-700 dark:text-green-300 font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300' }}"><span>Resolved</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">{{ $statusCounts['resolved'] }}</span></button></li>
                                    <li><button wire:click="$set('status', 'unresolved')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg cursor-pointer transition-all {{ $status === 'unresolved' ? 'bg-green-100/50 dark:bg-green-900/20 text-green-700 dark:text-green-300 font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300' }}"><span>Unresolved</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">{{ $statusCounts['unresolved'] }}</span></button></li>
                                </ul>
                            </div>

                            <!-- Categories Filter -->
                            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                                <h4 class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3">Categories</h4>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                        <label class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-100/50 dark:hover:bg-slate-700/50 cursor-pointer transition-all duration-200 group">
                                            <!-- Custom Checkbox -->
                                            <div class="relative">
                                                <input type="checkbox"
                                                       wire:click="toggleCategory({{ $category->id }})"
                                                       {{ in_array($category->id, $categoryIds ?? []) ? 'checked' : '' }}
                                                       class="sr-only peer">
                                                <div class="w-5 h-5 bg-white dark:bg-slate-700 border-2 border-slate-300 dark:border-slate-600 rounded-lg transition-all duration-200 peer-checked:bg-gradient-to-r peer-checked:from-red-600 peer-checked:to-orange-500 peer-checked:border-red-500 peer-hover:border-red-400 dark:peer-hover:border-red-500 group-hover:scale-105 flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- Category Content -->
                                            <div class="flex-1 flex items-center justify-between">
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300 group-hover:text-slate-900 dark:group-hover:text-slate-100 transition-colors">
                                                    {{ $category->name }}
                                                </span>
                                                <span class="px-2 py-1 text-xs font-medium bg-slate-100/60 dark:bg-slate-800/60 text-slate-500 dark:text-slate-400 rounded-full">
                                                    {{ $category->discussions_count }}
                                                </span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @if(!empty($categoryIds ?? []))
                                    <button wire:click="clearCategories" class="mt-4 w-full text-sm text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 transition-colors cursor-pointer font-medium">
                                        <div class="flex items-center justify-center gap-2 py-2 px-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Clear all categories
                                        </div>
                                    </button>
                                @endif
                            </div>

                            <!-- Sort Options -->
                            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                                <label for="forum-sort" class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3 block">Sort By</label>
                                <div class="relative">
                                    <select wire:model.live="sortBy" id="forum-sort" class="block w-full py-2.5 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all appearance-none cursor-pointer">
                                        <option value="latest">Latest</option>
                                        <option value="oldest">Oldest</option>
                                        <option value="popular">Most Popular</option>
                                        <option value="most_commented">Most Commented</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Right Content (Discussion List) -->
                <div class="flex-1">
                    <div class="space-y-4">
                        @forelse($discussions as $discussion)
                            <div class="{{ $discussion->is_resolved ? 'bg-green-50/70 dark:bg-green-900/10' : 'bg-white/70 dark:bg-slate-800/70' }} backdrop-blur-xl rounded-2xl border {{ $discussion->is_resolved ? 'border-green-200/60 dark:border-green-800/60' : 'border-slate-200/60 dark:border-slate-700/60' }} p-5 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20">
                                <div class="flex items-start gap-4">
                                    <!-- Avatar -->
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($discussion->user->name, 0, 2) }}
                                    </div>

                                    <!-- Main Content (Clickable) -->
                                    <a href="{{ route('discussions.show', $discussion->slug) }}" class="flex-1 block group cursor-pointer">
                                        <!-- Title and Status -->
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-2 flex-1 pr-4">
                                                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                                    {{ $discussion->title }}
                                                </h3>
                                                @auth
                                                    @if($discussion->user_id === auth()->id())
                                                        <div class="flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-full text-xs font-medium flex-shrink-0" title="Your discussion">
                                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                            </svg>
                                                            <span class="hidden sm:inline">Mine</span>
                                                        </div>
                                                    @endif
                                                @endauth
                                            </div>
                                            @if($discussion->is_resolved)
                                                <div class="flex items-center gap-2 text-green-600 dark:text-green-400 flex-shrink-0" title="Resolved">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                    <span class="hidden sm:inline text-sm font-medium">Resolved</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Meta Info -->
                                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                            Posted by <span class="font-semibold">{{ $discussion->user->name }}</span> in <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $discussion->category->name }}</span> • {{ $discussion->created_at->diffForHumans() }}
                                        </p>
                                    </a>

                                    <!-- Stats and Actions (Non-clickable) -->
                                    <div class="flex flex-col gap-3 items-center justify-center text-center w-24 flex-shrink-0">
                                        <!-- Share Button -->
                                        <button 
                                            x-data="{ 
                                                copied: false,
                                                shareUrl: '{{ route('discussions.show', $discussion->slug) }}',
                                                async copyToClipboard() {
                                                    try {
                                                        await navigator.clipboard.writeText(this.shareUrl);
                                                        this.copied = true;
                                                        setTimeout(() => { this.copied = false; }, 2000);
                                                    } catch (err) {
                                                        console.error('Failed to copy: ', err);
                                                    }
                                                }
                                            }"
                                            @click="copyToClipboard()"
                                            class="p-2 rounded-lg bg-slate-100/70 dark:bg-slate-700/70 hover:bg-slate-200/70 dark:hover:bg-slate-600/70 transition-all cursor-pointer transform hover:scale-110"
                                            :class="{ 'bg-green-100/70 dark:bg-green-900/30': copied }"
                                            title="Share discussion"
                                        >
                                            <svg x-show="!copied" class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            <svg x-show="copied" class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" style="display: none;">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                        
                                        <!-- Replies Count -->
                                        <div class="flex flex-col items-center">
                                            <span class="text-lg font-bold text-slate-700 dark:text-slate-300">{{ $discussion->replies_count }}</span>
                                            <span class="text-xs text-slate-500 dark:text-slate-400">Replies</span>
                                        </div>

                                        <!-- Views Count -->
                                        <div class="flex items-center gap-1 text-slate-500 dark:text-slate-400">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-xs font-medium">{{ number_format($discussion->views_count ?? 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-12 text-center">
                                <svg class="h-16 w-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">No discussions found</h3>
                                <p class="text-slate-600 dark:text-slate-400">
                                    Try adjusting your search or filter criteria.
                                </p>
                            </div>
                        @endforelse

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $discussions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-shared.mobile-nav-script />
</div>
