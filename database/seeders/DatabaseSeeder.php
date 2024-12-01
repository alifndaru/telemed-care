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
            'role_id' => 1,
            'klinik_id' => 1,
            'spesialis_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'Test 2User',
            'email' => 'test2@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 2,
            'klinik_id' => 2,
            'spesialis_id' => 2,
        ]);
        User::factory()->create([
            'name' => 'Test 3User',
            'email' => 'test3@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 3,
            'klinik_id' => 3,
            'spesialis_id' => 3,
        ]);
        User::factory()->create([
            'name' => 'Test 4User',
            'email' => 'test4@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 4,
            'klinik_id' => 4,
            'spesialis_id' => 4,
        ]);
        User::factory()->create([
            'name' => 'Test 5User',
            'email' => 'test5@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 5,
            'klinik_id' => 5,
            'spesialis_id' => 5,
        ]);
        User::factory()->create([
            'name' => 'Test 6User',
            'email' => 'test@example.com',
            'password' => bcrypt('test123'),
            'remember_token' => Str::random(10),
            'role_id' => 6,
            'klinik_id' => 6,
            'spesialis_id' => 6,
        ]);
    }
}
