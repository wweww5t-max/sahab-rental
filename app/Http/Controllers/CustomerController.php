<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id' => 'required|string|max:255|unique:customers,national_id',
            'mobile' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Customer::create([
            'full_name' => $request->full_name,
            'national_id' => $request->national_id,
            'mobile' => $request->mobile,
            'license_number' => $request->license_number,
            'nationality' => $request->nationality,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'تم إضافة العميل بنجاح');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
{
    return view('customers.edit', compact('customer'));
}


    public function update(Request $request, Customer $customer)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'national_id' => 'nullable|string|max:50',
        'license_number' => 'nullable|string|max:50',
        'birth_date' => 'nullable|date',
        'nationality' => 'nullable|string|max:100',
    ]);

    $customer->update([
        'full_name' => $request->full_name,
        'mobile' => $request->mobile,
        'national_id' => $request->national_id,
        'license_number' => $request->license_number,
        'birth_date' => $request->birth_date,
        'nationality' => $request->nationality,
    ]);

    return redirect()->route('customers.index')->with('success', 'تم تعديل العميل بنجاح');
}

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'تم حذف العميل بنجاح');
    }
}