<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_title' => $this->faker->sentence,
            'post_content' => $this->faker->paragraph,
            'post_type' => $this->faker->randomElement(['news', 'blog', 'tutorial']),
            'post_uploaded_by' => $this->faker->name,
        ];
    }
}
