@extends('layouts.app')

@section('title', 'العقود')

@section('content')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 30px;
            color: #111827;
        }

        .create-btn {
            background: #0f172a;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .create-btn:hover {
            opacity: 0.92;
        }

        .success-box {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 18px;
        }

        .contracts-table-wrap {
            overflow-x: auto;
        }

        .contracts-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        .contracts-table th {
            background: #f3f4f6;
            color: #111827;
            font-weight: bold;
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: right;
            font-size: 14px;
        }

        .contracts-table td {
            padding: 14px 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .contracts-table tr:hover td {
            background: #fafafa;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-closed {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }

        .pdf-btn {
            background: #2563eb;
        }

        .close-btn {
            background: #15803d;
        }

        .empty-box {
            text-align: center;
            padding: 20px;
            color: #6b7280;
        }
    </style>

    <div class="contracts-table-wrap">
<table class="contracts-table">

    <thead>
        <tr>
            <th>رقم العقد</th>
            <th>إجراء</th>
        </tr>
    </thead>

   <tbody>
@foreach($contracts as $contract)
<tr>
    <td>{{ $contract->contract_number }}</td>

    <td>
        <a href="{{ route('contracts.edit', $contract) }}">
            تعديل
        </a>
    </td>
</tr>
@endforeach
</tbody>

</table>
</div>

    <div class="contracts-table-wrap">
        <table class="contracts-table">
            <thead>
                <tr>
                    <th>رقم العقد</th>
                    <th>العميل</th>
                    <th>السيارة</th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>أنشأ بواسطة</th>
                    <th>PDF</th>
                    <th>إجراء</th>
                </tr>
            </thead>

            <tbody>
                @forelse($contracts as $contract)
                    <tr>
                        <td>{{ $contract->contract_number }}</td>
                        <td>{{ $contract->customer->full_name ?? '-' }}</td>
                        <td>{{ ($contract->vehicle->brand ?? '-') . ' - ' . ($contract->vehicle->model ?? '-') }}</td>
                        <td>{{ $contract->start_date }}</td>
                        <td>{{ $contract->end_date }}</td>
                        <td>{{ $contract->total_amount }}</td>

                        <td>
                            @if($contract->status === 'active')
                                <span class="badge badge-active">ساري</span>
                            @else
                                <span class="badge badge-closed">منتهي</span>
                            @endif
                        </td>

                        <td>{{ $contract->user->name ?? '-' }}</td>

                        <td>
                            <a href="{{ route('contracts.pdf', $contract->id) }}" target="_blank" class="action-btn pdf-btn">
                                تحميل
                            </a>
                        </td>

                        <td>
                            @if($contract->status === 'active')
                                <form action="{{ route('contracts.close', $contract->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn close-btn">إنهاء العقد</button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="empty-box">لا توجد عقود حالياً</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection