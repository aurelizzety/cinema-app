@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard</h1>

        <!-- Kartu: Nama Aplikasi dan Deskripsi -->
        <div class="p-6 bg-blue-500 text-gray-800 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold">Cinema App</h2>
            <p class="text-lg mt-2">Aplikasi ini dibuat untuk mempermudah manajemen data film, pengguna, dan jadwal penayangan film di bioskop. Dengan sistem pemesanan kursi sehingga pengguna dapat memilih kursi untuk menonton film sesuai dengan jadwal yang tersedia.</p>
        </div>

        <!-- Kartu: Tools yang Digunakan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tools yang Digunakan</h3>
            <div class="grid grid-cols-6 gap-6">
                <!-- Laravel -->
                <div class="text-center">
                    <img src="{{ asset('images/laravel-logo.png') }}" alt="Laravel Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600">Laravel</p>
                </div>
                <!-- MySQL -->
                <div class="text-center">
                    <img src="{{ asset('images/mysql-logo.png') }}" alt="MySQL Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600">MySQL</p>
                </div>
                <!-- Tailwind CSS -->
                <div class="text-center">
                    <img src="{{ asset('images/tailwind-logo.png') }}" alt="Tailwind CSS Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600">Tailwind CSS</p>
                </div>
                <!-- Jetstream -->
                <div class="text-center">
                    <img src="{{ asset('images/jetstream-logo.png') }}" alt="Jetstream Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600"> Laravel Jetstream</p>
                </div>
                <!-- Laragon -->
                <div class="text-center">
                    <img src="{{ asset('images/laragon-logo.png') }}" alt="Laragon Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600">Laragon</p>
                </div>
                <!-- Visual Studio Code -->
                <div class="text-center">
                    <img src="{{ asset('images/vscode-logo.png') }}" alt="VSCode Logo" class="mx-auto h-16 w-16 mb-2">
                    <p class="text-sm text-gray-600">VSCode</p>
                </div>
            </div>
        </div>
    </div>
@endsection
