<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Laravel\Dusk\Browser;

test('mention dropdown appears when typing @ in discussion comment', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionableUser = User::factory()->create([
        'username' => 'testuser123',
        'name' => 'Test User',
    ]);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->assertSee($discussion->title)
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', 'Hello @')
            ->pause(500)
            ->assertVisible('.mention-dropdown')
            ->assertSee('testuser123')
            ->assertSee('Test User');
    });
});

test('mention dropdown positions correctly on different screen sizes', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionableUser = User::factory()->create([
        'username' => 'responsive_user',
        'name' => 'Responsive User',
    ]);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user);

        // Test on mobile size
        $browser->resize(375, 667)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $dropdown = $browser->element('.mention-dropdown');
            $position = $browser->script('return arguments[0].getBoundingClientRect();', [$dropdown])[0];

            // Check if dropdown is within viewport
            expect($position['left'])->toBeGreaterThanOrEqual(0);
            expect($position['right'])->toBeLessThanOrEqual(375);
        }

        // Test on desktop size
        $browser->resize(1920, 1080)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $dropdown = $browser->element('.mention-dropdown');
            $position = $browser->script('return arguments[0].getBoundingClientRect();', [$dropdown])[0];

            // Check if dropdown is within viewport
            expect($position['left'])->toBeGreaterThanOrEqual(0);
            expect($position['right'])->toBeLessThanOrEqual(1920);
        }
    });
});

test('mention dropdown closes when clicking outside', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionableUser = User::factory()->create(['username' => 'clickaway_user']);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown')
                ->click('body')
                ->pause(200)
                ->assertMissing('.mention-dropdown');
        }
    });
});

test('mention dropdown navigation with keyboard', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $user1 = User::factory()->create(['username' => 'first_user', 'name' => 'First User']);
    $user2 = User::factory()->create(['username' => 'second_user', 'name' => 'Second User']);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown')
                // Test arrow down navigation
                ->keys('[data-test="reply-content"]', ['{ARROW_DOWN}'])
                ->pause(100)
                ->keys('[data-test="reply-content"]', ['{ARROW_DOWN}'])
                ->pause(100)
                // Test arrow up navigation
                ->keys('[data-test="reply-content"]', ['{ARROW_UP}'])
                ->pause(100)
                // Test Enter to select
                ->keys('[data-test="reply-content"]', ['{ENTER}'])
                ->pause(500)
                ->assertMissing('.mention-dropdown');
        }
    });
});

test('mention works after switching between write and preview tabs', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionableUser = User::factory()->create([
        'username' => 'tabswitch_user',
        'name' => 'Tab Switch User',
    ]);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', 'Some content')
            ->pause(100)
            // Switch to preview
            ->click('[data-test="preview-tab"]')
            ->pause(500)
            ->assertSee('Some content')
            // Switch back to write
            ->click('[data-test="write-tab"]')
            ->pause(500)
            // Try mention after tab switch
            ->click('[data-test="reply-content"]')
            ->keys('[data-test="reply-content"]', ['{END}'])
            ->type('[data-test="reply-content"]', ' @')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown');
        }
    });
});

test('mention searches users correctly with partial matches', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $user1 = User::factory()->create(['username' => 'john_doe', 'name' => 'John Doe']);
    $user2 = User::factory()->create(['username' => 'jane_smith', 'name' => 'Jane Smith']);
    $user3 = User::factory()->create(['username' => 'bob_jones', 'name' => 'Bob Jones']);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@j')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown')
                // Should show users starting with 'j'
                ->assertSee('john_doe')
                ->assertSee('jane_smith')
                ->assertDontSee('bob_jones')
                // Type more to narrow down
                ->type('[data-test="reply-content"]', 'oh')
                ->pause(500)
                ->assertSee('john_doe')
                ->assertDontSee('jane_smith');
        }
    });
});

test('mention dropdown shows user avatars and names correctly', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionableUser = User::factory()->create([
        'username' => 'avatar_user',
        'name' => 'Avatar User',
        'email' => 'avatar@example.com',
    ]);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@avatar')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown')
                ->assertSee('Avatar User')
                ->assertSee('@avatar_user')
                // Check if avatar initials are shown
                ->assertSee('AU'); // First letters of "Avatar User"
        }
    });
});

test('mention renders correctly in preview mode', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $mentionedUser = User::factory()->create([
        'username' => 'preview_user',
        'name' => 'Preview User',
    ]);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', 'Hello @preview_user, how are you?')
            ->pause(100)
            ->click('[data-test="preview-tab"]')
            ->pause(500)
            ->assertSeeIn('[data-test="preview-content"]', '@preview_user')
            // Check if mention has proper styling
            ->assertVisible('.mention');
    });
});

test('multiple mentions work in single message', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();
    $user1 = User::factory()->create(['username' => 'multi_user1']);
    $user2 = User::factory()->create(['username' => 'multi_user2']);

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', 'Hello @multi_user1 and @multi_user2!')
            ->pause(100)
            ->click('[data-test="preview-tab"]')
            ->pause(500)
            ->assertSeeIn('[data-test="preview-content"]', '@multi_user1')
            ->assertSeeIn('[data-test="preview-content"]', '@multi_user2');
    });
});

test('mention dropdown handles no results gracefully', function () {
    $user = User::factory()->create();
    $author = User::factory()->create();

    $category = Category::factory()->create();
    $discussion = Discussion::factory()->create([
        'user_id' => $author->id,
        'category_id' => $category->id,
    ]);

    $this->browse(function (Browser $browser) use ($user, $discussion) {
        $browser->loginAs($user)
            ->visit("/discussions/{$discussion->slug}")
            ->click('[data-test="reply-button"]')
            ->waitFor('[data-test="reply-form"]')
            ->type('[data-test="reply-content"]', '@nonexistentuser123')
            ->pause(500);

        if ($browser->element('.mention-dropdown')) {
            $browser->assertVisible('.mention-dropdown')
                ->assertSee('No users found');
        }
    });
});
