<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehiclesExport;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Search logic
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                ->orWhere('police_number', 'like', $searchTerm);
        }

        // Sort logic
        if ($request->has('sort')) {
            $direction = $request->has('direction') ? $request->direction : 'desc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->latest(); // Default sorting
        }

        $vehicle = $query->paginate(10);

        return view('vehicle.index', compact('vehicle'));
    }

    // Create
    public function create()
    {
        return view('vehicle.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'police_number' => 'required|string|max:255|unique:vehicles,police_number',
            'status' => 'required|in:active,maintenance,booked,in_use,inactive',
            'next_service' => 'required|date',
        ]);

        Vehicle::create($data);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle added successfully!');
    }

    // Edit
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'police_number' => 'string|max:255',
            'status' => 'in:active,maintenance,booked,in_use,inactive',
            'next_service' => 'date',
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully!');
    }

    // Show
    public function show(Vehicle $vehicle)
    {
        return view('vehicle.show', compact('vehicle'));
    }

    // Delete (assuming you have this method)
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully!');
    }

    public function exportToExcel()
    {
        return Excel::download(new VehiclesExport, 'vehicle.xlsx');
    }
}
