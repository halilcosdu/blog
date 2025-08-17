<?php

use App\Livewire\Blog\CompactNewsletter;
use Livewire\Livewire;

it('renders compact newsletter component', function () {
    Livewire::test(CompactNewsletter::class)
        ->assertSee('Latest Updates')
        ->assertSee('Stay informed with our latest posts')
        ->assertSee('Filters')
        ->assertSee('Subscribe');
});

it('toggles filters visibility', function () {
    Livewire::test(CompactNewsletter::class)
        ->assertSet('showFilters', false)
        ->call('toggleFilters')
        ->assertSet('showFilters', true)
        ->call('toggleFilters')
        ->assertSet('showFilters', false);
});

it('validates email subscription', function () {
    Livewire::test(CompactNewsletter::class)
        ->set('email', 'invalid-email')
        ->call('subscribe')
        ->assertHasErrors(['email']);
});

it('successfully subscribes with valid email', function () {
    Livewire::test(CompactNewsletter::class)
        ->set('email', 'test@example.com')
        ->call('subscribe')
        ->assertSet('isSubscribed', true)
        ->assertSet('email', '');
});

it('clears filters', function () {
    Livewire::test(CompactNewsletter::class)
        ->set('search', 'test search')
        ->set('selectedCategory', 'test-category')
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('selectedCategory', '');
});
