<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Title -->
                    <h2 class="text-2xl mb-4">Edit Kendaraan #{{$reservation->id}}</h2>

                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Vehicle ID Dropdown -->
                        <div class="mb-4">
                            <label for="vehicle_id" class="block">Vehicle:</label>
                            <select name="vehicle_id" id="vehicle_id" class="border p-2 w-full" required>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $reservation->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->police_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date Input -->
                        <div class="mb-4">
                            <label for="start_date" class="block">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" value="{{ $reservation->start_date }}" class="border p-2 w-full" required>
                        </div>

                        <!-- End Date Input -->
                        <div class="mb-4">
                            <label for="end_date" class="block">End Date:</label>
                            <input type="date" name="end_date" id="end_date" value="{{ $reservation->end_date }}" class="border p-2 w-full" required>
                        </div>

                        <!-- User Approval 1 Input -->
                        <div class="mb-4">
                            <label for="user_approval1_id" class="block">User Approval 1:</label>
                            <select name="user_approval1_id" id="user_approval1_id" class="border p-2 w-full" required>
                                @foreach($supervisors as $user)
                                    <option value="{{ $user->id }}" {{ $reservation->user_approval1_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User Approval 2 Input -->
                        <div class="mb-4">
                            <label for="user_approval2_id" class="block">User Approval 2:</label>
                            <select name="user_approval2_id" id="user_approval2_id" class="border p-2 w-full" required>
                                @foreach($managers as $user)
                                    <option value="{{ $user->id }}" {{ $reservation->user_approval2_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Driver ID Input -->
                        <div class="mb-4">
                            <label for="driver_id" class="block">Driver:</label>
                            <select name="driver_id" id="driver_id" class="border p-2 w-full" required>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ $reservation->driver_id == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block">Current Status:</label>
                            <input type="text" id="status" value="{{ $reservation->status }}" class="border p-2 w-full bg-gray-200" disabled>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block">Message:</label>
                            <textarea id="message" class="border p-2 w-full bg-gray-200" disabled>{{ $reservation->message }}</textarea>
                        </div>
                    </form>
                    <!-- Alpine.js State for Modal -->
                    <div x-data="{ open: false }">

                        @if(auth()->id() === $reservation->user_approval1_id && $reservation->status == 'pending')
                            <a href="{{ route('reservations.approve_by_supervisor', $reservation->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve as Supervisor</a>
                            <button @click="open = true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                        @endif

                        <!-- Manager Approval Button -->
                        @if(auth()->id() === $reservation->user_approval2_id && $reservation->status == 'approved_by_supervisor')
                            <a href="{{ route('reservations.approve_by_manager', $reservation->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Approve as Manager</a>
                            <button @click="open = true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                        @endif

                        <!-- Modal Structure -->
                        <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="bg-white p-6 rounded shadow-lg">
                                    <h2 class="text-xl mb-4">Reject Reservation</h2>

                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div>
                                            <label for="rejection_reason">Reason for Rejection:</label>
                                            <textarea name="rejection_reason" id="rejection_reason" class="border p-2 w-full"></textarea>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Confirm Rejection</button>
                                            <button type="button" @click="open = false" class="ml-4">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End of Alpine.js State for Modal -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


