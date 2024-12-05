<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mengambil data kursi berdasarkan pencarian
        $seats = Seat::when($search, function ($query, $search) {
            return $query->where('seat_number', 'like', "%{$search}%")
                ->orWhere('schedule_id', 'like', "%{$search}%");
        })
            ->paginate(10);

        // Mengirim data kursi ke view
        return view('seats.index', compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'seat_number' => 'required|string|max:5|unique:seats,seat_number',
            'schedule_id' => 'required|exists:schedules,id',  // Asumsi seat terkait dengan schedule
            'is_booked' => 'required|boolean',
        ]);

        // Menyimpan kursi baru
        $seat = Seat::create($validatedData);

        // Redirect ke daftar kursi dengan pesan sukses
        return redirect()->route('seats.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seat = Seat::findOrFail($id);
        return view('seats.show', compact('seat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $seat = Seat::findOrFail($id);
        return view('seats.edit', compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'seat_number' => 'nullable|string|max:5|unique:seats,seat_number,' . $id,
            'schedule_id' => 'nullable|exists:schedules,id',
            'is_booked' => 'nullable|boolean',
        ]);

        // Memperbarui data kursi
        $seat->update($validatedData);

        // Redirect kembali ke halaman daftar kursi dengan pesan sukses
        return redirect()->route('seats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->route('seats.index');
    }

    public function getSchedules($movieId)
    {
        $schedules = Schedule::where('movie_id', $movieId)->get();  // Sesuaikan dengan relasi yang ada
        return response()->json(['schedules' => $schedules]);
    }
}
