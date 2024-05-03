<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $faker = $this->faker;

        // Generate a unique filename
        $filename = $faker->word() . '.pdf'; // You can use word() or sentence() depending on your preference

        // Generate a random content for the file (optional)
        $content = $faker->text(200);

        // Store the file in Laravel's filesystem
        Storage::put('public/resources/' . $filename, $content);

        return [
            'resource_name' => $faker->sentence(),
            'resource_type' => $faker->randomElement(['event', 'announcement']), // Set the resource type randomly to 'event' or 'announcement'
            'resource_filename' => $filename, // Assign the generated filename
            'resource_url' => 'storage/resources/' . $filename, // Set the file path in Laravel
            'resource_uploaded_by' => $faker->name,
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
