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
                <a href="/lessons" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 transition-colors" style="hover:color: #26c859;" onmouseover="this.style.color='#26c859'" onmouseout="this.style.color=''">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Watch
                </a>
                <a href="/discussion" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'discussion' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Discussion</a>
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

                @if (Route::has('filament.customer.auth.login'))
                    @auth
                        <a href="{{ url('/customer') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 transition-all text-sm font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('filament.customer.auth.login') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50 text-slate-800 dark:text-slate-200 hover:bg-white/80 dark:hover:bg-slate-800/80 transition-all text-sm font-medium">
                            Login
                        </a>
                        @if (Route::has('filament.customer.auth.register'))
                            <a href="{{ route('filament.customer.auth.register') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-orange-500 text-white hover:shadow-lg hover:shadow-red-500/25 transition-all text-sm font-semibold">
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
            <a href="/lessons" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg transition" onmouseover="this.style.color='#26c859'; this.style.backgroundColor='rgba(38, 200, 89, 0.1)'" onmouseout="this.style.color=''; this.style.backgroundColor=''">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                </svg>
                Watch
            </a>
            <a href="/discussion" class="px-3 py-2 rounded-lg {{ $currentPage === 'discussion' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Discussion</a>
            <a href="{{ route('pricing') }}" class="px-3 py-2 rounded-lg {{ $currentPage === 'pricing' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Pricing</a>
            <a href="/sponsors" class="px-3 py-2 rounded-lg {{ $currentPage === 'sponsors' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Sponsors</a>
            <a href="/contact" class="px-3 py-2 rounded-lg {{ $currentPage === 'contact' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Contact</a>
        </nav>
    </div>
</div>