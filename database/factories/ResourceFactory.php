<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use Faker\Generator as Faker;

class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'resource_name' => $this->faker->sentence(),
            'resource_type' => $this->faker->randomElement(['reports', 'activities', 'forms']),
            'resource_filename' => $this->faker->word() . '.pdf',
            'resource_url' => 'storage/resources/' . $this->faker->word() . '.pdf',
            'resource_uploaded_by' => function () {
                // Get a random user ID from the users table
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
