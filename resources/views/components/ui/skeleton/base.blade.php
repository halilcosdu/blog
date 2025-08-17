@props(['width' => 'w-full', 'height' => 'h-4', 'rounded' => 'rounded'])

<div {{ $attributes->merge(['class' => 'skeleton-base ' . $width . ' ' . $height . ' ' . $rounded]) }}></div>