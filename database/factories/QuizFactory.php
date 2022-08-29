<?php

namespace Database\Factories;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        $slug = Str::slug($title);

        // Get a user
        $user = User::where('id', $this->faker->numberBetween(2,6))->first();

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->sentence(10),
            'user_id' => $user->id
        ];
    }
}
