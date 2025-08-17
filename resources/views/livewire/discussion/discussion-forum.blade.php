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
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <!-- Left Sidebar (Filters) -->
                <aside class="lg:col-span-3">
                    <div class="sticky top-24 space-y-6">
                        <!-- New Discussion Button -->
                        <a href="#" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-orange-500 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-red-500/25 transform hover:scale-105 transition-all duration-200 cursor-pointer">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                            <span>New Discussion</span>
                        </a>

                        <!-- Filters Panel -->
                        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-5">
                            <!-- Search -->
                            <div class="relative mb-5">
                                <label for="forum-search" class="sr-only">Search forum</label>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <input type="search" id="forum-search" placeholder="Search discussions..." class="block w-full pl-10 pr-4 py-2.5 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all">
                            </div>

                            <!-- Status Filters -->
                            <div>
                                <h4 class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3">Status</h4>
                                <ul class="space-y-2 text-sm">
                                    <li><a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg bg-red-100/50 dark:bg-red-900/20 text-red-700 dark:text-red-300 font-semibold"><span>All Discussions</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">24</span></a></li>
                                    <li><a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300"><span>Resolved</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">18</span></a></li>
                                    <li><a href="#" class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 text-slate-700 dark:text-slate-300"><span>Unresolved</span> <span class="px-2 py-0.5 text-xs rounded-full bg-white dark:bg-slate-700">6</span></a></li>
                                </ul>
                            </div>

                            <!-- Tags Filter -->
                            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                                <h4 class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3">Popular Tags</h4>
                                <div class="flex flex-wrap gap-2">
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50">Laravel</a>
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-900/50">PHP</a>
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-900/50">Livewire</a>
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-200 dark:hover:bg-yellow-900/50">Alpine.js</a>
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-200 dark:hover:bg-indigo-900/50">Deployment</a>
                                    <a href="#" class="px-3 py-1 rounded-full text-xs font-medium bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 hover:bg-pink-200 dark:hover:bg-pink-900/50">Testing</a>
                                </div>
                            </div>
                            
                            <!-- Sort Options -->
                            <div class="mt-6 pt-6 border-t border-slate-200/60 dark:border-slate-700/60">
                                <label for="forum-sort" class="text-sm font-semibold text-slate-600 dark:text-slate-300 mb-3 block">Sort By</label>
                                <div class="relative">
                                    <select id="forum-sort" class="block w-full py-2.5 px-4 pr-10 text-sm border border-slate-200/60 dark:border-slate-600/60 rounded-lg bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500/50 transition-all appearance-none cursor-pointer">
                                        <option>Latest</option>
                                        <option>Oldest</option>
                                        <option>Most Popular</option>
                                        <option>Most Commented</option>
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
                <div class="lg:col-span-9 mt-8 lg:mt-0">
                    <div class="space-y-4">
                        <!-- Single Discussion Item: Resolved -->
                        <a href="#" class="block group">
                            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-5 flex items-start gap-4 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20">
                                <!-- Avatar -->
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                    JD
                                </div>
                                
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <!-- Title and Status -->
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors pr-4">
                                            How to properly cache complex database queries in Laravel?
                                        </h3>
                                        <div class="flex items-center gap-2 text-green-600 dark:text-green-400 flex-shrink-0" title="Resolved">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            <span class="hidden sm:inline text-sm font-medium">Resolved</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Meta Info -->
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                        Posted by <span class="font-semibold">John Doe</span> in <span class="font-semibold text-blue-600 dark:text-blue-400">Laravel</span> • 2 hours ago
                                    </p>
                                </div>
                                
                                <!-- Stats -->
                                <div class="flex flex-col items-center justify-center text-center w-20 flex-shrink-0">
                                    <span class="text-xl font-bold text-slate-700 dark:text-slate-300">12</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Replies</span>
                                </div>
                            </div>
                        </a>

                        <!-- Single Discussion Item: Unresolved -->
                        <a href="#" class="block group">
                            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-5 flex items-start gap-4 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20">
                                <!-- Avatar -->
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                    AS
                                </div>
                                
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                        Best practices for deploying a Livewire app with zero downtime?
                                    </h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                        Posted by <span class="font-semibold">Alex Smith</span> in <span class="font-semibold text-indigo-600 dark:text-indigo-400">Deployment</span> • 1 day ago
                                    </p>
                                </div>
                                
                                <!-- Stats -->
                                <div class="flex flex-col items-center justify-center text-center w-20 flex-shrink-0">
                                    <span class="text-xl font-bold text-slate-700 dark:text-slate-300">3</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Replies</span>
                                </div>
                            </div>
                        </a>

                        <!-- Single Discussion Item: No Replies -->
                        <a href="#" class="block group">
                            <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 p-5 flex items-start gap-4 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20">
                                <!-- Avatar -->
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-emerald-400 flex-shrink-0 flex items-center justify-center text-white font-bold text-sm">
                                    MW
                                </div>
                                
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">
                                        Is it possible to use Vue components inside a Blade file with Livewire?
                                    </h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                        Posted by <span class="font-semibold">Maria Williams</span> in <span class="font-semibold text-green-600 dark:text-green-400">Livewire</span> • 3 days ago
                                    </p>
                                </div>
                                
                                <!-- Stats -->
                                <div class="flex flex-col items-center justify-center text-center w-20 flex-shrink-0">
                                    <span class="text-xl font-bold text-slate-700 dark:text-slate-300">0</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Replies</span>
                                </div>
                            </div>
                        </a>

                        <!-- Pagination (Static Demo) -->
                        <div class="mt-8 flex items-center justify-between">
                            <span class="text-sm text-slate-600 dark:text-slate-400">
                                Showing 1 to 3 of 24 results
                            </span>
                            <div class="flex items-center gap-2">
                                <a href="#" class="px-3 py-2 text-sm font-medium bg-white/70 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-700/60 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50">Previous</a>
                                <a href="#" class="px-3 py-2 text-sm font-medium bg-white/70 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-700/60 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- The footer can be added later if needed, or we can fetch data for it now --}}
    {{-- <x-shared.footer :top-lessons="$topLessons" /> --}}
    <x-shared.mobile-nav-script />
</div>