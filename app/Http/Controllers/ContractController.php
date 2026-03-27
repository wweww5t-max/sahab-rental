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

    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }
}

   public function create()
    {
        $customers = Customer::latest()->get();
        $vehicles = Vehicle::where('status', 'available')->latest()->get();

        return view('contracts.create', compact('customers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
    'customer_id' => ['required', 'exists:customers,id'],
    'vehicle_id' => ['required', 'exists:vehicles,id'],
    'start_date' => ['required', 'date'],
    'end_date' => ['required', 'date', 'after_or_equal:start_date'],
    'daily_rate' => ['required', 'numeric', 'min:0'],
    'discount_amount' => ['nullable', 'numeric', 'min:0'],
    'terms' => ['nullable', 'string'],
    'status' => ['required', 'string', 'max:255'],
]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $rentDays = $startDate->diffInDays($endDate) + 1;
        $subtotal = $rentDays * $request->daily_rate;
        $discount = $request->discount_amount ?? 0;
        $vatAmount = ($subtotal - $discount) * 0.15;
        $totalAmount = ($subtotal - $discount) + $vatAmount;

        $lastContract = Contract::latest()->first();
        $nextNumber = 1;

        if ($lastContract && $lastContract->contract_number) {
            $lastNumber = (int) str_replace('CTR-', '', $lastContract->contract_number);
            $nextNumber = $lastNumber + 1;
        }

        $contractNumber = 'CTR-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

      Contract::create([
    'contract_number' => $contractNumber,
    'customer_id' => $request->customer_id,
    'vehicle_id' => $request->vehicle_id,
    'user_id' => auth()->id(),
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'rent_days' => $rentDays,
    'daily_rate' => $request->daily_rate,
    'subtotal' => $subtotal,
    'vat_amount' => $vatAmount,
    'discount_amount' => $discount,
    'total_amount' => $totalAmount,
    'terms' => $request->terms,
    'status' => $request->status,
]);

        Vehicle::findOrFail($request->vehicle_id)->update([
            'status' => 'rented',
        ]);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'تم إضافة العقد بنجاح');
    }

    public function show(Contract $contract)
    {
        //
    }

    public function edit(Contract $contract)
    {
        //
    }

    public function update(Request $request, Contract $contract)
    {
        //
    }

    public function destroy(Contract $contract)
    {
        //
    }

  public function pdf(Contract $contract)
{
    $contract->load(['customer', 'vehicle']);

    $safe = function ($v) {
        return htmlspecialchars((string) ($v ?? '-'), ENT_QUOTES, 'UTF-8');
    };

    $statusText = $contract->status === 'active'
        ? 'ساري'
        : ($contract->status === 'closed' ? 'منتهي' : $contract->status);

    $statusColor = $contract->status === 'active' ? '#15803d' : '#b91c1c';

  $termsText = nl2br($safe(
    "1- يلتزم المستأجر بالمحافظة على المركبة طوال مدة العقد.
2- يتحمل المستأجر جميع المخالفات المرورية والأضرار الناتجة عن الاستخدام.
3- يمنع استخدام المركبة في أي نشاط مخالف للأنظمة والتعليمات.
4- يجب إعادة المركبة في التاريخ المحدد وبنفس حالتها.
5- يحق للمؤسسة الرجوع على المستأجر بأي مبالغ أو التزامات مترتبة."
));
    $contractUrl = url('/contracts/' . $contract->id);

    $logoHtml = '';
    $logoPath = public_path('logo.png');
    if (file_exists($logoPath)) {
        $logoHtml = '<img src="' . $logoPath . '" style="height:70px;">';
    }

    $stampHtml = '';
    $stampPath = public_path('stamp.png');
    if (file_exists($stampPath)) {
        $stampHtml = '<img src="' . $stampPath . '" style="height:75px;">';
    }

    $signatureHtml = '';
    $signaturePath = public_path('signature.png');
    if (file_exists($signaturePath)) {
        $signatureHtml = '<img src="' . $signaturePath . '" style="height:35px;"><br>';
    }

    $qrHtml = '';
    $qrPath = public_path('qr.png');
    if (file_exists($qrPath)) {
        $qrHtml = '<img src="' . $qrPath . '" style="height:90px;"><br>';
    } else {
        $qrHtml = '<div style="font-size:11px; color:#666;">رابط التحقق:<br>' . $safe($contractUrl) . '</div>';
    }

    $html = '
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: dejavusans;
                direction: rtl;
                text-align: right;
                font-size: 12px;
                color: #111827;
            }

            .page {
                border: 2px solid #1f2937;
                padding: 16px;
            }

            .header-table,
            .info-table,
            .signature-table,
            .terms-table,
            .verify-table {
                width: 100%;
                border-collapse: collapse;
            }

            .header-table td {
                border: none;
                vertical-align: middle;
            }

            .company-name {
                font-size: 26px;
                font-weight: bold;
                text-align: center;
                color: #111827;
            }

            .company-subtitle {
                font-size: 14px;
                text-align: center;
                color: #4b5563;
                margin-top: 4px;
            }

            .contract-badge {
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                background: #f3f4f6;
                border: 1px solid #d1d5db;
                padding: 8px;
            }

            .divider {
                border-top: 2px solid #111827;
                margin: 10px 0 14px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 12px;
            }

            td {
                border: 1px solid #1f2937;
                padding: 7px;
                text-align: right;
                direction: ltr;
                vertical-align: middle;
            }

            .section {
                background: #e5e7eb;
                text-align: center;
                font-weight: bold;
                font-size: 13px;
                direction: rtl;
            }

            .label {
                background: #f9fafb;
                font-weight: bold;
                width: 20%;
                direction: rtl;
            }

            .value {
                width: 30%;
            }

            .status {
                font-weight: bold;
                color: ' . $statusColor . ';
            }

            .money {
                font-size: 16px;
                font-weight: bold;
            }

            .terms {
                direction: rtl;
                text-align: right;
                line-height: 1.9;
                font-size: 12px;
                padding: 10px;
            }

            .signature-box {
                height: 95px;
                text-align: center;
                vertical-align: bottom;
                direction: rtl;
                font-weight: bold;
            }

            .verify-box {
                text-align: center;
                direction: rtl;
                padding: 10px;
            }

            .footer {
                margin-top: 10px;
                font-size: 10px;
                color: #6b7280;
                text-align: center;
            }

            .small-note {
                font-size: 10px;
                color: #6b7280;
                text-align: center;
                margin-top: 4px;
            }
        </style>
    </head>
    <body>

        <div class="page">

            <table style="width:100%; border:none; margin-bottom:5px;">
    <tr>
        <td style="width:20%; text-align:right; border:none;">
            <img src="'.public_path('logo.png').'" style="height:60px;">
        </td>

        <td style="width:80%; text-align:center; border:none;">
            <div style="font-size:22px; font-weight:bold; white-space:nowrap;">
                مؤسسة سحاب لتأجير السيارات
            </div>
            <div style="font-size:12px; color:#555;">
               
            </div>
        </td>
    </tr>
</table>

            <div class="divider"></div>

            <div class="contract-badge">عقد تأجير سيارة</div>

            <br>

            <table class="info-table">
                <tr>
                    <td colspan="4" class="section">بيانات العقد</td>
                </tr>
                <tr>
                    <td class="label">رقم العقد</td>
                    <td class="value">' . $safe($contract->contract_number) . '</td>
                    <td class="label">حالة العقد</td>
                    <td class="value status">' . $safe($statusText) . '</td>
                </tr>
                <tr>
                    <td class="label">تاريخ البداية</td>
                    <td class="value">' . $safe($contract->start_date) . '</td>
                    <td class="label">تاريخ النهاية</td>
                    <td class="value">' . $safe($contract->end_date) . '</td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td colspan="4" class="section">بيانات العميل</td>
                </tr>
                <tr>
                    <td class="label">الاسم</td>
                    <td class="value">' . $safe($contract->customer->full_name ?? '-') . '</td>
                    <td class="label">الجوال</td>
                    <td class="value">' . $safe($contract->customer->mobile ?? '-') . '</td>
                </tr>
                <tr>
                    <td class="label">رقم الهوية</td>
                    <td class="value">' . $safe($contract->customer->national_id ?? '-') . '</td>
                    <td class="label">نوع الرخصة</td>
                    <td class="value">' . $safe($contract->customer->license_number ?? '-') . '</td>
                </tr>
                <tr>
                    <td class="label">تاريخ الميلاد</td>
                    <td class="value">' . $safe($contract->customer->birth_date ?? '-') . '</td>
                    <td class="label">الجنسية</td>
                    <td class="value">' . $safe($contract->customer->nationality ?? '-') . '</td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td colspan="4" class="section">بيانات السيارة</td>
                </tr>
                <tr>
                    <td class="label">الماركة</td>
                    <td class="value">' . $safe($contract->vehicle->brand ?? '-') . '</td>
                    <td class="label">الموديل</td>
                    <td class="value">' . $safe($contract->vehicle->model ?? '-') . '</td>
                </tr>
                <tr>
                    <td class="label">اللوحة</td>
                    <td class="value">' . $safe($contract->vehicle->plate_number ?? '-') . '</td>
                    <td class="label">السنة</td>
                    <td class="value">' . $safe($contract->vehicle->year ?? '-') . '</td>
                </tr>
                <tr>
                    <td class="label">اللون</td>
                    <td class="value">' . $safe($contract->vehicle->color ?? '-') . '</td>
                    <td class="label">رقم الهيكل</td>
                    <td class="value">' . $safe($contract->vehicle->chassis_number ?? '-') . '</td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td colspan="4" class="section">التفاصيل المالية</td>
                </tr>
                <tr>
                    <td class="label">الإجمالي</td>
                    <td class="value money">' . $safe(number_format((float) ($contract->total_amount ?? 0), 2)) . '</td>
                    <td class="label">الخصم</td>
                    <td class="value">' . $safe(number_format((float) ($contract->discount_amount ?? 0), 2)) . '</td>
                </tr>
            </table>

           <table class="terms-table">
    <tr>
        <td class="section">الشروط والأحكام</td>
    </tr>
    <tr>
        <td class="terms">' . $termsText . '</td>
    </tr>
</table>

            <table class="signature-table">
                <tr>
                    <td colspan="2" class="section">التوقيع والختم</td>
                </tr>
                <tr>
                    <td class="signature-box">
                        توقيع العميل
                        <br><br>
                        __________________
                    </td>
                    <td class="signature-box">
                        توقيع المؤسسة
                        <br><br>
                        ' . $signatureHtml . '
                        ' . $stampHtml . '
                    </td>
                </tr>
            </table>

            

            <div class="footer">
                تم إنشاء هذا العقد إلكترونياً بواسطة نظام مؤسسة سحاب لتأجير السيارات
            </div>

        </div>

    </body>
    </html>
    ';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    return response(
        $mpdf->Output('contract-' . $contract->contract_number . '.pdf', 'I'),
        200
    )->header('Content-Type', 'application/pdf');
}
    public function close(Contract $contract)
    {
        $contract->update([
            'status' => 'closed',
        ]);

        $contract->vehicle->update([
            'status' => 'available',
        ]);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'تم إنهاء العقد بنجاح');
    }
}