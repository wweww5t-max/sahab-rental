<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->get();

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|string|max:255',
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number',
            'color' => 'nullable|string|max:255',
            'chassis_number' => 'nullable|string|max:255',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
        ]);

        Vehicle::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'plate_number' => $request->plate_number,
            'color' => $request->color,
            'chassis_number' => $request->chassis_number,
            'daily_rate' => $request->daily_rate,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'تم إضافة السيارة بنجاح');
    }

    public function show(Vehicle $vehicle)
    {
        //
    }

    public function edit(Vehicle $vehicle)
    {
        //
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    public function destroy(Vehicle $vehicle)
    {
        //
    }
}