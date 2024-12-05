<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Seat;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeatCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_seat()
    {
        $schedule = Schedule::factory()->create(); // Membuat jadwal untuk kursi

        $seatData = [
            'schedule_id' => $schedule->id,
            'seat_number' => 'A1',
            'is_booked' => false,
        ];

        // Membuat kursi baru
        $seat = Seat::create($seatData);

        // Memastikan kursi ada di database
        $this->assertDatabaseHas('seats', [
            'seat_number' => 'A1',
            'is_booked' => false,
        ]);
    }

    public function test_read_seat()
    {
        // Membuat kursi menggunakan factory
        $seat = Seat::factory()->create();

        // Mendapatkan kursi berdasarkan ID
        $retrievedSeat = Seat::find($seat->id);

        // Memastikan data kursi sesuai
        $this->assertEquals($seat->seat_number, $retrievedSeat->seat_number);
        $this->assertEquals($seat->is_booked, $retrievedSeat->is_booked);
    }

    public function test_update_seat()
    {
        // Membuat kursi pertama kali
        $seat = Seat::create([
            'schedule_id' => Schedule::factory()->create()->id,
            'seat_number' => 'B2',
            'is_booked' => false,
        ]);

        // Memastikan kursi sudah ada di database
        $this->assertDatabaseHas('seats', [
            'seat_number' => 'B2',
            'is_booked' => false,
        ]);

        // Mengambil kursi yang sudah ada untuk update
        $seatToUpdate = Seat::where('seat_number', 'B2')->first();

        // Update kursi yang sudah ada
        $seatToUpdate->seat_number = 'B3';  // Mengubah nomor kursi
        $seatToUpdate->is_booked = true;    // Mengubah status kursi
        $seatToUpdate->save();              // Simpan perubahan

        // Memastikan kursi telah diupdate di database
        $this->assertDatabaseHas('seats', [
            'seat_number' => 'B3',  // Cek nomor kursi yang sudah diubah
            'is_booked' => true,    // Cek status kursi yang sudah diubah
        ]);

        // Memastikan data lama tidak ada di database
        $this->assertDatabaseMissing('seats', [
            'seat_number' => 'B2',  // Pastikan nomor kursi lama tidak ada
        ]);
    }

    public function test_delete_seat()
    {
        // Membuat kursi pertama kali
        $seat = Seat::create([
            'schedule_id' => Schedule::factory()->create()->id,
            'seat_number' => 'C4',
            'is_booked' => true,
        ]);

        // Memastikan kursi sudah ada di database
        $this->assertDatabaseHas('seats', [
            'seat_number' => 'C4',
            'is_booked' => true,
        ]);

        // Menghapus kursi
        $seat->delete();

        // Memastikan kursi telah dihapus
        $this->assertDatabaseMissing('seats', [
            'seat_number' => 'C4',
        ]);
    }
}
