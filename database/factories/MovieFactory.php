<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph,
            'duration' => $this->faker->numberBetween(90, 180), // Durasi dalam menit
            'genre' => $this->faker->randomElement(['Action', 'Comedy', 'Drama', 'Horror']),
        ];
    }
}
