@extends('layouts.app')

@section('content')

<div class="page-card">
    <div class="section-head">
        <div>
            <h2 class="page-title">قائمة العقود</h2>
            <p class="page-subtitle"></p>
        </div>

        <a href="{{ route('contracts.create') }}" class="btn btn-primary">+ إنشاء عقد جديد</a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; margin:20px 0 24px 0;">
        <div style="background:linear-gradient(135deg,#3b82f6,#1d4ed8); color:white; padding:18px; border-radius:16px; text-align:center;">
            <div style="font-size:14px;">إجمالي العقود</div>
            <div style="font-size:30px; font-weight:bold; margin-top:6px;">{{ $contracts->count() }}</div>
        </div>

        <div style="background:linear-gradient(135deg,#10b981,#059669); color:white; padding:18px; border-radius:16px; text-align:center;">
            <div style="font-size:14px;">العقود السارية</div>
            <div style="font-size:30px; font-weight:bold; margin-top:6px;">{{ $contracts->where('status', 'active')->count() }}</div>
        </div>

        <div style="background:linear-gradient(135deg,#f59e0b,#d97706); color:white; padding:18px; border-radius:16px; text-align:center;">
            <div style="font-size:14px;">العقود المنتهية</div>
            <div style="font-size:30px; font-weight:bold; margin-top:6px;">{{ $contracts->where('status', 'closed')->count() }}</div>
        </div>

        <div style="background:linear-gradient(135deg,#6366f1,#4338ca); color:white; padding:18px; border-radius:16px; text-align:center;">
            <div style="font-size:14px;">إجمالي الإيرادات</div>
            <div style="font-size:30px; font-weight:bold; margin-top:6px;">{{ number_format($contracts->sum('total_amount'), 2) }}</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>رقم العقد</th>
                    <th>العميل</th>
                    <th>السيارة</th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>PDF</th>
                    <th>الإجراء</th>
                </tr>
            </thead>

            <tbody>
                @forelse($contracts as $contract)
                <tr>
                    <td>{{ $contract->contract_number }}</td>
                    <td>{{ $contract->customer->full_name ?? '-' }}</td>
                    <td>{{ $contract->vehicle->brand ?? '-' }} {{ $contract->vehicle->model ?? '' }}</td>
                    <td>{{ $contract->start_date }}</td>
                    <td>{{ $contract->end_date }}</td>
                    <td>{{ number_format($contract->total_amount, 2) }}</td>
                    <td>
                        @if($contract->status == 'active')
                            <span class="status-active">ساري</span>
                        @else
                            <span class="status-closed">منتهي</span>
                        @endif
                    </td>
                    <td>
                       <a href="{{ route('contracts.print', $contract->id) }}" target="_blank" class="btn btn-primary">
    تحميل العقد
</a>
                    <td>
                        <div class="actions">
                            <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-warning">تعديل</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="padding:30px; text-align:center; color:#64748b; font-weight:bold;">
                        لا توجد عقود حالياً
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection