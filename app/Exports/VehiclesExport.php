<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehiclesExport implements FromCollection, WithHeadings
{
    /**
     * Define the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Vehicle ID',
            'name',
            'police_number',
            'status',
            'next_service',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Vehicle::all()->map(function ($vehicle) {
            return [
                $vehicle->id,
                $vehicle->name,
                $vehicle->police_number,
                $vehicle->status,
                $vehicle->next_service
            ];
        });
    }
}
