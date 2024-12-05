@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Schedule List</h2>
            <button 
                onclick="window.location.href='{{ route('schedules.create') }}'" 
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Create New Schedule
            </button>
        </div>        
              
        <!-- Search form -->
        <div class="mb-4">
            <form action="{{ route('schedules.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by movie title...">
            </form>
        </div>

        <!-- Schedule Table -->
        <div class="overflow-x-auto">
            <table class="w-full max-w-xs px-4 py-2 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Movie Title</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Date</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Time</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Price</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($schedules as $schedule)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $schedule->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $schedule->movie->title }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ \Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $schedule->price }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                <a href="{{ route('schedules.show', $schedule->id) }}" class="px-4 py-2 text-blue-500">View</a>
                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="px-4 py-2 text-blue-500">Edit</a>
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline-block">
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
            {{ $schedules->links() }}
        </div>
    </div>
@endsection
