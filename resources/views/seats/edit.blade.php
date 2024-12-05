@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Seat</h2>

        <form action="{{ route('seats.update', $seat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="schedule_id" class="block text-sm font-medium text-gray-600">Schedule</label>
                <select id="schedule_id" name="schedule_id" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" disabled>
                    <option value="{{ $seat->schedule->id }}">{{ $seat->schedule->date }} {{ $seat->schedule->time }}</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="seat_number" class="block text-sm font-medium text-gray-600">Seat Number</label>
                <input type="text" id="seat_number" name="seat_number" value="{{ old('seat_number', $seat->seat_number) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="is_booked" class="block text-sm font-medium text-gray-600">Status</label>
                <select id="is_booked" name="is_booked" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="0" {{ old('is_booked', $seat->is_booked) == 0 ? 'selected' : '' }}>Available</option>
                    <option value="1" {{ old('is_booked', $seat->is_booked) == 1 ? 'selected' : '' }}>Booked</option>
                </select>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('seats.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Update Seat
                </button>
            </div>
        </form>
    </div>
@endsection
