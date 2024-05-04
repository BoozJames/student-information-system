<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     * @return array
     */
    public function definition()
    {
        // Generate a random subject code format (e.g., ABC123)
        $subjectCode = strtoupper($this->faker->randomLetter) . strtoupper($this->faker->randomLetter) . strtoupper($this->faker->randomLetter) . $this->faker->randomNumber(3);

        return [
            'subject_name' => $this->faker->word,
            'subject_code' => $subjectCode,
            'teacher_id' => \App\Models\User::factory()->create()->id,
        ];
    }
}
