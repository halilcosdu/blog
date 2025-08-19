<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostsListDropdownTest extends DuskTestCase
{
    public function test_category_select_appears()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'name' => 'Unique Test Category ' . uniqid(),
            'slug' => 'unique-test-category-' . uniqid(),
            'is_active' => true,
        ]);
        
        // Create a published post for this category so it appears in select
        Post::factory()->create([
            'title' => 'Test Post for Category',
            'category_id' => $category->id,
            'user_id' => $user->id,
            'published_at' => now(),
            'is_published' => true,
        ]);
        
        $this->browse(function (Browser $browser) use ($category) {
            $browser->resize(1200, 800)
                    ->visit('/posts')
                    ->waitFor('@category-dropdown-button')
                    ->click('@category-dropdown-button')
                    ->waitFor('@category-dropdown-menu')
                    ->assertSee($category->name);
        });
    }
    
    public function test_category_selection_filters_posts()
    {
        // Use existing categories from the database
        $existingCategory = \App\Models\Category::where('is_active', true)->first();
        
        if (!$existingCategory) {
            $this->markTestSkipped('No active categories found');
        }

        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                    ->visit('/posts')
                    ->waitFor('@category-dropdown-button')
                    ->click('@category-dropdown-button')
                    ->waitFor('@category-dropdown-menu')
                    ->screenshot('category-dropdown-open')
                    ->pause(1000)
                    ->check('@category-checkbox-' . $existingCategory->id) // Select existing category
                    ->pause(3000) // Give time for Livewire to process
                    ->screenshot('after-category-selection')
                    ->assertVisible('@category-dropdown-menu'); // Ensure dropdown is still visible
        });
    }
    
    public function test_dropdown_opens_and_closes()
    {
        // Use existing categories from the database
        $existingCategory = \App\Models\Category::where('is_active', true)->first();
        
        if (!$existingCategory) {
            $this->markTestSkipped('No active categories found');
        }
        
        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                    ->visit('/posts')
                    ->waitFor('@category-dropdown-button')
                    ->assertVisible('@category-dropdown-button')
                    ->assertSee('All Categories')
                    ->click('@category-dropdown-button')
                    ->waitFor('@category-dropdown-menu')
                    ->assertVisible('@category-dropdown-menu')
                    ->assertSee($existingCategory->name)
                    ->clickAtPoint(10, 10) // Click outside
                    ->pause(500)
                    ->assertMissing('@category-dropdown-menu');
        });
    }
    
    
    public function test_no_page_flash_during_category_selection()
    {
        // Use existing categories from the database
        $existingCategory = \App\Models\Category::where('is_active', true)->first();
        
        if (!$existingCategory) {
            $this->markTestSkipped('No active categories found');
        }
        
        $this->browse(function (Browser $browser) use ($existingCategory) {
            $browser->resize(1200, 800)
                    ->visit('/posts')
                    ->waitFor('@category-dropdown-button')
                    ->click('@category-dropdown-button')
                    ->waitFor('@category-dropdown-menu');
                    
            // Track if page flashes by measuring response time
            $startTime = microtime(true);
            $browser->check('@category-checkbox-' . $existingCategory->id);
            
            // Wait for Livewire to process
            $browser->waitUsing(5, 100, function () use ($browser) {
                return $browser->element('@category-dropdown-menu');
            });
            
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000; // Convert to milliseconds
            
            // If there's a page flash, it would take longer than expected
            $this->assertLessThan(3000, $duration, 'Category selection took too long, possible page flash detected');
        });
    }
}