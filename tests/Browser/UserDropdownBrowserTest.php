<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserDropdownBrowserTest extends DuskTestCase
{
    public function test_user_dropdown_functionality()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->resize(1200, 800) // Desktop size to ensure dropdown is visible
                ->visit('/')
                ->waitFor('@user-dropdown')
                ->assertDontSee('Dashboard') // Dropdown should be closed initially
                ->click('@user-dropdown') // Click to open dropdown
                ->waitFor('@dropdown-menu')
                ->assertSee('Dashboard')
                ->assertSee('Log out');
        });
    }

    public function test_dashboard_link_works()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->resize(1200, 800)
                ->visit('/')
                ->waitFor('@user-dropdown')
                ->click('@user-dropdown') // Open dropdown
                ->waitFor('@dropdown-menu')
                ->click('@dashboard-link') // Click dashboard link
                ->waitForLocation('/dashboard')
                ->assertPathIs('/dashboard');
        });
    }

    public function test_logout_functionality()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->resize(1200, 800)
                ->visit('/')
                ->waitFor('@user-dropdown')
                ->click('@user-dropdown') // Open dropdown
                ->waitFor('@dropdown-menu')
                ->click('@logout-button') // Click logout
                ->waitForLocation('/dashboard/login')
                ->assertPathIs('/dashboard/login');
        });
    }
}
