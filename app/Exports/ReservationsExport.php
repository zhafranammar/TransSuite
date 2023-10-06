<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationsExport implements FromCollection, WithHeadings
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
            'User Approval 1',
            'User Approval 2',
            'Driver',
            'Start Date',
            'End Date',
            'Status',
            'Message',
        ];
    }

    /**
     * Return the data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reservation::all()->map(function ($reservation) {
            return [
                $reservation->vehicle_id,
                $reservation->user_approval1_id,
                $reservation->user_approval2_id,
                $reservation->driver_id,
                $reservation->start_date,
                $reservation->end_date,
                $reservation->status,
                $reservation->message,
            ];
        });
    }
}
