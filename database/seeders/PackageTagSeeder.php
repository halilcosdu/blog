<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageTagSeeder extends Seeder
{
    public function run(): void
    {
        // Mevcut packageları al
        $packages = Package::all();
        
        if ($packages->isEmpty()) {
            $this->command->info('No packages found. Creating sample packages with tags...');
            
            // Örnek packagelar oluştur
            $samplePackages = [
                [
                    'name' => 'Laravel Debugbar',
                    'slug' => 'laravel-debugbar',
                    'description' => 'Laravel için güçlü bir debug araç çubuğu',
                    'status' => 'Released',
                    'url' => 'https://github.com/barryvdh/laravel-debugbar',
                    'github_url' => 'https://github.com/barryvdh/laravel-debugbar',
                    'packagist_url' => 'https://packagist.org/packages/barryvdh/laravel-debugbar',
                    'version' => '3.9.2',
                    'is_featured' => true,
                    'is_active' => true,
                    'tags' => ['Laravel', 'PHP', 'Debugging', 'Development']
                ],
                [
                    'name' => 'Laravel Horizon',
                    'slug' => 'laravel-horizon',
                    'description' => 'Laravel için Redis queue dashboard',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/horizon',
                    'github_url' => 'https://github.com/laravel/horizon',
                    'packagist_url' => 'https://packagist.org/packages/laravel/horizon',
                    'version' => '5.21.3',
                    'is_featured' => true,
                    'is_active' => true,
                    'tags' => ['Laravel', 'Queue', 'Redis', 'Monitoring']
                ],
                [
                    'name' => 'Laravel Telescope',
                    'slug' => 'laravel-telescope',
                    'description' => 'Laravel için debug yardımcısı',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/telescope',
                    'github_url' => 'https://github.com/laravel/telescope',
                    'packagist_url' => 'https://packagist.org/packages/laravel/telescope',
                    'version' => '4.17.0',
                    'is_featured' => true,
                    'is_active' => true,
                    'tags' => ['Laravel', 'PHP', 'Debugging', 'Monitoring']
                ],
                [
                    'name' => 'Laravel Sanctum',
                    'slug' => 'laravel-sanctum',
                    'description' => 'Laravel için API kimlik doğrulama',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/sanctum',
                    'github_url' => 'https://github.com/laravel/sanctum',
                    'packagist_url' => 'https://packagist.org/packages/laravel/sanctum',
                    'version' => '3.3.3',
                    'is_featured' => true,
                    'is_active' => true,
                    'tags' => ['Laravel', 'API', 'Authentication', 'Security']
                ],
                [
                    'name' => 'Spatie Laravel Permission',
                    'slug' => 'spatie-laravel-permission',
                    'description' => 'Laravel için role ve permission yönetimi',
                    'status' => 'Released',
                    'url' => 'https://spatie.be/docs/laravel-permission',
                    'github_url' => 'https://github.com/spatie/laravel-permission',
                    'packagist_url' => 'https://packagist.org/packages/spatie/laravel-permission',
                    'version' => '6.4.0',
                    'is_featured' => false,
                    'is_active' => true,
                    'tags' => ['Laravel', 'Authorization', 'Security', 'PHP']
                ],
                [
                    'name' => 'Laravel Cashier',
                    'slug' => 'laravel-cashier',
                    'description' => 'Stripe billing entegrasyonu',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/billing',
                    'github_url' => 'https://github.com/laravel/cashier',
                    'packagist_url' => 'https://packagist.org/packages/laravel/cashier',
                    'version' => '14.14.0',
                    'is_featured' => false,
                    'is_active' => true,
                    'tags' => ['Laravel', 'Payment', 'Stripe', 'Billing']
                ],
                [
                    'name' => 'Laravel Scout',
                    'slug' => 'laravel-scout',
                    'description' => 'Laravel için full-text search',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/scout',
                    'github_url' => 'https://github.com/laravel/scout',
                    'packagist_url' => 'https://packagist.org/packages/laravel/scout',
                    'version' => '10.6.1',
                    'is_featured' => false,
                    'is_active' => true,
                    'tags' => ['Laravel', 'Search', 'Elasticsearch', 'PHP']
                ],
                [
                    'name' => 'Laravel Socialite',
                    'slug' => 'laravel-socialite',
                    'description' => 'OAuth provider entegrasyonu',
                    'status' => 'Released',
                    'url' => 'https://laravel.com/docs/socialite',
                    'github_url' => 'https://github.com/laravel/socialite',
                    'packagist_url' => 'https://packagist.org/packages/laravel/socialite',
                    'version' => '5.11.0',
                    'is_featured' => false,
                    'is_active' => true,
                    'tags' => ['Laravel', 'OAuth', 'Authentication', 'Social']
                ]
            ];
            
            foreach ($samplePackages as $packageData) {
                $tags = $packageData['tags'];
                unset($packageData['tags']);
                
                $package = Package::create($packageData);
                $package->syncTags($tags);
            }
        } else {
            // Mevcut packagelara rastgele taglar ata
            $this->command->info('Assigning tags to existing packages...');
            
            $tagGroups = [
                ['Laravel', 'PHP', 'Tool'],
                ['Vue.js', 'JavaScript', 'Library'],
                ['React', 'JavaScript', 'Component'],
                ['Tailwind CSS', 'CSS', 'Framework'],
                ['Laravel', 'Testing', 'PHP'],
                ['API', 'Laravel', 'Package'],
                ['Security', 'PHP', 'Laravel'],
                ['Performance', 'Laravel', 'Optimization'],
                ['Database', 'Laravel', 'MySQL'],
                ['DevOps', 'Docker', 'Tool']
            ];
            
            foreach ($packages as $index => $package) {
                $tagGroup = $tagGroups[$index % count($tagGroups)];
                $package->syncTags($tagGroup);
                $this->command->info("Assigned tags to package: {$package->name}");
            }
        }
    }
}