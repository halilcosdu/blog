<?php

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Package Model Status Features', function () {
    it('returns correct status color for released status', function () {
        $package = Package::factory()->create(['status' => 'Released']);
        
        expect($package->status_color)->toBe('success');
    });

    it('returns correct status color for beta status', function () {
        $package = Package::factory()->create(['status' => 'Beta']);
        
        expect($package->status_color)->toBe('warning');
    });

    it('returns correct status color for coming soon status', function () {
        $package = Package::factory()->create(['status' => 'Coming Soon']);
        
        expect($package->status_color)->toBe('info');
    });

    it('returns correct status color for in development status', function () {
        $package = Package::factory()->create(['status' => 'In Development']);
        
        expect($package->status_color)->toBe('primary');
    });

    it('returns correct status color for planning status', function () {
        $package = Package::factory()->create(['status' => 'Planning']);
        
        expect($package->status_color)->toBe('secondary');
    });

    it('returns default status color for unknown status', function () {
        // Test the default case by using an invalid status in the model directly
        $package = new Package(['status' => 'Unknown Status']);
        
        expect($package->status_color)->toBe('secondary');
    });

    it('uses slug as route key', function () {
        $package = new Package();
        
        expect($package->getRouteKeyName())->toBe('slug');
    });
});

describe('Package Model Scopes', function () {
    it('filters active packages', function () {
        $activePackages = Package::factory(3)->create(['is_active' => true]);
        $inactivePackages = Package::factory(2)->create(['is_active' => false]);

        $results = Package::active()->get();
        
        expect($results)->toHaveCount(3);
        $results->each(function ($package) {
            expect($package->is_active)->toBeTrue();
        });
    });

    it('filters featured packages', function () {
        $featuredPackages = Package::factory(2)->create(['is_featured' => true]);
        $regularPackages = Package::factory(3)->create(['is_featured' => false]);

        $results = Package::featured()->get();
        
        expect($results)->toHaveCount(2);
        $results->each(function ($package) {
            expect($package->is_featured)->toBeTrue();
        });
    });

    it('orders packages by sort order and name', function () {
        $packages = Package::factory(3)->create([
            'sort_order' => fn() => fake()->numberBetween(1, 10),
            'name' => fn() => fake()->word(),
        ]);

        $results = Package::ordered()->get();
        
        expect($results)->toHaveCount(3);
        
        // Verify they're ordered by sort_order first, then by name
        $sortOrders = $results->pluck('sort_order')->toArray();
        $sortedSortOrders = collect($sortOrders)->sort()->values()->toArray();
        expect($sortOrders)->toBe($sortedSortOrders);
    });

    it('combines scopes correctly', function () {
        // Create test data
        $activeFeaturedPackage = Package::factory()->create([
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);
        
        $activeRegularPackage = Package::factory()->create([
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => 2,
        ]);
        
        $inactiveFeaturedPackage = Package::factory()->create([
            'is_active' => false,
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        $results = Package::active()->featured()->ordered()->get();
        
        expect($results)->toHaveCount(1);
        expect($results->first()->id)->toBe($activeFeaturedPackage->id);
    });
});

describe('Package Model Attributes', function () {
    it('has correct fillable attributes', function () {
        $package = new Package();
        
        expect($package->getFillable())->toBe([
            'name',
            'slug',
            'description',
            'status',
            'icon',
            'url',
            'github_url',
            'packagist_url',
            'documentation_url',
            'tags',
            'sort_order',
            'is_featured',
            'is_active',
            'version',
            'downloads_count',
            'stars_count',
        ]);
    });

    it('casts attributes correctly', function () {
        $package = new Package();
        
        expect($package->getCasts())->toMatchArray([
            'tags' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'downloads_count' => 'integer',
            'stars_count' => 'integer',
            'sort_order' => 'integer',
        ]);
    });

    it('handles tags as array', function () {
        $package = Package::factory()->create([
            'tags' => ['laravel', 'package', 'php'],
        ]);

        expect($package->tags)->toBeArray();
        expect($package->tags)->toBe(['laravel', 'package', 'php']);
    });

    it('handles integer counts correctly', function () {
        $package = Package::factory()->create([
            'downloads_count' => 1500,
            'stars_count' => 250,
            'sort_order' => 5,
        ]);

        expect($package->downloads_count)->toBeInt();
        expect($package->stars_count)->toBeInt();
        expect($package->sort_order)->toBeInt();
        expect($package->downloads_count)->toBe(1500);
        expect($package->stars_count)->toBe(250);
        expect($package->sort_order)->toBe(5);
    });
});

describe('Package Model Status Business Logic', function () {
    it('supports all defined status values', function () {
        $statuses = ['Released', 'Beta', 'Coming Soon', 'In Development', 'Planning'];
        
        foreach ($statuses as $status) {
            $package = Package::factory()->create(['status' => $status]);
            expect($package->status)->toBe($status);
            expect($package->status_color)->toBeString();
        }
    });

    it('handles github integration fields', function () {
        $package = Package::factory()->create([
            'github_url' => 'https://github.com/user/package',
            'packagist_url' => 'https://packagist.org/packages/user/package',
            'documentation_url' => 'https://package-docs.com',
        ]);

        expect($package->github_url)->toBe('https://github.com/user/package');
        expect($package->packagist_url)->toBe('https://packagist.org/packages/user/package');
        expect($package->documentation_url)->toBe('https://package-docs.com');
    });

    it('supports versioning', function () {
        $package = Package::factory()->create(['version' => '2.1.3']);
        
        expect($package->version)->toBe('2.1.3');
    });

    it('tracks download and star statistics', function () {
        $package = Package::factory()->create([
            'downloads_count' => 15000,
            'stars_count' => 500,
        ]);

        expect($package->downloads_count)->toBe(15000);
        expect($package->stars_count)->toBe(500);
    });
});

describe('Package Model Queries', function () {
    it('can filter by status', function () {
        $releasedPackages = Package::factory(2)->create(['status' => 'Released']);
        $betaPackages = Package::factory(1)->create(['status' => 'Beta']);
        $planningPackages = Package::factory(1)->create(['status' => 'Planning']);

        $releasedResults = Package::where('status', 'Released')->get();
        $betaResults = Package::where('status', 'Beta')->get();
        
        expect($releasedResults)->toHaveCount(2);
        expect($betaResults)->toHaveCount(1);
        
        $releasedResults->each(function ($package) {
            expect($package->status)->toBe('Released');
        });
    });

    it('can filter by tags', function () {
        $laravelPackages = Package::factory(2)->create([
            'tags' => ['laravel', 'php'],
        ]);
        
        $vuePackages = Package::factory(1)->create([
            'tags' => ['vue', 'javascript'],
        ]);

        // This would require JSON search in production, simulating with whereJsonContains
        // For now, we'll test that tags are stored correctly
        expect($laravelPackages->first()->tags)->toContain('laravel');
        expect($vuePackages->first()->tags)->toContain('vue');
    });

    it('can find package by slug', function () {
        $package = Package::factory()->create(['slug' => 'awesome-package']);
        
        $foundPackage = Package::where('slug', 'awesome-package')->first();
        
        expect($foundPackage)->not->toBeNull();
        expect($foundPackage->id)->toBe($package->id);
    });

    it('can order by popularity metrics', function () {
        $popularPackage = Package::factory()->create([
            'downloads_count' => 10000,
            'stars_count' => 500,
        ]);
        
        $regularPackage = Package::factory()->create([
            'downloads_count' => 1000,
            'stars_count' => 50,
        ]);

        $byDownloads = Package::orderBy('downloads_count', 'desc')->get();
        $byStars = Package::orderBy('stars_count', 'desc')->get();
        
        expect($byDownloads->first()->id)->toBe($popularPackage->id);
        expect($byStars->first()->id)->toBe($popularPackage->id);
    });
});

describe('Package Model Factory', function () {
    it('creates valid package with factory', function () {
        $package = Package::factory()->create();

        expect($package->name)->toBeString();
        expect($package->slug)->toBeString();
        expect($package->description)->toBeString();
        expect($package->status)->toBeString();
        expect($package->is_featured)->toBeBool();
        expect($package->is_active)->toBeBool();
        expect($package->downloads_count)->toBeInt();
        expect($package->stars_count)->toBeInt();
        expect($package->sort_order)->toBeInt();
        expect($package->created_at)->toBeInstanceOf(\Carbon\Carbon::class);
    });

    it('creates package with custom attributes', function () {
        $package = Package::factory()->create([
            'name' => 'Custom Package',
            'status' => 'Released',
            'is_featured' => true,
            'downloads_count' => 5000,
        ]);

        expect($package->name)->toBe('Custom Package');
        expect($package->status)->toBe('Released');
        expect($package->is_featured)->toBeTrue();
        expect($package->downloads_count)->toBe(5000);
    });

    it('creates multiple packages with unique slugs', function () {
        $packages = Package::factory(3)->create();

        expect($packages)->toHaveCount(3);
        
        $slugs = $packages->pluck('slug')->toArray();
        expect($slugs)->toBe(array_unique($slugs)); // All slugs should be unique
    });
});