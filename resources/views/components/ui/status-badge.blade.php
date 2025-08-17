@props(['status', 'statusColors' => []])

@php
    $defaultColors = [
        'Coming Soon' => ['classes' => 'status-coming-soon'],
        'In Development' => ['classes' => 'status-in-development'],
        'Planning' => ['classes' => 'status-planning'],
        'Released' => ['classes' => 'status-released'],
    ];
    
    $colors = $statusColors ?: $defaultColors;
    $statusStyle = $colors[$status] ?? $colors['Planning'];
    $statusClasses = $statusStyle['classes'] ?? 'status-planning';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium ' . $statusClasses]) }}>
    {{ $status }}
</span>