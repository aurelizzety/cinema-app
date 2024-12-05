@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Seat List</h2>
            <button 
                onclick="window.location.href='{{ route('seats.create') }}'" 
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Add New Seat
            </button>
        </div>

        <!-- Search form -->
        <div class="mb-4">
            <form action="{{ route('seats.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by seat number...">
            </form>
        </div>

        <!-- Seat Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Schedule</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Seat Number</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Status</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($seats as $seat)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $seat->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                {{ $seat->schedule->date }} {{ $seat->schedule->time }}
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $seat->seat_number }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                {{ $seat->is_booked ? 'Booked' : 'Available' }}
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                <a href="{{ route('seats.show', $seat->id) }}" class="px-4 py-2 text-blue-500">View</a>
                                <a href="{{ route('seats.edit', $seat->id) }}" class="px-4 py-2 text-blue-500">Edit</a>
                                <form action="{{ route('seats.destroy', $seat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this seat?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $seats->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
