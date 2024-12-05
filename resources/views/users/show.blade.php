@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">User Details</h2>

        <div class="border-t border-gray-200 max-w-md mx-auto bg-gray-50 p-6 rounded-lg">
            <dl class="divide-y divide-gray-200">
                <!-- ID -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">ID</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->id }}</dd>
                </div>

                <!-- Name -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                </div>

                <!-- Email -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                </div>

                <!-- Role -->
                <div class="py-4">
                    <dt class="text-sm font-medium text-gray-600">Role</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->role }}</dd>
                </div>
            </dl>
        </div>        

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Back
            </a>
        </div>
    </div>
@endsection
