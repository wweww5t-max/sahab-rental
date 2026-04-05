@extends('layouts.app')

@section('title', 'إنشاء عقد جديد')

@section('content')

<h2>إنشاء عقد جديد</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
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

    <label>تاريخ بداية العقد:</label>
    <input type="date" id="start_date" name="start_date">

    <label>تاريخ نهاية العقد:</label>
    <input type="date" id="end_date" name="end_date">

    <label>السعر الشهري:</label>
    <input type="number" step="0.01" id="daily_rate" name="daily_rate">

    <label>الإجمالي:</label>
    <input type="number" id="total_amount" name="total_amount" readonly>

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

<script>
function calculateTotal() {
    let start = document.getElementById('start_date').value;
    let end = document.getElementById('end_date').value;
    let price = document.getElementById('daily_rate').value;

    if (start && end && price) {
        let startDate = new Date(start);
        let endDate = new Date(end);

        let days = (endDate - startDate) / (1000 * 60 * 60 * 24) + 1;

        if (days > 0) {
            let total = days * price;
            document.getElementById('total_amount').value = total;
        }
    }
}

document.getElementById('start_date').addEventListener('change', calculateTotal);
document.getElementById('end_date').addEventListener('change', calculateTotal);
document.getElementById('daily_rate').addEventListener('input', calculateTotal);
</script>