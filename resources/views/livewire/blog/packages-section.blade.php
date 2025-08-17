<!-- Packages Section -->
<div wire:init="loadContent">
    @if(!$loaded)
        <!-- Packages Skeleton -->
        <x-ui.skeleton.section title-width="w-24" :items="4" />
    @else
        <!-- Actual Packages Content -->
        <x-ui.section-card title="Packages">
            <ul class="divide-y divide-slate-200/60 dark:divide-slate-700/60">
                @foreach($packages as $package)
                    <li>
                        <div class="flex items-center py-3">
                            <x-ui.icon-avatar :icon="$package['icon']" class="mr-3" />
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate">
                                    <a href="{{ $package['url'] }}" class="text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        {{ $package['name'] }}
                                    </a>
                                </p>
                                <p class="text-xs text-slate-600 dark:text-slate-300 mb-1">
                                    {{ $package['description'] }}
                                </p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    <x-ui.status-badge :status="$package['status']" :status-colors="config('packages.status_colors')" />
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </x-ui.section-card>
    @endif
</div>