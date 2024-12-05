<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Seat::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'seat_number' => 'required|string|max:5',
            'is_booked' => 'required|boolean',
        ]);

        $seat = Seat::create($validatedData);

        return response()->json($seat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Seat::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $seat = Seat::findOrFail($id);

        $validatedData = $request->validate([
            'schedule_id' => 'nullable|exists:schedules,id',
            'seat_number' => 'nullable|string|max:5',
            'is_booked' => 'nullable|boolean',
        ]);

        $seat->update($validatedData);

        return response()->json($seat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seat = Seat::findOrFail($id);
        $seat->delete();

        return response()->json(['message' => 'Seat deleted successfully']);
    }
}
