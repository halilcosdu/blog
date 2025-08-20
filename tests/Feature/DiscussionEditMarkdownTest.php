<?php

use App\Livewire\Discussion\EditDiscussion;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('Discussion Edit Markdown Editor Integration', function () {
    it('displays markdown editor component in edit page', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => 'This is **existing** content that should be displayed in the editor.',
        ]);

        $this->actingAs($user);

        $response = $this->get("/discussions/{$discussion->slug}/edit");
        $response->assertSuccessful();

        // Check for markdown editor specific elements (rendered HTML)
        $response->assertSee('markdown-editor-wrapper');
        $response->assertSee('You can use **bold**, *italic*, @mentions, and ```code blocks```!');
        $response->assertSee('Discussion Content');
        $response->assertSee('editor-toolbar');
        $response->assertSee('Write');
        $response->assertSee('Preview');

        // Check that existing content is passed to the component
        $response->assertSee('This is **existing** content that should be displayed in the editor.');
    });

    it('handles mention integration in markdown editor', function () {
        $user = User::factory()->create();
        $mentionedUser = User::factory()->create(['username' => 'testuser123']);
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $contentWithMentions = 'Hello @testuser123, what do you think about this **important** topic?';

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);

        // Simulate the SimpleMarkdownEditor updating the content
        $component->dispatch('content-updated', name: 'content', content: $contentWithMentions);

        $component->call('save')
            ->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($contentWithMentions);
    });

    it('preserves code blocks in markdown content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $codeBlockContent = "Here's a Laravel example:\n\n```php\n<?php\n\nclass UserController extends Controller\n{\n    public function index()\n    {\n        return User::all();\n    }\n}\n```\n\nWhat do you think?";

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $codeBlockContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($codeBlockContent);
    });

    it('handles bold and italic markdown syntax', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $styledContent = 'This is **very important** and this is *emphasized*. Also ***bold and italic***.';

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $styledContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($styledContent);
    });

    it('preserves list formatting in markdown', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $listContent = "Here are the main points:\n\n- First item\n- Second item with **bold**\n- Third item with @mention\n\nAnd numbered list:\n\n1. Step one\n2. Step two\n3. Step three";

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $listContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($listContent);
    });

    it('handles link syntax in markdown', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $linkContent = 'Check out [Laravel Documentation](https://laravel.com/docs) and also [this discussion](https://example.com/discussion).';

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $linkContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($linkContent);
    });

    it('preserves blockquote formatting', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $quoteContent = "As someone once said:\n\n> This is a quoted text\n> that spans multiple lines\n> and has **formatting**\n\nWhat are your thoughts?";

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $quoteContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($quoteContent);
    });

    it('handles mixed markdown content with all features', function () {
        $user = User::factory()->create();
        $mentionedUser = User::factory()->create(['username' => 'developer123']);
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $complexContent = <<<'MARKDOWN'
# Main Question

I'm having trouble with **Laravel Eloquent** relationships. Here's my current setup:

## Code Example

```php
class User extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

## Issues I'm facing:

1. **Performance** - queries are slow
2. *Memory usage* - too high
3. Relationships not loading properly

> I've tried various approaches but nothing seems to work effectively.

@developer123 could you please help me with this?

Here are some useful links:
- [Laravel Docs](https://laravel.com/docs/eloquent-relationships)
- [Stack Overflow Discussion](https://stackoverflow.com/questions/laravel-eloquent)

***Thanks in advance!***
MARKDOWN;

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $complexContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($complexContent);
    });

    it('updates content through direct property setting', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => 'Original content',
        ]);

        $this->actingAs($user);

        $newContent = 'Updated content with **markdown** and @mentions!';

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $newContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($newContent);
    });

    it('handles empty content updates gracefully', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => 'Original content',
        ]);

        $this->actingAs($user);

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: '');
        $component->call('save')->assertHasErrors(['content']); // Should validate as required
    });

    it('preserves special characters in markdown content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $specialContent = 'Special chars: & < > " \' àáâãäåæç @user123 **bold** `code` [link](url)';

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $specialContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($specialContent);
    });

    it('handles line breaks and paragraphs correctly', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $paragraphContent = "First paragraph with some text.\n\nSecond paragraph with **bold text**.\n\nThird paragraph with @mention and `code`.\n\n\nFourth paragraph after extra line breaks.";

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: $paragraphContent);
        $component->call('save')->assertHasNoErrors();

        expect($discussion->fresh()->content)->toBe($paragraphContent);
    });

    it('validates content is required even with markdown editor', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        $component = Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug]);
        $component->dispatch('content-updated', name: 'content', content: '');
        $component->call('save')->assertHasErrors(['content']);
    });
});
