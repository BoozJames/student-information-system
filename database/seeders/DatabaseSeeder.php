<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Resource::factory(50)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.test',
            'user_type' => 'Student'
        ]);

        \App\Models\User::factory()->create([
            'name' => env('SYS_USERNAME'),
            'email' => env('SYS_EMAIL'),
            'password' => env('SYS_PASSWORD'),
            'user_type' => env('SYS_USER_TYPE')
        ]);
    }
}
