<!-- Packages Section -->
<div wire:init="loadContent">
    @if(!$loaded)
        <!-- Packages Skeleton -->
        <x-ui.skeleton.section title-width="w-24" :items="4" />
    @else
        <!-- Actual Packages Content -->
        <x-ui.section-card title="Packages">
            <div class="space-y-4">
                @foreach($packages as $package)
                    <div class="group relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-xl p-4 hover:border-slate-300/60 dark:hover:border-slate-600/60 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-slate-200/20 dark:hover:shadow-slate-900/20">
                        <!-- Header -->
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-red-100 to-orange-100 dark:from-red-900/30 dark:to-orange-900/30 rounded-lg flex items-center justify-center text-lg shrink-0">
                                {{ $package['icon'] }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors truncate">
                                            <a href="{{ $package['url'] }}" class="hover:underline">{{ $package['name'] }}</a>
                                        </h3>
                                        @if($package['version'])
                                            <p class="text-xs text-slate-500 dark:text-slate-400">v{{ $package['version'] }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium whitespace-nowrap shrink-0 {{ $this->getStatusBadgeClasses($package['status']) }}">
                                        {{ $package['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-slate-600 dark:text-slate-300 mb-3 leading-relaxed">
                            {{ $package['description'] }}
                        </p>

                        <!-- Tags -->
                        @if($package['tags'] && $package['tags']->count() > 0)
                            <div class="flex flex-wrap gap-1 mb-3" x-data="{ showAllTags: false }">
                                <template x-if="!showAllTags">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($package['tags']->take(3) as $tag)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                        @if($package['tags']->count() > 3)
                                            <button @click="showAllTags = true" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-colors cursor-pointer">
                                                +{{ $package['tags']->count() - 3 }} more
                                            </button>
                                        @endif
                                    </div>
                                </template>
                                
                                <template x-if="showAllTags">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($package['tags'] as $tag)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                        <button @click="showAllTags = false" class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-200 dark:bg-slate-600 text-slate-600 dark:text-slate-400 hover:bg-slate-300 dark:hover:bg-slate-500 transition-colors cursor-pointer">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        @endif

                        <!-- Stats & Links -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                                @if($package['downloads_count'] > 0)
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"/>
                                        </svg>
                                        <span>{{ $package['downloads_count'] }}</span>
                                    </div>
                                @endif
                                @if($package['stars_count'] > 0)
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>{{ $package['stars_count'] }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Links -->
                            <div class="flex items-center gap-2">
                                @if($package['github_url'])
                                    <a href="{{ $package['github_url'] }}" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" title="GitHub">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                @endif
                                @if($package['packagist_url'])
                                    <a href="{{ $package['packagist_url'] }}" class="text-slate-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors" title="Packagist">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                        </svg>
                                    </a>
                                @endif
                                @if($package['documentation_url'])
                                    <a href="{{ $package['documentation_url'] }}" class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors" title="Documentation">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-ui.section-card>
    @endif
</div>