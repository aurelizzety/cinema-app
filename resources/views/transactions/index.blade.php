@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Transaction List</h2>
            <button 
                onclick="window.location.href='{{ route('transactions.create') }}'" 
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Create New Transaction
            </button>
        </div>

        <!-- Search form -->
        <div class="mb-4">
            <form action="{{ route('transactions.index') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    placeholder="Search by user name or movie title...">
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">ID</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">User Name</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Movie Title</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Seat</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Total Price</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Status</th>
                        <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->user->name }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->schedule->movie->title }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->seat->id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->total_price }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">{{ $transaction->status }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-800">
                                <a href="{{ route('transactions.show', $transaction->id) }}" class="px-2 py-1 text-blue-500">View</a>
                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="px-2 py-1 text-blue-500">Edit</a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $transactions->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
