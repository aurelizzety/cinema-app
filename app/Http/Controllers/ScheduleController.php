<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use App\Models\Seat;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Schedule::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('movie', function ($q) use ($search) {
                $q->where('title', 'like', "%$search%");
            });
        }

        $schedules = $query->paginate(10);
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movies = Movie::all(); // Mengambil semua film untuk dropdown
        return view('schedules.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:1', // Jumlah kursi yang akan dibuat
            'seat_prefix' => 'required|string|max:1', // Prefix untuk seat number, misalnya 'C'
        ]);

        // Simpan data schedule
        $schedule = new Schedule();
        $schedule->movie_id = $validated['movie_id'];
        $schedule->start_time = $validated['start_time'];
        $schedule->duration = $validated['duration'];
        $schedule->save();

        // Membuat kursi otomatis berdasarkan jumlah available_seats dan seat_prefix yang dimasukkan
        $seatPrefix = $validated['seat_prefix']; // Prefix seat seperti 'C'
        $availableSeats = $validated['available_seats'];

        // Loop untuk membuat kursi dengan format seat_number seperti C1, C2, C3, ...
        for ($i = 1; $i <= $availableSeats; $i++) {
            Seat::create([
                'schedule_id' => $schedule->id,
                'seat_number' => $seatPrefix . $i, // Membuat nomor kursi C1, C2, C3, dst.
                'is_booked' => false, // Kursi belum dipesan
            ]);
        }

        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil jadwal berdasarkan ID dan memuat kursi yang terkait dengan jadwal tersebut
        $schedule = Schedule::with('movie', 'seats')->findOrFail($id);

        // Menampilkan view dengan data jadwal dan kursi
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $movies = Movie::all(); // Mengambil semua film untuk dropdown
        return view('schedules.edit', compact('schedule', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // Validasi hanya untuk atribut yang bisa diubah
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        // Update atribut yang bisa diubah
        $schedule->update($request->only(['date', 'time', 'price']));

        // Redirect ke index dengan pesan sukses
        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index');
    }
}
