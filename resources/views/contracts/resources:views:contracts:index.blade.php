@extends('layouts.app')

@section('title', 'العقود')

@section('content')
<h1>قائمة العقود</h1>

<a href="{{ route('contracts.create') }}">➕ إنشاء عقد</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
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

    @foreach($contracts as $contract)
    <tr>
        <td>{{ $contract->contract_number }}</td>
        <td>{{ $contract->customer->full_name }}</td>
        <td>{{ $contract->vehicle->brand }} - {{ $contract->vehicle->model }}</td>
        <td>{{ $contract->start_date }}</td>
        <td>{{ $contract->end_date }}</td>
        <td>{{ $contract->total_amount }}</td>
        <td>{{ $contract->status }}</td>
        <td>
            <a href="{{ route('contracts.pdf', $contract->id) }}" target="_blank">تحميل PDF</a>
        </td>
        <td>
            @if($contract->status === 'active')
                <form action="{{ route('contracts.close', $contract->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">إنهاء العقد</button>
                </form>
            @else
                -
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection