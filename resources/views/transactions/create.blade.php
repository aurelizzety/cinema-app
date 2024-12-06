@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Create New Transaction</h2>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-600">User</label>
                <select id="user_id" name="user_id" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="schedule_id" class="block text-sm font-medium text-gray-600">Schedule</label>
                <select id="schedule_id" name="schedule_id" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Schedule</option>
                    @foreach($schedules as $schedule)
                        <option value="{{ $schedule->id }}" data-movie-title="{{ $schedule->movie->title }}" data-price="{{ $schedule->price }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                            {{ $schedule->movie->title }} - {{ $schedule->date }} {{ $schedule->time }}
                        </option>
                    @endforeach
                </select>
                @error('schedule_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="seat_id" class="block text-sm font-medium text-gray-600">Seat</label>
                <select id="seat_id" name="seat_id" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Seat</option>
                </select>                
                @error('seat_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="total_price" class="block text-sm font-medium text-gray-600">Total Price</label>
                <input type="text" id="total_price" name="total_price" value="{{ old('total_price') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
                @error('total_price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
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
                    Create Transaction
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('schedule_id').addEventListener('change', function () {
            const scheduleId = this.value;

            if (scheduleId) {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price'); // Ambil harga dari data-price
                
                // Update harga total
                document.getElementById('total_price').value = price;

                // Ambil kursi yang tersedia untuk jadwal ini
                fetch(`/transactions/seats/${scheduleId}`)
                    .then(response => response.json())
                    .then(data => {
                        const seatSelect = document.getElementById('seat_id');
                        seatSelect.innerHTML = '<option value="">Select Seat</option>'; // Kosongkan opsi kursi sebelumnya

                        // Update seat options
                        if (data.seats.length > 0) {
                            data.seats.forEach(seatId => {
                                const option = document.createElement('option');
                                option.value = seatId; // Menampilkan hanya seat_id
                                option.textContent = `Seat ID: ${seatId}`; // Menampilkan Seat ID saja
                                seatSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'No available seats';
                            seatSelect.appendChild(option);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching seats:', error);
                    });
            }
        });
    </script>    
@endsection
