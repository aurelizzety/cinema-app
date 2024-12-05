<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'movie_id' => 1, // ID dari 'Ride Your Wave'
            'date' => '2024-12-12',
            'time' => '18:00:00',
            'price' => 50000,
        ]);

        Schedule::create([
            'movie_id' => 2, // ID dari 'Josee, the Tiger and the Fish'
            'date' => '2024-12-12',
            'time' => '14:00:00',
            'price' => 40000,
        ]);
    }
}
