<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // عرض السيارات
    public function index()
{
    $vehicles = Vehicle::all();

    $available = Vehicle::where('status', 'available')->count();
    $rented = Vehicle::where('status', 'rented')->count();
    $maintenance = Vehicle::where('status', 'maintenance')->count();

    return view('vehicles.index', compact(
        'vehicles',
        'available',
        'rented',
        'maintenance'
    ));
}
    public function create()
    {
        return view('vehicles.create');
    }

    // حفظ سيارة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50',
            'year' => 'nullable|integer',
            'color' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'status' => 'required|string',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'تم إضافة السيارة بنجاح');
    }

    // صفحة تعديل السيارة
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    // تحديث السيارة
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'plate_number' => 'required|string|max:50',
            'year' => 'nullable|integer',
            'color' => 'nullable|string|max:100',
            'chassis_number' => 'nullable|string|max:100',
            'status' => 'required|string',
        ]);

        $vehicle->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'plate_number' => $request->plate_number,
            'year' => $request->year,
            'color' => $request->color,
            'chassis_number' => $request->chassis_number,
            'status' => $request->status,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'تم تعديل السيارة بنجاح');
    }

    // حذف السيارة
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'تم حذف السيارة');
    }
}