<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Title -->
                    <h2 class="text-2xl mb-4">Edit Kendaraan #{{$vehicle->id}}</h2>

                    <form action="{{ route('vehicle.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Input -->
                        <div class="mb-4">
                            <label for="name" class="block">Name:</label>
                            <input type="text" name="name" id="name" value="{{ $vehicle->name }}" class="border p-2 w-full" required>
                        </div>

                        <!-- Police Number Input -->
                        <div class="mb-4">
                            <label for="police_number" class="block">Police Number:</label>
                            <input type="text" name="police_number" id="police_number" value="{{ $vehicle->police_number }}" class="border p-2 w-full" required>
                        </div>

                        <!-- Status Input -->
                        <div class="mb-4">
                            <label for="status" class="block">Status:</label>
                            <select name="status" id="status" class="border p-2 w-full" required>
                                <option value="active" {{ $vehicle->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="booked" {{ $vehicle->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="in_use" {{ $vehicle->status == 'in_use' ? 'selected' : '' }}>In Use</option>
                                <option value="inactive" {{ $vehicle->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>


                        <!-- Next Service Input -->
                        <div class="mb-4">
                            <label for="next_service" class="block">Next Service:</label>
                            <input type="date" name="next_service" id="next_service" value="{{ $vehicle->next_service }}" class="border p-2 w-full" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
