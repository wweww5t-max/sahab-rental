@extends('layouts.app')

@section('title', 'إنشاء عقد')

@section('content')
    <h1>إنشاء عقد جديد</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf

        <label>العميل:</label>
        <select name="customer_id">
            <option value="">اختر العميل</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->full_name }}</option>
            @endforeach
        </select>

        <label>السيارة:</label>
        <select name="vehicle_id">
            <option value="">اختر السيارة</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">
                    {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->plate_number }})
                </option>
            @endforeach
        </select>

        <label>تاريخ البداية:</label>
        <input type="date" name="start_date">

        <label>تاريخ النهاية:</label>
        <input type="date" name="end_date">

        <label>السعر اليومي:</label>
        <input type="number" step="0.01" name="daily_rate">

        <label>خصم:</label>
        <input type="number" step="0.01" name="discount_amount">

        <label>الشروط:</label>
        <textarea name="terms"></textarea>

        <label>الحالة:</label>
        <select name="status">
            <option value="active">active</option>
            <option value="closed">closed</option>
        </select>

        <br><br>
        <button type="submit">حفظ العقد</button>
    </form>
@endsection