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
                    <h2 class="text-2xl mb-4">Tambah Reservasi</h2>

                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf

                        <!-- Vehicle ID Dropdown -->
                        <div class="mb-4">
                            <label for="vehicle_id" class="block">Vehicle:</label>
                            <select name="vehicle_id" id="vehicle_id" class="border p-2 w-full" required>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->police_number }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date Input -->
                        <div class="mb-4">
                            <label for="start_date" class="block">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="border p-2 w-full" required>
                        </div>

                        <!-- End Date Input -->
                        <div class="mb-4">
                            <label for="end_date" class="block">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="border p-2 w-full" required>
                        </div>

                        <!-- User Approval 1 Input -->
                        <div class="mb-4">
                            <label for="user_approval1_id" class="block">User Approval 1:</label>
                            <select name="user_approval1_id" id="user_approval1_id" class="border p-2 w-full" required>
                                @foreach($supervisors as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User Approval 2 Input -->
                        <div class="mb-4">
                            <label for="user_approval2_id" class="block">User Approval 2:</label>
                            <select name="user_approval2_id" id="user_approval2_id" class="border p-2 w-full" required>
                                @foreach($managers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Driver ID Input -->
                        <div class="mb-4">
                            <label for="driver_id" class="block">Driver:</label>
                            <select name="driver_id" id="driver_id" class="border p-2 w-full" required>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
