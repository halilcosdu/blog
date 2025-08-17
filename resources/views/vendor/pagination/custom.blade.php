@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="relative flex flex-col items-center justify-center px-4 w-full max-w-4xl mx-auto">
        <!-- Loading Overlay -->
        <div wire:loading class="absolute inset-0 bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm rounded-2xl flex items-center justify-center z-10">
            <div class="flex items-center gap-2 px-4 py-2 bg-white/90 dark:bg-slate-800/90 rounded-xl border border-slate-200/60 dark:border-slate-700/60">
                <div class="w-4 h-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Loading...</span>
            </div>
        </div>
        <div class="flex items-center justify-center w-full">
            <div class="flex items-center gap-1 flex-nowrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-slate-400 dark:text-slate-500 bg-white/50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 rounded-lg cursor-not-allowed flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="hidden sm:inline text-xs">Prev</span>
                </span>
            @else
                <button wire:click="previousPage" 
                   class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-slate-700 dark:text-slate-300 bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg transition-all duration-200 cursor-pointer flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="hidden sm:inline text-xs">Prev</span>
                </button>
            @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-2 py-2 text-sm font-medium text-slate-500 dark:text-slate-400 flex-shrink-0">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-orange-500 rounded-lg shadow-lg shadow-red-500/25 flex-shrink-0">
                                    {{ $page }}
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" 
                                   class="inline-flex items-center justify-center w-7 h-7 text-xs font-medium text-slate-700 dark:text-slate-300 bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg hover:bg-gradient-to-r hover:from-red-50 hover:to-orange-50 dark:hover:from-red-950/20 dark:hover:to-orange-950/20 hover:border-red-200 dark:hover:border-red-800 hover:text-red-700 dark:hover:text-red-300 transition-all duration-200 cursor-pointer flex-shrink-0">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" 
                   class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-slate-700 dark:text-slate-300 bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-lg hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg transition-all duration-200 cursor-pointer flex-shrink-0">
                    <span class="hidden sm:inline text-xs">Next</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            @else
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-slate-400 dark:text-slate-500 bg-white/50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 rounded-lg cursor-not-allowed flex-shrink-0">
                    <span class="hidden sm:inline text-xs">Next</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
            </div>
        </div>

        {{-- Results Info --}}
        <div class="mt-4 text-center">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Showing <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $paginator->firstItem() }}</span> 
                to <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $paginator->lastItem() }}</span> 
                of <span class="font-semibold text-slate-900 dark:text-slate-100">{{ $paginator->total() }}</span> results
            </p>
        </div>
    </nav>
@endif