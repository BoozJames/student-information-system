<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Define the user_id attribute using the User model factory,
            // which creates a new user and retrieves its ID.
            'user_id' => User::factory(),

            // Define the subject_id attribute using the Subject model factory,
            // which creates a new subject and retrieves its ID.
            'subject_id' => Subject::factory(),

            // Define the value attribute as a random number between 0 and 100
            // using Faker's numberBetween method.
            'value' => $this->faker->numberBetween(0, 100),
        ];
    }
}
