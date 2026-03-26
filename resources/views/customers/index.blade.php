@extends('layouts.app')

@section('title', 'العملاء')

@section('content')
    <h1>قائمة العملاء</h1>

    <a href="{{ route('customers.create') }}" class="btn btn-primary">➕ إضافة عميل</a>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <tr>
            <th>الاسم</th>
            <th>رقم الهوية</th>
            <th>الجوال</th>
            <th>الرخصة</th>
            <th>الجنسية</th>
        </tr>

        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->full_name }}</td>
                <td>{{ $customer->national_id }}</td>
                <td>{{ $customer->mobile }}</td>
                <td>{{ $customer->license_number }}</td>
                <td>{{ $customer->nationality }}</td>
            </tr>
        @endforeach
    </table>
@endsection