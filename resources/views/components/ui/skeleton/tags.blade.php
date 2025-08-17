@props(['count' => 8])

<div {{ $attributes }}>
    <x-ui.skeleton.text width="w-40" height="h-8" class="mb-2" />
    <x-ui.skeleton.text width="w-56" height="h-4" class="mb-6" />
    
    <div class="flex flex-wrap gap-3">
        @for($i = 0; $i < $count; $i++)
            <x-ui.skeleton.base width="w-16" height="h-8" rounded="rounded-full" />
        @endfor
    </div>
</div>