<?php

use App\Livewire\ShareButton;
use Livewire\Livewire;

it('can render share button component', function () {
    Livewire::test(ShareButton::class)
        ->assertSet('copied', false)
        ->assertSee('Share')
        ->assertStatus(200);
});

it('sets share url on mount', function () {
    $this->get('/test-url');

    Livewire::test(ShareButton::class)
        ->assertSet('shareUrl', request()->url());
});

it('can trigger copy to clipboard', function () {
    Livewire::test(ShareButton::class)
        ->assertSet('copied', false)
        ->call('copyToClipboard')
        ->assertSet('copied', true)
        ->assertDispatched('copy-url')
        ->assertDispatched('reset-copied-state');
});

it('can reset copied state', function () {
    Livewire::test(ShareButton::class)
        ->set('copied', true)
        ->call('resetCopiedState')
        ->assertSet('copied', false);
});

it('shows copied state in ui', function () {
    Livewire::test(ShareButton::class)
        ->set('copied', true)
        ->assertSee('Copied!')
        ->assertDontSee('Share');
});

it('shows share state in ui', function () {
    Livewire::test(ShareButton::class)
        ->set('copied', false)
        ->assertSee('Share')
        ->assertDontSee('Copied!');
});
