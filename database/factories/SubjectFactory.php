<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subject;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject_name' => $this->faker->word,
            'subject_code' => $this->faker->unique()->word, // Assuming subject code is a unique word
            'teacher_id' => function () {
                // Assuming you have User model and want to associate a random user as teacher
                return \App\Models\User::factory()->create()->id;
            },
        ];
    }
}
