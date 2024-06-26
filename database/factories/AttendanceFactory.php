<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'schedule_id' => \App\Models\Schedule::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'date' => $this->faker->date(),
            'attended' => $this->faker->boolean(),
        ];
    }
}
