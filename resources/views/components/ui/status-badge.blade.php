@props(['status', 'statusColors' => []])

@php
    $defaultColors = [
        'Coming Soon' => ['classes' => 'bg-teal-100 text-teal-800 dark:bg-teal-900/40 dark:text-teal-300 border border-teal-200/80 dark:border-teal-700/60'],
        'In Development' => ['classes' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 border border-amber-200/80 dark:border-amber-700/60'],
        'Planning' => ['classes' => 'bg-gray-100 text-gray-800 dark:bg-gray-700/40 dark:text-gray-300 border border-gray-200/80 dark:border-gray-600/60'],
        'Released' => ['classes' => 'bg-sky-100 text-sky-800 dark:bg-sky-900/40 dark:text-sky-300 border border-sky-200/80 dark:border-sky-700/60'],
    ];
    
    $colors = $statusColors ?: $defaultColors;
    $statusStyle = $colors[$status] ?? $colors['Planning'];
    $statusClasses = $statusStyle['classes'] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700/40 dark:text-gray-300 border border-gray-200/80 dark:border-gray-600/60';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium ' . $statusClasses]) }}>
    <span class="w-1.5 h-1.5 rounded-full {{ str_replace(['text-teal-800', 'text-amber-800', 'text-gray-800', 'text-sky-800'], ['bg-teal-500', 'bg-amber-500', 'bg-gray-500', 'bg-sky-500'], $statusClasses) }}"></span>
    <span>{{ $status }}</span>
</span>