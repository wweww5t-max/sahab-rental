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
public function pdf(Contract $contract)
{
    $contract->load(['customer', 'vehicle']);

    $html = '
    <h1>عقد رقم: ' . $contract->contract_number . '</h1>
    <p>العميل: ' . ($contract->customer->full_name ?? '-') . '</p>
    <p>السيارة: ' . ($contract->vehicle->brand ?? '-') . '</p>
    <p>الإجمالي: ' . $contract->total_amount . '</p>
    ';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    return response(
        $mpdf->Output('contract.pdf', 'I'),
        200
    )->header('Content-Type', 'application/pdf');
}