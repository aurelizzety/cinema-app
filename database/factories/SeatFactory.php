<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition()
    {
        return [
            'schedule_id' => Schedule::factory(),  // Menggunakan factory untuk membuat schedule
            'seat_number' => $this->faker->unique()->bothify('??##'),
            'is_booked' => $this->faker->boolean(50),  // 50% peluang kursi terbooking
        ];
    }
}
