<?php

namespace Tests\Browser;

use App\Models\Category;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ModernSortAndSearchTest extends DuskTestCase
{
    public function test_modern_sort_dropdown_trigger_appears()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->assertVisible('@sort-dropdown-trigger')
                ->assertSee('Latest First')
                ->assertSee('Choose sorting order');
        });
    }

    public function test_modern_sort_dropdown_opens_and_shows_options()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel')
                ->assertVisible('@sort-dropdown-panel')
                ->assertVisible('@sort-option-latest')
                ->assertVisible('@sort-option-popular')
                ->assertVisible('@sort-option-oldest')
                ->assertSee('Latest First')
                ->assertSee('Most Popular')
                ->assertSee('Oldest First');
        });
    }

    public function test_sort_option_selection_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->assertSee('Latest First') // Default
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel')
                ->click('@sort-option-popular')
                ->pause(2000) // Wait for Livewire to process
                ->assertSee('Most Popular') // Button text should update
                ->assertQueryStringHas('sort', 'popular'); // URL should reflect change
        });
    }

    public function test_sort_dropdown_closes_after_selection()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel')
                ->assertVisible('@sort-dropdown-panel')
                ->click('@sort-option-oldest')
                ->pause(1000)
                ->assertMissing('@sort-dropdown-panel'); // Should close after selection
        });
    }

    public function test_sort_dropdown_closes_on_outside_click()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel')
                ->assertVisible('@sort-dropdown-panel')
                ->clickAtPoint(10, 10) // Click outside
                ->pause(500)
                ->assertMissing('@sort-dropdown-panel');
        });
    }

    public function test_search_input_appears_and_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@search-input')
                ->assertVisible('@search-input')
                ->assertAttribute('@search-input', 'placeholder', 'Search by title, content, or tags...')
                ->type('@search-input', 'test search')
                ->pause(1000) // Wait for debounce
                ->assertInputValue('@search-input', 'test search')
                ->assertQueryStringHas('search', 'test search');
        });
    }

    public function test_search_clear_button_appears_and_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@search-input')
                ->type('@search-input', 'test search')
                ->pause(1000)
                ->assertVisible('@clear-search')
                ->click('@clear-search')
                ->pause(1000)
                ->assertInputValue('@search-input', '')
                ->assertMissing('@clear-search');
        });
    }

    public function test_search_input_focus_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@search-input')
                ->click('@search-input') // Focus the input
                ->pause(500)
                ->assertFocused('@search-input');
        });
    }

    public function test_search_input_typing_works()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@search-input')
                ->type('@search-input', 'Laravel')
                ->pause(1000)
                ->assertInputValue('@search-input', 'Laravel')
                ->assertQueryStringHas('search', 'Laravel');
        });
    }

    public function test_multiple_filters_work_together()
    {
        // Use existing category for simpler test
        $existingCategory = \App\Models\Category::where('is_active', true)->first();

        if (! $existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@search-input')
                    // Apply search filter
                ->type('@search-input', 'Laravel')
                ->pause(1000)
                    // Apply sort filter
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel')
                ->click('@sort-option-popular')
                ->pause(2000)
                    // Check URL has parameters
                ->assertQueryStringHas('search', 'Laravel')
                ->assertQueryStringHas('sort', 'popular');
        });
    }

    public function test_sort_animations_and_smooth_transitions()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                    // Test smooth opening
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel', 3)
                ->pause(300) // Let animation complete
                ->assertVisible('@sort-dropdown-panel')
                    // Test smooth closing
                ->clickAtPoint(10, 10)
                ->pause(300) // Let animation complete
                ->assertMissing('@sort-dropdown-panel');
        });
    }

    public function test_no_page_flash_during_sort_operations()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@sort-dropdown-trigger')
                ->click('@sort-dropdown-trigger')
                ->waitFor('@sort-dropdown-panel');

            // Track timing for smooth operations
            $startTime = microtime(true);
            $browser->click('@sort-option-popular')
                ->pause(1000); // Wait for processing

            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;

            // Should be fast and smooth, no page flash
            $this->assertLessThan(3000, $duration, 'Sort selection took too long');

            // Dropdown should close smoothly
            $browser->assertMissing('@sort-dropdown-panel');
        });
    }
}
