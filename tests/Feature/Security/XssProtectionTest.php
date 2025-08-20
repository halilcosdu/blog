<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

describe('XSS Protection in Markdown Content', function () {
    it('strips malicious HTML script tags from discussion content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Normal text <script>alert("XSS")</script> more text';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('<script>');
        expect($parsedContent)->not->toContain('alert("XSS")');
        expect($parsedContent)->toContain('Normal text');
        expect($parsedContent)->toContain('more text');
    });

    it('strips malicious HTML iframe tags from discussion content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Text with <iframe src="javascript:alert(1)"></iframe> embedded';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('<iframe');
        expect($parsedContent)->not->toContain('javascript:');
        expect($parsedContent)->toContain('Text with');
        expect($parsedContent)->toContain('embedded');
    });

    it('strips malicious HTML img tags with javascript URLs', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Image: <img src="javascript:alert(1)" onerror="alert(2)"> test';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('<img');
        expect($parsedContent)->not->toContain('javascript:');
        expect($parsedContent)->not->toContain('onerror');
        expect($parsedContent)->toContain('Image:');
        expect($parsedContent)->toContain('test');
    });

    it('prevents XSS through markdown link injection', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = '[Click me](javascript:alert("XSS")) and [another](data:text/html,<script>alert(1)</script>)';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('javascript:');
        expect($parsedContent)->not->toContain('data:text/html');
        expect($parsedContent)->toContain('Click me');
        expect($parsedContent)->toContain('another');
    });

    it('handles malicious mention patterns safely', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Hello @<script>alert("XSS")</script>user and @normal_user';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        // Process as done in the view
        $processedContent = preg_replace(
            '/@([a-zA-Z0-9._-]+)/',
            '<span class="mention inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">@$1</span>',
            Str::markdown($discussion->content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
        );

        expect($processedContent)->not->toContain('<script>');
        expect($processedContent)->not->toContain('alert("XSS")');
        expect($processedContent)->toContain('@normal_user');
    });

    it('strips HTML from discussion reply content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $maliciousContent = 'Reply with <script>alert("XSS")</script> malicious code';

        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($reply->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('<script>');
        expect($parsedContent)->not->toContain('alert("XSS")');
        expect($parsedContent)->toContain('Reply with');
        expect($parsedContent)->toContain('malicious code');
    });

    it('prevents XSS through HTML entities in content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Text with &lt;script&gt;alert("XSS")&lt;/script&gt; entities';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        // Should not execute as JavaScript
        expect($parsedContent)->not->toContain('alert("XSS")');
        expect($parsedContent)->toContain('Text with');
        expect($parsedContent)->toContain('entities');
    });

    it('safely handles markdown code blocks with potential XSS', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = "```html\n<script>alert('XSS')</script>\n```\nText after code block";

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        // Code in code blocks should be safe and not executed
        expect($parsedContent)->toContain('language-html');
        expect($parsedContent)->toContain('Text after code block');
        // The script tag should be inside a code block, not executable
        expect($parsedContent)->not->toMatch('/<script[^>]*>.*?alert.*?<\/script>/');
    });

    it('prevents XSS through CSS injection in style attributes', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'Text with <div style="background:url(javascript:alert(1))">styling</div>';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('style=');
        expect($parsedContent)->not->toContain('javascript:');
        expect($parsedContent)->toContain('Text with');
        expect($parsedContent)->toContain('styling');
    });

    it('prevents XSS through SVG injection', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $maliciousContent = 'SVG test: <svg onload="alert(1)"><script>alert(2)</script></svg>';

        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $maliciousContent,
        ]);

        $parsedContent = Str::markdown($discussion->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        expect($parsedContent)->not->toContain('<svg');
        expect($parsedContent)->not->toContain('onload');
        // SVG script content should be stripped, but text "alert" might remain
        expect($parsedContent)->not->toContain('<script>alert(2)</script>');
        expect($parsedContent)->toContain('SVG test:');
    });
});
