<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcı
        User::factory()->create([
            'type' => 1,
            'name' => 'Halil Coşdu',
            'username' => 'halilcosdu',
            'email' => 'admin@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // İçerik üreticileri
        User::factory()->create([
            'type' => 1,
            'name' => 'Taylor Otwell',
            'username' => 'taylorotwell',
            'email' => 'taylor@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Christoph Rumpel',
            'username' => 'christophrumpel',
            'email' => 'christoph@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Jeffrey Way',
            'username' => 'jeffreyway',
            'email' => 'jeffrey@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Caleb Porzio',
            'username' => 'calebporzio',
            'email' => 'caleb@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Dan Harrin',
            'username' => 'danharrin',
            'email' => 'dan@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Nuno Maduro',
            'username' => 'nunomaduro',
            'email' => 'nuno@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Adam Wathan',
            'username' => 'adamwathan',
            'email' => 'adam@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'type' => 1,
            'name' => 'Steve Schoger',
            'username' => 'steveschoger',
            'email' => 'steve@blog.test',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Normal kullanıcılar
        User::factory(50)->create([
            'type' => 0,
        ]);
    }
}