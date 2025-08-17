@props(['withAvatar' => true, 'avatarSize' => 'w-8 h-8'])

<div {{ $attributes->merge(['class' => 'flex items-center space-x-3']) }}>
    @if($withAvatar)
        <x-ui.skeleton.avatar :size="$avatarSize" />
    @endif
    <div class="flex-1">
        <x-ui.skeleton.text width="w-32" class="mb-1" />
        <x-ui.skeleton.text width="w-24" height="h-3" class="mb-1" />
        <x-ui.skeleton.text width="w-16" height="h-3" />
    </div>
</div>