<?php

use App\Models\Category;
use App\Models\Discussion;
use App\Models\User;

it('discussion show page includes markdown editor for replies', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Test Discussion for Markdown Editor',
        'content' => 'This is a test discussion content.',
    ]);

    $this->actingAs($user);
    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Check that markdown editor component is present
    $response->assertSeeLivewire('simple-markdown-editor');
    $response->assertSee('Add Your Reply');

    // Check that the markdown editor has the correct structure
    $response->assertSee('markdown-editor-wrapper', false);
    $response->assertSee('Write', false);
    $response->assertSee('Preview', false);
});

it('unauthenticated users cannot see reply form with markdown editor', function () {
    $user = User::factory()->create();
    $category = Category::first() ?? Category::factory()->create();

    $discussion = Discussion::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $response = $this->get(route('discussions.show', $discussion->slug));

    $response->assertStatus(200);

    // Should not see the markdown editor
    $response->assertDontSeeLivewire('simple-markdown-editor');
    $response->assertSee('You need to be logged in to reply');
});
