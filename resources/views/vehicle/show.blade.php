<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  <!-- Title -->
                  <h2 class="text-2xl mb-4">Detail Kendaraan #{{$vehicle->id}}</h2>
                  <!-- Name Input -->
                  <div class="mb-4">
                      <label for="name" class="block">Name:</label>
                      <input type="text" name="name" id="name" value="{{ $vehicle->name }}" class="border p-2 w-full bg-gray-200" disabled>
                  </div>

                  <!-- Police Number Input -->
                  <div class="mb-4">
                      <label for="police_number" class="block">Police Number:</label>
                      <input type="text" name="police_number" id="police_number" value="{{ $vehicle->police_number }}" class="border p-2 w-full bg-gray-200" disabled>
                  </div>

                  <!-- Status Input -->
                  <div class="mb-4">
                      <label for="status" class="block">Status:</label>
                      <input type="text" name="status" id="status" value="{{ $vehicle->status }}" class="border p-2 w-full bg-gray-200" disabled>
                  </div>

                  <!-- Next Service Input -->
                  <div class="mb-4">
                      <label for="next_service" class="block">Next Service:</label>
                      <input type="date" name="next_service" id="next_service" value="{{ $vehicle->next_service }}" class="border p-2 w-full bg-gray-200" disabled>
                  </div>

                  <a href="{{ route('vehicle.edit', $vehicle->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                      Edit
                  </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
