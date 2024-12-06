@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Transaction</h2>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-600">User</label>
                <input type="text" value="{{ $transaction->user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
            </div>

            <div class="mb-4">
                <label for="schedule_id" class="block text-sm font-medium text-gray-600">Schedule</label>
                <input type="text" value="{{ $transaction->schedule->movie->title }} - {{ $transaction->schedule->date }} {{ $transaction->schedule->time }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
            </div>

            <div class="mb-4">
                <label for="seat_id" class="block text-sm font-medium text-gray-600">Seat</label>
                <input type="text" value="{{ $transaction->seat->seat_number }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
            </div>

            <div class="mb-4">
                <label for="total_price" class="block text-sm font-medium text-gray-600">Total Price</label>
                <input type="text" value="{{ $transaction->total_price }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>

                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Update Transaction
                </button>
            </div>
        </form>
    </div>
@endsection
