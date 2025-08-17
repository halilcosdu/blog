@props(['count' => 4, 'cols' => 'md:grid-cols-2'])

<div {{ $attributes }}>
    <x-ui.skeleton.text width="w-40" height="h-8" class="mb-2" />
    <x-ui.skeleton.text width="w-56" height="h-4" class="mb-6" />
    
    <div class="grid grid-cols-1 {{ $cols }} gap-6">
        @for($i = 0; $i < $count; $i++)
            <x-ui.skeleton.card with-image image-height="h-32" />
        @endfor
    </div>
</div>