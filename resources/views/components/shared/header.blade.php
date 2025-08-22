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
                <a href="{{ route('watch') }}" class="relative inline-flex items-center gap-2 px-3 py-2 text-sm font-medium {{ $currentPage === 'watch' ? 'text-green-600 dark:text-green-400' : 'text-slate-700 dark:text-slate-300 hover:text-green-600 dark:hover:text-green-400' }} transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                    </svg>
                    Watch
                    @if($currentPage === 'watch')
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-green-600 to-green-500 rounded-full"></div>
                    @endif
                </a>
                <a href="/discussions" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'discussion' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Discussions</a>
                <a href="{{ route('pricing') }}" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'pricing' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Pricing</a>
                <a href="/sponsors" class="px-3 py-2 text-sm font-medium {{ $currentPage === 'sponsors' ? 'text-red-600 dark:text-red-400' : 'text-slate-700 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400' }} transition-colors">Sponsors</a>
                <a href="/avatar" class="relative inline-flex items-center gap-2 px-3 py-2 text-sm font-medium {{ $currentPage === 'avatar' ? 'text-purple-600 dark:text-purple-400' : 'text-purple-700 dark:text-purple-400 hover:text-purple-600 dark:hover:text-purple-300' }} transition-colors">
                    <div class="relative">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17L10.59 10.75C10.21 10.37 9.7 10.17 9.17 10.17H4C2.9 10.17 2 11.07 2 12.17V14.17H4V22H10V14.17H11V13C11 12.65 11.04 12.31 11.1 11.97L16.5 6.5L19 9H21ZM6 12.17H8V14.17H6V12.17Z"/>
                        </svg>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                            <span class="text-[8px] text-white font-bold">✓</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span>Avatar</span>
                        <span class="text-[10px] text-purple-500 dark:text-purple-400 font-semibold leading-none">Premium</span>
                    </div>
                    @if($currentPage === 'avatar')
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gradient-to-r from-purple-600 to-purple-500 rounded-full"></div>
                    @endif
                </a>
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
                        <livewire:user-dropdown />
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
            <a href="{{ route('watch') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg {{ $currentPage === 'watch' ? 'bg-green-100/60 dark:bg-green-900/60 text-green-700 dark:text-green-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                </svg>
                Watch
            </a>
            <a href="/discussions" class="px-3 py-2 rounded-lg {{ $currentPage === 'discussion' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Discussions</a>
            <a href="{{ route('pricing') }}" class="px-3 py-2 rounded-lg {{ $currentPage === 'pricing' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Pricing</a>
            <a href="/sponsors" class="px-3 py-2 rounded-lg {{ $currentPage === 'sponsors' ? 'bg-red-100/60 dark:bg-red-900/60 text-red-700 dark:text-red-300 font-semibold' : 'hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">Sponsors</a>
            <a href="/avatar" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg {{ $currentPage === 'avatar' ? 'bg-purple-100/60 dark:bg-purple-900/60 text-purple-700 dark:text-purple-300 font-semibold' : 'text-purple-700 dark:text-purple-400 hover:bg-slate-100/60 dark:hover:bg-slate-800/60' }} transition">
                <div class="relative">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17L10.59 10.75C10.21 10.37 9.7 10.17 9.17 10.17H4C2.9 10.17 2 11.07 2 12.17V14.17H4V22H10V14.17H11V13C11 12.65 11.04 12.31 11.1 11.97L16.5 6.5L19 9H21ZM6 12.17H8V14.17H6V12.17Z"/>
                    </svg>
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                        <span class="text-[8px] text-white font-bold">✓</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span>Avatar</span>
                    <span class="text-[10px] text-purple-500 dark:text-purple-400 font-semibold leading-none">Premium</span>
                </div>
            </a>
        </nav>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileToggle = document.querySelector('[data-mobile-toggle]');
    const mobileNav = document.getElementById('mobile-nav');
    const openIcon = document.querySelector('[data-mobile-icon="open"]');
    const closeIcon = document.querySelector('[data-mobile-icon="close"]');

    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function() {
            const isHidden = mobileNav.classList.contains('hidden');
            
            if (isHidden) {
                mobileNav.classList.remove('hidden');
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                mobileToggle.setAttribute('aria-expanded', 'true');
            } else {
                mobileNav.classList.add('hidden');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});
</script>
