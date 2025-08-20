<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('User Repository CRUD Operations', function () {
    it('extends base repository', function () {
        $user = User::factory()->create();
        $repository = new UserRepository($user);
        
        expect($repository)->toBeInstanceOf(\App\Repositories\BaseRepository::class);
    });
    
    it('can create user through repository', function () {
        $user = new User();
        $repository = new UserRepository($user);
        
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => bcrypt('password'),
        ];
        
        $result = $repository->create($data);
        
        expect($result)->toBeInstanceOf(User::class);
        expect($result->name)->toBe('Test User');
        expect($result->email)->toBe('test@example.com');
    });
});

describe('User Repository Top Authors', function () {
    it('gets top authors by published post count', function () {
        $category = Category::factory()->create();
        
        $author1 = User::factory()->create();
        $author2 = User::factory()->create();
        $author3 = User::factory()->create();
        $userWithoutPosts = User::factory()->create();
        
        // Author 1: 5 published posts
        Post::factory(5)->create([
            'user_id' => $author1->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        // Author 2: 3 published posts
        Post::factory(3)->create([
            'user_id' => $author2->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        // Author 3: 1 published post
        Post::factory(1)->create([
            'user_id' => $author3->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getTopAuthors(3);
        
        expect($result)->toHaveCount(3);
        expect($result->get(0)->id)->toBe($author1->id);
        expect($result->get(0)->posts_count)->toBe(5);
        expect($result->get(1)->id)->toBe($author2->id);
        expect($result->get(1)->posts_count)->toBe(3);
        expect($result->get(2)->id)->toBe($author3->id);
        expect($result->get(2)->posts_count)->toBe(1);
    });
    
    it('excludes users without published posts from top authors', function () {
        $category = Category::factory()->create();
        
        $authorWithPosts = User::factory()->create();
        $authorWithoutPosts = User::factory()->create();
        $authorWithUnpublishedPosts = User::factory()->create();
        
        Post::factory(3)->create([
            'user_id' => $authorWithPosts->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(2)->create([
            'user_id' => $authorWithUnpublishedPosts->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getTopAuthors(5);
        
        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($authorWithPosts->id);
    });
    
    it('respects limit parameter for top authors', function () {
        $category = Category::factory()->create();
        
        $authors = User::factory(5)->create();
        
        foreach ($authors as $index => $author) {
            Post::factory($index + 1)->create([
                'user_id' => $author->id,
                'category_id' => $category->id,
                'is_published' => true,
            ]);
        }
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getTopAuthors(2);
        
        expect($result)->toHaveCount(2);
    });
    
    it('handles database driver differences for top authors query', function () {
        $category = Category::factory()->create();
        $author = User::factory()->create();
        
        Post::factory(3)->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getTopAuthors(1);
        
        expect($result)->toHaveCount(1);
        expect($result->first()->posts_count)->toBe(3);
    });
    
    it('orders top authors by post count descending', function () {
        $category = Category::factory()->create();
        
        $author1 = User::factory()->create();
        $author2 = User::factory()->create();
        
        Post::factory(2)->create([
            'user_id' => $author1->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(5)->create([
            'user_id' => $author2->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getTopAuthors(2);
        
        expect($result->first()->id)->toBe($author2->id); // 5 posts
        expect($result->last()->id)->toBe($author1->id); // 2 posts
    });
});

describe('User Repository Email Lookup', function () {
    it('finds user by email', function () {
        $user = User::factory()->create(['email' => 'test@example.com']);
        $otherUser = User::factory()->create(['email' => 'other@example.com']);
        
        $userModel = new User();
        $repository = new UserRepository($userModel);
        
        $result = $repository->findByEmail('test@example.com');
        
        expect($result)->toBeInstanceOf(User::class);
        expect($result->id)->toBe($user->id);
        expect($result->email)->toBe('test@example.com');
    });
    
    it('returns null when email not found', function () {
        User::factory()->create(['email' => 'existing@example.com']);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->findByEmail('nonexistent@example.com');
        
        expect($result)->toBeNull();
    });
    
    it('email lookup is case sensitive', function () {
        $user = User::factory()->create(['email' => 'test@example.com']);
        
        $userModel = new User();
        $repository = new UserRepository($userModel);
        
        $result = $repository->findByEmail('TEST@EXAMPLE.COM');
        
        expect($result)->toBeNull(); // Should be case sensitive
    });
});

describe('User Repository Authors List', function () {
    it('gets all users who have published posts', function () {
        $category = Category::factory()->create();
        
        $authorWithPosts = User::factory()->create();
        $authorWithoutPosts = User::factory()->create();
        $authorWithUnpublishedPosts = User::factory()->create();
        
        Post::factory(3)->create([
            'user_id' => $authorWithPosts->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(2)->create([
            'user_id' => $authorWithUnpublishedPosts->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getAuthors();
        
        expect($result)->toHaveCount(1);
        expect($result->first()->id)->toBe($authorWithPosts->id);
    });
    
    it('includes post counts for authors', function () {
        $category = Category::factory()->create();
        $author = User::factory()->create();
        
        Post::factory(5)->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(3)->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getAuthors();
        
        expect($result->first()->posts_count)->toBe(5); // Only published posts
    });
    
    it('orders authors by post count descending', function () {
        $category = Category::factory()->create();
        
        $author1 = User::factory()->create();
        $author2 = User::factory()->create();
        $author3 = User::factory()->create();
        
        Post::factory(2)->create([
            'user_id' => $author1->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(5)->create([
            'user_id' => $author2->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(1)->create([
            'user_id' => $author3->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getAuthors();
        
        expect($result->get(0)->id)->toBe($author2->id); // 5 posts
        expect($result->get(1)->id)->toBe($author1->id); // 2 posts
        expect($result->get(2)->id)->toBe($author3->id); // 1 post
    });
    
    it('returns empty collection when no authors have published posts', function () {
        $category = Category::factory()->create();
        
        $users = User::factory(3)->create();
        
        foreach ($users as $user) {
            Post::factory(2)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'is_published' => false,
            ]);
        }
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getAuthors();
        
        expect($result)->toHaveCount(0);
    });
    
    it('counts only published posts for each author', function () {
        $category = Category::factory()->create();
        $author = User::factory()->create();
        
        Post::factory(3)->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'is_published' => true,
        ]);
        
        Post::factory(7)->create([
            'user_id' => $author->id,
            'category_id' => $category->id,
            'is_published' => false,
        ]);
        
        $user = new User();
        $repository = new UserRepository($user);
        
        $result = $repository->getAuthors();
        
        expect($result->first()->posts_count)->toBe(3); // Only published posts
    });
});