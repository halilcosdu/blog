@props(['status', 'statusColors' => []])

@php
    $defaultColors = [
        'Coming Soon' => ['classes' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'],
        'In Development' => ['classes' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300'],
        'Planning' => ['classes' => 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300'],
        'Released' => ['classes' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300'],
    ];
    
    $colors = $statusColors ?: $defaultColors;
    $statusStyle = $colors[$status] ?? $colors['Planning'];
    $statusClasses = $statusStyle['classes'] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium ' . $statusClasses]) }}>
    {{ $status }}
</span>