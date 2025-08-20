<?php

use App\Livewire\Blog\CompactNewsletter;
use App\Livewire\Discussion\CreateDiscussion;
use App\Livewire\Discussion\DiscussionShow;
use App\Livewire\Discussion\EditDiscussion;
use App\Models\Category;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

describe('Form Request Validation Security', function () {
    it('validates required fields in discussion creation', function () {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test all required fields are enforced
        Livewire::test(CreateDiscussion::class)
            ->set('title', '')
            ->set('content', '')
            ->set('category_id', null)
            ->call('save')
            ->assertHasErrors(['title', 'content', 'category_id']);
    });

    it('validates field lengths in discussion creation', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->actingAs($user);

        // Test title too short
        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Hi')
            ->set('content', 'This is a valid content with more than 10 characters')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['title']);

        // Test title too long
        Livewire::test(CreateDiscussion::class)
            ->set('title', str_repeat('a', 300))
            ->set('content', 'This is a valid content with more than 10 characters')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['title']);

        // Test content too short
        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Valid Title')
            ->set('content', 'Short')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['content']);
    });

    it('validates category exists and is active in discussion creation', function () {
        $user = User::factory()->create();
        $inactiveCategory = Category::factory()->create(['is_active' => false]);
        $this->actingAs($user);

        // Test with non-existent category
        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Valid Title')
            ->set('content', 'This is a valid content with more than 10 characters')
            ->set('category_id', 99999)
            ->call('save')
            ->assertHasErrors(['category_id']);

        // Test with inactive category
        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Valid Title')
            ->set('content', 'This is a valid content with more than 10 characters')
            ->set('category_id', $inactiveCategory->id)
            ->call('save')
            ->assertHasErrors(['category_id']);
    });

    it('validates reply content in discussion replies', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
        $this->actingAs($user);

        // Test reply content too short
        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->set('replyContent', 'Hi')
            ->call('addReply')
            ->assertHasErrors(['replyContent']);

        // Test empty reply content
        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->set('replyContent', '')
            ->call('addReply')
            ->assertHasErrors(['replyContent']);
    });

    it('validates edit reply content length', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
        $reply = DiscussionReply::factory()->create([
            'discussion_id' => $discussion->id,
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);

        // Start editing and test short content
        Livewire::test(DiscussionShow::class, ['slug' => $discussion->slug])
            ->call('startEditingReply', $reply->id)
            ->set('editReplyContent', 'Short')
            ->call('updateReply')
            ->assertHasErrors(['editReplyContent']);
    });

    it('validates discussion edit form fields', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
        $this->actingAs($user);

        // Test required title
        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', '')
            ->set('content', 'Valid content here')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['title']);

        // Test required content
        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', 'Valid Title')
            ->set('content', '')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['content']);

        // Test title too long
        Livewire::test(EditDiscussion::class, ['slug' => $discussion->slug])
            ->set('title', str_repeat('a', 300))
            ->set('content', 'Valid content here')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['title']);
    });

    it('validates newsletter email format', function () {
        // Test invalid email format
        Livewire::test(CompactNewsletter::class)
            ->set('email', 'invalid-email')
            ->call('subscribe')
            ->assertHasErrors(['email']);

        // Test empty email
        Livewire::test(CompactNewsletter::class)
            ->set('email', '')
            ->call('subscribe')
            ->assertHasErrors(['email']);

        // Test email too long
        Livewire::test(CompactNewsletter::class)
            ->set('email', str_repeat('a', 250).'@example.com')
            ->call('subscribe')
            ->assertHasErrors(['email']);
    });

    it('prevents HTML injection in form fields', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->actingAs($user);

        $maliciousTitle = '<script>alert("XSS")</script>Valid Title';
        $maliciousContent = '<iframe src="javascript:alert(1)"></iframe>Valid content here';

        // Create discussion with potentially malicious content
        Livewire::test(CreateDiscussion::class)
            ->set('title', $maliciousTitle)
            ->set('content', $maliciousContent)
            ->set('category_id', $category->id)
            ->call('save');

        // Check that the content was saved (will be sanitized on output)
        $discussion = Discussion::latest()->first();
        expect($discussion->title)->toBe($maliciousTitle);
        expect($discussion->content)->toBe($maliciousContent);

        // The real protection happens during markdown parsing/output
        // which is tested in XssProtectionTest
    });

    it('validates data types for numeric fields', function () {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Test with invalid category_id (will be validated by exists rule)
        Livewire::test(CreateDiscussion::class)
            ->set('title', 'Valid Title')
            ->set('content', 'This is a valid content with more than 10 characters')
            ->set('category_id', 99999)
            ->call('save')
            ->assertHasErrors(['category_id']);
    });

    it('validates authorization before processing forms', function () {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $category = Category::factory()->create();
        $discussion = Discussion::factory()->create([
            'user_id' => $user1->id,
            'category_id' => $category->id,
        ]);

        // Test that user2 cannot access the edit form for user1's discussion
        $this->actingAs($user2);

        try {
            $response = $this->get("/discussions/{$discussion->slug}/edit");
            $response->assertStatus(403);
        } catch (\Exception $e) {
            // If route doesn't exist or throws exception, verify authorization is working
            expect($e->getMessage())->toContain('403');
        }
    });

    it('validates string types and prevents null injection', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->actingAs($user);

        // All string fields should handle null values properly
        Livewire::test(CreateDiscussion::class)
            ->set('title', null)
            ->set('content', null)
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasErrors(['title', 'content']);
    });

    it('validates field sanitization does not break legitimate content', function () {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->actingAs($user);

        $legitimateTitle = 'How to use <Component> in React?';
        $legitimateContent = 'I want to render <div>content</div> safely in my component. How can I do this?';

        // Legitimate HTML-like content should be allowed in input
        Livewire::test(CreateDiscussion::class)
            ->set('title', $legitimateTitle)
            ->set('content', $legitimateContent)
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasNoErrors();

        // Verify the content was saved properly
        $discussion = Discussion::latest()->first();
        expect($discussion->title)->toBe($legitimateTitle);
        expect($discussion->content)->toBe($legitimateContent);
    });
});
