<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test 1User',
            'email' => 'test1@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Test 2User',
            'email' => 'test2@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Test 3User',
            'email' => 'test3@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->create([
            'name' => 'Test 4User',
            'email' => 'test4@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
