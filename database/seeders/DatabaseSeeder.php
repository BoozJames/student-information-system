<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Resource;
use App\Models\Schedule;
use App\Models\Post;
use App\Models\User;
use App\Models\Subject;
use App\Models\Attendance;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        Resource::factory(50)->create();
        Subject::factory()->count(60)->create();
        Grade::factory()->count(60)->create();
        Schedule::factory()->count(60)->create();
        Post::factory()->count(60)->create();
        Attendance::factory()->count(10)->create();

        User::factory()->create([
            'name' => 'Test Student',
            'email' => 'teststudent@test.test',
            'user_type' => 'student'
        ]);

        User::factory()->create([
            'name' => 'Test Teacher',
            'email' => 'testteacher@test.test',
            'user_type' => 'teacher'
        ]);

        \App\Models\User::factory()->create([
            'name' => env('SYS_USERNAME'),
            'email' => env('SYS_EMAIL'),
            'password' => env('SYS_PASSWORD'),
            'user_type' => env('SYS_USER_TYPE')
        ]);
    }
}
