<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Seat;
use App\Models\Schedule;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Transaction::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'seat_id' => 'required|exists:seats,id',
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Memastikan kursi yang dipilih belum dipesan
        $seat = Seat::findOrFail($validatedData['seat_id']);
        if ($seat->is_booked) {
            return response()->json(['message' => 'Seat is already booked.'], 400);
        }

        // Membuat transaksi baru
        $transaction = Transaction::create($validatedData);

        // Menandai kursi sebagai sudah dipesan
        $seat->update(['is_booked' => true]);

        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Transaction::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'schedule_id' => 'nullable|exists:schedules,id',
            'seat_id' => 'nullable|exists:seats,id',
            'total_price' => 'nullable|numeric',
            'status' => 'nullable|string',
        ]);

        $transaction->update($validatedData);

        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully']);
    }
}
