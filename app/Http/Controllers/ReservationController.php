<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query();

        // Search logic
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('message', 'like', $searchTerm);
        }

        // Sort logic
        if ($request->has('sort')) {
            $direction = $request->has('direction') ? $request->direction : 'desc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->latest(); // Default sorting
        }

        $reservations = $query->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $managers = Role::findByName('manager')->users;
        $supervisors = Role::findByName('supervisor')->users;
        $drivers = User::all();
        return view('reservations.create', compact('vehicles', 'managers', 'supervisors', 'drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            'user_approval1_id' => 'required|integer|exists:users,id',
            'user_approval2_id' => 'required|integer|exists:users,id',
            'driver_id' => 'required|integer|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'pending', // Add any specific validation if needed
            'message' => 'nullable|string',
        ]);

        Reservation::create($data);

        return redirect()->route('reservations.index')->with('success', 'Reservation added successfully!');
    }

    public function edit(Reservation $reservation)
    {
        $vehicles = Vehicle::all();
        $managers = Role::findByName('manager')->users;
        $supervisors = Role::findByName('supervisor')->users;
        $drivers = User::all();
        return view('reservations.edit', compact('reservation', 'vehicles', 'managers', 'supervisors', 'drivers'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'vehicle_id' => 'integer|exists:vehicles,id',
            'user_approval1_id' => 'integer|exists:users,id',
            'user_approval2_id' => 'integer|exists:users,id',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
            'status' => 'string', // Add any specific validation if needed
            'message' => 'nullable|string',
        ]);

        $reservation->update($data);

        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully!');
    }

    public function show(Reservation $reservation)
    {
        $vehicles = Vehicle::all();
        $managers = Role::findByName('manager')->users;
        $supervisors = Role::findByName('supervisor')->users;
        $drivers = User::all();
        return view('reservations.show', compact('reservation', 'vehicles', 'managers', 'supervisors', 'drivers'));
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully!');
    }

    public function approval_by_supervisor(Reservation $reservation)
    {
        // Check if the logged-in user is the designated supervisor for this reservation
        if (auth()->id() !== $reservation->user_approval1_id) {
            return redirect()->back()->with('error', 'You do not have permission to approve this reservation.');
        }

        $reservation->update([
            'status' => 'approved_by_supervisor',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation approved by supervisor!');
    }

    public function approval_by_manager(Reservation $reservation)
    {
        // Check if the logged-in user is the designated manager for this reservation
        if (auth()->id() !== $reservation->user_approval2_id) {
            return redirect()->back()->with('error', 'You do not have permission to approve this reservation.');
        }

        $reservation->update([
            'status' => 'approved',
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation approved by manager!');
    }

    public function reject(Reservation $reservation, Request $request)
    {
        // Check if the logged-in user is either the designated supervisor or manager for this reservation
        if (auth()->id() !== $reservation->user_approval1_id && auth()->id() !== $reservation->user_approval2_id) {
            return redirect()->back()->with('error', 'You do not have permission to reject this reservation.');
        }

        $data = $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        $reservation->update([
            'status' => 'rejected',
            'message' => $data['rejection_reason'],
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation rejected!');
    }

    public function exportToExcel()
    {
        return Excel::download(new ReservationsExport, 'reservations.xlsx');
    }

    public function dashboard()
    {
        // Grafik Reservasi per Bulan
        $reservationsPerMonth = DB::table('reservations')
            ->select(DB::raw('MONTH(start_date) as month'), DB::raw('COUNT(id) as count'))
            ->whereYear('start_date', now()->year)
            ->groupBy(DB::raw('MONTH(start_date)'))
            ->get();

        $reservationsPerMonth = $reservationsPerMonth->map(function ($item) {
            $item->month = $this->monthNumberToShortName($item->month);
            return $item;
        });

        // Grafik Kendaraan yang Diservis per Bulan
        $vehiclesService = DB::table('vehicles')
            ->select(DB::raw('MONTH(next_service) as month'), DB::raw('COUNT(id) as count'))
            ->whereYear('next_service', now()->year)
            ->groupBy(DB::raw('MONTH(next_service)'))
            ->get();

        $vehiclesService = $vehiclesService->map(function ($item) {
            $item->month = $this->monthNumberToShortName($item->month);
            return $item;
        });

        // Grafik Status Reservasi
        $reservationsStatus = DB::table('reservations')
            ->select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        // Grafik Status Kendaraan
        $vehicleStatus = DB::table('vehicles')
            ->select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        return view('dashboard', compact('reservationsPerMonth', 'vehiclesService', 'reservationsStatus', 'vehicleStatus'));
    }

    function monthNumberToShortName($monthNumber)
    {
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ];

        return $months[$monthNumber] ?? null;
    }
}
