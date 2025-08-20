<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User Search API Endpoint', function () {
    it('returns user search results in JSON format', function () {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
        ]);

        $response = $this->getJson('/api/users/search?q=john');

        $response->assertSuccessful()
            ->assertJson([
                [
                    'id' => $user->id,
                    'name' => 'John Doe',
                    'username' => 'johndoe',
                ],
            ]);
    });

    it('searches users by name', function () {
        $matchingUser = User::factory()->create(['name' => 'Laravel Expert']);
        $nonMatchingUser = User::factory()->create(['name' => 'Vue Developer']);

        $response = $this->getJson('/api/users/search?q=Laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($matchingUser->id);
        expect($data[0]['name'])->toBe('Laravel Expert');
    });

    it('searches users by username', function () {
        $matchingUser = User::factory()->create([
            'name' => 'John Smith',
            'username' => 'laravel_dev',
        ]);
        $nonMatchingUser = User::factory()->create([
            'name' => 'Jane Doe',
            'username' => 'vue_expert',
        ]);

        $response = $this->getJson('/api/users/search?q=laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($matchingUser->id);
        expect($data[0]['username'])->toBe('laravel_dev');
    });

    it('performs case insensitive search', function () {
        $user = User::factory()->create([
            'name' => 'Laravel Expert',
            'username' => 'laravel_dev',
        ]);

        $response = $this->getJson('/api/users/search?q=LARAVEL');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($user->id);
    });

    it('searches partial matches in name and username', function () {
        $user = User::factory()->create([
            'name' => 'Laravel Expert',
            'username' => 'dev_laravel_expert',
        ]);

        $response = $this->getJson('/api/users/search?q=expert');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($user->id);
    });

    it('returns both name and username matches', function () {
        $nameMatch = User::factory()->create([
            'name' => 'Laravel Developer',
            'username' => 'john_smith',
        ]);

        $usernameMatch = User::factory()->create([
            'name' => 'Jane Doe',
            'username' => 'laravel_expert',
        ]);

        $noMatch = User::factory()->create([
            'name' => 'Vue Developer',
            'username' => 'vue_dev',
        ]);

        $response = $this->getJson('/api/users/search?q=laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(2);

        $ids = collect($data)->pluck('id')->toArray();
        expect($ids)->toContain($nameMatch->id);
        expect($ids)->toContain($usernameMatch->id);
        expect($ids)->not->toContain($noMatch->id);
    });

    it('limits results to 8 users maximum', function () {
        User::factory(15)->create([
            'name' => fn () => 'Laravel '.fake()->name(),
        ]);

        $response = $this->getJson('/api/users/search?q=laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(8);
    });

    it('returns only required fields id name and username', function () {
        $user = User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);

        $response = $this->getJson('/api/users/search?q=test');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data[0])->toHaveKeys(['id', 'name', 'username']);
        expect($data[0])->not->toHaveKey('email');
        expect($data[0])->not->toHaveKey('password');
        expect($data[0])->not->toHaveKey('created_at');
        expect($data[0])->not->toHaveKey('updated_at');
    });

    it('returns empty array when no query parameter provided', function () {
        User::factory(3)->create();

        $response = $this->getJson('/api/users/search');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toBeArray();
        expect($data)->toHaveCount(0);
    });

    it('returns empty array when query is empty string', function () {
        User::factory(3)->create();

        $response = $this->getJson('/api/users/search?q=');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toBeArray();
        expect($data)->toHaveCount(0);
    });

    it('returns empty array when query is less than 2 characters', function () {
        User::factory()->create(['name' => 'A User', 'username' => 'a']);

        $response = $this->getJson('/api/users/search?q=a');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toBeArray();
        expect($data)->toHaveCount(0);
    });

    it('requires minimum 2 characters for search', function () {
        User::factory()->create(['name' => 'AB User', 'username' => 'ab']);

        $response = $this->getJson('/api/users/search?q=ab');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
    });

    it('has rate limiting protection', function () {
        User::factory()->create(['name' => 'Test User']);

        // Make multiple requests
        for ($i = 0; $i < 61; $i++) {
            $response = $this->getJson('/api/users/search?q=test');
        }

        // 61st request should be rate limited
        $response->assertStatus(429);
    });

    it('returns empty array when no users match search query', function () {
        User::factory()->create([
            'name' => 'Vue Developer',
            'username' => 'vue_dev',
        ]);

        $response = $this->getJson('/api/users/search?q=laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toBeArray();
        expect($data)->toHaveCount(0);
    });

    it('handles special characters in search query', function () {
        $user = User::factory()->create([
            'name' => 'Laravel & Vue Expert',
            'username' => 'full_stack_dev',
        ]);

        $response = $this->getJson('/api/users/search?q='.urlencode('Laravel & Vue'));

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($user->id);
    });

    it('handles unicode characters in search query', function () {
        $user = User::factory()->create([
            'name' => 'José María',
            'username' => 'jose_maria',
        ]);

        $response = $this->getJson('/api/users/search?q=José');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(1);
        expect($data[0]['id'])->toBe($user->id);
    });

    it('returns users ordered consistently', function () {
        $users = User::factory(5)->create([
            'name' => fn () => 'Laravel '.fake()->name(),
        ]);

        $response = $this->getJson('/api/users/search?q=laravel');

        $response->assertSuccessful();
        $data = $response->json();

        expect($data)->toHaveCount(5);

        // Make same request again to ensure consistent ordering
        $response2 = $this->getJson('/api/users/search?q=laravel');
        $data2 = $response2->json();

        expect(collect($data)->pluck('id')->toArray())
            ->toBe(collect($data2)->pluck('id')->toArray());
    });

    it('is accessible via GET request', function () {
        $user = User::factory()->create(['name' => 'Test User']);

        $response = $this->get('/api/users/search?q=test');

        $response->assertSuccessful();
        $response->assertHeader('Content-Type', 'application/json');
    });

    it('has correct route name', function () {
        expect(route('api.users.search'))->toBe(url('/api/users/search'));
    });
});
