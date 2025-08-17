@props(['title' => true, 'titleWidth' => 'w-32', 'items' => 4])

<x-ui.section-card {{ $attributes }}>
    @if($title)
        <x-ui.skeleton.text :width="$titleWidth" height="h-6" class="mb-4" />
    @endif
    
    <div class="space-y-4">
        @for($i = 0; $i < $items; $i++)
            <x-ui.skeleton.list-item />
        @endfor
    </div>
</x-ui.section-card>