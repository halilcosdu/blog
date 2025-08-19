<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;

it('renders markdown content correctly in discussion show page', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $markdownContent = "# Test Header\n\n**Bold text** and *italic text*\n\n```php\n\$code = 'test';\n```\n\n- List item 1\n- List item 2";

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Markdown Discussion',
        'content' => $markdownContent,
    ]);

    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Check that markdown is parsed and rendered as HTML
    $response->assertSee('<h1>Test Header</h1>', false);
    $response->assertSee('<strong>Bold text</strong>', false);
    $response->assertSee('<em>italic text</em>', false);
    $response->assertSee('<code class="language-php">$code = \'test\';</code>', false);
    $response->assertSee('<li>List item 1</li>', false);
    $response->assertSee('<li>List item 2</li>', false);

    // Ensure raw markdown syntax is not visible
    $response->assertDontSee('# Test Header');
    $response->assertDontSee('**Bold text**');
    $response->assertDontSee('*italic text*');
});

it('strips unsafe HTML from markdown content', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $maliciousContent = "# Safe Header\n\n<script>alert('xss')</script>\n\n**Bold text**";

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Security Test Discussion',
        'content' => $maliciousContent,
    ]);

    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Check that HTML is stripped but markdown is still rendered
    $response->assertSee('<h1>Safe Header</h1>', false);
    $response->assertSee('<strong>Bold text</strong>', false);

    // Ensure script tag is stripped
    $response->assertDontSee('<script>', false);
    $response->assertDontSee('alert(', false);
});

it('renders markdown content in discussion replies', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $markdownReply = "## Reply Header\n\n*This is an italic reply* with `inline code`.";

    $reply = $discussion->replies()->create([
        'user_id' => $user->id,
        'content' => $markdownReply,
    ]);

    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Check that reply markdown is parsed
    $response->assertSee('<h2>Reply Header</h2>', false);
    $response->assertSee('<em>This is an italic reply</em>', false);
    $response->assertSee('<code>inline code</code>', false);

    // Ensure raw markdown syntax is not visible in replies
    $response->assertDontSee('## Reply Header');
    $response->assertDontSee('*This is an italic reply*');
});
