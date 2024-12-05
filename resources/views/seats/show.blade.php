@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Seat Details</h2>

        <div class="border-t border-gray-200 max-w-md mx-auto bg-gray-50 p-6 rounded-lg">
            <dl class="divide-y divide-gray-200">
                <!-- ID -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $seat->id }}</dd>
                </div>

                <!-- Seat Number -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Seat Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $seat->seat_number }}</dd>
                </div>

                <!-- Schedule -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Schedule</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $seat->schedule->date }} {{ $seat->schedule->time }}
                    </dd>
                </div>

                <!-- Is Booked -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Is Booked</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $seat->is_booked ? 'Yes' : 'No' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('seats.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Back
            </a>
        </div>
    </div>
@endsection
