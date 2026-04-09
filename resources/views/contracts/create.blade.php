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
            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                {{ $customer->full_name }}
            </option>
        @endforeach
    </select>

    <label>السيارة:</label>
    <select name="vehicle_id">
        <option value="">اختر السيارة</option>
        @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->brand }} - {{ $vehicle->model }} ({{ $vehicle->plate_number }})
            </option>
        @endforeach
    </select>

    <label>تاريخ بداية العقد:</label>
    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}">

    <label>تاريخ نهاية العقد:</label>
    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">

    <label>السعر الشهري:</label>
    <input type="number" step="0.01" id="monthly_rate" name="monthly_rate" value="{{ old('monthly_rate') }}">

    <label>الإجمالي:</label>
    <input type="number" step="0.01" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" readonly>

    <label>الشروط:</label>
    <textarea name="terms">{{ old('terms') }}</textarea>

    <label>الحالة:</label>
    <select name="status">
        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>active</option>
        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>closed</option>
    </select>

    <br><br>
    <button type="submit">حفظ العقد</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const rateInput = document.getElementById('monthly_rate');
    const totalInput = document.getElementById('total_amount');

    function calculateTotal() {
        const start = startInput.value;
        const end = endInput.value;
        const rate = parseFloat(rateInput.value || 0);

        if (!start || !end || !rate) {
            totalInput.value = '';
            return;
        }

        const startDate = new Date(start);
        const endDate = new Date(end);

        let months =
            (endDate.getFullYear() - startDate.getFullYear()) * 12 +
            (endDate.getMonth() - startDate.getMonth()) + 1;

        if (months <= 0) {
            totalInput.value = '';
            return;
        }

        totalInput.value = (months * rate).toFixed(2);
    }

    startInput.addEventListener('change', calculateTotal);
    endInput.addEventListener('change', calculateTotal);
    rateInput.addEventListener('input', calculateTotal);

    calculateTotal();
});
</script>