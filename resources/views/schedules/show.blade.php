@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Schedule Details</h2>

        <!-- Detail Jadwal -->
        <div class="border-t border-gray-200 max-w-md mx-auto bg-gray-50 p-6 rounded-lg">
            <dl class="divide-y divide-gray-200">
                <!-- Movie Title -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Movie</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $schedule->movie->title }}</dd>
                </div>

                <!-- Date -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($schedule->date)->format('l, d F Y') }}</dd>
                </div>

                <!-- Time -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</dd>
                </div>

                <!-- Price -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Price</dt>
                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($schedule->price, 0, ',', '.') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Tabel Seat -->
        <div class="mt-6 border-t border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Seats</h3>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-600">
                        <th class="px-4 py-2">Seat Number</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedule->seats as $seat)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2">{{ $seat->seat_number }}</td>
                            <td class="px-4 py-2">
                                @if ($seat->is_booked)
                                    <span class="text-red-500">Booked</span>
                                @else
                                    <span class="text-green-500">Available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('schedules.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Back to Schedules
            </a>
        </div>
    </div>
@endsection
