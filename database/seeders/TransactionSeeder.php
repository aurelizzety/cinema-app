<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Seat;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seats = Seat::whereIn('seat_number', ['A1', 'A2'])->get();

        foreach ($seats as $seat) {
            // Periksa apakah kursi belum dipesan
            if (!$seat->is_booked) {
                // Buat transaksi untuk kursi tersebut
                Transaction::create([
                    'user_id' => 1,  // ID user
                    'schedule_id' => 1,  // ID jadwal
                    'seat_id' => $seat->id,  // ID kursi
                    'total_price' => 100000,  // Harga total
                    'status' => 'paid',  // Status pembayaran
                ]);

                // Tandai kursi sebagai sudah dipesan
                $seat->update(['is_booked' => true]);
            }
        }
    }
}
