@props(['icon', 'gradient' => 'icon-gradient', 'size' => 'w-8 h-8'])

<div {{ $attributes->merge(['class' => 'rounded-full ' . $gradient . ' flex items-center justify-center text-white text-sm ' . $size]) }}>
    {{ $icon }}
</div>