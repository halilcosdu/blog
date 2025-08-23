<?php

use App\Livewire\UserDropdown;
use App\Models\User;
use Livewire\Livewire;

it('can render user dropdown component', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->assertSet('open', false)
        ->assertSee($user->name)
        ->assertStatus(200);
});

it('can toggle dropdown open state', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->assertSet('open', false)
        ->call('toggle')
        ->assertSet('open', true)
        ->call('toggle')
        ->assertSet('open', false);
});

it('can close dropdown', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->set('open', true)
        ->call('closeDropdown')
        ->assertSet('open', false);
});

it('shows dropdown menu when open', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->set('open', true)
        ->assertSee('Dashboard')
        ->assertSee('Log out');
});

it('hides dropdown menu when closed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->set('open', false)
        ->assertDontSee('Dashboard')
        ->assertDontSee('Log out');
});

it('can navigate to dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->call('navigateToDashboard')
        ->assertRedirect('/dashboard');
});

it('can logout user', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(UserDropdown::class)
        ->call('logout')
        ->assertRedirect(route('filament.dashboard.auth.login'));

    $this->assertGuest();
});
