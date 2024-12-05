@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Users List</h2>
            <button 
                onclick="window.location.href='{{ route('users.create') }}'" 
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Create New User
            </button>
        </div>        
              

        <!-- Search form -->
        <div class="mb-4">
            <form action="{{ route('users.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Search by name or email...">
            </form>
        </div>

        <!-- User Table -->
        <div class="overflow-x-auto">
            <table class="w-full max-w-xs px-4 py-2 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Name</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Email</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                <a href="{{ route('users.show', $user->id) }}" class="px-4 py-2 text-blue-500">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 text-blue-500">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection
