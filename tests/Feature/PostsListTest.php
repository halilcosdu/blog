<?php

use App\Livewire\Blog\PostsList;
use App\Models\Category;
use Livewire\Livewire;

it('can render posts list component', function () {
    Livewire::test(PostsList::class)
        ->assertSet('categoryDropdownOpen', false)
        ->assertSet('categoryIds', [])
        ->assertStatus(200);
});

it('can toggle category dropdown', function () {
    Livewire::test(PostsList::class)
        ->assertSet('categoryDropdownOpen', false)
        ->call('toggleCategoryDropdown')
        ->assertSet('categoryDropdownOpen', true)
        ->call('toggleCategoryDropdown')
        ->assertSet('categoryDropdownOpen', false);
});

it('can close category dropdown', function () {
    Livewire::test(PostsList::class)
        ->set('categoryDropdownOpen', true)
        ->call('closeCategoryDropdown')
        ->assertSet('categoryDropdownOpen', false);
});

it('can toggle category selection', function () {
    $category = Category::factory()->create();

    Livewire::test(PostsList::class)
        ->assertSet('categoryIds', [])
        ->call('toggleCategory', $category->id)
        ->assertSet('categoryIds', [$category->id])
        ->call('toggleCategory', $category->id)
        ->assertSet('categoryIds', []);
});

it('shows search functionality', function () {
    Livewire::test(PostsList::class)
        ->assertSee('Search Posts');
});

it('can update search query', function () {
    Livewire::test(PostsList::class)
        ->set('search', 'Laravel')
        ->assertSet('search', 'Laravel');
});

it('can filter by categories', function () {
    $category = Category::factory()->create();

    Livewire::test(PostsList::class)
        ->set('categoryIds', [$category->id])
        ->assertSet('categoryIds', [$category->id]);
});
