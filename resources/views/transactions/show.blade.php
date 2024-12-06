@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Transaction Details</h2>

        <div class="border-t border-gray-200 max-w-md mx-auto bg-gray-50 p-6 rounded-lg">
            <dl class="divide-y divide-gray-200">
                <!-- Transaction ID -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Transaction ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->id }}</dd>
                </div>

                <!-- User Name -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">User Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->user->name }}</dd>
                </div>

                <!-- Movie Title -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Movie Title</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->schedule->movie->title }}</dd>
                </div>

                <!-- Seat Number -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Seat Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->seat->seat_number }}</dd>
                </div>

                <!-- Total Price -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Total Price</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ number_format($transaction->total_price, 2, ',', '.') }}</dd>
                </div>

                <!-- Status -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($transaction->status) }}</dd>
                </div>

                <!-- Created At -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->created_at->format('d-m-Y H:i') }}</dd>
                </div>

                <!-- Updated At -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Updated At</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaction->updated_at->format('d-m-Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Back
            </a>
        </div>
    </div>
@endsection
