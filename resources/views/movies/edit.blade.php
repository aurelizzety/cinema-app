@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Movie</h2>

        <form action="{{ route('movies.update', $movie->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('title')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $movie->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-sm font-medium text-gray-600">Duration (in minutes)</label>
                <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('duration')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-600">Genre</label>
                <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('genre')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between mt-6">
                <!-- Tombol Kembali ke Index (Pojok Kiri) -->
                <a href="{{ route('movies.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Back
                </a>

                <!-- Tombol Simpan Perubahan (Pojok Kanan) -->
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Update Movie
                </button>
            </div>
        </form>
    </div>
@endsection
