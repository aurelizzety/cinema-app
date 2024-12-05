<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_schedule()
    {
        $movie = Movie::factory()->create(); // Pastikan Movie ada untuk foreign key

        $scheduleData = [
            'movie_id' => $movie->id,
            'date' => '2024-12-25',
            'time' => '14:30:00',
            'price' => 50000,
        ];

        $schedule = Schedule::create($scheduleData);

        $this->assertDatabaseHas('schedules', [
            'movie_id' => $movie->id,
            'date' => '2024-12-25',
            'time' => '14:30:00',
            'price' => 50000,
        ]);
    }

    public function test_read_schedule()
    {
        $schedule = Schedule::factory()->create([
            'date' => '2024-12-31',
            'time' => '18:00:00',
        ]);

        $retrievedSchedule = Schedule::find($schedule->id);

        $this->assertEquals($schedule->date, $retrievedSchedule->date);
        $this->assertEquals($schedule->time, $retrievedSchedule->time);
    }

    public function test_update_schedule()
    {
        $schedule = Schedule::factory()->create([
            'date' => '2024-12-20',
            'time' => '10:00:00',
            'price' => 40000,
        ]);

        $schedule->update([
            'date' => '2024-12-25',
            'time' => '14:30:00',
            'price' => 60000,
        ]);

        $this->assertDatabaseHas('schedules', [
            'date' => '2024-12-25',
            'time' => '14:30:00',
            'price' => 60000,
        ]);

        $this->assertDatabaseMissing('schedules', [
            'date' => '2024-12-20',
            'time' => '10:00:00',
        ]);
    }

    public function test_delete_schedule()
    {
        $schedule = Schedule::factory()->create([
            'date' => '2024-12-31',
            'time' => '18:00:00',
        ]);

        $this->assertDatabaseHas('schedules', [
            'date' => '2024-12-31',
        ]);

        $schedule->delete();

        $this->assertDatabaseMissing('schedules', [
            'date' => '2024-12-31',
        ]);
    }
}
