<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::factory(), // Membuat Movie otomatis jika belum ada
            'date' => $this->faker->date(), // Menghasilkan tanggal acak
            'time' => $this->faker->time('H:i:s'), // Menghasilkan waktu acak
            'price' => $this->faker->numberBetween(10000, 100000), // Harga tiket antara 10.000 - 100.000
        ];
    }
}
