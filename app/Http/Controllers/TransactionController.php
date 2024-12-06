<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Seat;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::with(['user', 'schedule.movie'])
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })->orWhereHas('schedule.movie', function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Ambil semua user
        $schedules = Schedule::with('movie')->get(); // Ambil semua jadwal beserta filmnya
        return view('transactions.create', compact('users', 'schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'seat_id' => 'required|exists:seats,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,paid',
        ]);

        // Cek jika kursi yang dipilih sudah dipesan
        $seat = Seat::find($validated['seat_id']);

        // Verifikasi jika kursi sudah terbooking
        if ($seat->is_booked) {
            return redirect()->back()->withErrors(['seat_id' => 'This seat is already booked.']);
        }

        // Verifikasi jika ada transaksi pending dengan kursi yang sama
        $existingTransaction = Transaction::where('seat_id', $validated['seat_id'])
            ->where('status', 'pending')
            ->first();

        if ($existingTransaction) {
            return redirect()->back()->withErrors(['seat_id' => 'This seat is already reserved in another transaction.']);
        }

        // Membuat transaksi baru
        $transaction = new Transaction();
        $transaction->user_id = $validated['user_id'];
        $transaction->schedule_id = $validated['schedule_id'];
        $transaction->seat_id = $validated['seat_id'];
        $transaction->total_price = $validated['total_price'];
        $transaction->status = $validated['status'];
        $transaction->save();

        // Perbarui status kursi menjadi booked
        $seat->is_booked = true;
        $seat->save();

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with(['user', 'schedule', 'seat'])
            ->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = \App\Models\User::all();
        $schedules = \App\Models\Schedule::all();
        $seats = \App\Models\Seat::where('is_booked', false)
            ->orWhere('id', $transaction->seat_id) // Kursi yang saat ini digunakan tetap bisa dipilih
            ->get();

        return view('transactions.edit', compact('transaction', 'users', 'schedules', 'seats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:pending,paid', // Validasi status hanya bisa 'pending' atau 'paid'
        ]);

        // Ambil transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // Update status transaksi
        $transaction->status = $request->status;
        $transaction->save(); // Simpan perubahan

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Tandai kursi sebagai tersedia
        $transaction->seat->update(['is_booked' => false]);

        $transaction->delete();

        return redirect()->route('transactions.index');
    }

    public function getSeatsBySchedule($scheduleId)
    {
        // Ambil kursi yang terkait dengan jadwal yang dipilih dan status is_booked = false
        $seats = Seat::where('schedule_id', $scheduleId)
            ->where('is_booked', false) // Hanya kursi yang belum dipesan
            ->pluck('id'); // Ambil hanya seat_id (id kursi)

        return response()->json(['seats' => $seats]);
    }
}
