@extends('layouts.app')

@section('title', 'العقود')

@section('content')

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
    }

    .create-btn {
        background: #2563eb;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
        text-align: right;
    }

    th {
        background: #f9fafb;
    }

    .btn {
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-size: 12px;
    }

    .btn-edit {
        background: #f59e0b;
    }

    .btn-pdf {
        background: #2563eb;
    }

    .status-active {
        color: green;
        font-weight: bold;
    }

    .status-closed {
        color: red;
        font-weight: bold;
    }
</style>

<div class="page-header">
    <h1>قائمة العقود</h1>

    <a href="{{ route('contracts.create') }}" class="create-btn">
        + إنشاء عقد
    </a>
</div>

@if(session('success'))
    <div style="background:#dcfce7; padding:10px; margin-bottom:10px; border-radius:5px;">
        {{ session('success') }}
    </div>
@endif

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
            <th>إجراء</th>
        </tr>
    </thead>

    <tbody>
    @foreach($contracts as $contract)
        <tr>
            <td>{{ $contract->contract_number }}</td>

            <td>{{ $contract->customer->full_name ?? '-' }}</td>

            <td>
                {{ $contract->vehicle->brand ?? '-' }}
                {{ $contract->vehicle->model ?? '' }}
            </td>

            <td>{{ $contract->start_date }}</td>
            <td>{{ $contract->end_date }}</td>

            <td>{{ number_format($contract->total_amount, 2) }}</td>

            <td>
    @if($contract->status == 'active')
        <span class="status-active">ساري</span>

        <form action="{{ route('contracts.close', $contract->id) }}" method="POST" style="display:inline;">
            @csrf
            <button style="background:red;color:white;border:none;padding:5px 10px;margin-top:5px;">
                إنهاء
            </button>
        </form>

    @else
        <span class="status-closed">منتهي</span>
    @endif
</td>

            <td>
                <a href="{{ route('contracts.pdf', $contract) }}" class="btn btn-pdf">
                    تحميل
                </a>
            </td>

            <td>
                <a href="{{ route('contracts.edit', $contract) }}" class="btn btn-edit">
                    تعديل
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

@endsection