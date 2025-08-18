@props(['currentPage' => 'home'])

<!-- Header -->
<header class="relative sticky top-0 z-50">
    <!-- Background with glassmorphism -->
    <div class="absolute inset-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-200/50 dark:border-slate-700/50"></div>

    <nav class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-red-600 to-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                        phpuzem
                    </span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="relative px-3 py-2 text-sm font-medium {{ $currentPage === 'home' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">
                    Home
                    @if($currentPage === 'home')
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-red-600 to-orange-500 rounded-full"></div>
                    @endif
                </a>
                <a href="/posts" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'posts' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Posts</a>
                <a href="{{ route('watch') }}" class="relative inline-flex items-center gap-2 px-3 py-2 text-sm font-medium {{ $currentPage === 'watch' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Watch
                    @if($currentPage === 'watch')
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-red-600 to-orange-500 rounded-full"></div>
                    @endif
                </a>
                <a href="/discussions" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'discussion' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Discussions</a>
                <a href="{{ route('pricing') }}" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'pricing' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Pricing</a>
                <a href="/sponsors" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'sponsors' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Sponsors</a>
                <a href="/contact" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'contact' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Contact</a>
            </nav>

            <!-- Search & Actions -->
            <div class="flex items-center space-x-4">

                <!-- Mobile menu toggle -->
                <button type="button" aria-label="Toggle navigation" aria-expanded="false" data-mobile-toggle class="md:hidden p-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 transition-all cursor-pointer">
                    <svg data-mobile-icon="open" class="w-5 h-5 text-slate-700 dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg data-mobile-icon="close" class="hidden w-5 h-5 text-slate-700 dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 border border-slate-200/50 dark:border-slate-700/50 transition-all cursor-pointer">
                    <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                        <path class="dark:hidden" d="M10 2L13.09 8.26L20 9L14 14.74L15.18 21.02L10 17.77L4.82 21.02L6 14.74L0 9L6.91 8.26L10 2Z"/>
                        <path class="hidden dark:block" d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                </button>

                @if (Route::has('filament.dashboard.auth.login'))
                    @auth
                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative hidden sm:block">
                            <button 
                                @click="open = !open"
                                @click.away="open = false"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 transition-all text-sm font-medium"
                            >
                                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex items-center justify-center text-white font-bold text-xs">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                                <span>{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div 
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-lg overflow-hidden"
                                style="display: none;"
                            >
                                <div class="py-2">
                                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100/60 dark:hover:bg-slate-700/60 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                        Dashboard
                                    </a>
                                    <form method="POST" action="{{ route('filament.dashboard.auth.logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100/60 dark:hover:bg-slate-700/60 transition-all text-left">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Log out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('filament.dashboard.auth.login') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-800 dark:text-slate-200 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all text-sm font-medium">
                            Login
                        </a>
                        @if (Route::has('filament.dashboard.auth.register'))
                            <a href="{{ route('filament.dashboard.auth.register') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-orange-500 text-white hover:shadow-lg hover:shadow-red-500/25 transition-all text-sm font-semibold">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Navigation Panel -->
<div id="mobile-nav" class="md:hidden hidden sticky top-16 bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-slate-200/60 dark:border-slate-700/60 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="grid gap-1 text-slate-800 dark:text-slate-200">
            <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg {{ $currentPage === 'home' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Home</a>
            <a href="/posts" class="px-3 py-2 rounded-lg {{ $currentPage === 'posts' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Posts</a>
            <a href="{{ route('watch') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg {{ $currentPage === 'watch' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                </svg>
                Watch
            </a>
            <a href="/discussions" class="px-3 py-2 rounded-lg {{ $currentPage === 'discussion' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Discussions</a>
            <a href="{{ route('pricing') }}" class="px-3 py-2 rounded-lg {{ $currentPage === 'pricing' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Pricing</a>
            <a href="/sponsors" class="px-3 py-2 rounded-lg {{ $currentPage === 'sponsors' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Sponsors</a>
            <a href="/contact" class="px-3 py-2 rounded-lg {{ $currentPage === 'contact' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Contact</a>
        </nav>
    </div>
</div>
