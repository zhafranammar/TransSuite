<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="container mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                         <!-- Grafik Reservasi per Bulan -->
                        <div class="mb-6">
                            <h3 class="text-lg mb-2">Reservasi per Bulan</h3>
                            <canvas id="reservationsChart" class="w-full h-auto max-w-lg max-h-lg"></canvas>
                        </div>

                        <!-- Grafik Kendaraan yang Diservis per Bulan -->
                        <div class="mb-6">
                            <h3 class="text-lg mb-2">Kendaraan Diservis per Bulan</h3>
                            <canvas id="vehiclesServiceChart" class="w-full h-auto max-w-lg max-h-lg"></canvas>
                        </div>

                        <!-- Grafik 3 -->
                        <div class="bg-white p-4 rounded shadow">
                            <h2 class="text-xl font-bold mb-4">Status Reservasi</h2>
                            <canvas id="reservationsStatus" class="w-full h-64"></canvas>
                        </div>

                        <!-- Grafik 4 -->
                        <div class="bg-white p-4 rounded shadow">
                            <h2 class="text-xl font-bold mb-4">Status Kendaraan</h2>
                            <canvas id="vehicleStatus" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Script untuk menggambar grafik -->
<script>
    // Grafik 1: Reservasi per Bulan
    var ctx1 = document.getElementById('reservationsChart').getContext('2d');
    var reservationsPerMonthChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($reservationsPerMonth->pluck('month')),
            datasets: [{
                label: 'Reservasi per Bulan',
                data: @json($reservationsPerMonth->pluck('count')),
                borderColor: 'blue',
                fill: false
            }]
        }
    });

    // Grafik 2: Kendaraan yang Diservis per Bulan
    var ctx2 = document.getElementById('vehiclesServiceChart').getContext('2d');
    var vehiclesServiceChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: @json($vehiclesService->pluck('month')),
            datasets: [{
                label: 'Kendaraan Diservis',
                data: @json($vehiclesService->pluck('count')),
                backgroundColor: 'red'
            }]
        }
    });

    // Grafik 3: Status Reservasi
    var ctx3 = document.getElementById('reservationsStatus').getContext('2d');
    var reservationsStatusChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: @json($reservationsStatus->pluck('status')),
            datasets: [{
                label: 'Jumlah',
                data: @json($reservationsStatus->pluck('count')),
                backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple']
            }]
        }
    });

    // Grafik 4: Status Kendaraan
    var ctx4 = document.getElementById('vehicleStatus').getContext('2d');
    var vehicleStatusChart = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: @json($vehicleStatus->pluck('status')),
            datasets: [{
                label: 'Jumlah',
                data: @json($vehicleStatus->pluck('count')),
                backgroundColor: ['red', 'blue', 'green', 'yellow', 'purple']
            }]
        }
    });
</script>

