<div class="relative hidden sm:block" 
     wire:mouseenter="openDropdown" 
     wire:mouseleave="closeDropdown">
    <button 
        wire:click="toggle"
        dusk="user-dropdown"
        class="group inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl border border-white/30 dark:border-slate-700/30 text-slate-700 dark:text-slate-300 hover:bg-white/90 dark:hover:bg-slate-800/90 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20 transition-all duration-300 text-sm font-medium"
    >
        <div class="relative w-6 h-6 rounded-full bg-gradient-to-br from-red-500 via-red-600 to-orange-500 flex items-center justify-center text-white font-bold text-xs shadow-md shadow-red-500/25">
            {{ substr(auth()->user()->name, 0, 2) }}
            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-white/20 to-transparent"></div>
        </div>
        <span>{{ auth()->user()->name }}</span>
        <svg @class([
            'w-4 h-4 transition-all duration-300 text-slate-400 dark:text-slate-500 group-hover:text-slate-600 dark:group-hover:text-slate-300',
            'rotate-180 text-red-500 dark:text-red-400' => $open
        ]) fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    @if($open)
    <!-- Invisible bridge to prevent gap hover issues -->
    <div class="absolute right-0 top-full w-48 h-2 z-40" 
         wire:mouseenter="openDropdown"
         wire:mouseleave="closeDropdown"></div>
    
    <div 
        dusk="dropdown-menu"
        class="absolute right-0 top-full mt-2 w-48 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-xl border border-white/20 dark:border-slate-700/30 shadow-xl shadow-slate-200/10 dark:shadow-slate-900/20 overflow-hidden z-50 ring-1 ring-slate-200/10 dark:ring-slate-700/20"
        wire:transition.opacity
        wire:mouseenter="openDropdown"
        wire:mouseleave="closeDropdown"
    >
        <div class="py-1">
            <button 
                wire:click="navigateToDashboard"
                dusk="dashboard-link"
                class="group flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-gradient-to-r hover:from-red-50/80 hover:to-orange-50/40 dark:hover:from-red-950/30 dark:hover:to-orange-950/20 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200 text-left">
                <div class="w-6 h-6 rounded-lg bg-slate-100 dark:bg-slate-800 group-hover:bg-gradient-to-br group-hover:from-red-500 group-hover:to-orange-500 flex items-center justify-center transition-all duration-200">
                    <svg class="w-3.5 h-3.5 text-slate-600 dark:text-slate-400 group-hover:text-white transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                Dashboard
            </button>
            
            <div class="mx-3 h-px bg-gradient-to-r from-transparent via-slate-200/60 to-transparent dark:via-slate-700/60"></div>
            
            <button 
                wire:click="logout"
                dusk="logout-button"
                class="group flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-gradient-to-r hover:from-red-50/80 hover:to-red-100/40 dark:hover:from-red-950/20 dark:hover:to-red-950/30 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 text-left">
                <div class="w-6 h-6 rounded-lg bg-slate-100 dark:bg-slate-800 group-hover:bg-gradient-to-br group-hover:from-red-500 group-hover:to-red-600 flex items-center justify-center transition-all duration-200">
                    <svg class="w-3.5 h-3.5 text-slate-600 dark:text-slate-400 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                Log out
            </button>
        </div>
    </div>
    @endif

</div>