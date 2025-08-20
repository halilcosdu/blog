<?php

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Base Repository Interface', function () {
    it('implements repository interface', function () {
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        expect($repository)->toBeInstanceOf(RepositoryInterface::class);
    });
});

describe('Base Repository CRUD Operations', function () {
    it('can get all records', function () {
        $users = User::factory(3)->create();
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->all();

        expect($result)->toHaveCount(4);
        expect($result->first())->toBeInstanceOf(User::class);
    });

    it('can find record by id', function () {
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->find($user->id);

        expect($result)->toBeInstanceOf(User::class);
        expect($result->id)->toBe($user->id);
    });

    it('returns null when record not found', function () {
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->find(999);

        expect($result)->toBeNull();
    });

    it('can create new record', function () {
        $user = new User;
        $repository = new class($user) extends BaseRepository {};

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

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    });

    it('can update existing record', function () {
        $user = User::factory()->create(['name' => 'Old Name']);
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->update($user->id, ['name' => 'New Name']);

        expect($result)->toBeTrue();
        expect($user->fresh()->name)->toBe('New Name');
    });

    it('returns false when updating non-existent record', function () {
        $user = new User;
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->update(999, ['name' => 'Test']);

        expect($result)->toBeFalse();
    });

    it('can delete existing record', function () {
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->delete($user->id);

        expect($result)->toBeTrue();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    });

    it('returns false when deleting non-existent record', function () {
        $user = new User;
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->delete(999);

        expect($result)->toBeFalse();
    });

    it('can paginate records', function () {
        User::factory(25)->create();
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->paginate(10);

        expect($result->total())->toBe(26);
        expect($result->perPage())->toBe(10);
        expect($result->items())->toHaveCount(10);
    });

    it('uses default pagination when no limit specified', function () {
        User::factory(20)->create();
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->paginate();

        expect($result->perPage())->toBe(15);
    });
});

describe('Base Repository Model Management', function () {
    it('can get model instance', function () {
        $user = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $model = $repository->getModel();

        expect($model)->toBeInstanceOf(User::class);
        expect($model->id)->toBe($user->id);
    });

    it('can set model instance', function () {
        $originalUser = User::factory()->create();
        $newUser = User::factory()->create();
        $repository = new class($originalUser) extends BaseRepository {};

        $result = $repository->setModel($newUser);

        expect($result)->toBeInstanceOf(BaseRepository::class);
        expect($repository->getModel()->id)->toBe($newUser->id);
    });

    it('returns self when setting model for method chaining', function () {
        $user = User::factory()->create();
        $newUser = User::factory()->create();
        $repository = new class($user) extends BaseRepository {};

        $result = $repository->setModel($newUser);

        expect($result)->toBe($repository);
    });
});
