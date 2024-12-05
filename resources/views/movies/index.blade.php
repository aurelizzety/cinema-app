@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Movie List</h2>
            <button 
                onclick="window.location.href='{{ route('movies.create') }}'" 
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Create New Movie 
            </button>
        </div>        
              
        <!-- Search form -->
        <div class="mb-4">
            <form action="{{ route('movies.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by title or genre...">
            </form>
        </div>

        <!-- Movie Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Title</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Description</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Duration (min)</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Genre</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($movies as $movie)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $movie->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $movie->title }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ Str::limit($movie->description, 50) }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $movie->duration }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $movie->genre }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                <a href="{{ route('movies.show', $movie->id) }}" class="px-4 py-2 text-blue-500">View</a>
                                <a href="{{ route('movies.edit', $movie->id) }}" class="px-4 py-2 text-blue-500">Edit</a>
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline-block">
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
            {{ $movies->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
