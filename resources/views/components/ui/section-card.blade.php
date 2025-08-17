@props(['title' => null, 'padding' => 'p-5'])

<div {{ $attributes->merge(['class' => 'card-base ' . $padding]) }}>
    @if($title)
        <div class="flex items-center justify-between mb-4">
            <h4 class="section-title">
                {{ $title }}
            </h4>
        </div>
    @endif
    
    {{ $slot }}
</div>