@props(['withImage' => false, 'imageHeight' => 'h-32'])

<x-ui.section-card {{ $attributes }}>
    @if($withImage)
        <x-ui.skeleton.base width="w-full" :height="$imageHeight" class="mb-4" />
    @endif
    
    <x-ui.skeleton.text width="w-3/4" height="h-4" class="mb-2" />
    <x-ui.skeleton.text width="w-1/2" height="h-4" class="mb-3" />
    <x-ui.skeleton.text width="w-2/3" height="h-3" />
</x-ui.section-card>