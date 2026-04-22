<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mpdf\Mpdf;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['customer', 'vehicle'])->latest()->get();
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

    public function close($id)
    {
        $contract = Contract::findOrFail($id);

        $contract->update([
            'status' => 'closed'
        ]);

        // يرجع السيارة متاحة
        Vehicle::where('id', $contract->vehicle_id)->update([
            'status' => 'available'
        ]);

        return redirect()->back()->with('success', 'تم إنهاء العقد');
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());

        return redirect()->route('contracts.index')
            ->with('success', 'تم التعديل');
    }

   
   public function pdf($id)
{
    $contract = \App\Models\Contract::findOrFail($id);

    $html = view('contracts.pdf', compact('contract'))->render();

    $mpdf = new Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'dejavusans',
    ]);

    $mpdf->WriteHTML($html);

    return response(
        $mpdf->Output('', 'S'),
        200,
        [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="contract-'.$contract->contract_number.'.pdf"'
        ]
    );
}
public function print(Contract $contract)
{
    $contract->load(['customer', 'vehicle']);
    return view('contracts.print', compact('contract'));
}

public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'vehicle_id' => 'required|exists:vehicles,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'monthly_rate' => 'required|numeric|min:0',
    ]);

    $start = \Carbon\Carbon::parse($request->start_date);
    $end = \Carbon\Carbon::parse($request->end_date);

    $rentDays = $start->diffInDays($end) + 1;

    $months = (($end->year - $start->year) * 12) + ($end->month - $start->month) + 1;

    $subtotal = $months * $request->monthly_rate;
    $vatAmount = 0;
    $discountAmount = 0;

    $total = $subtotal + $vatAmount - $discountAmount;

    try {

        $contract = Contract::create([
            'contract_number' => 'CTR-' . str_pad((string) (Contract::count() + 1), 6, '0', STR_PAD_LEFT),
            'customer_id' => $request->customer_id,
            'vehicle_id' => $request->vehicle_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rent_days' => $rentDays,
            'daily_rate' => $request->monthly_rate,
            'subtotal' => $subtotal,
            'vat_amount' => $vatAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $total,
            'terms' => $request->terms,
            'status' => $request->status ?? 'active',
        ]);

    } catch (\Exception $e) {
        dd($e->getMessage());
    }

    Vehicle::where('id', $request->vehicle_id)->update([
        'status' => 'rented',
    ]);

    return redirect()->route('contracts.index')
        ->with('success', 'تم إنشاء العقد بنجاح');
}
}