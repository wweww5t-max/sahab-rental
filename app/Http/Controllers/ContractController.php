<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $customers = Customer::latest()->get();
        $vehicles = Vehicle::where('status', 'available')->latest()->get();

        return view('contracts.create', compact('customers', 'vehicles'));
    }

    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());

        return redirect()->route('contracts.index')
            ->with('success', 'تم التعديل');
    }
}
