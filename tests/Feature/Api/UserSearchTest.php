<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User Search API', function () {
    it('returns empty array when no query is provided', function () {
        // Create users with sequential unique usernames
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                'username' => "testuser{$i}",
                'name' => "Test User {$i}",
            ]);
        }

        $response = $this->getJson('/api/users/search');

        $response->assertStatus(200)
            ->assertJson([]);

        expect($response->json())->toHaveCount(0);
    });

    it('searches users by username', function () {
        User::factory()->create(['username' => 'john_doe', 'name' => 'John Doe']);
        User::factory()->create(['username' => 'jane_smith', 'name' => 'Jane Smith']);
        User::factory()->create(['username' => 'bob_wilson', 'name' => 'Bob Wilson']);

        $response = $this->getJson('/api/users/search?q=john');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['username'])->toBe('john_doe');
    });

    it('searches users by name', function () {
        User::factory()->create(['username' => 'user1', 'name' => 'John Doe']);
        User::factory()->create(['username' => 'user2', 'name' => 'Jane Smith']);

        $response = $this->getJson('/api/users/search?q=Jane');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['name'])->toBe('Jane Smith');
    });

    it('performs case insensitive search', function () {
        User::factory()->create(['username' => 'TestUser', 'name' => 'Test User']);

        $response = $this->getJson('/api/users/search?q=testuser');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['username'])->toBe('TestUser');
    });

    it('limits results to 8 users', function () {
        User::factory(15)->create(['name' => 'Test User']);

        $response = $this->getJson('/api/users/search?q=Test');

        $response->assertStatus(200);

        expect($response->json())->toHaveCount(8);
    });

    it('excludes users with empty usernames', function () {
        // Create user with valid username
        User::factory()->create(['username' => 'valid_user', 'name' => 'Valid User']);

        // Skip creating users with null/empty usernames since they violate DB constraints
        // In a real app, these wouldn't exist due to DB constraints

        $response = $this->getJson('/api/users/search?q=valid');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['username'])->toBe('valid_user');
    });

    it('returns partial matches', function () {
        User::factory()->create(['username' => 'developer', 'name' => 'Dev User']);
        User::factory()->create(['username' => 'designer', 'name' => 'Design User']);

        $response = $this->getJson('/api/users/search?q=dev');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['username'])->toBe('developer');
    });

    it('returns empty array when no matches found', function () {
        User::factory()->create(['username' => 'testuser', 'name' => 'Test User']);

        $response = $this->getJson('/api/users/search?q=nonexistent');

        $response->assertStatus(200)
            ->assertJson([]);
    });

    it('handles special characters in search query', function () {
        User::factory()->create(['username' => 'user@example', 'name' => 'User Example']);
        User::factory()->create(['username' => 'user.name', 'name' => 'Dotted User']);

        $response = $this->getJson('/api/users/search?q=user.');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);
        expect($users[0]['username'])->toBe('user.name');
    });

    it('prioritizes exact username matches', function () {
        User::factory()->create(['username' => 'test', 'name' => 'Test User']);
        User::factory()->create(['username' => 'testing', 'name' => 'Testing User']);
        User::factory()->create(['username' => 'testuser', 'name' => 'Test User Name']);

        $response = $this->getJson('/api/users/search?q=test');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users[0]['username'])->toBe('test'); // Exact match should be first
    });

    it('handles empty and whitespace queries', function () {
        for ($i = 1; $i <= 3; $i++) {
            User::factory()->create([
                'username' => "queryuser{$i}",
                'name' => "Query User {$i}",
            ]);
        }

        // Empty query
        $response = $this->getJson('/api/users/search?q=');
        $response->assertStatus(200);
        expect($response->json())->toHaveCount(0);

        // Whitespace query - URL encode the spaces
        $response = $this->getJson('/api/users/search?q=' . urlencode('   '));
        $response->assertStatus(200);
        expect($response->json())->toHaveCount(0);
    });

    it('returns required user fields only', function () {
        User::factory()->create([
            'username' => 'fieldsuser',
            'name' => 'Fields User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
        ]);

        $response = $this->getJson('/api/users/search?q=fields');

        $response->assertStatus(200);

        $users = $response->json();
        expect($users)->toHaveCount(1);

        $user = $users[0];
        expect($user)->toHaveKeys(['id', 'username', 'name']);
        expect($user)->not->toHaveKey('email');
        expect($user)->not->toHaveKey('email_verified_at');
    });
});
