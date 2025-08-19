<div class="relative hidden sm:block">
    <button 
        wire:click="toggle"
        dusk="user-dropdown"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100/50 dark:bg-slate-800/50 border border-slate-200/50 dark:border-slate-700/50 text-slate-700 dark:text-slate-300 hover:bg-slate-200/50 dark:hover:bg-slate-700/50 transition-all text-sm font-medium"
    >
        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-red-500 to-orange-400 flex items-center justify-center text-white font-bold text-xs">
            {{ substr(auth()->user()->name, 0, 2) }}
        </div>
        <span>{{ auth()->user()->name }}</span>
        <svg @class([
            'w-4 h-4 transition-transform',
            'rotate-180' => $open
        ]) fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    @if($open)
    <div 
        dusk="dropdown-menu"
        class="absolute right-0 mt-2 w-48 bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-xl border border-slate-200/60 dark:border-slate-700/60 shadow-lg overflow-hidden z-50"
        wire:transition.opacity
    >
        <div class="py-2">
            <button 
                wire:click="navigateToDashboard"
                dusk="dashboard-link"
                class="flex items-center gap-3 w-full px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100/60 dark:hover:bg-slate-700/60 transition-all text-left">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                Dashboard
            </button>
            <button 
                wire:click="logout"
                dusk="logout-button"
                class="flex items-center gap-3 w-full px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100/60 dark:hover:bg-slate-700/60 transition-all text-left">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Log out
            </button>
        </div>
    </div>
    @endif

    <!-- Click outside to close -->
    @if($open)
    <div class="fixed inset-0" wire:click="close" style="z-index: 40;"></div>
    @endif
</div>