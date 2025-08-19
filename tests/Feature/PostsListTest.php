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

it('shows dropdown menu when open', function () {
    Livewire::test(PostsList::class)
        ->set('categoryDropdownOpen', true)
        ->assertSeeHtml('class="p-2 space-y-1"'); // Dropdown content container
});

it('hides dropdown menu when closed', function () {
    Livewire::test(PostsList::class)
        ->set('categoryDropdownOpen', false)
        ->assertDontSeeHtml('class="p-2 space-y-1"'); // Dropdown content container
});

it('displays correct category count in dropdown button', function () {
    $component = Livewire::test(PostsList::class)
        ->set('categoryIds', [1])
        ->assertSee('1 category selected');

    $component->set('categoryIds', [1, 2])
        ->assertSee('2 categories selected');

    $component->set('categoryIds', [])
        ->assertSee('All Categories');
});
