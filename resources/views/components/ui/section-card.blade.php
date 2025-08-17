@props(['title' => null, 'padding' => 'p-5'])

<div {{ $attributes->merge(['class' => 'bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm border border-slate-200/60 dark:border-slate-700/60 rounded-2xl ' . $padding]) }}>
    @if($title)
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-lg font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                {{ $title }}
            </h4>
        </div>
    @endif
    
    {{ $slot }}
</div>