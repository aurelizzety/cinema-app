<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_transaction()
    {
        $user = User::factory()->create();
        $schedule = Schedule::factory()->create();
        $seat = Seat::factory()->create();

        $transactionData = [
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'seat_id' => $seat->id,
            'total_price' => 100000,
            'status' => 'pending',
        ];

        // Membuat transaksi baru
        $transaction = Transaction::create($transactionData);

        // Memastikan transaksi ada di database
        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'seat_id' => $seat->id,
            'total_price' => 100000,
            'status' => 'pending',
        ]);
    }

    public function test_read_transaction()
    {
        $transaction = Transaction::factory()->create();

        // Mengambil transaksi berdasarkan ID
        $retrievedTransaction = Transaction::find($transaction->id);

        // Memastikan data transaksi sesuai
        $this->assertEquals($transaction->id, $retrievedTransaction->id);
        $this->assertEquals($transaction->total_price, $retrievedTransaction->total_price);
    }

    public function test_update_transaction()
    {
        $transaction = Transaction::create([
            'user_id' => User::factory()->create()->id,
            'schedule_id' => Schedule::factory()->create()->id,
            'seat_id' => Seat::factory()->create()->id,
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        // Memastikan transaksi sudah ada di database
        $this->assertDatabaseHas('transactions', [
            'status' => 'pending',
        ]);

        // Mengupdate status transaksi
        $transaction->status = 'paid';
        $transaction->save();

        // Memastikan status transaksi telah diubah
        $this->assertDatabaseHas('transactions', [
            'status' => 'paid',
        ]);
    }

    public function test_delete_transaction()
    {
        $transaction = Transaction::create([
            'user_id' => User::factory()->create()->id,
            'schedule_id' => Schedule::factory()->create()->id,
            'seat_id' => Seat::factory()->create()->id,
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        // Memastikan transaksi sudah ada di database
        $this->assertDatabaseHas('transactions', [
            'status' => 'pending',
        ]);

        // Menghapus transaksi
        $transaction->delete();

        // Memastikan transaksi telah dihapus
        $this->assertDatabaseMissing('transactions', [
            'status' => 'pending',
        ]);
    }
}
