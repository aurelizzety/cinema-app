<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Menggunakan factory User
            'schedule_id' => Schedule::factory(),  // Menggunakan factory Schedule
            'seat_id' => Seat::factory(),  // Menggunakan factory Seat
            'total_price' => $this->faker->numberBetween(50000, 200000),
            'status' => $this->faker->randomElement(['pending', 'paid']),
        ];
    }
}
