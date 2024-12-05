@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New Schedule</h2>

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="movie_id" class="block text-sm font-medium text-gray-600">Movie</label>
                <select id="movie_id" name="movie_id" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Movie</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                    @endforeach
                </select>
                @error('movie_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-600">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('date')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="time" class="block text-sm font-medium text-gray-600">Time</label>
                <input type="time" id="time" name="time" value="{{ old('time') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('time')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="seat_prefix" class="block text-sm font-medium text-gray-600">Seat Prefix (Example: A or other alphabet)</label>
                <input type="text" id="seat_prefix" name="seat_prefix" value="{{ old('seat_prefix') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required maxlength="1">
                @error('seat_prefix')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="available_seats" class="block text-sm font-medium text-gray-600">Available Seats (Example: if input 3 then will be A1, A2, A3)</label>
                <input type="number" id="available_seats" name="available_seats" value="{{ old('available_seats') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('available_seats')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <!-- Tombol Kembali ke Index (Pojok Kiri) -->
                <a href="{{ route('schedules.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>

                <!-- Tombol Simpan Perubahan (Pojok Kanan) -->
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Create Schedule
                </button>
            </div>
        </form>
    </div>
@endsection
