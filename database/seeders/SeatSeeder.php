<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Seat::create([
                'schedule_id' => 1, // Jadwal ID untuk 'Ride Your Wave'
                'seat_number' => 'A' . $i,
                'is_booked' => 0, // Status awal kursi
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            Seat::create([
                'schedule_id' => 2, // Jadwal ID untuk 'Josee, the Tiger and the Fish'
                'seat_number' => 'B' . $i,
                'is_booked' => 0,
            ]);
        }
    }
}
