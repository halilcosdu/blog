@props(['size' => 'w-8 h-8'])

<x-ui.skeleton.base :width="$size" :height="$size" rounded="rounded-full" {{ $attributes }} />