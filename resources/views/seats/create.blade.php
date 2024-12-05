@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New Seat</h2>

        <form action="{{ route('seats.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="seat_number" class="block text-sm font-medium text-gray-600">Seat Number</label>
                <input type="text" id="seat_number" name="seat_number" value="{{ old('seat_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('seat_number')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="is_booked" class="block text-sm font-medium text-gray-600">Is Booked</label>
                <select id="is_booked" name="is_booked" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="0" {{ old('is_booked', '0') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('is_booked') == '1' ? 'selected' : '' }}>Yes</option>
                </select>
                @error('is_booked')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <!-- Tombol Kembali ke Index (Pojok Kiri) -->
                <a href="{{ route('seats.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>

                <!-- Tombol Simpan Perubahan (Pojok Kanan) -->
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Create Seat
                </button>
            </div>
        </form>
    </div>
@endsection
