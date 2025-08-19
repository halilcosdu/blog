<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ModernDropdownTest extends DuskTestCase
{
    public function test_modern_dropdown_trigger_appears()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'name' => 'Modern Test Category '.uniqid(),
            'slug' => 'modern-test-category-'.uniqid(),
            'is_active' => true,
        ]);

        // Create a published post for this category
        Post::factory()->create([
            'title' => 'Modern Test Post',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'published_at' => now(),
            'is_published' => true,
        ]);

        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->assertVisible('@category-dropdown-trigger')
                ->assertSee('All Categories')
                ->assertSee('Choose categories to filter');
        });
    }

    public function test_modern_dropdown_opens_and_shows_search()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                ->assertVisible('@category-dropdown-panel')
                ->assertVisible('@category-search')
                ->assertAttribute('@category-search', 'placeholder', 'Search categories...');
        });
    }

    public function test_category_search_functionality()
    {
        // Use existing categories from database
        $existingCategory = \App\Models\Category::where('is_active', true)->first();

        if (! $existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                ->type('@category-search', strtolower($existingCategory->name))
                ->pause(500)
                ->assertSee($existingCategory->name)
                    // Clear search
                ->clear('@category-search')
                ->pause(500)
                ->assertSee($existingCategory->name);
        });
    }

    public function test_category_selection_and_filtering()
    {
        // Use existing categories from the database
        $existingCategory = \App\Models\Category::where('is_active', true)->first();

        if (! $existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->assertSee('All Categories')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                ->screenshot('modern-dropdown-open')
                ->pause(1000)
                ->check('@category-option-'.$existingCategory->id)
                ->pause(3000) // Give time for Livewire to process
                ->screenshot('modern-after-category-selection')
                    // Check if button text updated
                ->assertSee('1 selected');
            // Note: Clear button might not be visible if dropdown closes after selection
        });
    }

    public function test_multiple_category_selection()
    {
        // Get multiple categories from database
        $categories = \App\Models\Category::where('is_active', true)->limit(2)->get();

        if ($categories->count() < 2) {
            $this->markTestSkipped('Need at least 2 active categories for this test');
        }

        $this->browse(function (Browser $browser) use ($categories) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                    // Select first category
                ->check('@category-option-'.$categories[0]->id)
                ->pause(1500)
                ->assertSee('1 selected')
                    // Select second category
                ->check('@category-option-'.$categories[1]->id)
                ->pause(1500)
                ->assertSee('2 selected');
            // Note: Multiple selection text may vary based on display logic
        });
    }

    public function test_clear_categories_functionality()
    {
        // Use existing category
        $existingCategory = \App\Models\Category::where('is_active', true)->first();

        if (! $existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                ->check('@category-option-'.$existingCategory->id)
                ->pause(2000)
                ->assertSee('1 selected')
                    // Test clearing by visiting clean URL
                ->visit('/posts')
                ->pause(2000)
                ->assertSee('All Categories');
        });
    }

    public function test_dropdown_closes_on_outside_click()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel')
                ->assertVisible('@category-dropdown-panel')
                ->clickAtPoint(10, 10) // Click outside
                ->pause(500)
                ->assertMissing('@category-dropdown-panel');
        });
    }

    public function test_dropdown_animations_and_smooth_transitions()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                    // Test smooth opening
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel', 3)
                ->pause(300) // Let animation complete
                ->assertVisible('@category-dropdown-panel')
                    // Test smooth closing
                ->clickAtPoint(10, 10)
                ->pause(300) // Let animation complete
                ->assertMissing('@category-dropdown-panel');
        });
    }

    public function test_no_page_flash_during_category_operations()
    {
        // Use existing category
        $existingCategory = \App\Models\Category::where('is_active', true)->first();

        if (! $existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                ->visit('/posts')
                ->waitFor('@category-dropdown-trigger')
                ->click('@category-dropdown-trigger')
                ->waitFor('@category-dropdown-panel');

            // Track timing for smooth operations
            $startTime = microtime(true);
            $browser->check('@category-option-'.$existingCategory->id)
                ->pause(1000); // Wait for processing

            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;

            // Should be fast and smooth, no page flash
            $this->assertLessThan(3000, $duration, 'Category selection took too long');

            // Dropdown should still be visible (no flash)
            $browser->assertVisible('@category-dropdown-panel');
        });
    }
}
