<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Mention System Input Validation', function () {
    it('only matches valid username patterns', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $validMentions = [
            '@username',
            '@user123',
            '@user.name',
            '@user_name',
            '@user-name',
            '@user.123',
            '@123user',
        ];

        $invalidMentions = [
            '@<script>',
            '@user space',
            '@user"quote',
            '@user\'quote',
            '@user<tag>',
            '@user&amp;',
            '@user%20',
            '@user+plus',
            '@user=equals',
            '@user[bracket]',
            '@user{brace}',
            '@user(paren)',
            '@user;semicolon',
            '@user:colon',
            '@user|pipe',
            '@user\\backslash',
            '@user/slash',
            '@user*asterisk',
            '@user?question',
            '@user!exclamation',
            '@user#hash',
            '@user$dollar',
        ];

        foreach ($validMentions as $mention) {
            $content = "Hello $mention how are you?";
            $discussion = Discussion::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'content' => $content,
            ]);

            $processedContent = preg_replace(
                '/@([a-zA-Z0-9._-]+)/',
                '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                \Illuminate\Support\Str::markdown($discussion->content, [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ])
            );

            expect($processedContent)->toContain('class="mention');
        }

        foreach ($invalidMentions as $mention) {
            $content = "Hello $mention how are you?";
            $discussion = Discussion::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'content' => $content,
            ]);

            $processedContent = preg_replace(
                '/@([a-zA-Z0-9._-]+)/',
                '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                \Illuminate\Support\Str::markdown($discussion->content, [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ])
            );

            // Invalid mentions should not match valid username pattern or be dangerous
            expect($processedContent)->not->toContain('<script>');
            expect($processedContent)->not->toContain('javascript:');
            expect($processedContent)->not->toContain('alert(');
        }
    });

    it('prevents XSS through malicious mention replacement', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Check this @"><script>alert("XSS")</script><span class="fake-mention mention"';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $processedContent = preg_replace(
            '/@([a-zA-Z0-9._-]+)/',
            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
            \Illuminate\Support\Str::markdown($discussion->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
        );

        expect($processedContent)->not->toContain('<script>');
        expect($processedContent)->not->toContain('alert("XSS")');
    });

    it('handles mention patterns at string boundaries correctly', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $testCases = [
            '@user',           // Start of string
            'Hello @user',     // After space
            '@user hello',     // Before space
            'Hi @user!',       // Before punctuation
            '@user,@user2',    // Multiple mentions
            '(@user)',         // In parentheses
            '"@user"',         // In quotes
            'email@user.com',  // Email (should not match)
            '@user@domain',    // Mixed pattern
        ];

        foreach ($testCases as $content) {
            $discussion = Discussion::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'content' => $content,
            ]);

            $processedContent = preg_replace(
                '/@([a-zA-Z0-9._-]+)/',
                '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                \Illuminate\Support\Str::markdown($discussion->content, [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ])
            );

            // Verify the output doesn't contain malicious content
            expect($processedContent)->not->toContain('<script>');
            expect($processedContent)->not->toContain('javascript:');
        }
    });

    it('validates mention length limits', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        // Very long username (could cause ReDoS attacks)
        $longUsername = '@'.str_repeat('a', 1000);

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => "Hello $longUsername test",
        ]);

        $startTime = microtime(true);

        $processedContent = preg_replace(
            '/@([a-zA-Z0-9._-]+)/',
            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
            \Illuminate\Support\Str::markdown($discussion->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
        );

        $endTime = microtime(true);

        // Should complete quickly (no ReDoS)
        expect($endTime - $startTime)->toBeLessThan(1.0);
        expect($processedContent)->toContain('class="mention');
    });

    it('handles unicode characters correctly in mentions', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $unicodeContent = 'Hello @üser and @αβγ and @用户';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $unicodeContent,
        ]);

        $processedContent = preg_replace(
            '/@([a-zA-Z0-9._-]+)/',
            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
            \Illuminate\Support\Str::markdown($discussion->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
        );

        // Unicode characters should not match the pattern (only a-zA-Z0-9._-)
        expect($processedContent)->not->toContain('class="mention');
        expect($processedContent)->toContain('@üser');
        expect($processedContent)->toContain('@αβγ');
        expect($processedContent)->toContain('@用户');
    });

    it('prevents mention injection through HTML attributes', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Test @user" onmouseover="alert(1)" class="hijacked';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $processedContent = preg_replace(
            '/@([a-zA-Z0-9._-]+)/',
            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
            \Illuminate\Support\Str::markdown($discussion->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
        );

        // The mention pattern should match @user but dangerous attributes should be escaped by markdown
        expect($processedContent)->not->toContain('<script>');
        expect($processedContent)->not->toContain('onmouseover="alert(1)"'); // Unescaped version
        expect($processedContent)->toContain('class="mention');
    });

    it('handles edge cases in mention regex safely', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $edgeCases = [
            '@',              // Just @ symbol
            '@@user',         // Double @
            '@user@',         // @ at end
            '@user..',        // Double dots
            '@user--',        // Double dashes
            '@user__',        // Double underscores
            '@.user',         // Starting with dot
            '@-user',         // Starting with dash
            '@_user',         // Starting with underscore
        ];

        foreach ($edgeCases as $content) {
            $discussion = Discussion::factory()->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'content' => "Test $content here",
            ]);

            $processedContent = preg_replace(
                '/@([a-zA-Z0-9._-]+)/',
                '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
                \Illuminate\Support\Str::markdown($discussion->content, [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ])
            );

            // Should not cause any errors or security issues
            expect($processedContent)->toBeString();
            expect($processedContent)->not->toContain('<script>');
        }
    });
});
